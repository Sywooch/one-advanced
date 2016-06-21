<?php
namespace frontend\widgets;

use Yii;
use common\models\Gallery;

//class News extends \yii\bootstrap\Widget
class GalleryWidget extends \yii\bootstrap\Widget
{
    public $template;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $model = Gallery::find()->where(['status' => 'on'])->orderBy('id DESC')->limit(3)->all();

        return $this->render($this->template,['model' => $model]);
    }
}