<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BlackList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="black-list-form well">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'user_id')->textInput() ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
