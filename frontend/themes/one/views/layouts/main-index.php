<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use limion\bootstraplightbox\BootstrapMediaLightboxAsset;
use common\widgets\Alert;
use yii\bootstrap\Carousel;
use common\models\Players;
use common\models\Teams;
use frontend\widgets\MenuWidget;
//use rmrevin\yii\fontawesome\FA;
use Madcoda\Youtube;
use yii\helpers\Url;
use kartik\icons\Icon;
use frontend\widgets\GalleryWidget;
use frontend\assets\CarouselAsset;
use frontend\widgets\StandingsWidget;
Icon::map($this, Icon::FA);

AppAsset::register($this);
if(Yii::$app->params['gamesPreview3d']) {
    CarouselAsset::register($this);
}
BootstrapMediaLightboxAsset::register($this);

$this->title = $this->title . ' | ФК ' . Yii::$app->params['main-team'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=1200">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!— Yandex.Metrika counter —>
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39359185 = new Ya.Metrika({
                    id:39359185,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39359185" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!— /Yandex.Metrika counter —>
<div class="wrap wrap-index">
    <?php
    NavBar::begin([
//        'brandLabel' => 'Frontend',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-top',//navbar-fixed-top
        ],
    ]);
        echo MenuWidget::widget(['position' => 'headerTop']);

        if (Yii::$app->user->isGuest) {
            $menuItems = [
                ['label' => 'Вход', 'url' => ['/site/login']],
                ['label' => 'Регистрация', 'url' => ['/site/signup']],
            ];
        } else {
            $menuItems[] = ['label' => 'Админ панель', 'url' => ['/admin'], 'visible' => Yii::$app->user->identity->role == 30];
            $menuItems[] = [
                'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right navbar-login-signup'],
            'items' => $menuItems,
        ]);
    NavBar::end();
    ?>

    <?php
    NavBar::begin([
//        'brandLabel' => 'Frontend',
        'brandLabel' => Html::img('@web/themes/one/src/logo.svg', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
//        'brandOptions' => ['class' => 'col-xs-4 brand'],
        'options' => [
            'class' => 'navbar-inverse navbar-bottom',
        ],
    ]);
        echo Html::beginTag('div',['class'=>'row']);
            echo Html::beginTag('div',['class'=>'col-xs-9 pull-right name-menu']);//col-xs-offset-1
                echo Html::img('@web/themes/one/src/layout/GK_sodruzestvo_white_2.png', ['class' => 'sponsor-header']);
                echo Html::tag('h3','Официальный сайт футбольного клуба');
                echo Html::tag('h2','"Балтика" Калининград');
                echo MenuWidget::widget(['position' => 'headerBottom']);
            echo Html::endTag('div');
        echo Html::endTag('div');


    NavBar::end();
    ?>

    <div class="container">
        <?php
//        $controller_action = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
//        if ($controller_action == 'site/index') {
            $carousel_items = [
                [
                    'content' => Html::img('@web/themes/one/src/slider/new-slide.png'),
                    'caption' => '<h2 style="margin-top: 0">УВАЖАЕМЫЕ БОЛЕЛЬЩИКИ!</h2>
                              <hr style="border-color: #011f5f; border-width: 2px; margin: 20px 0;">
                              <p style="">Мы рады приветствовать вас на обновленном сайте футбольного клуба “Балтика”.</p>
                              <p>В настоящий момент некоторые разделы находятся на этапе создания/редактирования/наполнения.</p>
                              <p>
                              Приносим свои извинения за доставленные неудобства.
                              Все пожелания и предложения по нашему новому сайту вы можете оставить в разделе
                              <a href="'.Url::toRoute(['/guest-book']).'" style="color: #07366F;"><b>гостевая</b></a>.
                              </p>
                              <p>Искренне надеемся, что наш новый сайт вам понравится!</p>',
                ],
//                [
//                    'content' => Html::img('@web/themes/one/src/slider/slide.png'),
//                    'caption' => '<h2 style="margin-top: 0">ЕСТЬ<br> ПЕРВАЯ<br> ПОБЕДА!</h2>
//                              <hr style="border-color: #011f5f; border-width: 2px; margin: 10px 0;">
//                              <p><div style="font-size: 16px"><b>БАЛТИКА - САХАЛИН 1:0</b></div><div style="font-size: 12px"><i>28.06.2015 г.Минск</i></div></p>
//                              <p style="">На учебно-тренировочном сборе в Минске, «Балтика» провела одну из двух запланированных встреч с «Сахалином». На эту игру тренерский штаб калининградской команды выпустил... </p>',
//                ],
//                [
//                    'content' => Html::img('@web/themes/one/src/slider/slide-2.jpg'),
//                    'caption' => '<h2 style="margin-top: 0">ПЕРВАЯ<br> ИГРА<br> ГОДА!</h2>
//                              <hr style="border-color: #011f5f; border-width: 2px; margin: 10px 0;">
//                              <p><div style="font-size: 16px"><b>БАЛТИКА - СОКОЛ 0:0</b></div><div style="font-size: 12px"><i>13.03.2016 г.Калининград</i></div></p>',
//                ],
                //Html::img('@web/themes/one/src/logo.png', ['alt'=>Yii::$app->name])
            ];
            echo Html::beginTag('div',['class'=>'carousel-home']);
                echo Carousel::widget([
                    'items' => $carousel_items,
                    'controls' => [
                        '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
                        '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
                    ],
                    'options' => [
                        'class' => 'carousel'
                    ],
                    'clientOptions' => [
                        'interval' => '10000',
                    ],
        //        'cl'
                ]);
//                echo Html::beginTag('div',['class'=>'carousel-promo']);
//                    echo Html::beginTag('div',['class'=>'row']);
//                        echo Html::beginTag('div',['class'=>'col-xs-6']);
//                            echo Html::beginTag('div',['class'=>'promo-game-block']);
//                                echo Html::beginTag('div',['class'=>'promo-game-header']);
//                                    echo Html::tag('div',
//                                        Html::tag('div','21.05.2016, Фонбет-первенство россии по футболу',['class'=>'promo-game-date col-xs-12 vtop'])/*.
//                                        Html::a('Отчет видео - фото','#',['class'=>'promo-game-link col-xs-4 text-right vtop'])*/,
//                                        ['class'=>'row']
//                                    );
//                                echo Html::endTag('div');
//                                echo Html::beginTag('div',['class'=>'row promo-game-row']);
//                                    echo Html::beginTag('div',['class'=>'col-xs-5 text-left promo-game-team vcenter']);
//                                        echo Html::img('@web/themes/one/src/logo.png', ['class' => 'hidden-sm']).Html::tag('span',Html::tag('b','Балтика'));
//                                    echo Html::endTag('div');
//                                    echo Html::beginTag('div',['class'=>'col-xs-2 text-center promo-game-score vcenter']);
//                                        echo Html::tag('div','0:3');
//                                    echo Html::endTag('div');
//                                    echo Html::beginTag('div',['class'=>'col-xs-5 text-right promo-game-team vcenter']);
//                                        echo Html::tag('span','Шинник').Html::img('@web/themes/one/src/teams/shinnik_yaroslavl.png', ['style'=>'height: 42px;width: auto;', 'class' => 'hidden-sm']);
//                                    echo Html::endTag('div');
//                                echo Html::endTag('div');
//                            echo Html::endTag('div');
//                        echo Html::endTag('div');
//                        echo Html::beginTag('div',['class'=>'col-xs-6']);
//                            echo Html::beginTag('div',['class'=>'promo-game-block']);
//                                echo Html::beginTag('div',['class'=>'promo-game-header']);
//                                    echo Html::tag('div',
//                                    Html::tag('div', '<script src="http://megatimer.ru/s/8ebdba3b7888be972454b34d81447b03.js"></script>', ['class' => 'pull-right']).
////                                    Html::tag('div', '<script src="http://megatimer.ru/s/e4d7007cd2e033e4d7e30b251ec7b569.js"></script>', ['class' => 'pull-right']).
//                                        Html::tag('div','11.07.2016, Фонбет-первенство россии',['class'=>'promo-game-date col-xs-8 vtop'])/*.
//                                        Html::a('Превью трансляции','#',['class'=>'promo-game-link col-xs-4 text-right vtop'])*/,
//                                        ['class'=>'row']
//                                    );
////                                echo '<script src="http://megatimer.ru/s/b5d4829fb96d5e489b75b5746ac698e7.js"></script>';
//                                echo Html::endTag('div');
//                                echo Html::beginTag('div',['class'=>'row promo-game-row']);
//                                    echo Html::beginTag('div',['class'=>'col-xs-5 text-left promo-game-team vcenter']);
//                                        echo Html::img('@web/themes/one/src/logo.png', ['class' => 'hidden-sm']).Html::tag('span',Html::tag('b','Балтика'));
//                                    echo Html::endTag('div');
//                                    echo Html::beginTag('div',['class'=>'col-xs-2 text-center promo-game-score vcenter']);
//                                        echo Html::tag('div','-:-');
//                                    echo Html::endTag('div');
//                                    echo Html::beginTag('div',['class'=>'col-xs-5 text-right promo-game-team vcenter']);
//                                        echo Html::tag('span','Шинник').Html::img('@web/themes/one/src/teams/shinnik_yaroslavl.png',['style'=>'height: 42px;width: auto;', 'class' => 'hidden-sm']);
//                                    echo Html::endTag('div');
//                                echo Html::endTag('div');
//                            echo Html::endTag('div');
//                        echo Html::endTag('div');
//                    echo Html::endTag('div');
//                echo Html::endTag('div');
            echo Html::endTag('div');
//        }
        ?>
        <?php if (!is_null($this->params['gamesPreview'])) { ?>
            <?php if(Yii::$app->params['gamesPreview3d']) { ?>
                <div class="carousel-promo-games">
                    <ul class="carousel carousel-3d">
                        <div class="carousel-bg"></div>
                        <?php
                        $i = 1;
                        foreach ($this->params['gamesPreview'] as $item) {
                            ?>
                            <li class="item">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="<?php echo Url::to(['/games/view', 'id' => $item->id]);?>" class="promo-game-block" data-pjax="false">
                                            <div class="promo-game-header <?php echo $i != 4 ? 'text-center' : '' ?>">
                                                <div class="row">
                                                    <div class="promo-game-date vtop <?php echo $i == 4 ? 'col-xs-8' : 'col-xs-12' ?>">
                                                        <?php
                                                        echo Yii::$app->formatter->asDatetime($item->date, 'php:d.m, H:i').'  '.$item->city.', стадион '.$item->stadium;
                                                        ?>
                                                    </div>
                                                    <?php
                                                    if ($i == 4) {
                                                        echo Html::tag('div', '<script src="http://megatimer.ru/s/8ebdba3b7888be972454b34d81447b03.js"></script>', ['class' => 'pull-right', 'style' => 'margin-right: 15px;']);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row promo-game-row">
                                                <div class="col-xs-5 text-left promo-game-team">
                                                    <?php
                                                    $image = $item->home->getImage();
                                                    if($image['urlAlias']!='placeHolder') {
                                                        $sizes = $image->getSizesWhen('x45');
                                                        echo Html::img($image->getUrl('x45'),[
                                                            'alt'=>$item->home->name,
                                                            'class' => 'hidden-sm',
                                                            'width'=>$sizes['width'],
                                                            'height'=>$sizes['height']
                                                        ]);
                                                    }
                                                    ?>
                                                    <span>
                                                        <?php
                                                        echo ($item->home->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                        echo $item->home->name;
                                                        echo ($item->home->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="col-xs-2 text-center promo-game-score">
                                                    <div><?php
                                                        if ($item->score == '0:0' && $item->date > time()) {
                                                            echo '-:-';
                                                        } else {
                                                            echo $item->score;
                                                        }
                                                        ?></div>
                                                </div>
                                                <div class="col-xs-5 text-right promo-game-team">
                                                    <span>
                                                        <?php
                                                        echo ($item->guest->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                        echo $item->guest->name;
                                                        echo ($item->guest->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                        ?>
                                                    </span>
                                                    <?php
                                                    $image = $item->guest->getImage();
                                                    if($image['urlAlias']!='placeHolder') {
                                                        $sizes = $image->getSizesWhen('x45');
                                                        echo Html::img($image->getUrl('x45'),[
                                                            'alt'=>$item->guest->name,
                                                            'class' => 'hidden-sm',
                                                            'width'=>$sizes['width'],
                                                            'height'=>$sizes['height']
                                                        ]);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php
                            $i++;
                        }
                        ?>
                        <div class="controls">
                            <a href="#" class="left carousel-control previous"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                            <a href="#" class="right carousel-control next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                        </div>

                    </ul>
                </div>
            <?php } else { ?>
                <div class="carousel-promo carousel-promo-2d">
                    <?php
                    $carIt = [
                        [$this->params['gamesPreview'][0], $this->params['gamesPreview'][1]],
                        [$this->params['gamesPreview'][2], $this->params['gamesPreview'][3]],
                        [$this->params['gamesPreview'][4], $this->params['gamesPreview'][5]],
                    ];
                    $i=0;
                    ?>
                    <div id="w5" class="carousel carousel-2d">
                        <div class="carousel-inner">
                            <?php foreach($carIt as $items) { $i++;$j=0;?>
                                <div class="item <?php echo $i==2 ? 'active' : ''?>">
                                    <div class="row">
                                        <?php foreach($items as $item) {$j++ ?>
<!--                                            --><?php //var_dump($item->season->full_name); ?>
                                            <div class="col-xs-6 carousel-promo-block">
                                                <a href="<?php echo Url::to(['/games/view', 'id' => $item->id]);?>" class="promo-game-block">
                                                    <div class="promo-game-header">
                                                        <div class="row">
                                                            <div class="col-xs-6 promo-game-pervenstvo text-right vcenter">
                                                                <?php
                                                                if ($item->category->name == 'Первенство') {
                                                                    $img = $item->season->getImage();
                                                                    if ($img['urlAlias']!='placeHolder') {
                                                                        echo Html::img($img->getUrl('20x'), ['style' => 'margin-right:5px;']);
                                                                    }
                                                                }
                                                                echo Html::tag('div', $item->category->name == 'Первенство' ? $item->season->division : $item->category->name, ['class' => 'game-preview-name']);
                                                                ?>
                                                            </div>
                                                            <div class="promo-game-date col-xs-6 vcenter" <?php echo $i==2 & $j==2 ? 'style="width: auto;"' : '' ?>>
                                                                <?php echo Yii::$app->formatter->asDateTime($item->date, 'php:d.m.Y H:s') ?>

                                                                <?php if($i==2 & $j==2) {
                                                                    echo Html::tag('div', '(' . '<script src="http://megatimer.ru/s/8ebdba3b7888be972454b34d81447b03.js"></script>' . ')', ['class' => 'timer']);
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="promo-game-row">
                                                        <div class="col-xs-5 text-right promo-game-team vcenter">
                                                    <span>
                                                        <?php
                                                        echo ($item->home->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                        echo $item->home->name;
                                                        echo ($item->home->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                        ?>
                                                    </span>
                                                            <?php
                                                            $image = $item->home->getImage();
                                                            if($image['urlAlias']!='placeHolder') {
    //                                                    $sizes = $image->getSizesWhen('30x45');
                                                                echo Html::img($image->getUrl('30x'),[
                                                                    'alt'=>$item->home->name,
                                                                    'class' => 'hidden-sm',
    //                                                        'width'=>$sizes['width'],
    //                                                        'height'=>$sizes['height']
                                                                ]);
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-xs-2 text-center promo-game-score vcenter">
                                                            <div><?php
                                                                if ($item->score == '0:0' && $item->date > time()) {
                                                                    echo '<div>-:-</div>';
                                                                } else {
                                                                    echo $item->score;
                                                                }
                                                                ?></div>
                                                        </div>
                                                        <div class="col-xs-5 text-left promo-game-team vcenter">
                                                            <?php
                                                            $image = $item->guest->getImage();
                                                            if($image['urlAlias']!='placeHolder') {
    //                                                    $sizes = $image->getSizesWhen('x45');
                                                                echo Html::img($image->getUrl('30x'),[
                                                                    'alt'=>$item->guest->name,
                                                                    'class' => 'hidden-sm',
    //                                                        'width'=>$sizes['width'],
    //                                                        'height'=>$sizes['height']
                                                                ]);
                                                            }
                                                            ?>
                                                            <span>
                                                        <?php
                                                        echo ($item->guest->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                        echo $item->guest->name;
                                                        echo ($item->guest->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                        ?>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="promo-photo-video-ticket text-center">
                                                    <?php

                                                    if ($item->date > time()) {
                                                        if ($item->home->name == Yii::$app->params['main-team']) {
                                                            if ($item->ticket_id != '' ) {
                                                                echo Html::a(Icon::show('ticket'), 'https://kgd.kassir.ru/kassirwidget/event/' . $item->ticket_id, [
                                                                    'onclick' => 'kassirWidget.summon({width:940, url:\'https://kgd.kassir.ru/kassirwidget/event/' . $item->ticket_id . '\'}); return false;',
                                                                    'target' => '_blank',
                                                                    'data-toggle' => 'tooltip',
                                                                    'data-placement' => 'top',
                                                                    'data-html' => 'bottom',
                                                                    'data-original-title' => 'Купить билет',
                                                                ]);
                                                            }
                                                        }
                                                    }
//                                                    var_dump($item->behavior_rules);
                                                    if ($item->behavior_rules != '' && $item->date > strtotime('-3 hour')) {
//                                                        <span title="Игры" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="">И</span>
                                                        echo Html::a(Icon::show('exclamation-triangle'), ['/games/view', 'id' => $item->id, 'tab' => 'rules'], [
                                                            'data-toggle' => 'tooltip',
                                                            'data-placement' => 'top',
                                                            'data-html' => 'bottom',
                                                            'data-original-title' => 'Правила поведения',
                                                        ]);
                                                    }
                                                    if (!is_null($item->gallery)) {
                                                        echo Html::a(Icon::show('camera'), ['/games/view', 'id' => $item->id, 'tab' => 'gallery'], [
                                                            'data-toggle' => 'tooltip',
                                                            'data-placement' => 'top',
                                                            'data-html' => 'bottom',
                                                            'data-original-title' => 'Фоторепортаж',
                                                        ]);
                                                    }
                                                    if ($item->video_id != '') {
                                                        echo Html::a(Icon::show('video-camera'), ['/games/view', 'id' => $item->id, 'tab' => 'video'], [
                                                            'data-toggle' => 'tooltip',
                                                            'data-placement' => 'top',
                                                            'data-html' => 'bottom',
                                                            'data-original-title' => 'Видео матча',
                                                        ]);
                                                    }
                                                    if ($item->prizes != '') {
                                                        echo Html::a(Icon::show('gift'), ['/games/view', 'id' => $item->id, 'tab' => 'prizes'], [
                                                            'data-toggle' => 'tooltip',
                                                            'data-placement' => 'top',
                                                            'data-html' => 'bottom',
                                                            'data-original-title' => 'Призы',
                                                        ]);
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <a class="left carousel-control" href="#w5" data-slide="prev">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                        </a>
                        <a class="right carousel-control" href="#w5" data-slide="next">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <?php  ?>
            <?php } ?>
        <?php } ?>
        <div class="row main-row">
            <div class="col-xs-3">
<!--                <div class="index-video">-->
<!--                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/SH5gKOoECNY" frameborder="0" allowfullscreen></iframe>-->
<!--                </div>-->
                <?php
                if (isset($this->params['widget_bar']) && $this->params['widget_bar'] != '') {
                echo '<div>'.$this->params['widget_bar'].'</div>';
                } else {
                    StandingsWidget::widget(['template' => 'smallTable']);
                }
                ?>
                <div class="banners-index">
                    <h4>Баннеры</h4>
                    <a href="http://www.sodrugestvo.ru/" target="_blank" class="text-center" style="margin-top: 15px; display: block;">
                        <?php echo Html::img('@web/themes/one/src/banner_1.gif', ['alt' => 'sponsor']) ?>
                    </a>
                    <a href="/page/dussh" target="_blank" class="text-center" style="margin-top: 15px; display: block;">
                        <?php echo Html::img('@web/themes/one/src/banner-det.jpg', ['alt' => 'sponsor']) ?>
                    </a>
                    <div class="text-center" style="margin-top: 15px;">
                        <?php echo Html::img('@web/themes/one/src/banner_2.jpg', ['alt' => 'sponsor', 'style' => 'width: 232px;']) ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-9 main-block">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
<!--        <div class="row">-->
<!--            <div class="col-sm-3"></div>-->
<!--            <div class="col-sm-9">-->

                <?= $content ?>
            </div>
        </div>
        <?php
        $teams = Teams::find()->where(['name' => Yii::$app->params['main-team']])->one();
//        var_dump();
//        $players = Players::find()->where(['teams_id'=>$teams->id])->orderBy('number')->all();
        $playersGoals = Players::find()->where(['teams_id'=>$teams->id])->orderBy('goals DESC')->one();
        $playersTransfers = Players::find()->where(['teams_id'=>$teams->id])->orderBy('transfers DESC')->one();
//        var_dump($players);
//        var_dump($players['2'])
        ?>
<!--        <div class="statistics-season">-->
            <div class="statistics-season">
                <div class="">
                    <h4>Статистика сезона</h4>
                    <div class="row">
                        <div class="col-xs-7 best-players">
                            <div class="col-xs-6 best-players-block">
                                <a href="<?php echo Url::toRoute(['/players/view', 'id' => $playersGoals['id']]) ?>">
                                <div class="best-players-header">
                                    <span class="best-players-role">Лучший бомбардир</span>
                                    <span class="best-players-goals"><?php
                                        $goals = $playersGoals->goals;
//                                        $goals = 6;
                                        $goalsText = '';
                                        $golov = [
                                            0,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,25,26,27,28,29,30,35,36,37,38,39,
                                            40,45,46,47,48,49,50,55,56,57,58,59,60,65,66,67,68,69,70,75,76,77,78,79,80,
                                            85,86,87,88,89,90,95,96,97,98,99,100
                                        ];
                                        $gol = [1,21,31,41,51,61,71,81,91];
                                        $gola = [2,3,4,22,23,24,32,33,34,42,43,44,52,53,54,62,63,64,72,73,74,82,83,84,92,93,94];
                                        if (in_array($goals, $golov)) {
                                            $goalsText = 'Голов';
                                        } elseif (in_array($goals, $gol)) {
                                            $goalsText = 'Гол';
                                        } elseif (in_array($goals, $gola)) {
                                            $goalsText = 'Гола';
                                        }
                                        echo $goals . ' ' . $goalsText;

//                                        echo Yii::t(
//                                            'app',
//                                            '{n, plural, =0{# Голов} =1{# Гол} one{# Гол} few{# Гола} many{# Голов} other{# Голов}}',
//                                            ['n' => 3]
//                                        );
                                        $playersGoals->goals
                                        ?> </span>
                                </div>
                                <div class="best-players-image">
                                    <?php
                                    $images = $playersGoals->getImages();
                                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
//                                        echo Html::beginTag('div',['class'=>'']);
                                            $image = $playersGoals->getImage();
//                                            echo Html::img($image->getUrl('x150'),['class' => 'img-responsive']);
                                            echo Html::tag('div',false,['class'=>'best-players-img','style'=> 'background-image:url('.$image->getUrl('x150').')']);
//                                        echo Html::endTag('div');
                                    }
                                    ?>
                                </div>
                                <div class="best-players-number-name">
                                    <span class="best-players-number">#<?php echo $playersGoals['number'] ?></span>
                                    <span class="best-players-name">
                                        <?php echo $playersGoals['surname'].' '.$playersGoals['name'] ?>
                                    </span>
                                </div>
                                </a>
                            </div>
                            <div class="col-xs-6 best-players-block">
                                <a href="<?php echo Url::toRoute(['/players/view', 'id' => $playersTransfers['id']]) ?>">
                                <div class="best-players-header">
                                    <span class="best-players-role">Лучший ассистент</span>
                                    <span class="best-players-goals"><?php
                                        $transfers = $playersTransfers->transfers;
                                        $transfersText = '';
                                        $peredach = [
                                            0,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,25,26,27,28,29,30,35,36,37,38,39,
                                            40,45,46,47,48,49,50,55,56,57,58,59,60,65,66,67,68,69,70,75,76,77,78,79,80,
                                            85,86,87,88,89,90,95,96,97,98,99,100
                                        ];
                                        $peredacha = [1,21,31,41,51,61,71,81,91];
                                        $peredachi = [2,3,4,22,23,24,32,33,34,42,43,44,52,53,54,62,63,64,72,73,74,82,83,84,92,93,94];
                                        if (in_array($transfers, $peredach)) {
                                            $transfersText = 'Передач';
                                        } elseif (in_array($transfers, $peredacha)) {
                                            $transfersText = 'Передача';
                                        } elseif (in_array($transfers, $peredachi)) {
                                            $transfersText = 'Передачи';
                                        }
                                        echo $transfers . ' ' . $transfersText;
//                                        echo Yii::t(
//                                            'app',
//                                            '{n, plural, =0{# Передач} =1{# Передача} one{# Передача} few{# Передачи} many{# Передач} other{# Передач}}',
//                                            ['n' => $playersTransfers->transfers ]
//                                        );
                                        ?> </span>
                                </div>
                                <div class="best-players-image">
                                    <?php
                                    $images = $playersTransfers->getImages();
                                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
//                                        echo Html::beginTag('div',['class'=>'']);
                                        $image = $playersTransfers->getImage();
//                                        echo Html::img($image->getUrl('x150'),['class' => 'img-responsive']);
                                        echo Html::tag('div',false,['class'=>'best-players-img','style'=> 'background-image:url('.$image->getUrl('x150').')']);
//                                        echo Html::endTag('div');
                                    }
                                    ?>
                                </div>
                                <div class="best-players-number-name">
                                    <span class="best-players-number">#<?php echo $playersTransfers['number'] ?></span>
                                    <span class="best-players-name">
                                        <?php echo $playersTransfers['surname'].' '.$playersTransfers['name'] ?>
                                    </span>
                                </div>
                                </a>
                            </div>
                        </div>
                        <?php
                        $mainTeam = $this->params['data']['mainTeam'];
//                        var_dump($this->params['data']['mainTeam']->id);
//                        var_dump($mainTeam->games);
//                        var_dump($mainTeam->gamesGuest);
//                        var_dump($mainTeam->games->home);
                        $games = [];
                        $games['home'] = $mainTeam->games;
                        $games['guest'] = $mainTeam->gamesGuest;
                        $games['homeCount'] = 0;
                        $games['homeWins'] = 0;
                        $games['homeLose'] = 0;
                        $games['homeDrow'] = 0;
                        $games['homeScored'] = 0;
                        $games['homeMissing'] = 0;
                        $games['guestCount'] = 0;
                        $games['guestWins'] = 0;
                        $games['guestLose'] = 0;
                        $games['guestDrow'] = 0;
                        $games['guestScored'] = 0;
                        $games['guestMissing'] = 0;
//                        var_dump($this->params['data']['season']);
                        foreach ($games['home'] as $item) {
                            if ($item->category->name == 'Первенство') {
                                if ($item->season_id == $this->params['data']['season']->id) {

                                    if ($item->date < time()){
                                        $games['homeCount']++;
//                                        var_dump($item->score);
                                        $score = explode(':', $item->score);
//                                        var_dump($score);
                                        $games['homeScored'] += $score[0];
                                        $games['homeMissing'] += $score[1];
                                        if ($score[0] > $score[1]) {
                                            $games['homeWins']++;
                                        } elseif($score[0] < $score[1]) {
                                            $games['homeLose']++;
                                        } elseif($score[0] == $score[1]) {
                                            $games['homeDrow']++;
                                        }
                                    }
                                }
                            }

                        }
                        foreach ($games['guest'] as $item) {
                            if ($item->category->name == 'Первенство') {
                                if ($item->season_id == $this->params['data']['season']->id) {
                                    if ($item->date < time()){
                                        $games['guestCount']++;
                                        $score = explode(':', $item->score);
                                        $games['guestScored'] += $score[1];
                                        $games['guestMissing'] += $score[0];
                                        if ($score[0] < $score[1]) {
                                            $games['guestWins']++;
                                        } elseif($score[0] > $score[1]) {
                                            $games['guestLose']++;
                                        } elseif($score[0] == $score[1]) {
                                            $games['guestDrow']++;
                                        }
                                    }
                                }
                            }

                        }
//                        var_dump($games['homeCount'],$games['homeWins'],$games['homeLose'],$games['homeDrow'],$games['homeScored'],$games['homeMissing']);
//                        var_dump($games['guestCount'],$games['guestWins'],$games['guestLose'],$games['guestDrow'],$games['guestScored'],$games['guestMissing']);

//                        $games['homeCount'] = count($games['home']);
//                        $games['guestCount'] = count($games['guest']);
                        $games['count'] = $games['homeCount'] + $games['guestCount'];
                        $games['wins'] = $games['homeWins'] + $games['guestWins'];
                        $games['drow'] = $games['homeDrow'] + $games['guestDrow'];
                        $games['lose'] = $games['homeLose'] + $games['guestLose'];
                        $games['scored'] = $games['homeScored'] + $games['guestScored'];
                        $games['missing'] = $games['homeMissing'] + $games['guestMissing'];
//                        var_dump($games);
                        ?>
                        <div class="col-xs-5 game-statistics">
                            <table>
    <!--                                <caption>...</caption>-->
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Дома</th>
                                        <th>На выезде</th>
                                        <th>Всего</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><th>Игры</th><td><?php echo $games['homeCount'] ?></td><td><?php echo $games['guestCount'] ?></td><td><?php echo $games['count'] ?></td></tr>
                                    <tr><th>Победы</th><td><?php echo $games['homeWins'] ?></td><td><?php echo $games['guestWins'] ?></td><td><?php echo $games['wins'] ?></td></tr>
                                    <tr><th>Ничьи</th><td><?php echo $games['homeDrow'] ?></td><td><?php echo $games['guestDrow'] ?></td><td><?php echo $games['drow'] ?></td></tr>
                                    <tr><th>Поражения</th><td><?php echo $games['homeLose'] ?></td><td><?php echo $games['guestLose'] ?></td><td><?php echo $games['lose'] ?></td></tr>
                                    <tr><th>Забито</th><td><?php echo $games['homeScored'] ?></td><td><?php echo $games['guestScored'] ?></td><td><?php echo $games['scored'] ?></td></tr>
                                    <tr><th>Пропущено</th><td><?php echo $games['homeMissing'] ?></td><td><?php echo $games['guestMissing'] ?></td><td><?php echo $games['missing'] ?></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<!--        </div>-->
        <div class="row">
            <div class="col-xs-12">
                <div class="promo-banners">
                    <div class="row">
<!--                        <div class="col-xs-6">--><?php //echo Html::img('@web/themes/one/src/needless/miss_baltica.png',['class'=>'pull-right']); ?><!--</div>-->
<!--                        <div class="col-xs-6">--><?php //echo Html::img('@web/themes/one/src/needless/atrib.jpg'); ?><!--</div>-->
<!--                        <div class="col-xs-6">--><?php //echo Html::img('@web/themes/one/src/needless/miss_baltica.png',['class'=>'pull-right']); ?><!--</div>-->
<!--                        <div class="col-xs-6">--><?php //echo Html::img('@web/themes/one/src/needless/atrib.jpg'); ?><!--</div>-->
                        <div class="col-xs-6 text-right"><a href="<?php echo Url::toRoute(['/page/atributika'])?>"><?php echo Html::img('@web/themes/one/src/needless/attributika.png'); ?></a></div>
                        <div class="col-xs-6"><a href="<?php echo Url::toRoute(['/club-questions']); ?>"><?php echo Html::img('@web/themes/one/src/needless/vopros.jpg'); ?></a></div>
                    </div>
                </div>
                <div class="video-tv">
                    <h3>Балтика-ТВ <a href="http://www.youtube.com/user/fcbaltika" class="btn btn-dark pull-right" target="_blank">Все видео</a></h3>
                    <div class="row">
                        <?php
                        $key='AIzaSyAvDmtfH6P73IJzaV4bN0JyoJl--3Z4tc8';
                        $youtube = new Youtube(array('key' => $key));
                        $channel = $youtube->getChannelByName('fcbaltika');
                        $playlist = $channel->contentDetails->relatedPlaylists->uploads;
                        $playlistItems = $youtube->getPlaylistItemsByPlaylistId($playlist);
                        $i = 0;
                        foreach ($playlistItems as $item) {
                            //        var_dump($item);
                            $i++;
                            if ($i <= 3) {
                                if ($i==1){
                                    ?>
                                    <div class="col-xs-8">
                                        <div class="video-left-block">
                                            <iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $item->snippet->resourceId->videoId ?>?showinfo=0' width='100%' height='400' frameborder='0' allowfullscreen></iframe>
                                            <div class="video-name"><?php echo $item->snippet->title ?></div>
                                        </div>
                                    </div>
                                    <?php
                                } elseif ($i==2) {
                                    ?>
                                    <div class="col-xs-4">
                                    <div class="video-right-block">
                                    <div class="video-right-block-top">
                                        <iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $item->snippet->resourceId->videoId ?>?showinfo=0' width='100%' height='170' frameborder='0' allowfullscreen></iframe>
                                        <div class="video-name"><?php echo $item->snippet->title ?></div>
                                    </div>
                                    <?php
                                } elseif ($i==3) {
                                    ?>
                                    <div class="video-right-block-bottom">
                                        <iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $item->snippet->resourceId->videoId ?>?showinfo=0' width='100%' height='170' frameborder='0' allowfullscreen></iframe>
                                        <div class="video-name"><?php echo $item->snippet->title ?></div>
                                    </div>
                                    </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div id="vote" class="vote-galery">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            if (isset($this->params['vote'])) {
                                echo $this->params['vote'];
                            }
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <div class="gallery-home">
                                <?php
                                echo GalleryWidget::widget(['template' => 'gallery-index', 'limit' => 5]);
                                ?>
                            </div>
<!--                            <h4>Галерея</h4>-->
<!--                            --><?php //echo Html::img('@web/themes/one/src/needless/gallery.png', ['class' => 'img-responsive']) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--            </div>-->
<!--        </div>-->
        <div class="social-widgets">
            <div>
                <h4>Мы в сети</h4>
                <div class="row">
                    <div class="col-xs-4 instagram">
                        <h5><?php echo Icon::show('instagram'); ?>ФК Балтика в Инстаграм</h5>
                        <!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/4c8ef695c2895cf0b2debaf947664f03.html" id="lightwidget_4c8ef695c2" name="lightwidget_4c8ef695c2"  scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;margin-left: -10px;"></iframe>
    <!--                    <iframe src="http://www.intagme.com/in/?u=ZmNiYWx0aWthfGlufDEwMHwyfDJ8fG5vfDI1fHVuZGVmaW5lZHxubw==" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:250px; height: 250px" ></iframe>-->
    <!--                    <script src="http://snapwidget.com/js/snapwidget.js"></script>-->
                    </div>
                    <div class="col-xs-4 twitter">
                        <h5><?php echo Icon::show('twitter'); ?>Официальный твитер ФК Балтика</h5>
                        <a class="twitter-timeline" data-lang="ru" data-width="100%" data-height="340" data-dnt="true" href="https://twitter.com/fcbaltika"><!--Tweets by fcbaltika--></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script><!--                            #twitterStyled .tweet {-->
    <!--                    <style type="text/css" id="twitterStyle">-->
    <!--                        #twitterStyled .tweet {-->
    <!--                            padding: 10px 10px 5px 10px;-->
    <!--                            margin:10px;-->
    <!--                            border-radius: 10px;-->
    <!--                            background-color: #9bcfe2;-->
    <!--                        }-->
    <!--                        #twitterStyled .tweet:nth-child(odd) {-->
    <!--                            margin-right:50px;-->
    <!--                        }-->
    <!--                        #twitterStyled .tweet:nth-child(even) {-->
    <!--                            margin-left:50px;-->
    <!--                        }-->
    <!--                        #twitterStyled .profile > img {-->
    <!--                            display: none;-->
    <!--                        }-->
    <!--                        #twitterStyled .tweet .tweet-actions {-->
    <!--                            visibility: hidden;-->
    <!--                        }-->
    <!--                        #twitterStyled .tweet:hover .tweet-actions {-->
    <!--                            visibility: visible;-->
    <!--                        }-->
    <!--                        #twitterStyled .stream {-->
    <!--                            background-color: #7AC0DA;-->
    <!--                            color:#fff;-->
    <!--                        }-->
    <!--                        #twitterStyled .header {-->
    <!--                            border-bottom: 1px dashed #fff;-->
    <!--                            margin-bottom:10px;-->
    <!--                            padding-bottom:5px;-->
    <!--                        }-->
    <!--                        #twitterStyled .p-name {-->
    <!--                            color: #207290;-->
    <!--                        }-->
    <!--                        #twitterStyled .p-nickname, #twitterStyled .dt-updated {-->
    <!--                            color: #2b8fb4;-->
    <!--                        }-->
    <!---->
    <!--                    </style>-->
    <!--                    <a class="twitter-timeline" href="https://twitter.com/fcbaltika" data-widget-id="719619106937434113">Твиты от @fcbaltika</a>-->
    <!--                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>-->
                    </div>
                    <div class="col-xs-4 vk">
                        <h5><?php echo Icon::show('vk'); ?>ФК Балтика Вконтакте</h5>
                        <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
    <!--                     VK Widget -->
                        <div id="vk_groups" class="block-center"></div>
                        <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 0, width: "350", height: "350", color1: '0c3e7e', color2: 'ffffff', color3: 'FFFFFF'}, 26849788);
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
<!--            <div class="container">-->
                <div class="footer-top">
                    <div class="footer-promotions">
                        <div class="footer-promotions-top">
                            <div class="row text-center">
                                <?php
                                echo Html::img('@web/themes/one/src/promotions/sodrughestvo.gif', ['class' => '']);

                                //                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/novatek.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                                ?>
                            </div>
                        </div>
                        <div class="footer-promotions-middle">
                            <div class="row">
                                <?php
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/novatek.png', ['class' => 'img-responsive']),['class'=>'']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/telesport.png', ['class' => 'img-responsive']),['class'=>'']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/jako.png', ['class' => 'img-responsive']),['class'=>'']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/sportbox.png', ['class' => 'img-responsive']),['class'=>'']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/match.png', ['class' => 'img-responsive']),['class'=>'']);
                                ?>
                            </div>
                            <?php
                            //                    echo Html::img('@web/themes/one/src/promotions/RFS.png');
                            //                    echo Html::img('@web/themes/one/src/promotions/KO.png');
                            //                    echo Html::img('@web/themes/one/src/promotions/KGD.png');
                            //                    echo Html::img('@web/themes/one/src/promotions/FNL.png');
                            //                    echo Html::img('@web/themes/one/src/promotions/FNL_fonbet.png');
                            ?>
                        </div>
                        <div class="footer-promotions-bottom">
                            <div class="row">
                                <?php
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/RFS.png', ['class' => 'img-responsive']),['class'=>'col-xs-2 col-xs-offset-2']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/KO.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/KGD.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                                echo Html::tag('div',Html::img('@web/themes/one/src/promotions/FNL.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                                //                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/FNL_fonbet.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer-info">
                        <div class="row">
                            <div class="col-xs-4">
                                <a class="footer-info-link">Контакты</a>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="footer-info-text">
                                            <h6>Приемная</h6>
                                            <a href="tel:84012216501">8(4012)21-65-01</a>
                                        </div>
                                        <div class="footer-info-text">
                                            <h6>Пресс-служба</h6>
                                            <a href="tel:84012956392">8(4012)95-63-92</a>
                                        </div>
                                        <div class="footer-info-text">
                                            <a href="mailto:football@fc-baltika.ru" style="text-transform: lowercase">football@fc-baltika.ru</a>
                                            <a href="mailto:press@fc-baltika.ru" style="text-transform: lowercase">press@fc-baltika.ru</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="footer-info-text">
                                            <div>236000, г.Калининград</div>
                                            <div>ул. Дмитрия Донского, д.2.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <a class="footer-info-link" href="/">Главная</a>
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/news'])?>">Новости</a>
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/players'])?>">Команда</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/page/partnership'])?>">Сотрудничество</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/page/smi'])?>">Журналистам</a>

                            </div>
                            <div class="col-xs-2">
                                <a class="footer-info-link">Клуб</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/person/administrations'])?>">Руководство</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/person/coaches'])?>">Тренерский Штаб</a>
<!--                                <a class="footer-info-link-small" href="#!">Персонал</a>-->
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/page/stadium'])?>">Стадион</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/page/history-club'])?>">История</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/page/contacts'])?>">Контакты</a>
                            </div>
                            <div class="col-xs-2">
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/games?output=all'])?>">Сезон</a>
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/season/tournament'])?>">Турнирная Таблица</a>
                                <a class="footer-info-link-small" href="">Бомбардиры</a>
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/page/tickets'])?>">Билеты</a>
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/page/atributika'])?>">Атрибутика</a>
                            </div>
                            <div class="col-xs-2">
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/gallery'])?>">Галерея</a>
                                <a class="footer-info-link" href="https://www.youtube.com/user/fcbaltika">Балтика-TV</a>
<!--                                <a class="footer-info-link" href="#">Скидки</a>-->
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/guest-book'])?>">Гостевая</a>
                                <a class="footer-info-link" href="<?php echo Url::toRoute(['/club-questions'])?>">Вопросы клубу</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <!--            <div class="row">-->
                    <div class="footer-copiright">
                        <div class="footer-logo">
                            <?php echo Html::img('@web/themes/one/src/logo.png', ['class' => 'img-responsive','alt'=>Yii::$app->name]) ?>
                        </div>
                        <div class="footer-copiright-text">
                            <div>При использовании материалов ссылка на официальный сайт ФК БАЛТИКА обязательна</div>
                            <div>Copyright &copy; <?= date('Y') ?></div>
                        </div>
                    </div>
                    <div class="footer-social">
                        <div class="pull-right text-right">
                            <?php
                            echo Html::a(Icon::show('facebook'),'https://www.facebook.com/fcbaltika',['target'=>'_blank']);
                            echo Html::a(Icon::show('twitter'),'https://twitter.com/fcbaltika',['target'=>'_blank']);
                            echo Html::a(Icon::show('youtube'),'http://www.youtube.com/user/fcbaltika',['target'=>'_blank']);
                            echo Html::a(Icon::show('instagram'),'https://www.instagram.com/fcbaltika/',['target'=>'_blank']);
                            ?>
                            <div class="copyright">Разработка и поддержка - <a href="http://pixlet.ru/">Pixlet</a></div>
                        </div>
                        <div class="pull-right" style="margin-top: 7px;margin-right: 15px;">
                            <!--LiveInternet counter--><script type="text/javascript"><!--
                                new Image().src = "//counter.yadro.ru/hit?r"+
                                    escape(document.referrer)+((typeof(screen)=="undefined")?"":
                                    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                                        screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                                    ";"+Math.random();//--></script><!--/LiveInternet-->
                            <!--LiveInternet logo--><a href="//www.liveinternet.ru/click"
                                                       target="_blank"><img src="//counter.yadro.ru/logo?17.1"
                                                                            title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня"
                                                                            alt="" border="0" width="88" height="31"/></a><!--/LiveInternet-->
                        </div>
                        <div class="pull-right" style="margin-top: 7px;margin-right: 15px;">
                            <!— Yandex.Metrika informer —>
                            <a href="https://vk.com/away.php?utf=1&to=https%3A%2F%2Fmetrika.yandex.ru%2Fstat%2F%3Fid%3D39359185%26amp%3Bfrom%3Dinformer"
                               target="_blank" rel="nofollow"><img src="https://vk.com/away.php?utf=1&to=https%3A%2F%2Finformer.yandex.ru%2Finformer%2F39359185%2F3_0_FFFFFFFF_FFFFFFFF_0_visits"
                                                                   style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" /></a>
                            <!— /Yandex.Metrika informer —>
                        </div>
                    </div>
                    <!--            </div>-->
                </div>
<!--            </div>-->
        </footer>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
