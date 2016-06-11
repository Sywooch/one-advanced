<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GuestBook */

$this->title = 'Update Guest Book: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Guest Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guest-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
