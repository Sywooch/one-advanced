<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UploadForm;

/* @var $this yii\web\View */
/* @var $model common\models\Players */
/* @var $form yii\widgets\ActiveForm */
if($model->errors) {
    var_dump($model->errors);
}
?>

<div class="players-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php $image=new UploadForm(); ?>

    <?= $form->field($image, 'file')->fileInput()->label('Upload image') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?php  echo $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?php echo $form->field($model, 'teams_id')->dropDownList(ArrayHelper::map($teams, 'id', 'name')) ?>

    <?php // echo $form->field($model, 'goals')->textInput() ?>

    <?php // echo $form->field($model, 'transfers')->textInput() ?>

    <?php // echo $form->field($model, 'yellow_cards')->textInput() ?>

    <?php // echo $form->field($model, 'red_cards')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
