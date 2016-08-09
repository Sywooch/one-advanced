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
<!--            <div style="overflow: hidden">-->
<!--                <div class="" style="margin-bottom: 10px;">-->
<!--                    <a class="btn btn-default" role="button" data-toggle="collapse"-->
<!--                       href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">-->
<!--                        Поиск <span class="caret"></span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="collapse" id="collapseExample">-->
<!--                <div class="well">-->
<!--                </div>-->
<!--            </div>-->

    <p>
    </p>
<!--    <div class="row">-->
<!--        <div class="col-xs-6">-->
<!--            --><?php //echo $this->render('_search', ['model' => $searchModel]); ?>
<!--        </div>-->
<!--    </div>-->
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
                            'header' => '№'
                        ],

            //            'id',
            //            [
            //                'attribute' => 'season.name',
            //                'label' => 'Сезон',
            //            ],
                        [
                            'attribute' => 'team.name',
                            'label' => 'Команда',
                        ],
                        [
                            'attribute' => 'games',
                            'label' => 'И',
                        ],
                        [
                            'attribute' => 'wins',
                            'label' => 'В',
                        ],
                        [
                            'attribute' => 'draws',
                            'label' => 'Н',
                        ],
                        [
                            'attribute' => 'lesions',
                            'label' => 'П',
                        ],
                        [
                            'attribute' => 'goals_against',
                            'label' => 'ГП',
                        ],
                        [
                            'attribute' => 'goals_scored',
                            'label' => 'ГЗ',
                        ],
                        [
                            'label' => 'РМ',
                            'value' => function($data){
            //                    var_dump($data);
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
