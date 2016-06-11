<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guest_book".
 *
 * @property integer $id
 * @property string $name
 * @property string $body
 * @property string $email
 * @property integer $user_id
 * @property integer $ip
 * @property string $status
 * @property integer $date
 *
 * @property User $user
 */
class GuestBook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guest_book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'required'],
            [['body', 'status'], 'string'],
            [['user_id', 'ip', 'date'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'body' => 'Текст',
            'email' => 'Email',
            'user_id' => 'ID Пользователя',
            'ip' => 'Ip',
            'status' => 'Статус',
            'date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
