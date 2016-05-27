<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">
    <h1 class=""><?= Html::encode($this->title) ?></h1>
    <?php
    echo Html::tag('div',Html::tag('span',Yii::$app->formatter->asDate($model -> date,'dd.MM.yy'),['class'=>'news-date']).Html::tag('span',$model->category->name,['class'=>'news-category']),['class'=>'date-category news-index-date']);
    $images = $model->getImages();
    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
        $image = $model->getImage();
        $sizes = $image->getSizesWhen('400x');
        //            echo Html::img($image->getUrl('x300'),['class' => 'center-block img-responsive','width'=>$sizes['width'], 'height'=>$sizes['height']]);
        echo Html::img($image->getUrl('x200'),['class' => 'news-view-img thumbnail img-responsive','width'=>$sizes['width']]);
    }

    echo Html::tag('div',$model->content,['class'=>'news-view-content']); ?>
</div>