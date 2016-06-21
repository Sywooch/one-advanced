<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Games;

/**
 * GamesSearch represents the model behind the search form about `common\models\Games`.
 */
class GamesSearch extends Games
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'home_id', 'guest_id', 'season_id', 'tour', 'score', 'date'], 'integer'],
            [['city', 'stadium', 'referee', 'referee2', 'referee3', 'content', 'status'], 'safe'],
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
        $query = Games::find()->orderBy('id DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'home_id' => $this->home_id,
            'guest_id' => $this->guest_id,
            'season_id' => $this->season_id,
            'tour' => $this->tour,
            'score' => $this->score,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'stadium', $this->stadium])
            ->andFilterWhere(['like', 'referee', $this->referee])
            ->andFilterWhere(['like', 'referee2', $this->referee2])
            ->andFilterWhere(['like', 'referee3', $this->referee3])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
