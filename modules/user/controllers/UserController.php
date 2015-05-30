<?php

namespace app\modules\user\controllers;

use app\commons\AbstractController;
use app\commons\AbstractPages;
use app\commons\Url;
use app\modules\user\forms\SignupForm;
use app\modules\user\models\User;
use app\modules\user\models\UserSearch;
use app\modules\user\forms\LoginForm;
use app\modules\wialon\models\Wialon;
use app\modules\wialon\models\WialonError;
use yii\filters\AccessControl;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Class UserController
 * @package app\modules\user\controllers
 */
class UserController extends AbstractController
{
	const PAGE_PROFILE = 'profile';

	public function actionIndex()
	{
		$this->currentPages = AbstractPages::PAGES_USERS;

		/** @var UserSearch $userSearch */
		$userSearch = new UserSearch();

		return $this->render('index', [
			'users' => $userSearch->search()->getModels(),
		]);
	}

    /**
     * @return string
     */
    public function actionCreate()
    {
        $this->currentPages = AbstractPages::PAGES_USERS_CREATE;

        $signUpForm = new SignupForm();

        return $this->processForm($signUpForm);
    }

    /**
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (empty($id)) {
            throw new NotFoundHttpException();
        }
        // показать старый пароль?
        $showOldPassField = true;

        /** @var User $modelUser */
        $modelUser = User::findOne([
            'id' => $id
        ]);

        $signUpForm = new SignupForm();
        $signUpForm->setAttributes($modelUser->getAttributes());
        $signUpForm->setAccess($modelUser->getAccessRules());
        $signUpForm->setUser($modelUser);

        return $this->processForm($signUpForm, $showOldPassField);
    }

    /**
     * @param SignupForm $modelForm
     *
     * @return string|\yii\web\Response
     */
    private function processForm($modelForm, $flag = false)
    {
        if (Yii::$app->getRequest()->getIsPost()) {
            if ($modelForm->load(Yii::$app->getRequest()->post())) {
                if ($modelForm->save()) {
                    if ($flag === false) {
                        Yii::$app->getSession()->setFlash('success', Yii::t('main', 'Пользователь добавлен'));
                    } elseif ($flag === true) {
                        Yii::$app->getSession()->setFlash('success', Yii::t('main', 'Пользователь отредактирован'));
                    } elseif ($flag === self::PAGE_PROFILE) {
                        Yii::$app->getSession()->setFlash('success', Yii::t('main', 'Ваши данные успешно изменены'));
                        return $this->redirect(Url::toRoute('view-profile'));
                    }

                    return $this->redirect(Url::toRoute('index'));
                } else {
                    if ($flag === false) {
                        Yii::$app->getSession()->setFlash('error', Yii::t('main', 'Вы допустили ошибки при добавлении пользователя'));
                    } elseif ($flag === true) {
                        Yii::$app->getSession()->setFlash('error', Yii::t('main', 'Вы допустили ошибки при редактировании пользователя'));
                    } elseif ($flag === self::PAGE_PROFILE) {
                        Yii::$app->getSession()->setFlash('error', Yii::t('main', 'Вы допустили ошибки при редактировании личных данных'));
                    }
                }
            }
        }

        return $this->render($flag === self::PAGE_PROFILE ? 'profile' : 'form', [
            'modelForm' => $modelForm,
            'showOldPass' => $flag
        ]);
    }

    /**
     * Delete user
     */
    public function actionDelete($id)
    {
        if (empty($id)) {
            throw new NotFoundHttpException();
        }

        /** @var User $modelUser */
        $modelUser = User::findOne([
            'id' => $id
        ]);

		if($modelUser && isset($modelUser->wialon_user_id)) {
			return $this->redirect(Url::to('/user/user'));
		} else {
			$modelUser->delete();
			Yii::$app->getSession()->setFlash('success', Yii::t('main', 'Пользователь удалён'));

            return $this->redirect(Url::toRoute('index'));
        }
    }

    /**
     * Page with user profile
     */
    public function actionViewProfile()
    {
        $user = Yii::$app->user->identity;
        $signUpForm = new SignupForm();
        $signUpForm->setAttributes($user->getAttributes());
        $signUpForm->setSettings($user->getFlagMasks());
        $signUpForm->setAccess($user->getAccessRules());
        $signUpForm->setPassword('');
        $signUpForm->setPasswordRepeat('');
        $signUpForm->setUser($user);

		return $this->processForm($signUpForm, self::PAGE_PROFILE);
	}

}
