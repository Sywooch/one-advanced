<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "season_details".
 *
 * @property integer $id
 * @property integer $season_id
 * @property integer $team_id
 * @property integer $games
 * @property integer $wins
 * @property integer $draws
 * @property integer $lesions
 * @property integer $spectacles
 * @property integer $goals_against
 * @property integer $goals_scored
 *
 * @property Seasons $season
 * @property Teams $team
 */
class SeasonDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'season_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['season_id', 'team_id'], 'integer'],
            [['season_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seasons::className(), 'targetAttribute' => ['season_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['team_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'season_id' => 'Сезон',
            'team_id' => 'Команда',
            'games' => 'Игр',
            'wins' => 'Побед',
            'draws' => 'Ничьи',
            'lesions' => 'Поражений',
            'spectacles' => 'Очки',
            'goals_against' => 'Пропущенные',
            'goals_scored' => 'Забитые',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeason()
    {
        return $this->hasOne(Seasons::className(), ['id' => 'season_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_id']);
    }
}
