<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GamesEvents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="games-events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'event_type')->dropDownList([ 'goal' => 'Goal', 'y_card' => 'Y card', 'r_card' => 'R card', 'replacement' => 'Replacement', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'player_one_id')->textInput() ?>

    <?= $form->field($model, 'player_two_id')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
