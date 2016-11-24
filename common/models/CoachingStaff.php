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
 * @property string $content
 * @property string $category
 * @property integer $sort
 * @property integer $category_caches
 *
 * @property Teams $teams
 */
class CoachingStaff extends \yii\db\ActiveRecord
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
        return 'coaching_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'date', 'role', 'teams_id', 'status', 'category'], 'required'],
            [['teams_id', 'sort', 'category_caches'], 'integer'],
            [['date'], 'safe'],
            [['status', 'content', 'category'], 'string'],
            [['name', 'surname', 'patronymic', 'role'], 'string', 'max' => 100],
            [['category_caches'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCaches::className(), 'targetAttribute' => ['category_caches' => 'id']],
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
            'status' => 'Статус',
            'content' => 'Контент',
            'category' => 'Категория',
            'sort' => 'Сортировка',
            'category_caches' => 'Подраздел',
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
    public function getCategoryCaches()
    {
        return $this->hasOne(CategoryCaches::className(), ['id' => 'category_caches']);
    }
    public function getAllCategoryCaches()
    {
        return CategoryCaches::find()->where(['status' => 'on'])->all();
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
