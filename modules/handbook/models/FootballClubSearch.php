<?php

namespace app\modules\handbook\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\handbook\models\FootballClub;

/**
 * FootballClubSearch represents the model behind the search form about `app\modules\handbook\models\FootballClub`.
 */
class FootballClubSearch extends FootballClub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'stadium_id'], 'integer'],
            [['fc_name'], 'safe'],
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
        $query = FootballClub::find()
            ->select('football_club.id, football_club.fc_name, city.city_name, stadium.stadium_name')
            ->leftJoin('city', 'city.id=football_club.city_id')
            ->leftJoin('stadium', 'stadium.id=football_club.stadium_id');

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
            'stadium_id' => $this->stadium_id,
        ]);

        $query->andFilterWhere(['like', 'fc_name', $this->fc_name]);

        return $dataProvider;
    }
}
