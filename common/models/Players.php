<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "players".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property integer $number
 * @property string $nationality
 * @property integer $height
 * @property integer $weight
 * @property integer $date
 * @property string $role
 * @property integer $teams_id
 * @property integer $goals
 * @property integer $transfers
 * @property integer $yellow_cards
 * @property integer $red_cards
 * @property string $content
 * @property string $patronymic
 * @property string $tag
 * @property string $career
 *
 * @property GamesEvents[] $gamesEvents
 * @property GamesEvents[] $gamesEvents0
 * @property GamesPlayers[] $gamesPlayers
 * @property Teams $teams
 */
class Players extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'common\widgets\costaRico\yii2Images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'nationality', 'date', 'teams_id'], 'required'],
            [['number', 'height', 'weight', 'teams_id', 'goals', 'transfers', 'yellow_cards', 'red_cards'], 'integer'],
            [['date'], 'safe'],
            [['role', 'content', 'career'], 'string'],
            [['name', 'surname', 'nationality', 'patronymic'], 'string', 'max' => 100],
            [['tag'], 'string', 'max' => 255],
            [['teams_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['teams_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'number' => 'Номер',
            'nationality' => 'Национальность',
            'height' => 'Рост',
            'weight' => 'Вес',
            'date' => 'Дата рождения',
            'role' => 'Позиция',
            'teams_id' => 'Команда',
            'goals' => 'Голы',
            'transfers' => 'Передачи',
            'yellow_cards' => 'Желтые Карточки',
            'red_cards' => 'Красные Карточки',
            'content' => 'Контент',
            'tag' => 'Тег',
            'career' => 'Карьера',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamesPlayers()
    {
        return $this->hasMany(GamesPlayers::className(), ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasOne(Teams::className(), ['id' => 'teams_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamesEvents()
    {
        return $this->hasMany(GamesEvents::className(), ['player_one_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamesEvents0()
    {
        return $this->hasMany(GamesEvents::className(), ['player_two_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = Yii::$app->formatter->asTimestamp($this->date);
//            $this->date = Yii::$app->formatter->asDate($this->date);
//            var_dump($this->date);
//            die;
            return true;
        }
        return false;
    }
}
