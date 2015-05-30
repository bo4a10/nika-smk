<?php

namespace app\modules\handbook\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\handbook\models\Indicator;

/**
 * IndicatorSearch represents the model behind the search form about `app\modules\handbook\models\Indicator`.
 */
class IndicatorSearch extends Indicator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'measure_unit_id'], 'integer'],
            [['indicator_name'], 'safe'],
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
        $query = Indicator::find()
            ->select('indicators.id, indicators.indicator_name, measure_unit.unit_name')
            ->leftJoin('measure_unit', 'indicators.measure_unit_id=measure_unit.id');

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
            'measure_unit_id' => $this->measure_unit_id,
        ]);

        $query->andFilterWhere(['like', 'indicator_name', $this->indicator_name]);

        return $dataProvider;
    }
}
