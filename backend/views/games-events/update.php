<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GamesEvents */

$this->title = 'Update Games Events: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Games Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="games-events-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
