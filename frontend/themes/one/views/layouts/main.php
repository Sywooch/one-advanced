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
use frontend\widgets\MenuWidget;
//use rmrevin\yii\fontawesome\FA;
use kartik\icons\Icon;
Icon::map($this, Icon::FA);

AppAsset::register($this);
\edgardmessias\assets\nprogress\NProgressAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
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
        echo MenuWidget::widget(['position' => 'headerTop']);

        if (Yii::$app->user->isGuest) {
            $menuItems = [
                ['label' => 'Вход', 'url' => ['/site/login']],
                ['label' => 'Регистрация', 'url' => ['/site/signup']],
            ];
        } else {
            $menuItems = [[
                'label' => 'Выйти (' . Yii::$app->user->identity->username . ')',
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
                echo Html::tag('h3','Футбольный клуб');
                echo Html::tag('h2','Балтика "Калининград"');
                echo MenuWidget::widget(['position' => 'headerBottom']);
            echo Html::endTag('div');
        echo Html::endTag('div');


    NavBar::end();
    ?>

    <div class="container">
        <?php
        if (isset($this->params['image_page'])) {
            $imagePage = $this->params['image_page'];
        } else {
            $imagePage = '/themes/one/src/layout/news.png';
        }

        if (isset($this->params['headerName'])) {
            $headerName = $this->params['headerName'];
        } else {
            $headerName = '';
        }
        ?>
        <div class="top-img">
            <img src="<?php echo $imagePage; ?>" alt="" class="img-responsive">
            <div class="header-name"><h1><?php echo Html::encode($headerName); ?></h1></div>
        </div>

        <div class="row main-row">
            <div class="col-xs-9 main-block">
                <?php
                /*echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])*/
                ?>
                <?= Alert::widget() ?>
<!--        <div class="row">-->
<!--            <div class="col-sm-3"></div>-->
<!--            <div class="col-sm-9">-->

                <?= $content ?>
            </div>
            <div class="col-xs-3 main-block">
                <?php
//                var_dump($this->params['widget_bar']);
                if (isset($this->params['widget_bar']) && $this->params['widget_bar'] != '') {
                    echo '<div>'.$this->params['widget_bar'].'</div>';
                } else {
                ?>
                    <div class="standings">
                        <h4>Турнирная таблица</h4>
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
                            <tr><td>1</td><td><?php echo Html::img('@web/themes/one/src/teams/gazovik.png') ?>Газовик</td><td>24</td><td>59</td></tr>
                            <tr><td>2</td><td><?php echo Html::img('@web/themes/one/src/teams/tom.png') ?>Томь</td><td>24</td><td>52</td></tr>
                            <tr><td>3</td><td><?php echo Html::img('@web/themes/one/src/teams/arsenal-tula.png') ?>Арсенал Т</td><td>24</td><td>46</td></tr>
                            <tr><td>4</td><td><?php echo Html::img('@web/themes/one/src/teams/volgar.png') ?>Волгарь</td><td>24</td><td>44</td></tr>
                            <tr><td>5</td><td><?php echo Html::img('@web/themes/one/src/teams/fakel.png') ?>Факел</td><td>24</td><td>41</td></tr>
                            <tr><td>6</td><td><?php echo Html::img('@web/themes/one/src/teams/sibir.png') ?>Сибирь</td><td>24</td><td>40</td></tr>
                            <tr><td>7</td><td><?php echo Html::img('@web/themes/one/src/teams/spartak-2.png') ?>Спартак-2</td><td>24</td><td>38</td></tr>
                            <tr><td>8</td><td><?php echo Html::img('@web/themes/one/src/teams/tyumen.png') ?>Тюмень</td><td>23</td><td>35</td></tr>
                            <tr><td>9</td><td><?php echo Html::img('@web/themes/one/src/teams/sokol-saratov.png') ?>Сокол</td><td>24</td><td>34</td></tr>
                            <tr><td>10</td><td><?php echo Html::img('@web/themes/one/src/teams/enisei.png') ?>Енисей</td><td>24</td><td>34</td></tr>
                            <tr><td>11</td><td><?php echo Html::img('@web/themes/one/src/teams/shinnik.png') ?>Шинник</td><td>24</td><td>33</td></tr>
                            <tr><td><b>12</b></td><td><?php echo Html::img('@web/themes/one/src/teams/baltika.png') ?><b>Балтика</b></td><td><b>23</b></td><td><b>31</b></td></tr>
                            <tr><td>13</td><td><?php echo Html::img('@web/themes/one/src/teams/volga.png') ?>Волга НН</td><td>24</td><td>29</td></tr>
                            <tr><td>14</td><td><?php echo Html::img('@web/themes/one/src/teams/tosno.png') ?>Тосно</td><td>24</td><td>27</td></tr>
                            <tr><td>15</td><td><?php echo Html::img('@web/themes/one/src/teams/luch.png') ?>Луч-Энергия</td><td>24</td><td>25</td></tr>
                            <tr><td>16</td><td><?php echo Html::img('@web/themes/one/src/teams/zenit-2.jpg') ?>Зенит-2</td><td>24</td><td>25</td></tr>
                            <tr><td>17</td><td><?php echo Html::img('@web/themes/one/src/teams/ska-energiya.png') ?>СКА-Энергия</td><td>24</td><td>24</td></tr>
                            <tr><td>18</td><td><?php echo Html::img('@web/themes/one/src/teams/baikal.png') ?>Байкал</td><td>24</td><td>22</td></tr>
                            <tr><td>19</td><td><?php echo Html::img('@web/themes/one/src/teams/kamaz.png') ?>КАМАЗ</td><td>24</td><td>16</td></tr>
                            <tr><td>20</td><td><?php echo Html::img('@web/themes/one/src/teams/torpedo-armavir.png') ?>Торпедо Ар</td><td>24</td><td>16</td></tr>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        $players = Players::find()->where(['teams_id'=>'3'])->all();
//        var_dump($players['2'])
        ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-promotions">
                <div class="footer-promotions-top">
                    <div class="row">
                        <?php
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/RFS.png', ['class' => 'img-responsive']),['class'=>'col-xs-2 col-xs-offset-1']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/KO.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/KGD.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/FNL.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/FNL_fonbet.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
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
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/telesport.png', ['class' => 'img-responsive']),['class'=>'col-xs-3']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/jako.png', ['class' => 'img-responsive']),['class'=>'col-xs-3']);
//                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/sport.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/sportbox.png', ['class' => 'img-responsive']),['class'=>'col-xs-3']);
                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/polytan.png', ['class' => 'img-responsive']),['class'=>'col-xs-3']);
                        ?>
                    </div>
                </div>
            </div>
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
                        echo Html::a(Icon::show('facebook'),'https://www.facebook.com/fcbaltika',['target'=>'_blank']);
                        echo Html::a(Icon::show('twitter'),'https://twitter.com/fcbaltika',['target'=>'_blank']);
                        echo Html::a(Icon::show('youtube'),'http://www.youtube.com/user/fcbaltika',['target'=>'_blank']);
                        echo Html::a(Icon::show('instagram'),'https://www.instagram.com/fcbaltika/',['target'=>'_blank']);
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
