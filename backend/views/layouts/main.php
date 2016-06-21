<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
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
        'brandLabel' => 'Backend',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site']],
        ['label' => 'Frontend', 'url' => Yii::$app->urlManager->hostInfo],
        [
            'label' => 'Новости',
            'items' => [
                ['label' => 'Новости', 'url' => ['/news']],
//                '<li class="divider"></li>',
//                '<li class="dropdown-header"></li>',
                ['label' => 'Категории', 'url' => ['/category']],
            ],
        ],
        [
            'label' => 'Турнирная Таблица',
            'items' => [
                ['label' => 'Игры', 'url' => ['/games']],
                ['label' => 'Детали сезонов', 'url' => ['/season-details']],
                ['label' => 'Сезоны', 'url' => ['/seasons']],
                ['label' => 'Команды', 'url' => ['/teams']],
                ['label' => 'Игроки', 'url' => ['/players']],
                ['label' => 'Категории игр', 'url' => ['/category-games']],
            ],
        ],
        [
            'label' => 'Настройка сайта',
            'items' => [
                ['label' => 'Страницы', 'url' => ['/pages']],
                ['label' => 'Меню', 'url' => ['/menu']],
                ['label' => 'Галерея', 'url' => ['/gallery']],
                ['label' => 'Гостевая', 'url' => ['/guest-book']],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
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
        <?= $content ?>
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
