<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GamesPlayers;

/**
 * GamesPlayersSearch represents the model behind the search form about `common\models\GamesPlayers`.
 */
class GamesPlayersSearch extends GamesPlayers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'game_id', 'player_id', 'team_id', 'time'], 'integer'],
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
        $query = GamesPlayers::find();

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
            'game_id' => $this->game_id,
            'player_id' => $this->player_id,
            'team_id' => $this->team_id,
            'time' => $this->time,
        ]);

        return $dataProvider;
    }
}
