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
 * @property string $slug
 * @property string $status
 */
class Pages extends \yii\db\ActiveRecord
{
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
            [['content', 'status'], 'string'],
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
            'slug' => 'Slug',
            'status' => 'Статус',
        ];
    }
}
