<?php


namespace app\commons;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class AbstractActiveRecord
 * @package app\commons
 */
class AbstractActiveRecord extends ActiveRecord
{
	public $createdFormatAt;
	public $updatedFormatAt;

	/**
//	 * @inheritdoc
//	 */
//	public function behaviors()
//	{
//		return [
//			TimestampBehavior::className(),
//		];
//	}

	public function afterFind()
	{
		parent::afterFind();

		if ($this->hasAttribute('created_at') && $this->hasProperty('createdFormatAt')) {
			$this->createdFormatAt = date("d.m.Y", $this->created_at);
		}

		if ($this->hasAttribute('updated_at') && $this->hasProperty('updatedFormatAt')) {
			$this->updatedFormatAt = date("d.m.Y", $this->updated_at);
		}
	}

	/**
	 * @return bool
	 */
	public function beforeValidate()
	{
		if (parent::beforeValidate()) {
			if ($this->hasAttribute('alias') && empty($this->alias)) {
				$random = substr(md5(rand()), 0, 7);
				$title  = 'title_' . \app\commons\Lang::getCurrent()->getUrl();
				if ( !empty($this->{$title})) {
					$this->setAlias($random . '-' . LocoTranslitFilter::cyrillicToLatin($this->{$title}));
				} elseif ( !empty($this->title)) {
					$this->setAlias($random . '-' . LocoTranslitFilter::cyrillicToLatin($this->title));
				}
			}

			return true;
		}

		return false;
	}

	/**
	 * @return mixed
	 */
	public function getCreatedFormatAt()
	{
		return $this->createdFormatAt;
	}

	/**
	 * @param mixed $createdFormatAt
	 */
	public function setCreatedFormatAt($createdFormatAt)
	{
		$this->createdFormatAt = $createdFormatAt;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedFormatAt()
	{
		return $this->updatedFormatAt;
	}

	/**
	 * @param mixed $updatedFormatAt
	 */
	public function setUpdatedFormatAt($updatedFormatAt)
	{
		$this->updatedFormatAt = $updatedFormatAt;
	}

	public static function getArrayIdName($data)
	{
		$result = [];

		foreach($data as $value) {
			$result[$value['id']] = $value['name'];
		}

		return  $result;
	}
}