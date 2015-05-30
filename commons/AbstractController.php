<?php


namespace app\commons;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;


/**
 * Class AbstractController
 * @package app\commons
 */
class AbstractController extends Controller
{
	const PAGES_USERS      = AbstractPages::PAGES_USERS;
	const PAGES_USER_GROUPS = AbstractPages::PAGES_USER_GROUPS;
	const PAGES_CURRENCY   = AbstractPages::PAGES_CURRENCY;
	const PAGES_PROJECTS   = AbstractPages::PAGES_PROJECTS;

	public $pageTitle    = '';
	public $breadcrumbs  = [];
	public $currentPages = '';

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
						'actions' => ['login', 'reset-password'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['login', 'reset-password'],
						'allow' => false,
						'roles' => ['@'],
					],
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => ['get'],
				],
			],
		];
	}

	/**
	 *
	 */
	public function init()
	{
		parent::init();
	}

	/**
	 * @return array
	 */
	public function actions()
	{
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			]
		];
	}

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	protected function respondJSON($data = [])
	{
		\Yii::$app->response->format = 'json';

		return $data;
	}

	/**
	 * Общий метод добавления или редактирования данных для всех справочников в модальном окне
	 * @param $model
	 * @param string $view
	 * @return array|string|Response
	 */
	protected function actionChange($model, $view = '_form')
	{
		if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$model->save();
		} else {
			return $this->renderAjax($view, [
				'model' => $model
			]);
		}

		return $this->redirect(['index']);
	}
}