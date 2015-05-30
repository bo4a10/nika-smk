<?php


namespace app\commons;


use app\modules\user\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class AdminController
 * @package app\commons
 */
class AdminController extends Controller
{
	const PAGES_USERS      = AbstractPages::PAGES_USERS;
	const PAGES_USER_GROUPS = AbstractPages::PAGES_USER_GROUPS;
	const PAGES_CURRENCY   = AbstractPages::PAGES_CURRENCY;
	const PAGES_PROJECTS   = AbstractPages::PAGES_PROJECTS;

	public $layout       = "//admin";
	public $pageTitle    = '';
	public $breadcrumbs  = [];
	public $currentPages = AbstractPages::PAGES_USERS;

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => [User::ROLE_MODERATOR],
					],
				],
			]
		];
	}

	/**
	 * @return array
	 */
	protected function respondJSON($data = [])
	{
		\Yii::$app->response->format = 'json';

		return $data;
	}
} 