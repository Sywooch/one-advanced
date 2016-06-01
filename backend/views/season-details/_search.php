<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="season-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'season_id') ?>

    <?= $form->field($model, 'team_id') ?>

    <?= $form->field($model, 'games') ?>

    <?= $form->field($model, 'wins') ?>

    <?php // echo $form->field($model, 'draws') ?>

    <?php // echo $form->field($model, 'lesions') ?>

    <?php // echo $form->field($model, 'spectacles') ?>

    <?php // echo $form->field($model, 'goals_against') ?>

    <?php // echo $form->field($model, 'goals_scored') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
