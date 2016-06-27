<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property string $questions
 * @property string $description
 * @property string $url
 * @property string $content
 * @property string $status
 *
 * @property Answers[] $answers
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questions', 'status'], 'required'],
            [['content', 'status'], 'string'],
            [['questions', 'description', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questions' => 'Вопрос',
            'description' => 'Описание',
            'url' => 'Url',
            'content' => 'Контент',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['questions_id' => 'id']);
    }
}
