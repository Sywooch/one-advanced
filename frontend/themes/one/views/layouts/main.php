<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\Carousel;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
//        'brandLabel' => 'Frontend',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-top',//navbar-fixed-top
        ],
    ]);
        $menuItems = [
    //        ['label' => 'Главная', 'url' => ['/site/index']],
    //        ['label' => 'About', 'url' => ['/site/about']],
    //        ['label' => 'Contact', 'url' => ['/site/contact']],
    //        ['label' => 'Новости', 'url' => ['/news']],
            ['label' => 'Сотрудничество', 'url' => ['#']],
            ['label' => 'Скидки', 'url' => ['#']],
            ['label' => 'Купить билет', 'url' => ['#']],
            ['label' => 'Интернет-магазин', 'url' => ['#']],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItems,
        ]);

        if (Yii::$app->user->isGuest) {
            $menuItems = [
                ['label' => 'Вход', 'url' => ['/site/login']],
                ['label' => 'Регистрация', 'url' => ['/site/signup']],
            ];
        } else {
            $menuItems = [[
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ]];
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
        'brandLabel' => Html::img('@web/themes/one/src/logo.png', ['alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-bottom',
        ],
    ]);
        $menuItems = [
            ['label' => 'Новости', 'url' => ['/news']],
            ['label' => 'Команда', 'url' => ['#']],
            ['label' => 'Клуб', 'url' => ['#']],
            ['label' => 'Сезон', 'url' => ['#']],
            ['label' => 'Болельщикам', 'url' => ['#']],
            ['label' => 'Медиа', 'url' => ['#']],
            ['label' => 'Архив', 'url' => ['#']],
            ['label' => 'Гостевая', 'url' => ['#']],
        ];
        echo Html::beginTag('div',['class'=>'row']);
            echo Html::beginTag('div',['class'=>'col-xs-9 pull-right']);//col-xs-offset-1
                echo Html::tag('h3','Футбольный клуб');
                echo Html::tag('h2','Балтика "Калининград"');
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-left'],
                    'items' => $menuItems,
                ]);
            echo Html::endTag('div');
        echo Html::endTag('div');


    NavBar::end();
    ?>

    <div class="container">
        <?php

        $carousel_items = [
            [
                'content' => Html::img('@web/themes/one/src/slider/slide-1.jpg'),
                'caption' => '<h2 style="margin-top: 0">ЕСТЬ<br> ПЕРВАЯ<br> ПОБЕДА!</h2>
                              <hr style="border-color: #011f5f; border-width: 2px; margin: 10px 0;">
                              <p><div style="font-size: 16px"><b>БАЛТИКА - САХАЛИН 1:0</b></div><div style="font-size: 12px"><i>28.06.2015 г.Минск</i></div></p>
                              <p style="">На учебно-тренировочном сборе в Минске, «Балтика» провела одну из двух запланированных встреч с «Сахалином». На эту игру тренерский штаб калининградской команды выпустил... </p>',
            ],
            [
                'content' => Html::img('@web/themes/one/src/slider/slide-2.jpg'),
                'caption' => '<h2 style="margin-top: 0">ПЕРВАЯ<br> ИГРА<br> ГОДА!</h2>
                              <hr style="border-color: #011f5f; border-width: 2px; margin: 10px 0;">
                              <p><div style="font-size: 16px"><b>БАЛТИКА - СОКОЛ 0:0</b></div><div style="font-size: 12px"><i>13.03.2016 г.Калининград</i></div></p>',
            ],
            //Html::img('@web/themes/one/src/logo.png', ['alt'=>Yii::$app->name])
        ];

        $carousel_promo_items = [
            [
                'content' => Html::img('@web/themes/one/src/slider/sahalin-logo.jpg'),
                'caption' => '<h2 style="margin-top: 0">ЕСТЬ<br> ПЕРВАЯ<br> ПОБЕДА!</h2>
                              <hr style="border-color: #011f5f; border-width: 2px; margin: 10px 0;">
                              <p><div style="font-size: 16px"><b>БАЛТИКА - САХАЛИН 1:0</b></div><div style="font-size: 12px"><i>28.06.2015 г.Минск</i></div></p>
                              <p style="font-size: 11px">На учебно-тренировочном сборе в Минске, «Балтика» провела одну из двух запланированных встреч с «Сахалином». На эту игру тренерский штаб калининградской команды выпустил... </p>',
            ],
            [
                'content' => Html::img('@web/themes/one/src/slider/isloch-logo.png'),
                'caption' => '<h2 style="margin-top: 0">ПЕРВАЯ<br> ИГРА<br> ГОДА!</h2>
                              <hr style="border-color: #011f5f; border-width: 2px; margin: 10px 0;">
                              <p><div style="font-size: 16px"><b>БАЛТИКА - СОКОЛ 0:0</b></div><div style="font-size: 12px"><i>13.03.2016 г.Калининград</i></div></p>',
            ],
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
                    'interval' => '1000000000',
                ],
    //        'cl'
            ]);
            echo Html::beginTag('div',['class'=>'carousel-promo']);
                echo Html::beginTag('div',['class'=>'row']);
                    echo Html::beginTag('div',['class'=>'col-xs-6']);
                        echo Html::beginTag('div',['class'=>'promo-game-block']);
                            echo Html::beginTag('div',['class'=>'promo-game-header']);
                                echo Html::tag('div',
                                    Html::tag('div','28.06.2015, Контрольный матч',['class'=>'promo-game-date col-xs-8 vtop']).
                                    Html::a('Отчет видео - фото','#',['class'=>'promo-game-link col-xs-4 text-right vtop']),
                                    ['class'=>'row']
                                );
                            echo Html::endTag('div');
                            echo Html::beginTag('div',['class'=>'row promo-game-row']);
                                echo Html::beginTag('div',['class'=>'col-xs-5 text-left promo-game-team vcenter']);
                                    echo Html::img('@web/themes/one/src/logo.png').Html::tag('span',Html::tag('b','Балтика'));
                                echo Html::endTag('div');
                                echo Html::beginTag('div',['class'=>'col-xs-2 text-center promo-game-score vcenter']);
                                    echo Html::tag('div','1:0');
                                echo Html::endTag('div');
                                echo Html::beginTag('div',['class'=>'col-xs-5 text-right promo-game-team vcenter']);
                                    echo Html::tag('span','Сахалин').Html::img('@web/themes/one/src/slider/sahalin-logo.jpg');
                                echo Html::endTag('div');
                            echo Html::endTag('div');
                        echo Html::endTag('div');
                    echo Html::endTag('div');
                    echo Html::beginTag('div',['class'=>'col-xs-6']);
                        echo Html::beginTag('div',['class'=>'promo-game-block']);
                            echo Html::beginTag('div',['class'=>'promo-game-header']);
                                echo Html::tag('div',
                                    Html::tag('div','01.07.2015, Контрольный матч',['class'=>'promo-game-date col-xs-8 vtop']).
                                    Html::a('Превью трансляции','#',['class'=>'promo-game-link col-xs-4 text-right vtop']),
                                    ['class'=>'row']
                                );
                            echo Html::endTag('div');
                            echo Html::beginTag('div',['class'=>'row promo-game-row']);
                                echo Html::beginTag('div',['class'=>'col-xs-5 text-left promo-game-team vcenter']);
                                    echo Html::img('@web/themes/one/src/logo.png').Html::tag('span',Html::tag('b','Балтика'));
                                echo Html::endTag('div');
                                echo Html::beginTag('div',['class'=>'col-xs-2 text-center promo-game-score vcenter']);
                                    echo Html::tag('div','-:-');
                                echo Html::endTag('div');
                                echo Html::beginTag('div',['class'=>'col-xs-5 text-right promo-game-team vcenter']);
                                    echo Html::tag('span','Ислочь').Html::img('@web/themes/one/src/slider/isloch-logo.png',['style'=>'height: 41px;width: auto;']);
                                echo Html::endTag('div');
                            echo Html::endTag('div');
                        echo Html::endTag('div');
                    echo Html::endTag('div');
                echo Html::endTag('div');
            echo Html::endTag('div');
        echo Html::endTag('div');
        ?>
        <div class="row">
            <div class="col-sm-3">
                <div class="index-video">
                    <iframe width="100%" height="inherit" src="https://www.youtube.com/embed/SH5gKOoECNY" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-sm-9">
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
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

<footer class="footer">
    <div class="container">
<!--        <p class="pull-left"></p>-->

        <p class="pull-right">Жуков & Кузьмич &copy;  <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
