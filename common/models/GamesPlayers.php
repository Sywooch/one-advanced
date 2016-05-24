<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "games_players".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $team_id
 * @property integer $player_id
 * @property integer $time
 *
 * @property Games $game
 * @property Players $players
 */
class GamesPlayers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games_players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'player_id', 'team_id'], 'required'],
            [['game_id', 'player_id', 'team_id', 'time'], 'integer'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Players::className(), 'targetAttribute' => ['player_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'ID Игры',
            'player_id' => 'ID Игрока',
            'team_id' => 'ID Команды',
            'time' => 'Время',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Games::className(), ['id' => 'game_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasOne(Players::className(), ['id' => 'player_id']);
    }
}
