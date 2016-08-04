<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CoachingStaff */

$this->title = 'Создание';
$this->params['breadcrumbs'][] = ['label' => 'Тренерский штаб', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-staff-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
