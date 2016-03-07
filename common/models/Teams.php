<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $year
 * @property string $web_site
 * @property string $description
 */
class Teams extends \yii\db\ActiveRecord
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
        return 'teams';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['slug', 'year', 'web_site'], 'string', 'max' => 250]
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
            'slug' => 'Slug',
            'year' => 'Year',
            'web_site' => 'Web Site',
            'description' => 'Description',
        ];
    }
}
