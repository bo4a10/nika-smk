<?php
namespace app\modules\user\components\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * User group rule class.
 */
class AdminGroupRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'admin';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $roles = Yii::$app->user->identity->role;
            foreach($roles as $role) {
                if ($item->name === 'superadmin') {
                    return $role === $item->name;
                } elseif ($item->name === 'admin') {
                    return $role === $item->name || $role === 'superadmin';
                } elseif ($item->name === 'moderator') {
                    return $role === $item->name || $role === 'superadmin' || $role === 'admin';
                } elseif ($item->name === 'user') {
                    return $role === $item->name || $role === 'superadmin' || $role === 'admin' || $role === 'moderator';
                } elseif ($item->name === 'view') {
                    return $role === $item->name || $role === 'superadmin' || $role === 'admin' || $role === 'moderator';
                }
            }
        }
        return false;
    }
}