<?php

namespace app\modules\handbook\models;

use Yii;
use app\modules\handbook\models\MeasureUnit;
/**
 * This is the model class for table "indicators".
 *
 * @property integer $id
 * @property string $indicator_name
 * @property integer $measure_unit_id
 *
 * @property IndicatorValue[] $indicatorValues
 * @property MeasureUnit $measureUnit
 */
class Indicator extends \yii\db\ActiveRecord
{
    public $unit_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indicators';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['indicator_name'], 'required'],
            [['measure_unit_id'], 'integer'],
            [['indicator_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'indicator_name' => 'Название',
            'measure_unit_id' => 'Единица измерения',
            'unit_name' => 'Единица измерения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicatorValues()
    {
        return $this->hasMany(IndicatorValue::className(), ['indicator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeasureUnit()
    {
        return $this->hasOne(MeasureUnit::className(), ['id' => 'measure_unit_id']);
    }

    public function getAllMeasureUnit()
    {
        $query = MeasureUnit::find()->select('id, unit_name')->all();
        $array = [];
        foreach ($query as $value) {
            $array[$value->id] = $value->unit_name;
        }
        return $array;
    }
}
