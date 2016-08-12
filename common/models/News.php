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
 * @property integer $gallery_id
 * @property integer $date_create
 * @property string $tags
 *
 * @property Gallery $gallery
 * @property Category $category
 */
class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'common\widgets\costaRico\yii2Images\behaviors\ImageBehave',
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
            [['title', 'snippet', 'content'], 'required'],
            [['category_id', 'views', 'comments', 'date', 'gallery_id'], 'integer'],
            [['snippet', 'content', 'status_id', 'tags'], 'string'],
            [['title', 'alias'], 'string', 'max' => 100],
            [['alias'], 'unique'],
            [['date_create'], 'safe'],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'alias' => 'Псевдоним',
            'category_id' => 'Категория',
            'snippet' => 'Отрывок',
            'content' => 'Контент',
            'views' => 'Просмотры',
            'comments' => 'Коментарии',
            'status_id' => 'Статус',
            'date' => 'Дата обновления',
            'date_create' => 'Дата создания',
            'tags' => 'Теги',
        ];
    }

//    function getPublishedPosts()
//    {
//        return new ActiveDataProvider([
//            'query' => Post::find()
//                ->where(['publish_status' => self::STATUS_PUBLISH])
//        ]);
//    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getAllCategory()
    {
        return Category::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
//            $this->date_create = Yii::$app->formatter->asTimestamp($this->date_create);

//            var_dump($this->isNewRecord );
//            var_dump($this->date);
//            die;
//            $this->date_create = Yii::$app->formatter->asTimestamp($this->date_create);
            $this->date = time();
            return true;
        }
        return false;
    }

}