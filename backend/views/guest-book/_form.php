<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuestBook */
/* @var $form yii\widgets\ActiveForm */
if ($model->errors) {
    var_dump($model->errors);
}
?>

<div class="guest-book-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?php //echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'body')->textarea(['rows' => 6]) ?>

<!--    --><?php //echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!--    --><?php //echo $form->field($model, 'user_id')->textInput() ?>

<!--    --><?php //echo $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->dropDownList([ 'on' => 'On', 'off' => 'Off', ], ['prompt' => '']) ?>
    <?php echo $form->field($model, 'reCaptcha')->widget(
        \himiklab\yii2\recaptcha\ReCaptcha::className(),
        ['siteKey' => '6LedACkTAAAAAIOcJlOY_f3Nwa5Bl-l9-iRwe7WU']
    )->label(false) ?>
<!--    --><?php //echo $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
