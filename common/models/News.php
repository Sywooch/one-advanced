<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property integer $category_id
 * @property string $snippet
 * @property string $content
 * @property integer $views
 * @property integer $comments
 * @property string $status_id
 * @property integer $date
 */
class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
        /*Original code*/
//        return [
//            [
//                'class' => SluggableBehavior::className(),
//                'attribute' => 'title',
//                'slugAttribute' => 'slug'
//            ],
//        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'snippet', 'content'], 'required'],
            [['category_id', 'views', 'comments', 'date'], 'integer'],
            [['snippet', 'content', 'status_id'], 'string'],
            [['title', 'alias'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'category_id' => 'Category',
            'snippet' => 'Snippet',
            'content' => 'Content',
            'views' => 'Views',
            'comments' => 'Comments',
            'status_id' => 'Status',
            'date' => 'Date',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->date = time();
//            var_dump($this->date);die;
//            $this->category_id = 0;

            return true;
        }
        return false;
    }

//date("d.m.Y H:i");
}