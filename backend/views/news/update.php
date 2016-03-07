<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Update News: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->registerJsFile('js/remove_image.js');

?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $images = $model->getImages();
    if($images[0]['urlAlias']!='placeHolder') {
        echo Html::beginTag('div',['class' => 'well']);
            echo Html::beginTag('div',['class' => 'row']);
                foreach($images as $img){
                    echo Html::beginTag('div',['class' => 'col-xs-6']);
                        echo Html::a(Html::img($img->getUrl('x100'),['alt' => $model->title]),false,['class' => 'thumbnail']);
                        if(!$img->isMain) {
                            $columns = 4;
                            echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                                echo Html::a('Setmain', ['set-main', 'id'=> $model->id,'id_img'=>$img->id], ['class' => 'btn  btn-success']);
                            echo Html::endTag('div');
                        } else {
                            $columns = 6;
                        }
                        echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                            echo Html::a('View', $img->getUrl(), ['class' => 'btn  btn-primary','target' => '_blank']);
                        echo Html::endTag('div');
                        echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                            echo Html::a('Remove', ['remove-image', 'id'=> $model->id], ['class' => 'btn  btn-danger']);
                        echo Html::endTag('div');
                    echo Html::endTag('div');
                }
            echo Html::endTag('div');
        echo Html::endTag('div');
    }

    echo $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ])
    ?>

</div>