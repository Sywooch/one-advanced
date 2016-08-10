<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\GamesPlayers;

/* @var $this yii\web\View */
/* @var $model common\models\Games */

$this->title = $model->home->name.' : '.$model->guest->name;
$this->params['breadcrumbs'][] = ['label' => 'Матчи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы хотите безвозвратно удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-xs-4">
            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
//            'id',
//            [
//                'attribute' => 'home.name',
//                'label' => 'Команда дома',
//            ],
//            [
//                'attribute' => 'guest.name',
//                'label' => 'Команда в гостях',
//            ],
                    'score',
                    [
                        'attribute' => 'season.name',
                        'label' => 'Сезон',
                    ],
                    'tour',
                    'city',
                    'stadium',
                    'referee',
                    'referee2',
                    'referee3',
                    'content:html',
                    'date:datetime',
                    'status',
                ],
            ]);
            ?>
        </div>
        <?php if (!empty($gameData['home']) && !empty($gameData['guest'])) { ?>
            <div class="col-xs-4">
                <ul>
                <?php
                echo Html::tag('h4', 'Состав команды '.$model->home->name);
                foreach ($gameData['home'] as $item) {
                    echo Html::tag('li', '#'.$item->players->number.' '.$item->players->surname.' '.$item->players->name);
                }
                ?>
                </ul>
            </div>
            <div class="col-xs-4">
                <ul>
                    <?php
                    echo Html::tag('h4', 'Состав команды '.$model->guest->name);
                    foreach ($gameData['guest'] as $item) {
                        echo Html::tag('li', '#'.$item->players->number.' '.$item->players->surname.' '.$item->players->name);
                    }
                    ?>
                </ul>
            </div>
        <?php } else { ?>
            <div class="col-xs-8"><?php echo $model->recaps ?></div>
        <?php } ?>
    </div>


</div>
