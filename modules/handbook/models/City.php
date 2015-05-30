<?php

namespace app\modules\handbook\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $city_name
 *
 * @property FootballClub[] $footballClubs
 * @property Stadium[] $stadia
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_name'], 'required'],
            [['city_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFootballClubs()
    {
        return $this->hasMany(FootballClub::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStadia()
    {
        return $this->hasMany(Stadium::className(), ['city_id' => 'id']);
    }
}
