<?php

namespace app\modules\main\controllers;

use app\commons\AbstractController;
use app\modules\objects\models\Object;
use app\modules\user\forms\SignupForm;
use Yii;
use yii\console\Exception;
use yii\web\UploadedFile;

/**
 * Class FileController
 * @package app\modules\main\controllers
 */
class FileController extends AbstractController
{
	/**
	 * @return array
	 */
//	public function behaviors()
//	{
//		return [
//			'access' => [
//				'class' => AccessControl::className(),
//				'rules' => [
//					[
//						'actions' => ['upload-files', 'delete-files', 'upload-image',],
//						'allow'   => true,
//						'roles'   => [User::ROLE_USER],
//					],
//				],
//			]
//		];
//	}

	/**
	 * @return array
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * @return array
	 * @throws Exception
	 */
	public function actionUploadImage()
	{

		$model = Yii::$app->getRequest()->post('Object') ? new Object() : new SignupForm();

		/** @var UploadedFile $file */
		$file = UploadedFile::getInstance($model, Yii::$app->getRequest()->post('Object') ? 'icon' : 'file');

		$model->setPhoto($file);

		if ($model->validate(['file'])) {
			$file->saveAs(Yii::$app->params['uploads']['images'] . $file->name);

			return $this->respondJSON([
				'filePath' => Yii::$app->params['uploads']['images'] . $file->name,
			]);
		} else {
			throw new Exception(join('<br/>', $model->getErrors('file')));
		}
	}

}
