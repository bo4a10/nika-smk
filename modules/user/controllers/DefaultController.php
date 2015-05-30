<?php

namespace app\modules\user\controllers;

use app\commons\AbstractController;
use app\commons\Url;
use app\modules\user\forms\LoginForm;
use app\modules\user\forms\PasswordResetRequestForm;
use app\modules\wialon\models\Wialon;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class DefaultController
 * @package app\modules\user\controllers
 */
class DefaultController extends AbstractController
{
	/**
	 * @return string
	 */
	public function actionLogin()
	{
		$this->layout = '//blank';

		$loginForm = new LoginForm();

		if (Yii::$app->getRequest()->getIsPost()) {
			if ($loginForm->load(Yii::$app->getRequest()->post()) && $loginForm->login()) {
				return $this->redirect(Url::to('/handbook/city'));
			}
		}

		return $this->render('login', [
			'loginForm' => $loginForm
		]);
	}

	/**
	 * @return \yii\web\Response
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->redirect(Url::to('/login'));
	}

	/**
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionResetPassword()
	{
		$this->layout = '//blank';

		$passwordResetRequestForm = new PasswordResetRequestForm();

		if (Yii::$app->getRequest()->getIsPost()) {
			if ($passwordResetRequestForm->load(Yii::$app->getRequest()->post()) && $passwordResetRequestForm->reset()) {
				return $this->redirect(Url::to('/'));
			}
		}

		return $this->render('resetPassword', [
			'passwordResetRequestForm' => $passwordResetRequestForm
		]);
	}
}
