<?php

namespace app\modules\handbook\models;

use Yii;

/**
 * This is the model class for table "football_club".
 *
 * @property integer $id
 * @property string $fc_name
 * @property integer $city_id
 * @property integer $stadium_id
 *
 * @property City $city
 * @property Stadium $stadium
 * @property IndicatorValue[] $indicatorValues
 */
class FootballClub extends \yii\db\ActiveRecord
{
    public $city_name;
    public $stadium_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'football_club';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fc_name'], 'required'],
            [['city_id', 'stadium_id'], 'integer'],
            [['fc_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fc_name' => 'Футбольный клуб',
            'city_id' => 'Город',
            'stadium_id' => 'Стадион',
            'city_name' => 'Город',
            'stadium_name' => 'Стадион'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStadium()
    {
        return $this->hasOne(Stadium::className(), ['id' => 'stadium_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicatorValues()
    {
        return $this->hasMany(IndicatorValue::className(), ['fc_id' => 'id']);
    }

    public function getAllCity()
    {
        $query = City::find()->select('id, city_name')->all();
        $array = [];
        foreach ($query as $value) {
            $array[$value->id] = $value->city_name;
        }
        return $array;
    }

    public function getAllStadium()
    {
        $query = Stadium::find()->select('id, stadium_name')->all();
        $array = [];
        foreach ($query as $value) {
            $array[$value->id] = $value->stadium_name;
        }
        return $array;
    }
}
