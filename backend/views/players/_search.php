<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PlayersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="players-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'teams_id') ?>

    <?php // echo $form->field($model, 'goals') ?>

    <?php // echo $form->field($model, 'transfers') ?>

    <?php // echo $form->field($model, 'yellow_cards') ?>

    <?php // echo $form->field($model, 'red_cards') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
