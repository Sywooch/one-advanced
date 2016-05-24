<?php

namespace common\models;

use Yii;
use common\behaviors\DateToTimeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property integer $home_id
 * @property integer $guest_id
 * @property integer $season_id
 * @property integer $tour
 * @property string $score
 * @property string $city
 * @property string $stadium
 * @property string $referee
 * @property string $referee2
 * @property string $referee3
 * @property string $content
 * @property integer $date
 * @property string $status
 * @property integer $gallery_id
 *
 * @property Gallery $gallery
 * @property Seasons $season
 * @property Teams $home
 * @property Teams $guest
 * @property GamesPlayers[] $gamesPlayers
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games';
    }

//    public $date;
//
//    public function behaviors() {
//        return [
//            [
//                'class' => DateToTimeBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_VALIDATE => 'date',
//                    ActiveRecord::EVENT_AFTER_FIND => 'date',
//                ],
//                'timeAttribute' => 'date', //Атрибут модели в котором хранится время в int
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['home_id', 'guest_id', 'season_id', 'tour', 'score', 'city', 'stadium', 'referee', 'referee2', 'referee3', 'content', 'status'], 'required'],
            [['home_id', 'guest_id', 'season_id', 'tour', 'gallery_id'], 'integer'],
            [['content', 'status'], 'string'],
            [['score'], 'string', 'max' => 50],
            [['date'], 'safe'],
            [['city', 'stadium', 'referee', 'referee2', 'referee3'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'home_id' => 'Команда дома',
            'guest_id' => 'Команда в гостях',
            'season_id' => 'Сезон',
            'tour' => 'Тур',
            'score' => 'Счёт',
            'city' => 'Город',
            'stadium' => 'Стадион',
            'referee' => 'Судья 1',
            'referee2' => 'Судья 2',
            'referee3' => 'Судья 3',
            'content' => 'Контент',
            'date' => 'Дата',
            'status' => 'Статус',
        ];
    }

    public function getAllTeams()
    {
        return Teams::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHome()
    {
        return $this->hasOne(Teams::className(), ['id' => 'home_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuest()
    {
        return $this->hasOne(Teams::className(), ['id' => 'guest_id']);
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
    public function getGamesPlayers()
    {
        return $this->hasMany(GamesPlayers::className(), ['game_id' => 'id']);
    }

    public function getAllSeasons()
    {
        return Seasons::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = Yii::$app->formatter->asTimestamp($this->date);
            return true;
        }
        return false;
    }
}
