<?php

use kartik\grid\GridView;
use yiister\gentelella\widgets\Panel;
use kartik\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Панель управления сайтом';
$this->params['h1'] = true;
$this->params['panel'] = true;
?>
<div class="site-index">

    <?php
    Panel::begin(
        [
            'header' => 'Последние Новости',
            'icon' => 'list',
            'collapsable' => true,
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider['news'],
        'options' => [
            'class' => 'guest-book-home'
        ],
        'summary' => false,
        'columns' => [
            'title',
            'snippet',
//            'category:name',
//            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $url ='/admin/news/' . $action . '?id='.$model->id;
                    return $url;
                }
            ],
        ],
    ]);
    Panel::end();
    Panel::begin(
        [
            'header' => 'Вопросы Клубу',
            'icon' => 'question-circle-o',
            'collapsable' => true,
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider['club-questions'],
        'options' => [
            'class' => 'guest-book-home'
        ],
        'summary' => false,
        'columns' => [
            'name',
            'question:ntext',
            'answer:ntext',
//            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $url ='/admin/club-questions/' . $action . '?id='.$model->id;
                    return $url;
                }
            ],
        ],
    ]);
    Panel::end();
    Panel::begin(
        [
            'header' => 'Гостевая книга',
            'icon' => 'book',
            'collapsable' => true,
        ]
    );
    echo GridView::widget([
        'dataProvider' => $dataProvider['guest-book'],
        'options' => [
            'class' => 'guest-book-home'
        ],
        'summary' => false,
        'columns' => [
            'name',
            [
                'attribute' => 'body',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::tag('div', $data->body, ['class' => 'guest-body']);
                }
            ],
            'email',
            'date:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    $url ='/admin/guest-book/' . $action . '?id='.$model->id;
                    return $url;
                }
            ],
        ],
    ]);
    Panel::end();
    ?>

</div>
