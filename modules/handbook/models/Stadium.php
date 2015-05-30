<?php

namespace app\modules\handbook\models;

use Yii;
use app\modules\handbook\models\City;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stadium".
 *
 * @property integer $id
 * @property string $stadium_name
 * @property integer $city_id
 *
 * @property FootballClub[] $footballClubs
 * @property City $city
 */
class Stadium extends \yii\db\ActiveRecord
{
    public $city_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stadium';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stadium_name'], 'required'],
            [['city_id'], 'integer'],
            [['stadium_name'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' =>\voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'listCity' => 'city'
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stadium_name' => 'Название стадиона',
            'city_id' => 'Город',
            'city_name' => 'Город',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFootballClubs()
    {
        return $this->hasMany(FootballClub::className(), ['stadium_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
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
}
