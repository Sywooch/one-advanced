<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CoachingStaff */

$this->title = 'Обновление: ' . $model->surname;
$this->params['breadcrumbs'][] = ['label' => 'Тренерский штаб', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->surname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="coaching-staff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
