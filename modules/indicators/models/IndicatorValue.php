<?php

namespace app\modules\indicators\models;

use app\modules\handbook\models\FootballClub;
use app\modules\handbook\models\Indicator;
use Yii;

/**
 * This is the model class for table "indicator_value".
 *
 * @property integer $id
 * @property integer $fc_id
 * @property integer $indicator_id
 * @property string $date
 * @property integer $value
 *
 * @property Indicators $indicator
 * @property FootballClub $fc
 */
class IndicatorValue extends \yii\db\ActiveRecord
{
    public $fc_name;
    public $indicator_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indicator_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fc_id', 'indicator_id', 'value'], 'required'],
            [['fc_id', 'indicator_id', 'value'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fc_id' => 'Футбольный клуб',
            'fc_name' => 'Футбольный клуб',
            'indicator_name' => 'Показатель',
            'indicator_id' => 'Показатель',
            'date' => 'Дата',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicator()
    {
        return $this->hasOne(Indicators::className(), ['id' => 'indicator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFc()
    {
        return $this->hasOne(FootballClub::className(), ['id' => 'fc_id']);
    }


    public function getAllFootballClubs()
    {
        $query = FootballClub::find()->select('id, fc_name')->all();
        $array = [];
        foreach ($query as $value) {
            $array[$value->id] = $value->fc_name;
        }
        return $array;
    }

    public function getAllIndicators()
    {
        $query = Indicator::find()->select('id, indicator_name')->all();
        $array = [];
        foreach ($query as $value) {
            $array[$value->id] = $value->indicator_name;
        }
        return $array;
    }
}
