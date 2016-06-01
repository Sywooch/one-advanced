<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SeasonDetails;

/**
 * SeasonDetailsSearch represents the model behind the search form about `common\models\SeasonDetails`.
 */
class SeasonDetailsSearch extends SeasonDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'season_id', 'team_id', 'games', 'wins', 'draws', 'lesions', 'spectacles', 'goals_against', 'goals_scored'], 'integer'],
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
        $query = SeasonDetails::find();

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
            'season_id' => $this->season_id,
            'team_id' => $this->team_id,
            'games' => $this->games,
            'wins' => $this->wins,
            'draws' => $this->draws,
            'lesions' => $this->lesions,
            'spectacles' => $this->spectacles,
            'goals_against' => $this->goals_against,
            'goals_scored' => $this->goals_scored,
        ]);

        return $dataProvider;
    }
}
