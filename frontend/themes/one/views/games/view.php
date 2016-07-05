<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\GamesPlayers;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Games */

$this->title = $model->home->name.' : '.$model->guest->name;
$this->params['breadcrumbs'][] = ['label' => 'Матчи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['image_page'] = '';
$compositionsStep = false;
$galleryStep = false;
if (!empty($gameData['home']) && !empty($gameData['guest'])) {
    $compositionsStep = true;
}
if (!is_null($model->gallery)) {
    $galleryStep = true;
}
?>
<div class="games-view">

<!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->

    <div class="games-view-score">
        <div class="row text-center prev-next-games">
            <div class="col-xs-4">
                <?php if (!is_null($gameData['prevGame'])) : ?>
                <a href="<?php echo Url::to(['view', 'id' => $gameData['prevGame']->id]) ?>"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <span>Предыдущий матч</span></a>
                <?php endif; ?>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo Url::to('/games') ?>">Расписание игр</a>
            </div>
            <div class="col-xs-4">
                <?php if (!is_null($gameData['nextGame'])) : ?>
                <a href="<?php echo Url::to(['view', 'id' => $gameData['nextGame']->id]) ?>"><span>Следующий матч</span> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="row score-team-games">
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
                    $score = explode(':', $model->score);
                ?>
                <div class="game-view-score">
                    <span class="game-view-score"><?php echo $score[0] ?></span>
                    <span class="game-view-devider"><?php echo ':' ?></span>
                    <span class="game-view-score"><?php echo $score[1] ?></span>
                </div>
                <div class="day-month"><?php echo Yii::$app->formatter->asDate($model -> date,'php:d.m H:i') ?></div>
                <div class="game-view-city-stadion"><?php echo $model->city ?>, Стадион <?php echo $model->stadium?></div>

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
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Обзор</a></li>
<!--        //        $galleryStep = false;-->

        <?php if ($compositionsStep) : ?>
            <li role="presentation"><a href="#compositions" aria-controls="compositions" role="tab" data-toggle="tab">Составы</a></li>
        <?php endif; ?>
        <?php if ($galleryStep) : ?>
            <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Фото</a></li>
        <?php endif; ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home"><?php echo $model->content ?></div>
        <?php if ($compositionsStep) : ?>
            <div role="tabpanel" class="tab-pane" id="compositions">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary" style="margin-bottom: 0">
                            <div class="panel-heading">
                                <?php echo $model->home->name; ?>
                                <div class="pull-right">г.<?php echo $model->home->city ?></div>
                            </div>
                        </div>
                        <?php
                        echo GridView::widget([
                            'dataProvider' => $dataProvider['gamePlayersHome'],
                            'pjax' => true,
                            'options' => [
                                'id' => 'game-view-home',
                            ],
                            'responsive'=>true,
                            'hover'=>true,
                            'bordered'=>false,
                            'striped'=>true,
                            'containerOptions'=>['style'=>'overflow: auto'],
                            'layout' => '{items}',
                            'columns' => [
                                [
                                    'label' => false,
                                    'value' => function ($model) {
                                        return $model->players->number;
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'label' => 'Основной состав',
                                    'value' => function ($model) {
                                        return $model->players->surname.' '.$model->players->name;
                                    },
                                    'format' => 'raw',
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel panel-primary" style="margin-bottom: 0">
                            <div class="panel-heading">
                                <?php echo $model->guest->name; ?>
                                <div class="pull-right">г.<?php echo $model->guest->city ?></div>
                            </div>
                        </div>
                        <?php
                        echo GridView::widget([
                            'dataProvider' => $dataProvider['gamePlayersGuest'],
                            'pjax' => true,
                            'options' => [
                                'id' => 'game-view-guest',
                            ],
                            'responsive'=>true,
                            'hover'=>true,
                            'bordered'=>false,
                            'striped'=>true,
                            'containerOptions'=>['style'=>'overflow: auto'],
                            'layout' => '{items}',
                            'columns' => [
                                [
                                    'label' => false,
                                    'value' => function ($model) {
                                        return $model->players->number;
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'label' => 'Основной состав',
                                    'value' => function ($model) {
                                        return $model->players->surname.' '.$model->players->name;
                                    },
                                    'format' => 'raw',
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($galleryStep) : ?>
            <div role="tabpanel" class="tab-pane" id="gallery">
                <div class="row" style="margin: 0">
                    <?php
    //                var_dump($model->gallery);
    //                var_dump($model->gallery->getImages());
                    $images = $model->gallery->getImages();
                    if($images[0]['urlAlias']!='placeHolder') {
                        foreach($images as $img){
                            echo Html::tag('div',
                                Html::a(
                                    Html::img($img->getUrl('160x130'),['alt' => $model->gallery->name, 'class' => 'thumbnail']),
                                    $img->getUrl(),
                                    ['target' => '_blank']
                                ),
                                ['class' => 'gallery-view-box']
                            );
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

<!--    <div class="row">-->
<!--        <div class="col-xs-4">-->
<!--            --><?php //echo DetailView::widget([
//                'model' => $model,
//                'attributes' => [
////            'id',
////            [
////                'attribute' => 'home.name',
////                'label' => 'Команда дома',
////            ],
////            [
////                'attribute' => 'guest.name',
////                'label' => 'Команда в гостях',
////            ],
//                    'score',
//                    [
//                        'attribute' => 'season.name',
//                        'label' => 'Сезон',
//                    ],
//                    'tour',
//                    'city',
//                    'stadium',
//                    'referee',
//                    'referee2',
//                    'referee3',
//                    'content:html',
//                    'date:datetime',
//                    'status',
//                ],
//            ]);
//            ?>
<!--        </div>-->
<!--        <div class="col-xs-4">-->
<!--            <ul>-->
<!--            --><?php
//            echo Html::tag('h4', 'Состав команды '.$model->home->name);
//            foreach ($gameData['home'] as $item) {
//                echo Html::tag('li', '#'.$item->players->number.' '.$item->players->surname.' '.$item->players->name);
//            }
//            ?>
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="col-xs-4">-->
<!--            <ul>-->
<!--                --><?php
//                echo Html::tag('h4', 'Состав команды '.$model->guest->name);
//                foreach ($gameData['guest'] as $item) {
//                    echo Html::tag('li', '#'.$item->players->number.' '.$item->players->surname.' '.$item->players->name);
//                }
//                ?>
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->


</div>
