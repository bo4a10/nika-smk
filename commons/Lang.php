<?php

namespace app\commons;

use Yii;

/**
 * This is the model class for table "lang".
 *
 * @property integer $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property integer $default
 * @property integer $created_at
 * @property integer $updated_at
 */
class Lang extends AbstractActiveRecord
{
	//Переменная, для хранения текущего объекта языка
	public static $current = null;

	/**
	 * @return array
	 */
//    public function behaviors()
//    {
//        return [
//            'timestamp' => [
//                'class' => 'yii\behaviors\TimestampBehavior',
//                'attributes' => [
//                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
//                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
//                ],
//            ],
//        ];
//    }

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'lang';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['url', 'local', 'name', 'created_at', 'updated_at'], 'required'],
			[['default', 'created_at', 'updated_at'], 'integer'],
			[['url', 'local', 'name'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'         => 'ID',
			'url'        => 'Url',
			'local'      => 'Local',
			'name'       => 'Name',
			'default'    => 'Default',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		];
	}

	/*
	 * Получение текущего объекта языка
	 */
	static function getCurrent()
	{
		if (self::$current === null) {
			self::$current = self::getDefaultLang();
		}

		return self::$current;
	}

	/*
	 * Установка текущего объекта языка и локаль пользователя
	 */
	static function setCurrent($url = null)
	{
		$language           = self::getLangByUrl($url);
		self::$current      = ($language === null) ? self::getDefaultLang() : $language;
		Yii::$app->language = self::$current->local;
	}

	/*
	 * Получения объекта языка по умолчанию
	 */
	static function getDefaultLang()
	{
		return Lang::find()->where('lang.default = :default', [':default' => 1])->one();
	}

	/*
	 * Получения объекта языка по буквенному идентификатору
	 */
	static function getLangByUrl($url = null)
	{
		if ($url === null) {
			return null;
		} else {
			$language = Lang::find()->where('url = :url', [':url' => $url])->one();
			if ($language === null) {
				return null;
			} else {
				return $language;
			}
		}
	}

	function getUrl()
	{
		return $this->url;
	}
}
