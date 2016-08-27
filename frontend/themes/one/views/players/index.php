<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Игроки';
$this->params['breadcrumbs'][] = $this->title;

$this->params['headerName'] = $this->title;
?>
<div class="players-index">
    <!--    --><?php //Pjax::begin(); ?>
    <div class="list-view">
        <h3>Вратари</h3>
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider['vr'],
            'options' => [
                'class' => 'row',
            ],
            'itemOptions' => ['class' => 'item col-xs-4'],
            'itemView' => '_list',
            'summary' => false,
//
//        'itemView' => function ($model, $key, $index, $widget) {
//            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
//        },
        ]);
        ?>
    </div>
    <div class="list-view">
        <h3>Защитники</h3>
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider['zsh'],
            'options' => [
                'class' => 'row',
            ],
            'itemOptions' => ['class' => 'item col-xs-4'],
            'itemView' => '_list',
            'summary' => false,
        ]);
        ?>

    </div>
    <div class="list-view">
        <h3>Полузащитники</h3>
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider['pzsh'],
            'options' => [
                'class' => 'row',
            ],
            'itemOptions' => ['class' => 'item col-xs-4'],
            'itemView' => '_list',
            'summary' => false,
        ]);
        //        $playersRole = ['вр' => 'Вратарь', 'зщ' => 'Защитник', 'пз' => 'Полузащитник', 'нп' => 'Нападающий', ];

        ?>

    </div>
    <div class="list-view">
        <h3>Нападающие</h3>
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider['np'],
            'options' => [
                'class' => 'row',
            ],
            'itemOptions' => ['class' => 'item col-xs-4'],
            'itemView' => '_list',
            'summary' => false,
        ]);
        ?>
    </div>

    <div class="players-all-img">
        <?php echo Html::img('@web/themes/one/src/baltika-2016.jpg'); ?>
    </div>
    <!--    --><?php //Pjax::end(); ?>

</div>
