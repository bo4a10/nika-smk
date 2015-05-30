<?php
namespace app\modules\user\forms;

use app\commons\StringHelper;
use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
	public $email;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			[
				'email',
				'exist',
				'targetClass' => 'app\modules\user\models\User',
				'message'     => Yii::t('error', 'Такой E-mail отсутствует в базе')
			],
		];
	}

	/**
	 * Sends an email with a link, for resetting the password.
	 *
	 * @return boolean whether the email was send
	 */
	public function reset()
	{
		if ($this->validate()) {
			/** @var User $user */
			$user = User::findByEmail($this->email);

			if ( !is_object($user)) {
				$this->addError('email', Yii::t('error', 'Такой E-mail отсутствует в базе'));

				return $this->getErrors();
			}

			$password = StringHelper::getPassword();
			$user->setPassword($password);
			$user->save(false);

			$user->sendEmail($user->email, Yii::t('main', 'Восстановление пароля на сайте "Допомога"'), 'resetPassword_' . \app\commons\Lang::getCurrent()->getUrl(), [
				'user'     => $user,
				'password' => $password,
			]);

			return $user;
		}

		return $this->getErrors();
	}
}
