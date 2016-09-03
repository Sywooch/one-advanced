<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Players */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Игроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-view well">

    <?php
    $images = $model->getImages();
    //var_dump($images->isMain);die;
    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
        echo Html::beginTag('div',['class'=>'pull-left']);
            $image = $model->getImage();
//            echo Html::tag(
//                'p',
                echo Html::img($image->getUrl('x400'),['class' => 'img-responsive',]);
//                ['class'=>'']
//            );
        echo Html::endTag('div');

    }
    ?>
    <p class="pull-right">
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->
    <div class="clearfix"></div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'surname',
            'number',
            'nationality',
            'height',
            'weight',
            'date:date',
            'role',
            'teams.name',
            'goals',
            'transfers',
            'yellow_cards',
            'red_cards',
        ],
    ]) ?>

</div>
