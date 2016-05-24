<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GamesPlayers */

$this->title = 'Update Games Players: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Games Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="games-players-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
