<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $questions_id
 * @property string $answer
 * @property integer $how_many
 *
 * @property Questions $questions
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['questions_id', 'answer'], 'required'],
            [['questions_id', 'how_many'], 'integer'],
            [['answer'], 'string', 'max' => 255],
            [['questions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['questions_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questions_id' => 'Вопрос',
            'answer' => 'Ответ',
            'how_many' => 'Количество голосов',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasOne(Questions::className(), ['id' => 'questions_id']);
    }

    public function getAllQuestions ()
    {
        return Questions::find()->where(['status' => 'on'])->all();
    }
}
