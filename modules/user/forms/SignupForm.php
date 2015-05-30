<?php
namespace app\modules\user\forms;

use app\commons\AbstractForm;
use app\modules\user\models\User;
use app\modules\user\models\UserSettings;
use Yii;
use yii\base\Model;
use yii\db\Exception;

/**
 * Signup form
 */
class SignupForm extends AbstractForm
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $username;
    public $full_name;
    public $email;
    public $password;
    public $passwordRepeat;
    public $position;
    public $phone;
    public $skype;
    public $photo;
    public $access;
    public $user;
    public $file;
    public $oldPassword;

    private $oldSettings = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'full_name', 'position', 'skype'], 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            [
                'username',
                'unique',
                'targetClass' => 'app\modules\user\models\User',
                'message' => Yii::t('main', 'Это имя пользователя уже занято'),
                'when' => function ($model, $attribute) {
                    /**@var SignupForm $model */
                    if ($user = $model->getUser()) {
                        /**@var User $user */
                        return $user->getUsername() != $model->getUsername();
                    }

                    return true;
                }
            ],
            ['username', 'string', 'min' => 3, 'max' => 255],
            [['email', 'full_name'], 'required'],
            ['email', 'email'],
            [
                'email',
                'unique',
                'targetClass' => 'app\modules\user\models\User',
                'message' => Yii::t('main', 'Этот адрес электронной почты уже занят'),
                'when' => function ($model, $attribute) {
                    /**@var SignupForm $model */
                    if ($user = $model->getUser()) {
                        /**@var User $user */
                        return $user->getEmail() != $model->getEmail();
                    }

                    return true;
                }
            ],
            [
                'password',
                'required',
                'when' => function ($model, $attribute) {
                    /**@var SignupForm $model */
                    return !$model->getUser();
                }
            ],
            ['password', 'string', 'min' => 6],
            [
                'passwordRepeat',
                'required',
                'when' => function ($model, $attribute) {
                    if ($model->password !== '') {
                        return true;
                    }
                    /**@var SignupForm $model */
                    return !$model->getUser();
                }
            ],
            [
                'passwordRepeat',
                'compare',
                'compareAttribute' => 'password',
                'message' => Yii::t('main', 'Пароли не совпадают'),
                'when' => function ($model, $attribute) {
                    /**@var SignupForm $model */
                    if ($user = $model->getUser()) {
                        /**@var User $user */
                        return $model->getPassword();
                    }

                    return true;
                }
            ],
            [
                'oldPassword',
                'required',
                'when' => function ($model, $attribute) {
                    if ($model->getUser() && ($model->password !== '' || $model->passwordRepeat)) {
                        return true;
                    }
                }
            ],
            ['passwordRepeat', 'required', 'on' => 'insert'],
            ['oldPassword', 'required', 'on' => 'insert'],
            [['full_name', 'position', 'photo'], 'string', 'max' => 255],
            [['phone', 'skype'], 'string', 'max' => 32],
            [['access'], 'required', 'message' => Yii::t('main', 'Укажите права доступа пользователя')],
            [
                ['file'],
                'file',
                'extensions' => Yii::$app->params['files']['extensions'],
                'maxSize' => Yii::$app->params['files']['maxFileSizes'],
                'tooBig' => Yii::t('error', 'Файл «{file}» слишком большой. Размер не должен превышать 2Мбайт'),
            ],
            [['position', 'phone', 'skype', 'photo', 'access'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'       => Yii::t('main', 'Логин'),
            'full_name'      => Yii::t('main', 'ФИО'),
            'position'       => Yii::t('main', 'Должность'),
            'email'          => Yii::t('main', 'E-Mail'),
            'phone'          => Yii::t('main', 'Телефон'),
            'skype'          => Yii::t('main', 'Скайп'),
            'password'       => Yii::t('main', 'Пароль'),
            'passwordRepeat' => Yii::t('main', 'Повторите пароль'),
            'status'         => Yii::t('main', 'Статус'),
            'photo'          => Yii::t('main', 'Загрузить фото'),
            'oldPassword'    => Yii::t('main', 'Старый пароль'),

        ];
    }

    /**
     * Добавление нового пользователя
     * @return bool
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $user = $this->saveUser();
                if (!$user) {
                    return false;
                }

                $userSettings = $this->saveUserSettings($user);
                if (!$userSettings) {
                    return false;
                }

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();

                return false;
            }

            return true;
        }

        return false;
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
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * @param mixed $full_name
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password_hash
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }

    /**
     * @param mixed $passwordRepeat
     */
    public function setPasswordRepeat($passwordRepeat)
    {
        $this->passwordRepeat = $passwordRepeat;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param mixed $skype
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param mixed $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * Adding flag masks to user settings in database
     *
     * @param User $user
     *
     * @return bool
     */
    private function saveUserSettings($user)
    {
//        $addedSettings = array_diff($this->getSettings(), $this->oldSettings);
//        $removedSettings = $this->removeUserSettings();
//
//        foreach ($addedSettings as $flagMask) {
//            $oneSetting = new UserSettings();
//            $oneSetting->setUserId($user->getId());
//            $oneSetting->setFlagMask($flagMask);
//
//            $user->link('userSettings', $oneSetting);
//        }

        return true;
    }

    /**
     * Права доступа пользователя
     * @return array
     */
    public static function getUserAccess()
    {
        return [
            'deny'     => Yii::t('main', 'Доступ отсутствует'),
            'view'     => Yii::t('main', 'Просмотр'),
            'exec_cmd' => Yii::t('main', 'Выполнение команд'),
            'edit'     => Yii::t('main', 'Редактирование'),
            'manage'   => Yii::t('main', 'Управление'),
        ];
    }


    /**
     * Save user to database
     * @return User
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    private function saveUser()
    {
        $user = $this->getUser() ?: new User();
        $user->setAttributes($this->getAttributes());

        if (!$this->getUser()) {
            $user->setParentUserId(Yii::$app->getUser()->getId());
            $user->setPasswordHash(Yii::$app->security->generatePasswordHash($this->getPassword()));
            $user->generateAuthKey();
        }

        $user->save(false);

        return $user;
    }

    /**
     * Удаляет флаги настроек пользователя
     */
    private function removeUserSettings()
    {
        /** @var User $user */
        $user = $this->getUser();

        if (is_object($user)) {
            $removeSettings = array_diff($this->oldSettings, $this->getSettings());
            UserSettings::deleteAll([
                'flag_mask' => $removeSettings,
                'user_id' => $user->getId()
            ]);

            return $removeSettings;
        } else {
            return [];
        }
    }
}
