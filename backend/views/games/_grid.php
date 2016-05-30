<?php

use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

/* @var $dataProvider yii\data\ActiveDataProvider */

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'pjax' => true,
    'options' => [
        'id' => $gridOptions['id'],
    ],
    'responsive'=>true,
    'hover'=>true,
    'bordered'=>true,
    'striped'=>true,
    'containerOptions'=>['style'=>'overflow: auto'],
    'panel'=>[
        'type'=>GridView::TYPE_DEFAULT,
        'heading' => $gridOptions['panel']['heading'],
        'before' => false,
        'after' => $gridOptions['panel']['after'],
    ],
    'columns' => $gridOptions['columns'],
]);