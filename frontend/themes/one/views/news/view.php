<?php

use kartik\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['headerName'] = $this->title;
?>
<div class="news-view">
    <?php
    $images = $model->getImages();
    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
        $image = $model->getImage();
//        $sizes = $image->getSizesWhen('400x');
        //            echo Html::img($image->getUrl('x300'),['class' => 'center-block img-responsive','width'=>$sizes['width'], 'height'=>$sizes['height']]);
        echo Html::tag('div',Html::img($image->getUrl('1170x500'),['class' => 'news-view-img img-responsive','width'=>'100%']), ['class' => 'news-view-img-block']);
    }
    ?>
    <div class="news-view-block">
        <?php
        echo Html::tag(
            'div',
            Html::tag('span',Yii::$app->formatter->asDate($model -> date_create,'dd.MM.yy'),['class'=>'news-date']) .
            Html::tag('span',$model->category->name,['class'=>'news-category']) .
            Html::tag('span', Html::icon('eye-open') . ' ' . $model->views, ['class' => 'news-view']),
            ['class'=>'date-category news-index-date']
        );
        echo Html::tag('h1', $this->title);
        echo Html::tag('div', $model->snippet, ['class' => 'news-snippet']);
        echo Html::tag('div',$model->content,['class'=>'news-view-content']);

        if($images[0]['urlAlias']!='placeHolder') {
            ?>
            <div class="news-images-block">
                <?php
                foreach($images as $img) {
                    echo Html::beginTag('div', ['class' => 'news-images-box', 'style' => 'margin-bottom:20px']);
                    if (!$img->isMain) {
                        echo Html::a(Html::img($img->getUrl('x500'),['class' => 'center-block img-responsive']), $img->getUrl(''), ['class' => 'lightbox']);
                    }
                    echo Html::endTag('div');
                }
                ?>
            </div>
        <?php
        }
        ?>

    </div>
</div>