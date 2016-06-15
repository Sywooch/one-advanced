<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryGames */

$this->title = 'Обновить категорию: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории игр', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="category-games-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
