<?php

namespace app\modules\handbook\models;

use Yii;

/**
 * This is the model class for table "measure_unit".
 *
 * @property integer $id
 * @property string $unit_name
 *
 * @property Indicators[] $indicators
 */
class MeasureUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measure_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_name'], 'required'],
            [['unit_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndicators()
    {
        return $this->hasMany(Indicators::className(), ['measure_unit_id' => 'id']);
    }
}
