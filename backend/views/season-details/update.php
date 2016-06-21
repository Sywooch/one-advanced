<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetails */
$this->title = $model->team->name . ' (' . $model->season->name . ')';
$this->params['breadcrumbs'][] = ['label' => 'Детали сезона', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->team->name . ' (' . $model->season->name . ')', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="season-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
