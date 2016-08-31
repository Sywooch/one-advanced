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
$translationStep = false;
$videoStep = false;
$behavior_rulesStep = false;
$prizesStep = false;
$previewStep = false;
$statisticsStep = false;
$pressConferenceStep = false;
$contentActive = 'active';
$galleryActive = '';
$videoActive = '';
$prizesActive = '';
$behavior_rulesActive = '';
if ($model->preview_content != '') {
    $previewStep = true;
}
if ((!empty($gameData['home']) && !empty($gameData['guest'])) || ($model->recaps != '')) {
    $compositionsStep = true;
}
if (!is_null($model->gallery)) {
    $galleryStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'gallery') {
        $contentActive = '';
        $galleryActive = 'active';
        $videoActive = '';
        $prizesActive = '';
        $behavior_rulesActive = '';
    }
}
if ($model->translation != '') {
    $translationStep = true;
}
if ($model->statistics != '') {
    $statisticsStep = true;
}
if ($model->press_conference != '') {
    $pressConferenceStep = true;
}
if ($model->video_id != '') {
    $videoStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'video') {
        $contentActive = '';
        $galleryActive = '';
        $videoActive = 'active';
        $prizesActive = '';
        $behavior_rulesActive = '';
    }
}
if ($model->behavior_rules != '' && $model->date > strtotime('-3 hour')) {
    $behavior_rulesStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'rules') {
        $contentActive = '';
        $galleryActive = '';
        $videoActive = '';
        $prizesActive = '';
        $behavior_rulesActive = 'active';
    }
}
if ($model->prizes != '') {
    $prizesStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'prizes') {
        $contentActive = '';
        $galleryActive = '';
        $videoActive = '';
        $prizesActive = 'active';
        $behavior_rulesActive = '';
    }
}
if ($model->behavior_rules != '') {
    $rulesStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'behavior_rules') {
        $contentActive = '';
        $galleryActive = '';
        $videoActive = '';
        $prizesActive = '';
        $behavior_rulesActive = 'active';
    }
}
$images = $model->getImage();
//var_dump($images);

if($images['urlAlias']!='placeHolder') {
    $imgUrl = 'background-image: url(' . $images->getUrl() . ');';
} else {
    $imgUrl = '';
}
?>
<div class="games-view">

<!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->

    <div class="games-view-score" style="<?php echo $imgUrl ?>">
        <div class="row text-center prev-next-games">
            <div class="col-xs-4">
                <?php if (!is_null($gameData['prevGame'])) : ?>
                <a href="<?php echo Url::to(['view', 'id' => $gameData['prevGame']->id]) ?>"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> <span>Предыдущий матч</span></a>
                <?php endif; ?>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo Url::to(['/games', 'output' => 'all']) ?>">Расписание игр</a>
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
                        $img = $model->season->getImage();
                        if ($img['urlAlias']!='placeHolder') {
                            echo Html::tag('div', Html::img($img->getUrl('50x'), ['style' => 'margin-right:0px;']), ['class' => 'games-img']);
                        }
                        echo $model->season->full_name;
                    } else {
                        echo $model->category->name;
                    }
                    ?>
                </div>
                <?php
                    if ($model->score == '0:0' && $model->date > time()) {
                        $model->score = '-:-';
                    }
                    $score = explode(':', $model->score);

                ?>
                <div class="game-view-score-block">
                    <span class="game-view-score"><?php echo $score[0] ?></span>
                    <span class="game-view-devider"><?php echo ':' ?></span>
                    <span class="game-view-score"><?php echo $score[1] ?></span>
                </div>
                <div class="day-month"><?php echo Yii::$app->formatter->asDate($model -> date,'php:d.m H:i') ?> (<?php echo Yii::$app->formatter->asDate($model -> date + 3600,'php:H:i') ?> Мск)</div>
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
    <div class="game-view-block">
        <?php if ($model->content != '') : ?>
        <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php if ($previewStep && $model->date > time()) : ?>
                    <li role="presentation" class="<?php echo $contentActive ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-pencil" aria-hidden="true"></i> Превью</a></li>
                <?php else : ?>
                    <li role="presentation" class="<?php echo $contentActive ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-pencil" aria-hidden="true"></i> Отчёт</a></li>
                <?php endif; ?>
                <?php if ($compositionsStep) : ?>
                    <li role="presentation">
                        <a href="#compositions" aria-controls="compositions" role="tab" data-toggle="tab"><i class="fa fa-align-justify" aria-hidden="true"></i> Составы</a>
                    </li>
                <?php endif; ?>
                <?php if ($galleryStep) : ?>
                    <li role="presentation" class="<?php echo $galleryActive ?>">
                        <a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab"><i class="fa fa-camera" aria-hidden="true"></i> Фото</a>
                    </li>
                <?php endif; ?>
                <?php if ($translationStep) : ?>
                    <li role="presentation"><a href="#translation" aria-controls="translation" role="tab" data-toggle="tab"><i class="fa fa-television" aria-hidden="true"></i> Трансляция</a></li>
                <?php endif; ?>
                <?php if ($statisticsStep) : ?>
                    <li role="presentation" class="<?php echo $videoActive ?>"><a href="#statistics" aria-controls="statistics" role="tab" data-toggle="tab"><i class="fa fa-align-justify" aria-hidden="true"></i> Статистика</a></li>
                <?php endif; ?>
                <?php if ($videoStep) : ?>
                    <li role="presentation" class="<?php echo $videoActive ?>"><a href="#video" aria-controls="video" role="tab" data-toggle="tab"><i class="fa fa-video-camera" aria-hidden="true"></i> Видео</a></li>
                <?php endif; ?>
                <?php if ($pressConferenceStep) : ?>
                    <li role="presentation" class="<?php echo $videoActive ?>"><a href="#pressConference" aria-controls="pressConference" role="tab" data-toggle="tab"><i class="fa fa-video-camera" aria-hidden="true"></i> Пресс конференция</a></li>
                <?php endif; ?>
                <?php if ($behavior_rulesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
                    <li role="presentation" class="<?php echo $behavior_rulesActive ?>"><a href="#behavior_rules" aria-controls="behavior_rules" role="tab" data-toggle="tab"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Правила поведения на матче</a></li>
                <?php endif; ?>
                <?php if ($prizesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
                    <li role="presentation" class="<?php echo $prizesActive ?>"><a href="#prizes" aria-controls="prizes" role="tab" data-toggle="tab"><i class="fa fa-gift" aria-hidden="true"></i> Призы</a></li>
                <?php endif; ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php if ($model->content != '') : ?>
                    <div role="tabpanel" class="tab-pane <?php echo $contentActive ?>" id="home"><?php echo $model->content ?></div>
                <?php endif; ?>
                <?php if ($compositionsStep) : ?>
                    <div role="tabpanel" class="tab-pane" id="compositions">
                        <?php if ($model->recaps != '') : ?>
                            <?php echo $model->recaps ?>
                        <?php else : ?>
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
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
                <?php if ($galleryStep) : ?>
                    <div role="tabpanel" class="tab-pane <?php echo $galleryActive ?>" id="gallery">
                        <div class="row" style="margin: 0">
                            <?php
                            //                var_dump($model->gallery);
                            //                var_dump($model->gallery->getImages());
                            $images = $model->gallery->getImages();
                            if($images[0]['urlAlias']!='placeHolder') {
                                foreach($images as $img){
                                    $options = ['target' => '_blank'];
                                    $imgExtension = pathinfo($img->filePath)['extension'];
                                    if ($imgExtension != '') {
                                        $options = ['class' => 'lightbox'];
                                    }
                                    echo Html::tag('div',
                                        Html::a(
                                            Html::img($img->getUrl('160x130'),['alt' => $model->gallery->name, 'class' => '']),
                                            $img->getUrl(),$options
                                        ),
                                        ['class' => 'gallery-view-box']
                                    );
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($translationStep) : ?>
                    <div role="tabpanel" class="tab-pane" id="translation"><?php echo $model->translation ?></div>
                <?php endif; ?>
                <?php if ($statisticsStep) : ?>
                    <div role="tabpanel" class="tab-pane" id="statistics"><?php echo $model->statistics ?></div>
                <?php endif; ?>

                <?php if ($videoStep) : ?>
                    <div role="tabpanel" class="tab-pane <?php echo $videoActive ?>" id="video">
                        <!--                width="560" height="315"-->
                        <iframe style="width: 100%; height: 620px;" src="https://www.youtube.com/embed/<?php echo $model->video_id ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <?php if ($pressConferenceStep) : ?>
                    <div role="tabpanel" class="tab-pane" id="pressConference">
                        <iframe style="width: 100%; height: 620px;" src="https://www.youtube.com/embed/<?php echo $model->press_conference ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
                <?php if ($behavior_rulesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
                    <div role="tabpanel" class="tab-pane <?php echo $behavior_rulesActive ?>" id="behavior_rules"><?php echo $model->behavior_rules ?></div>
                <?php endif; ?>
                <?php if ($prizesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
                    <div role="tabpanel" class="tab-pane <?php echo $prizesActive ?>" id="prizes"><?php echo $model->prizes ?></div>
                <?php endif; ?>
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
