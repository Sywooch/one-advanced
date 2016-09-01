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
 * @property string $addressee
 */
class ClubQuestions extends \yii\db\ActiveRecord
{

    public $reCaptcha;

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
            [['question', 'addressee'], 'required'],
            [['question', 'answer', 'status'], 'string'],
            [['user_id', 'date'], 'integer'],
            [['name', 'addressee'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 50],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LedACkTAAAAAABRB94hv1GBWA3ZreeDbexv0aSY']
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
            'addressee' => 'Адресат',
        ];
    }
}
