<?php

namespace app\modules\indicators\controllers;

use app\commons\AbstractPages;
use Yii;
use app\modules\indicators\models\IndicatorLimit;
use app\modules\indicators\models\IndicatorLimitSearch;
use app\commons\AbstractController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndicatorLimitController implements the CRUD actions for IndicatorLimit model.
 */
class IndicatorLimitController extends AbstractController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all IndicatorLimit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->currentPages = AbstractPages::PAGES_INDICATORS_MIN_MAX;

        $searchModel = new IndicatorLimitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new IndicatorLimit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->currentPages = AbstractPages::PAGES_INDICATORS_MIN_MAX;
        $model = new IndicatorLimit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IndicatorLimit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->currentPages = AbstractPages::PAGES_INDICATORS_MIN_MAX;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IndicatorLimit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IndicatorLimit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndicatorLimit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IndicatorLimit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
