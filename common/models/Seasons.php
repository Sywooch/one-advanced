<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seasons".
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $division
 * @property string $slug
 * @property string $status
 *
 * @property Games[] $games
 * @property SeasonDetails[] $seasonDetails
 */
class Seasons extends \yii\db\ActiveRecord
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
        return 'seasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'full_name', 'division', 'slug', 'status'], 'required'],
            [['status', 'full_name'], 'string'],
            [['name', 'division'], 'string', 'max' => 200],
            [['slug'], 'string', 'max' => 250]
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
            'full_name' => 'Полное имя',
            'division' => 'Дивизион',
            'slug' => 'Url',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['season_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeasonDetails()
    {
        return $this->hasMany(SeasonDetails::className(), ['season_id' => 'id']);
    }
}
