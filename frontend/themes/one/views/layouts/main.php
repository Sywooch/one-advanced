<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
        'options' => ['class' => 'navbar-nav navbar-right'],
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
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
<!--        <div class="row">-->
<!--            <div class="col-sm-3"></div>-->
<!--            <div class="col-sm-9">-->

                <?= $content ?>
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
