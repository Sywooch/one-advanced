<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Teams */

$this->title = 'Обновление Команды: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Команды', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="teams-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $images = $model->getImages();
    if($images[0]['urlAlias']!='placeHolder') {
        echo Html::beginTag('div',['class' => 'well']);
            echo Html::beginTag('div',['class' => 'row']);
            foreach($images as $img){
                echo Html::beginTag('div',['class' => 'col-xs-6']);
                    echo Html::a(Html::img($img->getUrl('x100'),['alt' => $model->name]),false,['class' => 'thumbnail']);
                    if(!$img->isMain) {
                        $columns = 4;
                        echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                            echo Html::a('Сделать основной', ['set-main', 'id'=> $model->id,'id_img'=>$img->id], ['class' => 'btn  btn-success']);
                        echo Html::endTag('div');
                    } else {
                        $columns = 6;
                    }
                    echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                        echo Html::a('Просмотр', $img->getUrl(), ['class' => 'btn  btn-primary','target' => '_blank']);
                    echo Html::endTag('div');
                    echo Html::beginTag('div',['class' => 'col-xs-'.$columns.' text-center']);
                        echo Html::a('Удалить', ['remove-image', 'id'=> $model->id], ['class' => 'btn  btn-danger']);
                    echo Html::endTag('div');
                echo Html::endTag('div');
            }
            echo Html::endTag('div');
        echo Html::endTag('div');
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
