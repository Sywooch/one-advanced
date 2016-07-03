<?php

use yii\helpers\Html;
use common\models\Teams;

/* @var $this yii\web\View */
/* @var $model common\models\Players */

$this->title = 'Обновление игрока: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Игроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="players-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
//    $images = $model->getImage();
//    if($images['urlAlias']!='placeHolder') {
//        echo Html::beginTag('div',['class' => 'well']);
//        echo Html::a(Html::img($images->getUrl('x300'),['alt' => $model->name, 'class' => 'thumbnail']),false);

//        echo Html::beginTag('div',['class' => 'row']);
//            foreach($images as $img){
//                echo Html::beginTag('div',['class' => 'col-xs-6']);
//                    echo Html::a(Html::img($img->getUrl('x100'),['alt' => $model->name]),false,['class' => 'thumbnail']);
//                    if(!$img->isMain) {
//                        $columns = 4;
//                        echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
//                        echo Html::a('Setmain', ['set-main', 'id'=> $model->id,'id_img'=>$img->id], ['class' => 'btn  btn-success']);
//                        echo Html::endTag('div');
//                    } else {
//                        $columns = 6;
//                    }
//                    echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
//                        echo Html::a('View', $img->getUrl(), ['class' => 'btn  btn-primary','target' => '_blank']);
//                    echo Html::endTag('div');
//                    echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
//                        echo Html::a('Remove', ['remove-image', 'id'=> $model->id], ['class' => 'btn  btn-danger']);
//                    echo Html::endTag('div');
//                echo Html::endTag('div');
//            }
//            echo Html::endTag('div');
//        echo Html::endTag('div');
//    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
        'teams' => Teams::find()->all()
    ]) ?>

</div>
