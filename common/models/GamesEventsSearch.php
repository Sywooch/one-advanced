<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\GamesEvents;

/**
 * GamesEventsSearch represents the model behind the search form about `common\models\GamesEvents`.
 */
class GamesEventsSearch extends GamesEvents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'game_id', 'team_id', 'player_one_id', 'player_two_id', 'time'], 'integer'],
            [['event_type'], 'safe'],
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
        $query = GamesEvents::find();

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
            'team_id' => $this->team_id,
            'player_one_id' => $this->player_one_id,
            'player_two_id' => $this->player_two_id,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'event_type', $this->event_type]);

        return $dataProvider;
    }
}
