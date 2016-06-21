<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
//Yii::$app->formatter->locale = 'ru-RU';

?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'emptyText' => 'Список пуст',
        'emptyTextOptions' => ['tag' => 'p'],

//        'options' => ['tag' => 'div','class' => 'news-list','id' => 'news-list',],
//        'layout' => "{pager}\n{summary}\n{items}\n{pager}",
        'layout' => "{summary}\n{items}\n<div class=\"text-center\">{pager}</div>",
        'summary' => '<div class="summary">Показаны записи <b>{begin}-{end}</b> из <b>{totalCount}</b>.</div>',
//        'summaryOptions' => ['tag' => 'div','class' => 'my-summary summary'],
        'itemOptions' => ['class' => 'news-item'],

        'pager' => [
            'firstPageLabel' => '<<',
            'prevPageLabel' => '<',
            'nextPageLabel' => '>',
            'lastPageLabel' => '>>',
            'maxButtonCount' => 10,
        ],
    ]);
    ?>

</div>
