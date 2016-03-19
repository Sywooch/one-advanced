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
            [['name', 'surname', 'nationality'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'number' => 'Number',
            'nationality' => 'Nationality',
            'height' => 'Height',
            'weight' => 'Weight',
            'date' => 'Date',
            'role' => 'Role',
            'teams_id' => 'Teams ID',
            'goals' => 'Goals',
            'transfers' => 'Transfers',
            'yellow_cards' => 'Yellow Cards',
            'red_cards' => 'Red Cards',
        ];
    }

    public function getTeams()
    {
        return $this->hasOne(Teams::className(), ['id' => 'teams_id']);
    }
}
