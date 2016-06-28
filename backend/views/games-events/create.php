<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GamesEvents */

$this->title = 'Create Games Events';
$this->params['breadcrumbs'][] = ['label' => 'Games Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
