<?php
namespace frontend\widgets;

use Yii;
use common\models\News;

//class News extends \yii\bootstrap\Widget
class NewsWidget extends \yii\bootstrap\Widget
{
    public $template;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
//        if(!empty($this->zone)) {
            $output = News::find()->all();
//            $output = News::find()->where(['zone' => $this->zone, 'status' => 'on'])->orderBy('sort')->all();
            return $this->render($this->template,['news' => $output]);
//        }
    }
}