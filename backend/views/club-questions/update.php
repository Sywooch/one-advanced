<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ClubQuestions */

$this->title = 'Обновить вопрос пользователя ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Club Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="club-questions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
