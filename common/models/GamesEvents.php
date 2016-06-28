<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "games_events".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $team_id
 * @property string $event_type
 * @property integer $player_one_id
 * @property integer $player_two_id
 * @property integer $time
 *
 * @property Games $game
 * @property Teams $team
 * @property Players $playerOne
 * @property Players $playerTwo
 */
class GamesEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'team_id', 'event_type', 'player_one_id', 'player_two_id', 'time'], 'required'],
            [['game_id', 'team_id', 'player_one_id', 'player_two_id', 'time'], 'integer'],
            [['event_type'], 'string'],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['game_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['player_one_id'], 'exist', 'skipOnError' => true, 'targetClass' => Players::className(), 'targetAttribute' => ['player_one_id' => 'id']],
            [['player_two_id'], 'exist', 'skipOnError' => true, 'targetClass' => Players::className(), 'targetAttribute' => ['player_two_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'team_id' => 'Team ID',
            'event_type' => 'Event Type',
            'player_one_id' => 'Player One ID',
            'player_two_id' => 'Player Two ID',
            'time' => 'Time',
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
    public function getTeam()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerOne()
    {
        return $this->hasOne(Players::className(), ['id' => 'player_one_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerTwo()
    {
        return $this->hasOne(Players::className(), ['id' => 'player_two_id']);
    }
}
