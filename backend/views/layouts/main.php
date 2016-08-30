<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yiister\gentelella\widgets\Panel;
use yii\helpers\Url;
use limion\bootstraplightbox\BootstrapMediaLightboxAsset;

$bundle = yiister\gentelella\assets\Asset::register($this);
BootstrapMediaLightboxAsset::register($this);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=1200">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">
<?php $this->beginBody() ?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
<!--                    <a href="/" class="site_title"><i class="fa fa-futbol-o" style="border: none;"></i> <span>ФК Балтика!</span></a>-->
                    <a href="/admin" class="site_title">
                        <?php echo Html::img('@web/images/logo.svg'); ?>
                        <span>ФК Балтика</span>
                    </a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
<!--                <div class="profile">-->
<!--                    <div class="profile_pic">-->
<!--                        <div class="img-circle profile_img">-->
<!--                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="profile_info">-->
<!--                        <span>Добро пожаловать,</span>-->
<!--                        <h2>--><?php //echo Yii::$app->user->identity->username; ?><!--</h2>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- /menu prile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <h3>Меню</h3>
                        <?php
                        $menuItems = [
                            ['label' => 'Главная', 'url' => ['/site/index'], "icon" => "home"],
                            [
                                'label' => 'Новости',
                                "icon" => "list",
                                "url" => "#!",
                                'items' => [
                                    ['label' => 'Новости', 'url' => ['/news']],
//                '<li class="divider"></li>',
//                '<li class="dropdown-header"></li>',
                                    ['label' => 'Категории', 'url' => ['/category']],
                                ],
                            ],
                            [
                                'label' => 'Настройки сезонов',
                                "url" => "#!",
                                "icon" => "list-alt",
                                'items' => [
                                    ['label' => 'Игры', 'url' => ['/games']],
                                    ['label' => 'Таблица', 'url' => ['/season-details']],
                                    ['label' => 'Сезоны', 'url' => ['/seasons']],
                                    ['label' => 'Команды', 'url' => ['/teams']],
                                    ['label' => 'Игроки', 'url' => ['/players']],
                                    ['label' => 'Тренерский штаб', 'url' => ['/coaching-staff']],
                                    ['label' => 'Категории игр', 'url' => ['/category-games']],
                                ],
                            ],
                            [
                                'label' => 'Настройка сайта',
                                "url" => "#!",
                                "icon" => "cog",
                                'items' => [
                                    ['label' => 'Страницы', 'url' => ['/pages']],
                                    ['label' => 'Меню', 'url' => ['/menu']],
                                    ['label' => 'Галерея', 'url' => ['/gallery']],
                                    ['label' => 'Гостевая', 'url' => ['/guest-book']],
                                    ['label' => 'Голосование', 'url' => ['/questions']],
                                    ['label' => 'Вопросы клубу', 'url' => ['/club-questions']],
                                ],
                            ],
                        ];
                        echo \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => $menuItems,
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="<?php echo Url::toRoute(['/site/logout']); ?>" class="user-profile"  data-method="post" title="Logout" aria-expanded="false">
                                <i class="fa fa-sign-out"></i> <span>Выход</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo Yii::$app->urlManager->hostInfo ?>" title="На сайт"><span class="fa fa-share" aria-hidden="true"></span><span class="hidden-sm"> На сайт</span></a>
                        </li>
                        <li class="">
                            <div><span>Добро пожаловать, </span><b><?php echo Yii::$app->user->identity->username; ?></b></div>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
<!--            --><?php //if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <?php
                        if (!isset($this->params['h1'])) {
                            echo Html::tag('h1', $this->title);
                        }
                        ?>
                    </div>
                    <div class="title_right">
                        <div class="col-xs-12 form-group pull-right text-right">
                            <?php echo Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                        </div>
                    </div>
                </div>
<!--            --><?php //endif; ?>
            <div class="clearfix"></div>
            <?php
            echo Alert::widget();
            if (!isset($this->params['panel'])) {
                Panel::begin();
            }
            echo $content;
            if (!isset($this->params['panel'])) {
                Panel::end();
            }
            ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="text-center">
                Поддержка и разработка - <a href="http://pixlet.ru/" rel="nofollow" target="_blank">Pixlet</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
