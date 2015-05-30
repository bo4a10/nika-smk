<?php
namespace app\commands;

use app\modules\user\components\rbac\AdminGroupRule;
use app\modules\user\components\rbac\UserGroupRule;
use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;

/**
 * RBAC console controller.
 */
class RbacController extends Controller
{
	/**
	 * Initial RBAC action
	 *
	 * @param integer $id Admin ID
	 */
	public function actionInit($id = null)
	{
		$auth = new DbManager;
		$auth->init();

		$auth->removeAll(); //удаляем старые данные
		// Rules
		$groupRule = new AdminGroupRule();

		$auth->add($groupRule);

		// Role Admin
		$admin              = $auth->createRole('admin');
		$admin->description = 'Администраторы';
		$admin->ruleName    = $groupRule->name;
		$auth->add($admin);

		// Admin assignments
		if ($id !== null) {
			$auth->assign($admin, $id);
		}

		//Role User
		$groupRule = new UserGroupRule();

		$auth->add($groupRule);

		$user              = $auth->createRole('user');
		$user->description = 'Пользователи';
		$user->ruleName    = $groupRule->name;
		$auth->add($user);

		// Creating rules for users
		$view              = $auth->createPermission('view');
		$view->description = 'Просмотр';
		$view->ruleName    = $user->ruleName;
		$auth->add($view);

		$deny              = $auth->createPermission('deny');
		$deny->description = 'Доступ отсутствует';
		$deny->ruleName    = $user->ruleName;
		$auth->add($deny);

		$exec_cmd              = $auth->createPermission('exec_cmd');
		$exec_cmd->description = 'Выполнение команд';
		$exec_cmd->ruleName    = $user->ruleName;
		$auth->add($exec_cmd);

		$manage              = $auth->createPermission('manage');
		$manage->description = 'Управление';
		$manage->ruleName    = $user->ruleName;
		$auth->add($manage);

		$edit              = $auth->createPermission('edit');
		$edit->description = 'Редактирование';
		$edit->ruleName    = $user->ruleName;
		$auth->add($edit);

		//Creating rules for users group
		$view              = $auth->createPermission('group_view');
		$view->description = 'Просмотр';
		$view->ruleName    = $user->ruleName;
		$auth->add($view);

		$deny              = $auth->createPermission('group_deny');
		$deny->description = 'Доступ отсутствует';
		$deny->ruleName    = $user->ruleName;
		$auth->add($deny);

		$exec_cmd              = $auth->createPermission('group_exec_cmd');
		$exec_cmd->description = 'Выполнение команд';
		$exec_cmd->ruleName    = $user->ruleName;
		$auth->add($exec_cmd);

		$manage              = $auth->createPermission('group_manage');
		$manage->description = 'Управление';
		$manage->ruleName    = $user->ruleName;
		$auth->add($manage);

		$edit              = $auth->createPermission('group_edit');
		$edit->description = 'Редактирование';
		$edit->ruleName    = $user->ruleName;
		$auth->add($edit);
	}
}