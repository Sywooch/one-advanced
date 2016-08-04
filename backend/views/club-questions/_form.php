<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ClubQuestions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="club-questions-form well">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'name')->textInput(['maxlength' => true]);
        $model->date = time();
    }
    ?>
    <?php echo $form->field($model, 'addressee')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'question')->textarea(['rows' => 6, 'readonly' => !$model->isNewRecord]) ?>

    <?php echo $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

<!--    --><?php //echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!--    --><?php //echo $form->field($model, 'user_id')->textInput() ?>

<!--    --><?php //echo $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->dropDownList([ 'on' => 'On', 'off' => 'Off', ]) ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'date')->hiddenInput()->label(false);
    }
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
