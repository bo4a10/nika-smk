<?php
namespace app\modules\user\forms;

use app\modules\user\models\User;
use Yii;
use yii\base\Model;

/**
 * Feedback form
 */
class FeedbackForm extends Model
{
	public $username;
	public $email;
	public $message;
	public $verifyCode;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['email', 'username'], 'filter', 'filter' => 'trim'],
			[['email', 'username', 'message'], 'required'],
			['email', 'email'],
			['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha', 'skipOnEmpty' => !Yii::$app->getUser()->getIsGuest()],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'username' => Yii::t('main', 'Имя и Фамилия'),
			'email'    => Yii::t('main', 'E-mail'),
			'message'  => Yii::t('main', 'Сообщение'),
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function send()
	{
		if ($this->validate()) {
			$send = Yii::$app->mailer->compose('feedback_' .  \app\commons\Lang::getCurrent()->getUrl(), [
				'user' => $this
			])
			                         ->setTo(Yii::$app->params['supportEmail'])
			                         ->setFrom([
				                         $this->email => 'Допомога.'
			                         ])
			                         ->setSubject(Yii::t('main', 'Обратная связь сайта "Допомога"'))
			                         ->send();

			return $send;
		}

		return $this->getErrors();
	}
}
