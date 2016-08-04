<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "club_questions".
 *
 * @property integer $id
 * @property string $name
 * @property string $question
 * @property string $answer
 * @property string $email
 * @property integer $user_id
 * @property string $ip
 * @property string $status
 * @property integer $date
 */
class ClubQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'club_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question'], 'required'],
            [['question', 'answer', 'status'], 'string'],
            [['user_id', 'date'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 50],
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
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'email' => 'Email',
            'user_id' => 'ID Пользователя',
            'ip' => 'Ip',
            'status' => 'Статус',
            'date' => 'дата',
        ];
    }
}
