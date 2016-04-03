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
use common\models\Players;
use rmrevin\yii\fontawesome\FA;

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
        $controller_action = Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
        if ($controller_action == 'site/index') {
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
        }
        ?>
        <div class="row">
            <div class="col-xs-4">
                <div class="index-video">
                    <iframe width="100%" height="inherit" src="https://www.youtube.com/embed/SH5gKOoECNY" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="standings">
                    <h5>Турнирная таблица</h5>
                    <p>ФОНБЕТ-Первенства России по футболу среди команд ФНЛ 2015/16</p>
                    <table>
                        <!--                                <caption>...</caption>-->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Команда</th>
                                <th>Игры</th>
                                <th>Очки</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td>Газовик</td><td>24</td><td>59</td></tr>
                            <tr><td>2</td><td>Томь</td><td>24</td><td>52</td></tr>
                            <tr><td>3</td><td>Арсенал Т</td><td>24</td><td>46</td></tr>
                            <tr><td>4</td><td>Волгарь</td><td>24</td><td>44</td></tr>
                            <tr><td>5</td><td>Факел</td><td>24</td><td>41</td></tr>
                            <tr><td>6</td><td>Сибирь</td><td>24</td><td>40</td></tr>
                            <tr><td>7</td><td>Спартак-2</td><td>24</td><td>38</td></tr>
                            <tr><td>8</td><td>Тюмень</td><td>23</td><td>35</td></tr>
                            <tr><td>9</td><td>Сокол</td><td>24</td><td>34</td></tr>
                            <tr><td>10</td><td>Енисей</td><td>24</td><td>34</td></tr>
                            <tr><td>11</td><td>Шинник</td><td>24</td><td>33</td></tr>
                            <tr><td><b>12</b></td><td><b>Балтика</b></td><td><b>23</b></td><td><b>31</b></td></tr>
                            <tr><td>13</td><td>Волга НН</td><td>24</td><td>29</td></tr>
                            <tr><td>14</td><td>Тосно</td><td>24</td><td>27</td></tr>
                            <tr><td>15</td><td>Луч-Энергия</td><td>24</td><td>25</td></tr>
                            <tr><td>16</td><td>Зенит-2</td><td>24</td><td>25</td></tr>
                            <tr><td>17</td><td>СКА-Энергия</td><td>24</td><td>24</td></tr>
                            <tr><td>18</td><td>Байкал</td><td>24</td><td>22</td></tr>
                            <tr><td>19</td><td>КАМАЗ</td><td>24</td><td>16</td></tr>
                            <tr><td>20</td><td>Торпедо Ар</td><td>24</td><td>16</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-8 main-block">
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
        $players = Players::find()->where(['teams_id'=>'3'])->all();
//        var_dump($players['2'])
        ?>
<!--        <div class="statistics-season">-->
            <div class="row statistics-season">
                <div class="col-xs-12">
                    <h5>Сатитстика сезона</h5>
                    <div class="row">
                        <div class="col-xs-7 best-players">
                            <div class="col-xs-6 best-players-block">
                                <div class="best-players-header">
                                    <span class="best-players-role">Лучший бомбардир</span>
                                    <span class="best-players-goals">4 Гола</span>
                                </div>
                                <div class="best-players-image">
                                    <?php
                                    $images = $players['3']->getImages();
                                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
//                                        echo Html::beginTag('div',['class'=>'']);
                                            $image = $players['3']->getImage();
//                                            echo Html::img($image->getUrl('x150'),['class' => 'img-responsive']);
                                            echo Html::tag('div',false,['class'=>'best-players-img','style'=> 'background:url('.$image->getUrl('x150').')']);
//                                        echo Html::endTag('div');
                                    }
                                    ?>
                                </div>
                                <div class="best-players-number-name">
                                    <span class="best-players-number">#<?php echo $players['3']['number'] ?></span>
                                    <span class="best-players-name">
                                        <?php echo $players['3']['surname'].' '.$players['3']['name'] ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-6 best-players-block">
                                <div class="best-players-header">
                                    <span class="best-players-role">Лучший ассистент</span>
                                    <span class="best-players-goals">3 передачи</span>
                                </div>
                                <div class="best-players-image">
                                    <?php
                                    $images = $players['2']->getImages();
                                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
//                                        echo Html::beginTag('div',['class'=>'']);
                                        $image = $players['2']->getImage();
//                                        echo Html::img($image->getUrl('x150'),['class' => 'img-responsive']);
                                        echo Html::tag('div',false,['class'=>'best-players-img','style'=> 'background:url('.$image->getUrl('x150').')']);
//                                        echo Html::endTag('div');
                                    }
                                    ?>
                                </div>
                                <div class="best-players-number-name">
                                    <span class="best-players-number">#<?php echo $players['2']['number'] ?></span>
                                    <span class="best-players-name">
                                        <?php echo $players['2']['surname'].' '.$players['2']['name'] ?>
                                    </span>
                                </div>
                            </div>
                        </div>
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
                                    <tr><th>Игры</th><td>11</td><td>13</td><td>24</td></tr>
                                    <tr><th>Победы</th><td>5</td><td>3</td><td>8</td></tr>
                                    <tr><th>Ничьи</th><td>3</td><td>4</td><td>7</td></tr>
                                    <tr><th>Поражения</th><td>3</td><td>6</td><td>9</td></tr>
                                    <tr><th>Забито</th><td>15</td><td>10</td><td>25</td></tr>
                                    <tr><th>Пропущено</th><td>11</td><td>13</td><td>24</td></tr>
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
                        <div class="col-xs-6"><?php echo Html::img('@web/themes/one/src/needless/miss_baltica.png',['class'=>'pull-right']); ?></div>
                        <div class="col-xs-6"><?php echo Html::img('@web/themes/one/src/needless/atributica.png'); ?></div>
                    </div>
                </div>
                <div class="vote-galery">
                    <div class="row">
                        <div class="col-xs-6">
                            <h5>Голосование</h5>
                            <p>
                                Кто по Вашему мнению лучший игрок ФК Балтика первой части
                                ФОНБЕТ-Первенства России по футболу среди команд клубов ФНЛ 2015/16 ?
                            </p>
                            <div class="row">
                                <div class="col-xs-4 vote-logo">
                                    <?php echo Html::img('@web/themes/one/src/logo.png', ['class' => 'img-responsive','alt'=>Yii::$app->name]) ?>
                                </div>
                                <div class="col-xs-8 vote-block">
                                    <?php
                                    $i=0;
                                    foreach($players as $player) {
                                        $i++;
                                        echo Html::beginTag('div',['class'=>'vote-players']);
                                            echo Html::input('radio','optionsBestPlayers',$player['id'],['class'=>'vote-players-radio','checked'=>(($i==1)?true:false)]);
                                            echo Html::label(
                                                Html::tag('span','#'.$player['number'],['class'=>'vote-players-number']).
                                                Html::tag('span',$player['name'].' '.$player['surname'],['class'=>'vote-players-name']),
                                                false,
                                                ['class'=>'input-helper input-helper--radio']
                                            );
                                        echo Html::endTag('div');
                                    }
                                    ?>
                                    <button class="btn">Голосовать</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <h5>Галерея</h5>
                            <?php echo Html::img('@web/themes/one/src/needless/gallery.png', ['class' => 'img-responsive']) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-promotions"></div>
            <div class="footer-info">
                <div class="row">
                    <div class="col-xs-4">
                        <a class="footer-info-link" href="#">Контакты</a>
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
                                    <a href="mailto:football@fc-baltika.ru">Пресс-служба</a>
                                    <a href="mailto:press@fc-baltika.ru"></a>
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
                        <a class="footer-info-link" href="#">Главная</a>
                        <a class="footer-info-link" href="#">Новости</a>
                        <a class="footer-info-link" href="#">Команда</a>
                        <a class="footer-info-link-small" href="#">Сотрудничество</a>
                        <a class="footer-info-link-small" href="#">Журналистам</a>

                    </div>
                    <div class="col-xs-2">
                        <a class="footer-info-link" href="#">Клуб</a>
                        <a class="footer-info-link-small" href="#">Руководство</a>
                        <a class="footer-info-link-small" href="#">Тренерский Штаб</a>
                        <a class="footer-info-link-small" href="#">Персонал</a>
                        <a class="footer-info-link-small" href="#">Стадион</a>
                        <a class="footer-info-link-small" href="#">История</a>
                        <a class="footer-info-link-small" href="#">Контакты</a>
                    </div>
                    <div class="col-xs-2">
                        <a class="footer-info-link" href="#">Сезон</a>
                        <a class="footer-info-link-small" href="#">Турнирная Таблица</a>
                        <a class="footer-info-link-small" href="#">Бомбардиры</a>
                        <a class="footer-info-link" href="#">Билеты</a>
                        <a class="footer-info-link" href="#">Атрибутика</a>
                    </div>
                    <div class="col-xs-2">
                        <a class="footer-info-link" href="#">Галерея</a>
                        <a class="footer-info-link" href="#">Балтика-TV</a>
                        <a class="footer-info-link" href="#">Скидки</a>
                        <a class="footer-info-link" href="#">Гостевая</a>

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
                    <div class="pull-right">
                        <?php
                        echo Html::a(FA::icon('facebook'),'https://www.facebook.com/fcbaltika',['target'=>'_blank']);
                        echo Html::a(FA::icon('twitter'),'https://twitter.com/fcbaltika',['target'=>'_blank']);
                        echo Html::a(FA::icon('youtube'),'http://www.youtube.com/user/fcbaltika',['target'=>'_blank']);
                        echo Html::a(FA::icon('instagram'),'https://www.instagram.com/fcbaltika/',['target'=>'_blank']);
                        ?>
                    </div>
                </div>
<!--            </div>-->
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
