<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GamesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="games-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'home_id') ?>

    <?= $form->field($model, 'guest_id') ?>

    <?= $form->field($model, 'season_id') ?>

    <?= $form->field($model, 'tour') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'stadium') ?>

    <?php // echo $form->field($model, 'referee') ?>

    <?php // echo $form->field($model, 'referee2') ?>

    <?php // echo $form->field($model, 'referee3') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
