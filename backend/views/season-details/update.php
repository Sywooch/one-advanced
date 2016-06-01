<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetails */

$this->title = 'Update Season Details: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Season Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="season-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
