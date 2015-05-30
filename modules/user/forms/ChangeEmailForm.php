<?php
namespace app\modules\user\forms;

use app\commons\AbstractForm;
use app\modules\user\models\User;
use Yii;

/**
 * Change Email Form
 */
class ChangeEmailForm extends AbstractForm
{
	public $oldEmail;
	public $email;
	public $emailRepeat;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['oldEmail', 'email', 'emailRepeat'], 'filter', 'filter' => 'trim'],
			[['oldEmail', 'email', 'emailRepeat'], 'required'],
			[['oldEmail', 'email', 'emailRepeat'], 'email'],
			[
				'email',
				'unique',
				'targetClass' => 'app\modules\user\models\User',
				'message'     => Yii::t('error', 'Этот адрес электронной почты уже есть в базе')
			],
			[
				'emailRepeat',
				'compare',
				'compareAttribute' => 'email',
				'message'          => Yii::t('error', 'E-mail не совпадают')
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'oldEmail'    => Yii::t('main', 'Нынешний адрес'),
			'email'       => Yii::t('main', 'Новый адрес'),
			'emailRepeat' => Yii::t('main', 'Подтвердить адрес'),
		];
	}

	/**
	 * @return User|array
	 */
	public function change()
	{
		if ($this->validate()) {
			/** @var User $user */
			$user = User::findByEmail($this->oldEmail);

			if ( !is_object($user)) {
				$this->addError('oldEmail', Yii::t('error', 'Такой E-mail отсутствует в базе'));

				return $this->getErrors();
			}

			$user->setEmail($this->email);
			$user->setStatus(User::STATUS_NO_ACTIVATE_EMAIL);
			$user->generateAuthKey();
			$user->save(false);

			$user->sendEmail($user->email, Yii::t('main', 'Изменение E-mail на сайте "Допомога"'), 'changeEmail_' . \app\commons\Lang::getCurrent()->getUrl(), [
				'user' => $user,
			]);

			return $user;
		}

		return $this->getErrors();
	}
}
