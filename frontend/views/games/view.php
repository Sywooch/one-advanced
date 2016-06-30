<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\GamesPlayers;

/* @var $this yii\web\View */
/* @var $model common\models\Games */

$this->title = $model->home->name.' : '.$model->guest->name;
$this->params['breadcrumbs'][] = ['label' => 'Матчи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

var_dump($model);
var_dump($model->season);

?>
<div class="games-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="well games-view-score">
        <div class="row">
            <div class="col-xs-4 text-right games-view-score-teams">
                <div class="text-center">
                    <?php
                    $image = $model->home->getImage();
                    if($image['urlAlias']!='placeHolder') {
                        $sizes = $image->getSizesWhen('x130');
                        echo Html::img($image->getUrl('x130'),[
                            'alt'=>$model->home->name,
                            'class' => 'hidden-sm',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]);
                    }

                    echo Html::tag('div', $model->home->name, ['class' => 'game-view-team-name']);
                    echo Html::tag('div', $model->home->city, ['class' => 'game-view-team-city']);

                    ?>
                </div>
            </div>
            <div class="col-xs-4 text-center">
                <div class="game-view-category">
                    <?php
                    if ($model->category->name == 'Первенство') {
                        echo $model->season->full_name;
                    } else {
                        echo $model->category->name;
                    }
                    ?>
                </div>
                <?php
                if ($model->score == '') {
                    $score = explode(':', $model->score);
                } else {
                    $score = [0, 1];
                }
                var_dump($score);
                ?>
                <div class="game-view-score">
<!--                    <span class="game-view-score">--><?php //echo $score[0] ?><!--</span>-->
<!--                    <span class="game-view-devider">--><?php //echo ':' ?><!--</span>-->
<!--                    <span class="game-view-score">--><?php //echo $score[1] ?><!--</span>-->
                </div>
                <div class="day-month"><?php echo Yii::$app->formatter->asDate($model -> date,'php:d.m') ?></div>
                <div class="year"><?php echo Yii::$app->formatter->asTime($model -> date,'H:i') ?></div>
                <div class="game-view-city-stadion"><?php echo $model->home->city ?>, Стадион <?php echo $model->home->stadium?></div>

            </div>
            <div class="col-xs-4 text-left games-view-score-teams">
                <div class="text-center">
                    <?php
                    $image = $model->guest->getImage();
                    if($image['urlAlias']!='placeHolder') {
                        $sizes = $image->getSizesWhen('x130');
                        echo Html::img($image->getUrl('x130'),[
                            'alt'=>$model->guest->name,
                            'class' => 'hidden-sm',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]);
                    }
                    ?>
                    <div class="game-view-team-name"><?php echo $model->guest->name ?></div>
                    <div class="game-view-team-city"><?php echo $model->guest->city ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
<!--        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>-->
<!--        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">...</div>
        <div role="tabpanel" class="tab-pane" id="profile">...</div>
<!--        <div role="tabpanel" class="tab-pane" id="messages">...</div>-->
<!--        <div role="tabpanel" class="tab-pane" id="settings">...</div>-->
    </div>

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
    </div>


</div>
