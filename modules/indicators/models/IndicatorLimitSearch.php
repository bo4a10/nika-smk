<?php

namespace app\modules\indicators\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\indicators\models\IndicatorLimit;

/**
 * IndicatorLimitSearch represents the model behind the search form about `app\modules\indicators\models\IndicatorLimit`.
 */
class IndicatorLimitSearch extends IndicatorLimit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'indicator_id', 'value', 'type'], 'integer'],
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
        $query = IndicatorLimit::find()
            ->select('indicator_limit.id, indicator_limit.value, indicator_limit.date, indicator_limit.type, indicators.indicator_name')
            ->leftJoin('indicators', 'indicators.id=indicator_limit.indicator_id');

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
            'indicator_id' => $this->indicator_id,
            'date' => $this->date,
            'value' => $this->value,
            'type' => $this->type,
        ]);

        return $dataProvider;
    }
}
