<?php

namespace app\modules\indicators\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\indicators\models\IndicatorCurrent;

/**
 * IndicatorCurrentSearch represents the model behind the search form about `app\modules\indicators\models\IndicatorCurrent`.
 */
class IndicatorCurrentSearch extends IndicatorCurrent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'indicator_id', 'value'], 'integer'],
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
        $query = IndicatorCurrent::find()
            ->select('indicator_current.id, indicator_current.date, indicator_current.value, indicators.indicator_name')
            ->leftJoin('indicators', 'indicators.id=indicator_current.indicator_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
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
        ]);

        return $dataProvider;
    }
}
