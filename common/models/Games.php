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
 * @property integer $category_id
 *
 * @property CategoryGames $category
 * @property Gallery $gallery
 * @property Seasons $season
 * @property Teams $home
 * @property Teams $guest
 * @property GamesEvents[] $gamesEvents
 * @property GamesPlayers[] $gamesPlayers
 */
class Games extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
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
            [['category_id', 'home_id', 'guest_id', 'score', 'season_id', 'content', 'category_id', 'status'], 'required'],
//            [['home_id', 'guest_id', 'season_id', 'tour', 'score', 'city', 'stadium', 'referee', 'referee2', 'referee3', 'content', 'status'], 'required'],
            [['home_id', 'guest_id', 'season_id', 'tour', 'gallery_id', 'category_id'], 'integer'],
            [['content', 'status'], 'string'],
            [['score'], 'string', 'max' => 50],
            [['date'], 'safe'],
            [['city', 'stadium', 'referee', 'referee2', 'referee3'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryGames::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
            [['home_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['home_id' => 'id']],
            [['guest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['guest_id' => 'id']],
            [['season_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seasons::className(), 'targetAttribute' => ['season_id' => 'id']],
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
            'category_id' => 'Категория матча',
            'gallery_id' => 'Галерея матча',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryGames::className(), ['id' => 'category_id']);
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

    public function getAllCategories()
    {
        return CategoryGames::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    public function getAllGallery()
    {
        return Gallery::find()->where(['status' => 'on'])->all();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = Yii::$app->formatter->asTimestamp($this->date);
            if ($this->tour == '') {
                $this->tour = 0;
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamesEvents()
    {
        return $this->hasMany(GamesEvents::className(), ['game_id' => 'id']);
    }
}
