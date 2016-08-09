<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['season_id', 'team_id','season_id', 'games','wins', 'draws','lesions', 'spectacles', 'goals_against', 'goals_scored'], 'integer'],
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
            'wins' => 'Выигрыши',
            'draws' => 'Ничьи',
            'lesions' => 'Поражения',
            'spectacles' => 'Очки',
            'goals_against' => 'Голы Пропущеные',
            'goals_scored' => 'Голы Забитые',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeason()
    {
        return $this->hasOne(Seasons::className(), ['id' => 'season_id']);
    }

    public function getAllSeason()
    {
        return ArrayHelper::map(
            Seasons::find()->select(['id','name'])->where(['status'=>'on'])->asArray()->all(),
            'id',
            'name'
        );
    }

    public function getAllTeamSeason()
    {
        $model = Teams::find()->where(['name' => Yii::$app->params['main-team']])->with('seasonDetails')->one();
        $season_id = $model->seasonDetails;
        var_dump($season_id);die;
        return ArrayHelper::map(
            Seasons::find()->select(['id','full_name'])->where(['status'=>'on', 'id' => $season_id])->asArray()->all(),
            'id',
            'full_name'
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Teams::className(), ['id' => 'team_id']);
    }

    public function getAllTeam()
    {
        return ArrayHelper::map(
            Teams::find()->select(['id','name'])->asArray()->all(),
            'id',
            'name'
        );
    }
}
