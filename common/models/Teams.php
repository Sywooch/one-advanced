<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $year
 * @property string $web_site
 * @property string $description
 *
 * @property Games[] $games
 * @property Games[] $gamesGuest
 * @property Players[] $players
 * @property SeasonDetails[] $seasonDetails
 */
class Teams extends \yii\db\ActiveRecord
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
        return 'teams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['slug', 'year', 'web_site'], 'string', 'max' => 250]
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
            'slug' => 'Url',
            'year' => 'Год создания',
            'web_site' => 'Сайт',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['home_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGamesGuest()
    {
        return $this->hasMany(Games::className(), ['guest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Players::className(), ['teams_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeasonDetails()
    {
        return $this->hasMany(SeasonDetails::className(), ['team_id' => 'id']);
    }
}
