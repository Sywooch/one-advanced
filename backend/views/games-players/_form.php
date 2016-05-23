<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GamesPlayers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="games-players-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'game_id')->textInput() ?>

    <?= $form->field($model, 'player_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
