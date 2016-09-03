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
    }
}
if ($model->translation != '') {
    $translationStep = true;
}
if ($model->statistics != '') {
    $statisticsStep = true;
}
if ($model->press_conference != '' || $model->press_conference2 != '') {
    $pressConferenceStep = true;
}
if ($model->video_id != '') {
    $videoStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'video') {
        $contentActive = '';
        $galleryActive = '';
        $videoActive = 'active';
    }
}
if ($model->behavior_rules != '') {
    $behavior_rulesStep = true;
}
if ($model->prizes != '') {
    $prizesStep = true;
    if (isset($_GET['tab']) && $_GET['tab'] == 'prizes') {
        $contentActive = '';
        $galleryActive = '';
        $videoActive = '';
        $prizesActive = 'active';
    }
}

//var_dump($model->home->name);
//if (isset($_GET['tab'])) {
//    ?>
<!--    <script type="text/javascript">$("#video");</script>-->
<?php
////    $this->registerJs('show.bs.tab(\''.$_GET['tab'].'\')');
//}
?>
<div class="games-view">

<!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->
    <div class="row text-center">
        <div class="col-xs-4">
            <a href="<?php echo Url::to(['view', 'id' => $gameData['prevGame']->id]) ?>">Предыдущий матч</a>
        </div>
        <div class="col-xs-4">
            <a href="<?php echo Url::to('/games') ?>">Расписание игр</a>
        </div>
        <div class="col-xs-4">
            <a href="<?php echo Url::to(['view', 'id' => $gameData['nextGame']->id]) ?>">Следующий матч</a>
        </div>
    </div>
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
    <?php if ($model->content != '') : ?>
    <ul class="nav nav-tabs" role="tablist">
        <?php if ($previewStep && $model->date > time()) : ?>
            <li role="presentation" class="<?php echo $contentActive ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Превью</a></li>
        <?php else : ?>
            <li role="presentation" class="<?php echo $contentActive ?>"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Обзор</a></li>
        <?php endif; ?>
<!--        <li role="presentation" class="--><?php //echo $contentActive ?><!--"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Обзор</a></li>-->
<!--        //        $galleryStep = false;-->
        <?php if ($compositionsStep) : ?>
            <li role="presentation"><a href="#compositions" aria-controls="compositions" role="tab" data-toggle="tab">Составы</a></li>
        <?php endif; ?>
        <?php if ($galleryStep) : ?>
            <li role="presentation" class="<?php echo $galleryActive ?>"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Фото</a></li>
        <?php endif; ?>
        <?php if ($translationStep) : ?>
            <li role="presentation"><a href="#translation" aria-controls="translation" role="tab" data-toggle="tab">Трансляция</a></li>
        <?php endif; ?>
        <?php if ($statisticsStep) : ?>
            <li role="presentation" class=""><a href="#statistics" aria-controls="statistics" role="tab" data-toggle="tab">Статистика</a></li>
        <?php endif; ?>
        <?php if ($videoStep) : ?>
            <li role="presentation" class="<?php echo $videoActive ?>"><a href="#video" aria-controls="video" role="tab" data-toggle="tab">Видео</a></li>
        <?php endif; ?>
        <?php if ($pressConferenceStep) : ?>
            <li role="presentation" class=""><a href="#pressConference" aria-controls="pressConference" role="tab" data-toggle="tab">Пресс конференция</a></li>
        <?php endif; ?>
        <?php if ($behavior_rulesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
            <li role="presentation"><a href="#behavior_rules" aria-controls="behavior_rules" role="tab" data-toggle="tab">Правила поведения на матче</a></li>
        <?php endif; ?>
        <?php if ($prizesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
            <li role="presentation" class="<?php echo $prizesActive ?>"><a href="#prizes" aria-controls="prizes" role="tab" data-toggle="tab">Призы</a></li>
        <?php endif; ?>
<!--        $translationStep = false;-->
<!--        $videoStep = false;-->
<!--        $behavior_rulesStep = false;-->
<!--        $prizesStep = false;-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <?php if ($previewStep && $model->date > time()) : ?>
            <div role="tabpanel" class="tab-pane <?php echo $contentActive ?>" id="home"><?php echo $model->preview_content ?></div>
        <?php else : ?>
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
                <?php if ($model->press_conference != '') : ?>
                <iframe style="width: 100%; height: 620px;" src="https://www.youtube.com/embed/<?php echo $model->press_conference ?>" frameborder="0" allowfullscreen></iframe>
                <?php endif; ?>
                <?php
                if ($model->press_conference != '' && $model->press_conference2 != '') {
                    echo Html::tag('p', false, ['style' => 'margin-bottom: 20px']);
                }
                ?>
                <?php if ($model->press_conference2 != '') : ?>
                <iframe style="width: 100%; height: 620px;" src="https://www.youtube.com/embed/<?php echo $model->press_conference2 ?>" frameborder="0" allowfullscreen></iframe>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ($behavior_rulesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
            <div role="tabpanel" class="tab-pane" id="behavior_rules"><?php echo $model->behavior_rules ?></div>
        <?php endif; ?>
        <?php if ($prizesStep && $model->home->name == Yii::$app->params['main-team']) : ?>
            <div role="tabpanel" class="tab-pane <?php echo $prizesActive ?>" id="prizes"><?php echo $model->prizes ?></div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

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
