<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]);
    ?>
<!--    --><?php //echo GridView::widget([
//        'dataProvider' => $dataProvider,
////        'filterModel' => $searchModel,
//        'columns' => [
////            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'title',
//            'alias',
//            'category.name',
//            'snippet:ntext',
//            // 'content:ntext',
//            // 'image_url:url',
//            // 'views',
//            // 'comments',
//            // 'status_id',
//            // 'date',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

</div>
