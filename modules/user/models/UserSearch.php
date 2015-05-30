<?php

namespace app\modules\user\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `app\modules\user\models\User`.
 */
class UserSearch extends User
{
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @return ActiveDataProvider
	 */
	public function search()
	{
		$query = User::find();
		$query->where([
			'parent_user_id' => Yii::$app->getUser()->getId()
		]);

		$dataProvider = new ActiveDataProvider([
			'query'      => $query,
			'sort'       => [
				'defaultOrder' => [
					'full_name'  => SORT_ASC,
				]
			],
			'pagination' => [
				'pageSize' => \Yii::$app->params['pageSize'],
			]

		]);

//		$dataProvider->getSort()->attributes['profile'] = [
//			'asc'  => ['profile.last_name' => SORT_ASC],
//			'desc' => ['profile.last_name' => SORT_DESC],
//		];
//
//		$dataProvider->getSort()->attributes['createdAt'] = [
//			'asc'  => ['created_at' => SORT_ASC],
//			'desc' => ['created_at' => SORT_DESC],
//		];
//
//		if ( !($this->load($params) && $this->validate())) {
//			return $dataProvider;
//		}
//
//		if ( !empty($this->profile)) {
//			$query->andFilterWhere([
//				'like',
//				'profile.last_name',
//				$this->profile
//			]);
//		}
//
//		if ( !empty($this->email)) {
//			$query->andFilterWhere([
//				'like',
//				'email',
//				$this->getEmail()
//			]);
//		}
//
//        $query->andFilterWhere([
//            'id' => $this->getId(),
//            'status' => $this->getStatus(),
//            'parent_id' => $this->getParentId(),
//        ]);
//
//        $query->andFilterWhere(['like', 'title', $this->getTitle()]);

		return $dataProvider;
	}
}
