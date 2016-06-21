<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CategoryGames */

$this->title = 'Создание категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории игр', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-games-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
