<?php
namespace app\modules\user\components\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * User group rule class.
 */
class UserGroupRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'user';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            foreach($role as $access) {
                if ($item->name === 'admin') {
                    return $access === $item->name;
                } elseif ($item->name === 'user') {
                    return $access === $item->name || $access === 'admin';
                } elseif ($item->name === 'edit') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'exec_cmd') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'manage') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'deny') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'view') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'group_edit') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'group_exec_cmd') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'group_manage') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'group_deny') {
                    return $access === $item->name || $access === 'user';
                } elseif ($item->name === 'group_view') {
                    return $access === $item->name || $access === 'user';
                }
            }
        }
        return false;
    }
}