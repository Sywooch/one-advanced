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
use frontend\widgets\MenuWidget;
//use rmrevin\yii\fontawesome\FA;
use kartik\icons\Icon;
use frontend\widgets\StandingsWidget;
use yii\helpers\Url;
Icon::map($this, Icon::FA);

AppAsset::register($this);
\edgardmessias\assets\nprogress\NProgressAsset::register($this);
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
                echo Html::a(false, 'http://www.sodrugestvo.ru/', ['class' => 'sponsor-header', 'target' => '_blank']);
                echo Html::tag('h3','Официальный сайт футбольного клуба');
                echo Html::tag('h2','"Балтика" Калининград');
                echo MenuWidget::widget(['position' => 'headerBottom']);
            echo Html::endTag('div');
        echo Html::endTag('div');


    NavBar::end();
    ?>

    <div class="container">
        <?php
//        if (isset($this->params['image_page'])) {
//            $imagePage = $this->params['image_page'];
//        } else {
//            $imagePage = '/themes/one/src/layout/news.png';
//        }

//        if (isset($this->params['headerName'])) {
//            $headerName = $this->params['headerName'];
//        } else {
//            $headerName = '';
//        }
        ?>
<!--        <div class="top-img">-->
<!--            <img src="--><?php //echo $imagePage; ?><!--" alt="" class="img-responsive">-->
<!--            <div class="header-name"><h1>--><?php //echo Html::encode($headerName); ?><!--</h1></div>-->
<!--        </div>-->

        <div class="row main-row">
            <div class="col-xs-12 main-block main-block-inner-left">
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
<!--            <div class="col-xs-3 main-block main-block-inner-right">-->
<!--                --><?php
//                if (isset($this->params['widget_bar']) && $this->params['widget_bar'] != '') {
//                    echo '<div>'.$this->params['widget_bar'].'</div>';
//                } else {
//                    echo StandingsWidget::widget(['template' => 'smallTable']);
//                }
//                ?>
<!--                <div class="sponsors">-->
<!--                    <a href="http://www.sodrugestvo.ru/" target="_blank" class="text-center" style="margin-top: 15px; display: block;">-->
<!--                        --><?php //echo Html::img('@web/themes/one/src/banner_1.gif', ['alt' => 'sponsor', 'class' => 'img-responsive']) ?>
<!--                    </a>-->
<!--                    <div class="text-center" style="margin-top: 15px; display: block;">-->
<!--                        --><?php //echo Html::img('@web/themes/one/src/banner_2.gif', ['alt' => 'sponsor', 'class' => 'img-responsive']) ?>
<!--                    </div>-->
<!--                    <div class="text-center" style="margin-top: 15px; display: block;">-->
<!--                        --><?php //echo Html::img('@web/themes/one/src/banner_3.gif', ['alt' => 'sponsor', 'class' => 'img-responsive']) ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <?php
        $players = Players::find()->where(['teams_id'=>'3'])->all();
//        var_dump($players['2'])
        ?>

        <footer class="footer">
<!--            <div class="container">-->
                <div class="footer-top">
                    <div class="footer-promotions">
                        <div class="footer-promotions-top">
                            <div class="row text-center">
                                <?php
                                echo Html::a(
                                    Html::img('@web/themes/one/src/promotions/sodrughestvo.gif', ['class' => '']),
                                    'http://www.sodrugestvo.ru/',
                                    ['target' => '_blank']
                                );
                                //                        echo Html::tag('div',Html::img('@web/themes/one/src/promotions/novatek.png', ['class' => 'img-responsive']),['class'=>'col-xs-2']);
                                ?>
                            </div>
                        </div>
                        <div class="footer-promotions-middle">
                            <div class="row">
                                <?php
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/original/novatek-white.png', ['class' => 'img-responsive']),
                                        'http://www.novatek.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/original/fav-white.png', ['class' => 'img-responsive']),
                                        'http://www.china-faw.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/original/telesport-white.png', ['class' => 'img-responsive']),
                                        'http://www.tele-sport.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/original/jako.png', ['class' => 'img-responsive']),
                                        'http://www.jako-russia.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/original/sportbox.png', ['class' => 'img-responsive']),
                                        'http://news.sportbox.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/original/match-nash.png', ['class' => 'img-responsive']),
                                        'http://matchtv.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'']);
                                ?>
                            </div>
                        </div>
                        <div class="footer-promotions-bottom">
                            <div class="row">
                                <?php
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/RFS.png', ['class' => 'img-responsive']),
                                        'http://www.rfs.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'col-xs-2 col-xs-offset-2']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/KO.png', ['class' => 'img-responsive']),
                                        'http://www.gov39.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'col-xs-2']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/KGD.png', ['class' => 'img-responsive']),
                                        'http://www.klgd.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'col-xs-2']);
                                echo Html::tag('div',
                                    Html::a(
                                        Html::img('@web/themes/one/src/promotions/FNL.png', ['class' => 'img-responsive']),
                                        'http://1fnl.ru/',
                                        ['target' => '_blank']
                                    ),
                                    ['class'=>'col-xs-2']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer-info">
                        <div class="row">
                            <div class="col-xs-4">
                                <a class="footer-info-link">Контакты</a>
                                <div class="row">
                                    <div class="col-xs-5">
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
                                    <div class="col-xs-7">
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
                                <a class="footer-info-link-small" href="<?php echo Url::toRoute(['/page/bombardiry'])?>">Бомбардиры</a>
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