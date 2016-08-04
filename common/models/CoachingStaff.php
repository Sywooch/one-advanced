<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "coaching_staff".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property integer $date
 * @property string $role
 * @property integer $teams_id
 * @property string $status
 *
 * @property Teams $teams
 */
class CoachingStaff extends \yii\db\ActiveRecord
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
        return 'coaching_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'date', 'role', 'teams_id', 'status'], 'required'],
            [['teams_id'], 'integer'],
            [['date'], 'safe'],
            [['status'], 'string'],
            [['name', 'surname', 'patronymic', 'role'], 'string', 'max' => 100],
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
            'date' => 'Дата рождения',
            'role' => 'Должность',
            'teams_id' => 'Команда',
            'status' => 'статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeams()
    {
        return $this->hasOne(Teams::className(), ['id' => 'teams_id']);
    }
    public function getAllTeams()
    {
        return Teams::find()->all();
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
