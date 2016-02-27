<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seasons".
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $division
 * @property string $slug
 * @property string $status
 */
class Seasons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seasons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'full_name', 'division', 'slug', 'status'], 'required'],
            [['status'], 'string'],
            [['name', 'full_name', 'division'], 'string', 'max' => 200],
            [['slug'], 'string', 'max' => 250]
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
            'full_name' => 'Full Name',
            'division' => 'Division',
            'slug' => 'Slug',
            'status' => 'Status',
        ];
    }
}
