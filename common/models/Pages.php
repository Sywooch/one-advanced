<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_descr
 * @property string $content
 * @property string $widget_bar
 * @property string $slug
 * @property string $status
 */
class Pages extends \yii\db\ActiveRecord
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
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content', 'slug', 'status'], 'required'],
            [['content', 'widget_bar', 'status'], 'string'],
            [['name', 'meta_title', 'meta_keywords', 'meta_descr'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 125],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'meta_title' => 'Мета Title',
            'meta_keywords' => 'Мета Keywords',
            'meta_descr' => 'Мета Descr',
            'content' => 'Контент',
            'widget_bar' => 'Виджет бар',
            'slug' => 'Slug',
            'status' => 'Статус',
        ];
    }
}
