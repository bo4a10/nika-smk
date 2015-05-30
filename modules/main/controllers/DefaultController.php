<?php

namespace app\modules\main\controllers;

use app\commons\AbstractController;
use app\commons\Lang;
use app\commons\LangUrlManager;
use app\commons\Url;
use app\modules\admin\models\Settings;
use Yii;
use yii\base\NotSupportedException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Class DefaultController
 * @package app\modules\main\controllers
 */
class DefaultController extends AbstractController
{
	/**
	 * @return string
	 */
	public function actionIndex()
	{
		if (Yii::$app->getUser()->getIsGuest()) {
			return $this->redirect(Url::to('/login'));
		}
		return $this->render('index', []);

	}

	/**
	 * @return string
	 */
	public function actionAbout()
	{
		$modelSettings = Settings::find()->one();
		if ( !$modelSettings) {
			$modelSettings = new Settings();
		}

		return $this->render('about', [
			'modelSettings' => $modelSettings,
		]);
	}
}
