<?php

use kartik\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Games */

$this->title = 'Update Games: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="games-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<!--    <div class="well">-->
    <div class="row">
        <div class="col-md-6">
        <?php
//        Pjax::begin(['id' => 'all-players-block', 'timeout' => 0]);
        echo GridView::widget([
            'dataProvider' => $dataProvider['playersHome'],
            'pjax' => true,
            'options' => [
                'id' => 'players-home',
            ],
            'responsive'=>true,
            'hover'=>true,
            'bordered'=>true,
            'striped'=>true,
            'containerOptions'=>['style'=>'overflow: auto'],
            'panel'=>[
                'type'=>GridView::TYPE_DEFAULT,
                'heading' => '<h4>Все игроки команды '.$model->home->name.'</h4>',
                'before' => false,
                'after' => Html::button(Html::icon('plus').' Добавить Игроков', [
                    'class' => 'btn btn-success', 'id' => 'add-players', 'data-game' => $model->id, 'data-team' => $model->home_id
                ]),
            ],
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
            ],
        ]);
//        Pjax::end();

        ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <div class="row">
    <div class="col-md-6">
    <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider['gamePlayersHome'],
            'pjax' => true,
            'options' => [
                'id' => 'game-home-players',
            ],
            'responsive'=>true,
            'hover'=>true,
            'bordered'=>true,
            'striped'=>true,
            'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
            'panel'=>[
                'type'=>GridView::TYPE_DEFAULT,
                'heading' => '<h4>Игроки матча команды '.$model->home->name.'</h4>',
//                'footer'=>'',
                'before' => false,
                'after' => false,
            ],
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],

//                'id',
//                'game_id',
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
//                'time:datetime',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model) {
                        $url = Url::to(['games-players/'.$action, 'id' => $model->id]);
                        return $url;
                    },
                    'template' => '{delete-pjax}',
                    'buttons' => [
                        'delete-pjax' => function ($url, $model) {
//                            var_dump($model);
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', false, [
                                'onclick' => 'deletePlayer('.$model->id.')',
                                'style' => 'cursor:pointer',
                                'title' =>'Удалить',
//                                'data-confirm'=>"Хотите удалить?",
                                'data-pjax'=>1
                            ]);
                        },
                    ]
                ],
            ],
        ]);
//        Pjax::end();
        ?>
    </div>
        <div class="col-md-6">

        </div>
    </div>
<!--    </div>-->
</div>
    <script type="text/javascript">
//        $(document).ready(function(){
//});
//            $('#add-players').click(function () {
//            if (confirm($(this).attr('data-confirm-text'))) {
//            if (confirm($(this).attr('data-confirm-text'))) {
//                var keys = $('#all-players').yiiGridView('getSelectedRows');
//                if (keys.length<0) {
//                    console.log(keys);
//                }
//                var status = $('#status-select').val();
//                if ((isFinite(status) && status != '') && (keys.length > 0)) {
//                    $.post('/admin/qtp-product-list/set-status', {
//                        keys: keys,
//                        status: status,
//                    }).done(function () {
//                        $.pjax.reload({container: "#products"});
//                        var elemButton = $('#status-submit-button');
//                        var confirmText = elemButton.attr('data-confirm-text');
//                        var newConfirmText = confirmText.replace(/^[0-9]+/, '');
//                        elemButton.attr('data-confirm-text', newConfirmText);
//                    });
//                } else {
//                    $(this).attr('disabled', 'disabled');
//                }
//            }
//            });
//        });
    </script>

<?php


//$this->registerJs('$(\'#add-players\').click(function () {
//        var keys = $(\'#all-players\').yiiGridView(\'getSelectedRows\');
//
//        if (keys.length>0) {
//            console.log(keys);
//            $.post(\'/admin/games/add-players\', {
//                    keys: keys
//                }).done(function () {
//                    $.pjax.reload({container: "#all-players-block"});
//                });
//        }
//    });
//    ');
//$this->registerJsFile('@web/js/games_update.js');
$this->registerJsFile('@web/js/games_update.js', ['depends' => ['yii\web\YiiAsset'],'position' => \yii\web\View::POS_END]);
//$this->registerJs('$(\'#status-submit-button\').click(function () {
//        var keys = $(\'#products\').yiiGridView(\'getSelectedRows\');
//        var status = $(\'#status-select\').val();
//        if ((isFinite(status) && status != \'\') && (keys.length > 0)) {
//            $.post(\'/admin/qtp-product-list/set-status\', {
//                keys: keys,
//                status: status,
//            }).done(function () {
//                $.pjax.reload({container: "#products"});
//            });
//        } else {
//            $(this).attr(\'disabled\', \'disabled\');
//        }
//    });
//
//    function checkSelectAndKeys() {
//        var keys = $(\'#products\').yiiGridView(\'getSelectedRows\');
//        var status = $(\'#status-select\').val();
//        if ((isFinite(status) && status != \'\') && keys.length > 0) {
//            $(\'#status-submit-button\').removeAttr(\'disabled\');
//        } else {
//            $(\'#status-submit-button\').attr(\'disabled\', \'disabled\');
//        }
//    }
//
//    $(\'input[type="checkbox"]\', $(\'#products\')).on(\'change\', checkSelectAndKeys);
//
//    $(\'#status-select\').on(\'change\', checkSelectAndKeys);');