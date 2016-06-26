<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Медиа', 'url' => ['/gallery']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="gallery-view-block">
        <?php
        $images = $model->getImages();
        $allImg = [];
        $allImgConfig = [];
        if($images[0]['urlAlias']!='placeHolder') {
            foreach($images as $img){
                echo Html::tag('div',
                    Html::a(
                        Html::img($img->getUrl('160x130'),['alt' => $model->name, 'class' => 'thumbnail']),
                        $img->getUrl(),
                        ['target' => '_blank']
                    ),
                    ['class' => 'gallery-view-box']
                );
            }
        }
        ?>
    </div>
</div>
