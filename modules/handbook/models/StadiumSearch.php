<?php

namespace app\modules\handbook\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\handbook\models\Stadium;

/**
 * StadiumSearch represents the model behind the search form about `app\modules\handbook\models\Stadium`.
 */
class StadiumSearch extends Stadium
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id'], 'integer'],
            [['stadium_name'], 'safe'],
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
        $query = Stadium::find()
            ->select('stadium.id, stadium.stadium_name, city.city_name')
            ->leftJoin('city', 'city.id=stadium.city_id');

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
            'city_id' => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'stadium_name', $this->stadium_name]);

        return $dataProvider;
    }
}
