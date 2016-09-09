<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Games */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Обновление игры "' . $model->home->name.' : '.$model->guest->name.'""';
$this->params['breadcrumbs'][] = ['label' => 'Матчи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->home->name.' : '.$model->guest->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="games-update">

<!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<!--    <div class="well">-->
    <div class="row">
        <div class="col-md-6">
        <?php
//        Pjax::begin(['id' => 'all-players-block', 'timeout' => 0]);
        $gridId = 'players-home';
        echo $this->render('_grid', [
            'model' => $model,
            'dataProvider' => $dataProvider['playersHome'],
            'gridOptions' => [
                'id' => $gridId,
//                'team' => $model->home->name,
                'panel' => [
                    'heading' => '<h4>Все игроки команды '.$model->home->name.'</h4>',
                    'after' => Html::button(Html::icon('plus').' Добавить Игроков к Матчу', [
                        'class' => 'btn btn-success perform-action', 'data-game' => $model->id, 'data-team' => $model->home_id, 'data-grid-id' => $gridId
                    ]),

                ],
//                'team_id' => $model->home_id,
                'columns' => [
                    ['class' => 'kartik\grid\CheckboxColumn'],
                    'surname',
                    'number',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model) {
                            $url = Url::to(['players/'.$action, 'id' => $model->id]);
                            return $url;
                        },
                        'template' => '{view} {update}',
                    ],
                ]
            ],
        ]);
        $gridId = 'sub-players-home';
        echo $this->render('_grid', [
            'model' => $model,
            'dataProvider' => $dataProvider['gamePlayersHome'],
            'gridOptions' => [
                'id' => $gridId,
//                'team' => $model->home->name,
                'panel' => [
                    'heading' => '<h4>Состав матча команды '.$model->home->name.'</h4>',
                    'after' => false,

                ],
//                'team_id' => $model->home_id,
                'columns' => [
                    [
                        'attribute' => 'players.name',
                        'label' => 'Имя',
                    ],
                    [
                        'attribute' => 'players.surname',
                        'label' => 'Фамилия',
                    ],
                    [
                        'attribute' => 'players.number',
                        'label' => 'Номер',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model) {
                            $url = Url::to(['games-players/'.$action, 'id' => $model->id]);
                            return $url;
                        },
                        'template' => '{delete-pjax}',
                        'buttons' => [
                            'delete-pjax' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', false, [
                                    'onclick' => 'deletePlayer('.$model->id.',\'/admin/games-players/delete-pjax\')',
                                    'style' => 'cursor:pointer',
                                    'title' =>'Удалить',
//                                'data-confirm'=>"Хотите удалить?",
                                    'data-pjax'=>1
                                ]);
                            },
                        ]
                    ],
                ]
            ],
        ]);

        ?>
        </div>
        <div class="col-md-6">
            <?php
            $gridId = 'players-guest';
            echo $this->render('_grid', [
                'model' => $model,
                'dataProvider' => $dataProvider['playersGuest'],
                'gridOptions' => [
                    'id' => $gridId,
//                    'team' => $model->guest->name,
                    'panel' => [
                        'heading' => '<h4>Все игроки команды '.$model->guest->name.'</h4>',
                        'after' => Html::button(Html::icon('plus').' Добавить Игроков к Матчу', [
                            'class' => 'btn btn-success perform-action', 'data-game' => $model->id, 'data-team' => $model->guest_id, 'data-grid-id' => $gridId
                        ]),

                    ],
//                    'team_id' => $model->guest_id,
                    'columns' => [
                        ['class' => 'kartik\grid\CheckboxColumn'],
                        'surname',
                        'number',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'urlCreator' => function ($action, $model) {
                                $url = Url::to(['players/'.$action, 'id' => $model->id]);
                                return $url;
                            },
                            'template' => '{view} {update}',
                        ],
                    ]
                ],
            ]);
            $gridId = 'sub-players-guest';
            echo $this->render('_grid', [
                'model' => $model,
                'dataProvider' => $dataProvider['gamePlayersGuest'],
                'gridOptions' => [
                    'id' => $gridId,
//                    'team' => $model->guest->name,
                    'panel' => [
                        'heading' => '<h4>Состав матча команды '.$model->guest->name.'</h4>',
                        'after' => false,

                    ],
//                    'team_id' => $model->guest_id,
                    'columns' => [
                        [
                            'attribute' => 'players.name',
                            'label' => 'Имя',
                        ],
                        [
                            'attribute' => 'players.surname',
                            'label' => 'Фамилия',
                        ],
                        [
                            'attribute' => 'players.number',
                            'label' => 'Номер',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'urlCreator' => function ($action, $model) {
                                $url = Url::to(['games-players/'.$action, 'id' => $model->id]);
                                return $url;
                            },
                            'template' => '{delete-pjax}',
                            'buttons' => [
                                'delete-pjax' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', false, [
                                        'onclick' => 'deletePlayer('.$model->id.',\'/admin/games-players/delete-pjax\')',
                                        'style' => 'cursor:pointer',
                                        'title' =>'Удалить',
//                                'data-confirm'=>"Хотите удалить?",
                                        'data-pjax'=>1
                                    ]);
                                },
                            ]
                        ],
                    ]
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6">
    <?php

//        Pjax::end();
        ?>
    </div>
        <div class="col-md-6">

        </div>
    </div>
<!--    </div>-->
</div>

<?php
$this->registerJsFile('@web/js/addMany_deleteOne.js', ['depends' => ['yii\web\YiiAsset'],'position' => \yii\web\View::POS_END]);