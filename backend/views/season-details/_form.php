<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="season-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'season_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'games')->textInput() ?>

    <?= $form->field($model, 'wins')->textInput() ?>

    <?= $form->field($model, 'draws')->textInput() ?>

    <?= $form->field($model, 'lesions')->textInput() ?>

    <?= $form->field($model, 'spectacles')->textInput() ?>

    <?= $form->field($model, 'goals_against')->textInput() ?>

    <?= $form->field($model, 'goals_scored')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
