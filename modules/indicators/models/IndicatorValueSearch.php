<?php

namespace app\modules\indicators\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\indicators\models\IndicatorValue;

/**
 * IndicatorValueSearch represents the model behind the search form about `app\modules\indicators\models\IndicatorValue`.
 */
class IndicatorValueSearch extends IndicatorValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fc_id', 'indicator_id', 'value'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = IndicatorValue::find()
            ->select('football_club.fc_name, indicators.indicator_name, indicator_value.id, indicator_value.date, indicator_value.value')
            ->leftJoin('football_club', 'football_club.id=indicator_value.fc_id')
            ->leftJoin('indicators', 'indicators.id=indicator_value.indicator_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fc_id' => $this->fc_id,
            'indicator_id' => $this->indicator_id,
            'date' => $this->date,
            'value' => $this->value,
        ]);

        return $dataProvider;
    }
}
