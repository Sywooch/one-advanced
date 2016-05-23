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
 * @property integer $role
 * @property integer $teams_id
 * @property integer $goals
 * @property integer $transfers
 * @property integer $yellow_cards
 * @property integer $red_cards
 *
 * @property GamesPlayers[] $gamesPlayers
 * @property Teams $teams
 */
class Players extends \yii\db\ActiveRecord
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
        return 'players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'nationality', 'date', 'teams_id'], 'required'],
            [['number', 'height', 'weight', 'date', 'role', 'teams_id', 'goals', 'transfers', 'yellow_cards', 'red_cards'], 'integer'],
            [['name', 'surname', 'nationality'], 'string', 'max' => 100],
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
}
