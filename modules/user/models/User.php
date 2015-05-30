<?php

namespace app\modules\user\models;

use app\commons\AbstractActiveRecord;
use app\modules\user\forms\SignupForm;
use app\modules\wialon\models\WialonAccess;
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $full_name
 * @property string $position
 * @property string $email
 * @property string $phone
 * @property string $skype
 * @property string $photo
 * @property string $auth_key
 * @property string $password_hash
 * @property integer $wialon_user_id
 * @property integer $status
 * @property integer $parent_user_id
 *
 * @property UserSettings[] $userSettings
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property User $parentUser
 * @property User[] $users
 */
class User extends AbstractActiveRecord implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_NO_ACTIVE = 2;
    const USER_ROLE = 'user';

    public $role;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'full_name', 'position', 'email', 'password_hash'], 'required'],
            [['status', 'wialon_user_id'], 'integer'],
            [['username', 'full_name', 'position', 'email', 'photo', 'password_hash'], 'string', 'max' => 255],
            [['phone', 'skype', 'auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'username'      => Yii::t('main', 'Логин'),
            'full_name'     => Yii::t('main', 'ФИО'),
            'position'      => Yii::t('main', 'Должность'),
            'email'         => Yii::t('main', 'E-Mail'),
            'phone'         => Yii::t('main', 'Телефон'),
            'skype'         => Yii::t('main', 'Скайп'),
            'password_hash' => Yii::t('main', 'Пароль'),
            'status'        => Yii::t('main', 'Статус'),
            'photo'         => 'Photo',
            'auth_key'      => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentUser()
    {
        return $this->hasOne(User::className(), ['id' => 'parent_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['parent_user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSettings()
    {
        return $this->hasMany(UserSettings::className(), ['user_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // setting user's role
        $access = [];
        $wialonRules = [];
        if (!empty(Yii::$app->getRequest()->post('SignupForm')['access'])) {
            $access = Yii::$app->getRequest()->post('SignupForm')['access'];
            $wialonRules = SignupForm::getUserAccess();
        }

        if (!empty($access)) {
            $auth = Yii::$app->authManager;
            $name = $this->role ? $this->role : self::USER_ROLE;
            $role = $auth->getRole($name);
            if (!$insert) {
                // revoke rule for user or for group
                foreach ($wialonRules as $key => $value) {
                    $auth->revoke($auth->getPermission($key), $this->id);
                }
                $auth->revoke($auth->getRole(self::USER_ROLE), $this->id);
            }
            $auth->assign($role, $this->id);

            // assign permissions
            foreach ($access as $permit) {
                $permit = Yii::$app->authManager->getPermission($permit);
                Yii::$app->authManager->assign($permit, $this->id);
            }
        }
    }

    /**
     *
     */
    public function afterFind()
    {
        parent::afterFind();

        $userRoles = [];
        $items = Yii::$app->authManager->getRolesByUser($this->id);
        foreach ($items as $item) {
            $userRoles[] = $item->name;
        }
        $this->role = $userRoles;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    public function getRolesUser($id)
    {
        $this->hasMany(AuthAssignment::className(), ['user_id' => 'id'])->where(['user_id' => $id]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])
                    ->viaTable('auth_assignment',['user_id' => 'id']);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     *
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     *
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $email
     * @param $subject
     * @param $view
     * @param array $params
     *
     * @return bool
     */
    public function sendEmail($email, $subject, $view, $params = [])
    {
        $send = Yii::$app->mailer->compose($view, $params)
                ->setTo($email)
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::t('main', 'Модуль AGRO')])
                ->setSubject($subject)
                ->send();

        return $send;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param string $skype
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $auth_key
     */
    public function setAuthKey($auth_key)
    {
        $this->auth_key = $auth_key;
    }

    /**
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    /**
     * @param string $password_hash
     */
    public function setPasswordHash($password_hash)
    {
        $this->password_hash = $password_hash;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getGroup()
    {
        return $this->user_group_id;
    }

    /**
     * @param int $user_group_id
     */
    public function setGroup($user_group_id)
    {
        $this->user_group_id = $user_group_id;
    }



    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     *
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param mixed $token
     * @param null $type
     *
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     *
     * @param string $authKey the given auth key
     *
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @return string
     */
    public function getPhotoPath()
    {
        return !empty($this->getPhoto()) ? $this->getPhoto() : '/img/user.png';
    }

    /**
     * @return int
     */
    public function getWialonUserId()
    {
        return $this->wialon_user_id;
    }

    /**
     * @param int $wialon_user_id
     */
    public function setWialonUserId($wialon_user_id)
    {
        $this->wialon_user_id = $wialon_user_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getFullName() ?: $this->getUsername();
    }

    /**
     * @return int
     */
    public function getParentUserId()
    {
        return $this->parent_user_id;
    }

    /**
     * @param int $parent_user_id
     */
    public function setParentUserId($parent_user_id)
    {
        $this->parent_user_id = $parent_user_id;
    }

    /**
     * @return array
     */
    public function getFlagMasks()
    {
        return ArrayHelper::getColumn($this->getUserSettings()->all(), 'flag_mask');
    }

    /**
     * Getting access rules for user index view
     * @return array
     */
    public function getAccessRules()
    {
        return ArrayHelper::getColumn($this->getAuthAssignments()->all(), 'item_name');
    }

    /**
     * Get users by creator
     */
    public function getAllUsersByCreator()
    {
        $users = self::find()->where([
                     'parent_user_id' => Yii::$app->getUser()->getId()
                 ]);
        return $users;
    }

    /**
     * Assign group permissions to users
     *
     * @param array $users
     * @param array $data
     * @return bool
     */
    public function assignGroupPermissions($users, $data)
    {
        $permissions = $data['UserGroup']['access'];
        if (!empty($permissions)) {
            $wialonRules = WialonAccess::getGroupAccess();
            $auth = Yii::$app->authManager;
            // delete wialon group permissions
            $revoke = $this->revokeAllPermissions($users);
            if (!$revoke) {
                return false;
            }
            // assign wialon group permissions
            foreach ($permissions as $permission) {
                $permission = Yii::$app->authManager->getPermission($permission);
                foreach ($users as $userId) {
                    $auth->assign($permission, $userId);
                }
            }

        }

        return true;
    }

    /**
     * Revoke all group permission from user if delete group or delete user from its group
     *
     * @param array $users
     * @return bool
     */
    public function revokeAllPermissions(array $users)
    {
        $auth = Yii::$app->authManager;
        $wialonGroupAccess = WialonAccess::getGroupAccess();
        try {
            foreach ($users as $userId) {
                foreach ($wialonGroupAccess as $permission => $v) {
                    $auth->revoke($auth->getPermission($permission), $userId);
                }
            }
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
