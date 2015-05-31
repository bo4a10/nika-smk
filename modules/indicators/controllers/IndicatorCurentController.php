<?php

namespace app\modules\indicators\controllers;

use app\commons\AbstractPages;
use Yii;
use app\modules\indicators\models\IndicatorCurrent;
use app\modules\indicators\models\IndicatorCurrentSearch;
use app\commons\AbstractController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndicatorCurentController implements the CRUD actions for IndicatorCurrent model.
 */
class IndicatorCurentController extends AbstractController
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
     * Lists all IndicatorCurrent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->currentPages = AbstractPages::PAGES_FC_ADD_CURRENT_INDICATORS;

        $searchModel = new IndicatorCurrentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new IndicatorCurrent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->currentPages = AbstractPages::PAGES_FC_ADD_CURRENT_INDICATORS;

        $model = new IndicatorCurrent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing IndicatorCurrent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->currentPages = AbstractPages::PAGES_FC_ADD_CURRENT_INDICATORS;
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
     * Deletes an existing IndicatorCurrent model.
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
     * Finds the IndicatorCurrent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndicatorCurrent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IndicatorCurrent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
