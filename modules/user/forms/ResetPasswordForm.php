<?php
namespace app\modules\user\forms;

use app\commons\AbstractForm;
use app\modules\user\models\User;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends AbstractForm
{
	public $oldPassword;
	public $password;
	public $passwordRepeat;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['oldPassword', 'password', 'passwordRepeat'], 'required'],
			[['oldPassword', 'password'], 'string', 'min' => 6],
			[
				'passwordRepeat',
				'compare',
				'compareAttribute' => 'password',
				'message'          => Yii::t('error', 'Пароли не совпадают')
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'oldPassword'    => Yii::t('main', 'Нынешний пароль'),
			'password'       => Yii::t('main', 'Новый пароль'),
			'passwordRepeat' => Yii::t('main', 'Подтвердите пароль'),
		];
	}

	/**
	 * Resets password.
	 *
	 * @return boolean if password was reset.
	 */
	public function resetPassword()
	{
		if ($this->validate()) {
			/** @var User $user */
			$user = User::findIdentity(Yii::$app->getUser()->getId());
			$user->setPassword($this->password);
			$user->save(false);

			$user->sendEmail($user->email, Yii::t('main', 'Изменение пароля на сайте "Допомога"'), 'resetPasswordRequest_' . \app\commons\Lang::getCurrent()->getUrl(), [
				'user'     => $user,
				'password' => $this->password
			]);

			return $user;
		}

		return $this->getErrors();
	}
}
