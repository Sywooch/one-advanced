<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "answers_poll".
 *
 * @property integer $id
 * @property integer $quest_id
 * @property integer $answer_id
 * @property string $ip
 * @property integer $date
 *
 * @property Answers $answer
 * @property Questions $quest
 */
class AnswersPoll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers_poll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quest_id', 'answer_id', 'date'], 'integer'],
            [['ip'], 'string', 'max' => 255],
            [['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answers::className(), 'targetAttribute' => ['answer_id' => 'id']],
            [['quest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['quest_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quest_id' => 'Quest ID',
            'answer_id' => 'Answer ID',
            'ip' => 'Ip',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answers::className(), ['id' => 'answer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuest()
    {
        return $this->hasOne(Questions::className(), ['id' => 'quest_id']);
    }
}
