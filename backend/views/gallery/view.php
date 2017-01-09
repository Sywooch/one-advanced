<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\FileInput;
//use kartik\file\FileInput;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Gallery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Галерея', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-view">

    <h1>Папка: <?php echo Html::encode($this->title) ?></h1>
    <p>
        <?php echo $model->description; ?>
    </p>
    <p>
        <?php
        echo Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]);
        ?>
    </p>
    <?php
    $images = $model->getImages();
    $allImg = [];
    $allImgConfig = [];
    if($images[0]['urlAlias']!='placeHolder') {
        foreach($images as $img){
            $allImg[] = Html::a(Html::img($img->getUrl('160x130'),['alt' => $model->name]), $img->getUrl(), ['target' => '_blank']);
//            $allImg[] = Html::img($img->getUrl('200x200'),['alt' => $model->name]);
//            var_dump($img);
            $allImgConfig[] = [
//                'caption' => Url::toRoute($img->getUrl(), true),
//                'caption' => $_SERVER['HTTP_HOST'].$img->getUrl(),
//                'width' => '120px',
                'url' => Url::to(['/gallery/remove-image', 'id' => $img->id]),
//                'key' => $img,
//                'extra' => $img

            ];
//            echo $_SERVER['HTTP_HOST'].$img->getUrl();
        }
    }
//    var_dump($allImg);
    echo FileInput::widget([
        'name' => 'gallery',
        'options'=>[
            'multiple'=>true,
//            'accept' => 'image/*'
        ],
        'pluginOptions' => [
            'initialPreview' => $allImg,
            'initialPreviewConfig' => $allImgConfig,
            'overwriteInitial' => false,

            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => true,

//            'browseClass' => 'btn btn-success',
//            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
//            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',

//            'browseClass' => 'btn btn-primary btn-block',
//            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
//            'browseLabel' =>  'Select Photo',
            'previewFileType' => 'any',
            'uploadUrl' => Url::to(['/gallery/upload-files', 'id' => $model->id]),
//            'uploadExtraData' => [
//                'album_id' => 20,
//                'cat_id' => 'Nature'
//            ],
//            'maxFileCount' => 10
        ]
    ]);
    ?>
<!--    --><?php //echo DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'name',
//            'description',
//            'status',
//        ],
//    ]) ?>

</div>
