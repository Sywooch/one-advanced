<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GamesPlayers */

$this->title = 'Create Games Players';
$this->params['breadcrumbs'][] = ['label' => 'Games Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-players-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
