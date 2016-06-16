<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "black_list".
 *
 * @property integer $id
 * @property string $email
 * @property integer $user_id
 * @property string $ip
 */
class BlackList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'black_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['email', 'ip'], 'string', 'max' => 255],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'user_id' => 'User ID',
            'ip' => 'Ip',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->email == '' && $this->user_id == '' && $this->ip == '') {
                return false;
            } else {
                return true;
            }

        }
        return false;
    }
}
