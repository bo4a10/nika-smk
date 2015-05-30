<?php

namespace app\modules\user\controllers;

use app\modules\user\models\User;
use app\modules\user\models\UserSearch;
use Yii;
use app\modules\user\models\UserGroup;
use app\modules\user\models\UserGroupSearch;
use app\commons\AbstractController;
use app\commons\AbstractPages;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseJson;

/**
 * UserGroupController implements the CRUD actions for UserGroup model.
 */
class UserGroupController extends AbstractController
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

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
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->currentPages = AbstractPages::PAGES_USER_GROUPS;

        $searchModel = new UserGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->currentPages = AbstractPages::PAGES_USER_GROUPS_CREATE;

        $model = new UserGroup();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $params = Yii::$app->getRequest()->getBodyParams();

            return $model->saveGroup($params);
        } else {
            return $this->renderForms($model, self::SCENARIO_CREATE);
        }
    }

    /**
     * Updates an existing UserGroup model.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->setOldListUser($model->getGroupsUser());

        if ($model->load(Yii::$app->request->post()) && $model->validate() && Yii::$app->request->isAjax) {
            $params = Yii::$app->getRequest()->getBodyParams();

            return $model->saveGroup($params);
        }

        return $this->renderForms($model, self::SCENARIO_UPDATE);
    }

    /**
     * Deletes an existing UserGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->request->isPost) {
            $model = $this->findModel($id);
            $usersIn = $model->getGroupsUser();

            return $this->respondJSON(['success' => $model->deleteGroup($usersIn)]);
        }

        return false;
    }

    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Render form to create or update user group
     *
     * @param object $model
     * @param string $flag
     * @return mixed
     */
    private function renderForms($model, $flag)
    {
        if ($flag === self::SCENARIO_UPDATE) {
            $model->listUser = $model->getUsersInGroup();
            $model->access = explode(',', $model->access);
        }

        $userSearch = new User();
        $users = $userSearch->getAllUsersByCreator();

        return $this->renderAjax('_form', [
            'model'         => $model,
            'users'         => $users,
        ]);
    }

    /**
     * Ajax validation method
     */
    public function actionAjaxValidate()
    {
        $model = new UserGroup();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}
