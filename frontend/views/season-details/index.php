<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeasonDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Url::remember();

$this->title = 'Турнирная таблица';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel panel-default">
<!--        <div class="panel-body">-->
            <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
            //        'filterModel' => $searchModel,
                    'bordered'=>false,
                    'striped'=>true,
                    'condensed'=>false,
                    'responsive'=>false,
                    'hover'=>true,
                    'summary' => false,
                    'tableOptions' => [
                        'style' => 'margin-bottom:0'
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'Место'
                        ],

            //            'id',
            //            [
            //                'attribute' => 'season.name',
            //                'label' => 'Сезон',
            //            ],
                        [
                            'attribute' => 'team.name',
                            'label' => 'Команда',
                            'value' => function ($data) {
                                $imgBlock = '';
                                $img = $data->team->getImage();
                                if($img['urlAlias']!='placeHolder') {
                                    $imgBlock = Html::img($img->getUrl('x20'), ['class' => 'team-img']);
                                }
                                return $imgBlock . $data->team->name;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'attribute' => 'games',
                            'label' => '<span title="Игры" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">И</span>',
                            'encodeLabel' => false,
                        ],
                        [
                            'attribute' => 'wins',
                            'label' => '<span title="Выигрыши" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">В</span>',
                            'encodeLabel' => false,
                        ],
                        [
                            'attribute' => 'draws',
                            'label' => '<span title="Ничьи" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">Н</span>',
                            'encodeLabel' => false,
                        ],
                        [
                            'attribute' => 'lesions',
                            'label' => '<span title="Пропущеные" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">П</span>',
                            'encodeLabel' => false,
                        ],
                        [
                            'attribute' => 'goals_scored',
                            'label' => '<span title="Голы забитые" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">ГЗ</span>',
                            'encodeLabel' => false,
                        ],
                        [
                            'attribute' => 'goals_against',
                            'label' => '<span title="Голы пропущенные" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">ГП</span>',
                            'encodeLabel' => false,
                        ],
                        [
                            'label' => '<span title="Разница мячей" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">РМ</span>',
                            'encodeLabel' => false,
                            'value' => function($data){
                                $rm = $data->goals_scored - $data->goals_against;
                                return $rm;
                            }
                        ],
                        [
                            'attribute' => 'spectacles',
                            'label' => 'О',
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
<!--        </div>-->
    </div>
</div>
