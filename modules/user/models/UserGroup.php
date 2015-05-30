<?php

namespace app\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseJson;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $id
 * @property string $group_name
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $creator_id
 * @property string $access
 *
 * @property User[] $users
 */
class UserGroup extends \app\commons\AbstractActiveRecord
{
    public $listUser;
    private $_oldUsers;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_name', 'access'], 'required'],
            [['created_at', 'updated_at', 'creator_id'], 'integer'],
            [['group_name'], 'string', 'max' => 255],
            [['creator_id', 'listUser'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_name' => Yii::t('main', 'Название группы пользователей'),
            'created_at' => Yii::t('main', 'Дата добавления'),
            'updated_at' => Yii::t('main', 'Дата обновления'),
            'creator_id' => Yii::t('main', 'Создатель'),
            'access'     => Yii::t('main', 'Права доступа группы пользователей')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_group_id' => 'id']);
    }

    /**
     * Set creator_id for group
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->creator_id = Yii::$app->user->getId();
        $this->setAccess($this->access);

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * Getting access rules for user index view
     * @return array
     */
    public function getAccessRules()
    {
        return ArrayHelper::getColumn($this->getAuthAssignments()->all(), 'item_name');
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function setAccess($access)
    {
        return $this->access = (is_array($access)) ? implode(',', $access) : $access;
    }

    public function setOldListUser($list)
    {
        return $this->_oldUsers = $list;
    }

    public function getOldListUser()
    {
        return $this->_oldUsers;
    }

    public function setListUser($list)
    {
        return $this->listUser = BaseJson::decode($list);
    }

    public function getListUser()
    {
        return $this->listUser;
    }

    public function getGroupsUser()
    {
        return ArrayHelper::getColumn($this->getUsers()->all(), 'id');
    }

    /**
     * Updating user group
     *
     * @param mixed $params
     * @return bool
     */
    public function saveGroup($params)
    {
        $this->setListUser($params['UserGroup']['listUser']);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $group = $this->save();
            if (!$group) {
                return false;
            }

            $userSettings = $this->saveUsersWithGroups($params);
            if (!$userSettings) {
                return false;
            }

            $transaction->commit();

            return true;
        } catch (Exception $e) {
            $transaction->rollBack();

            return false;
        }
    }

    /**
     * Update users after making changes in group settings
     *
     * @return bool
     */
    public function saveUsersWithGroups($params)
    {
        $selected = ($params['selectedUsers'] !== '') ? explode(',', $params['selectedUsers']) : [];
        $unSelected = ($params['unSelectedUsers'] !== '') ? explode(',', $params['unSelectedUsers']) : [];
        $userModel = new User();

        // remove users from group
        if (!empty($unSelected)) {
            // revokeAll permissions to users
            $usersToRevokePermissions = User::findAll([
                'id'            => $unSelected,
                'user_group_id' => $this->id,
            ]);
            $usersToRevokePermissions = ArrayHelper::getColumn($usersToRevokePermissions, 'id');
            $userModel->revokeAllPermissions($usersToRevokePermissions);

            // update users which were unassigned from group
            User::updateAll(['user_group_id' => null], [
                'id'            => $unSelected,
                'user_group_id' => $this->id,
            ]);
        }

        // assign users to group
        if (!empty($selected)) {
            // update users which were assigned to group
            User::updateAll(['user_group_id' => $this->id], ['id' => $selected]);
            $assignSuccess = $userModel->assignGroupPermissions($selected, $params);
            if (!$assignSuccess) {
                return false;
            }
        }

        return true;
    }

    /**
     * Delete user group and remove groups rules from auth_assignment table
     *
     * @param array $users
     * @return bool
     */
    public function deleteGroup($users)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $userModel = new User();
            if (!empty($users)) {
                $rules = $userModel->revokeAllPermissions($users);
                if (!rules) {
                    return false;
                }
            }

            $this->delete();

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();

            return false;
        }

        return true;
    }

    /**
     * Get users in this group when updating group
     */
    public function getUsersInGroup()
    {
        $result = User::find()->select('id')
            ->where(['parent_user_id' => Yii::$app->user->getId()])
            ->andWhere(['user_group_id' => $this->id])
            ->all();

        return BaseJson::encode(ArrayHelper::getColumn($result, 'id'));
    }
}
