<?php

namespace app\modules\user\forms;

use app\commons\AbstractForm;
use app\modules\user\models\User;
use app\modules\wialon\models\Wialon;
use app\modules\wialon\models\WialonError;
use Yii;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends AbstractForm
{
	public $username;
	public $password;
	public $rememberMe = true;

	private $_user = false;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'password' => 'Пароль',
			'username' => 'Пользователь',
		];
	}

	/**
	 * Logs in a user using the provided username and password.
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			$user    = $this->getUser();
			$isLogin = Yii::$app->user->login($user, $this->rememberMe ? Yii::$app->params['rememberMe'] : 0);

			if ($isLogin) {
				return $isLogin;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	/**
	 * Finds user by [[username]]
	 *
	 * @param [] $wialonResponse
	 *
	 * @return bool|null|User
	 */
	public function getUser()
	{
		if ($this->_user === false) {

			$this->_user = User::findByUsername($this->username);
		}

		return $this->_user;
	}


	/**
	 * Add user to db
	 *
	 * @param [] $wialonResponse
	 *
	 * @throws \yii\base\Exception
	 * @throws \yii\base\InvalidConfigException
	 */
	public function addUser($wialonResponse)
	{
		$this->_user = new User();
		$this->_user->setUsername($this->getUsername());
		$this->_user->setPasswordHash(Yii::$app->security->generatePasswordHash($this->getPassword()));
		$this->_user->setWialonUserId($wialonResponse['uid']);
		$this->_user->save(false);
	}

	/**
	 * @return mixed
	 */
	public function loginWialon()
	{
		$wialon = new Wialon(Yii::$app->params['wialon']['schema'], Yii::$app->params['wialon']['host']);
        
		return $wialon->login($this->username, $this->password);
	}

	/**
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username)
	{
		$this->username = $username;
	}

	/**
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @return boolean
	 */
	public function isRememberMe()
	{
		return $this->rememberMe;
	}

	/**
	 * @param boolean $rememberMe
	 */
	public function setRememberMe($rememberMe)
	{
		$this->rememberMe = $rememberMe;
	}
}
