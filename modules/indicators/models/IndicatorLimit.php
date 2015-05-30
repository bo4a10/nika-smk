<?php

namespace app\modules\indicators\models;

use Yii;
use app\modules\handbook\models\Indicator;

/**
 * This is the model class for table "indicator_limit".
 *
 * @property integer $id
 * @property integer $indicator_id
 * @property string $date
 * @property integer $value
 * @property integer $type
 *
 * @property Indicators $indicator
 */
class IndicatorLimit extends \yii\db\ActiveRecord
{
    public $indicator_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indicator_limit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['indicator_id', 'value', 'type', 'date'], 'required'],
            [['indicator_id', 'value', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'indicator_id' => 'Показатель',
            'indicator_name' => 'Показатель',
            'date' => 'Дата',
            'value' => 'Значение',
            'type' => 'Тип',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicator()
    {
        return $this->hasOne(Indicators::className(), ['id' => 'indicator_id']);
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
