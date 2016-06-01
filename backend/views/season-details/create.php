<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetails */

$this->title = 'Create Season Details';
$this->params['breadcrumbs'][] = ['label' => 'Season Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
