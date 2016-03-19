<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Players;

/**
 * PlayersSearch represents the model behind the search form about `common\models\Players`.
 */
class PlayersSearch extends Players
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'number', 'height', 'weight', 'date', 'role', 'teams_id', 'goals', 'transfers', 'yellow_cards', 'red_cards'], 'integer'],
            [['name', 'surname', 'nationality'], 'safe'],
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
        $query = Players::find();

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
            'number' => $this->number,
            'height' => $this->height,
            'weight' => $this->weight,
            'date' => $this->date,
            'role' => $this->role,
            'teams_id' => $this->teams_id,
            'goals' => $this->goals,
            'transfers' => $this->transfers,
            'yellow_cards' => $this->yellow_cards,
            'red_cards' => $this->red_cards,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'nationality', $this->nationality]);

        return $dataProvider;
    }
}
