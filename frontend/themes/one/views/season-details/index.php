<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Teams;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeasonDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Url::remember();

$this->title = 'Турнирная таблица';
$this->params['breadcrumbs'][] = $this->title;

$season = $dataProvider->getModels()[0]->season;
$homeTeamId = Teams::find()->select('id')->where(['name' => Yii::$app->params['main-team']])->one()->id;

?>
<div class="season-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p style="font-size: 18px">
        <?php
        $img = $season->getImage();
        if ($img['urlAlias']!='placeHolder') {
            echo Html::img($img->getUrl('50x'), ['style' => 'margin-right:5px;']);
        }
        echo $season->full_name;
        ?>
    </p>
<!--    <div class="panel panel-default">-->
<!--        <div class="panel-body">-->
            <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
            //        'filterModel' => $searchModel,
                    'bordered'=>false,
                    'striped'=>false,
                    'condensed'=>false,
                    'responsive'=>false,
                    'hover'=>true,
                    'summary' => false,
                    'rowOptions'=>function ($model, $key, $index, $grid) use ($homeTeamId) {
                        if ($model->team_id == $homeTeamId) {
                            return [
                                'class' => 'main-team'
                            ];
                        }
                    },
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
                            'label' => '<span title="Поражения" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">П</span>',
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
                            'label' => '<span title="Очки" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">О</span>',
                            'encodeLabel' => false,
                            'attribute' => 'spectacles',
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
    <div class="transcript">
        <div class="row">
            <div class="col-xs-3 col-xs-offset-6">
                <div><span class="transcript-label">И</span><span class="transcript-value">Игры</span></div>
                <div><span class="transcript-label">В</span><span class="transcript-value">Выигрыши</span></div>
                <div><span class="transcript-label">Н</span><span class="transcript-value">Ничьи</span></div>
                <div><span class="transcript-label">П</span><span class="transcript-value">Поражения</span></div>
            </div>
            <div class="col-xs-3">
                <div><span class="transcript-label">ГЗ</span><span class="transcript-value">Голов забито</span></div>
                <div><span class="transcript-label">ГП</span><span class="transcript-value">Голов пропущено</span></div>
                <div><span class="transcript-label">РМ</span><span class="transcript-value">Разница мячей</span></div>
                <div><span class="transcript-label">О</span><span class="transcript-value">Очки</span></div>
            </div>
        </div>
    </div>
<!--        </div>-->
<!--    </div>-->
</div>
