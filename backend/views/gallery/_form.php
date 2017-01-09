<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UploadForm;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textarea() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'on' => 'Активна', 'off' => 'Неактивна', ]) ?>

    <?php
//    $image=new UploadForm();

//    echo $form->field($image, 'file')->fileInput();

//    echo FileInput::widget([
//        'name' => 'input-ru[]',
//        'language' => 'ru',
//        'options' => ['multiple' => true],
//        'pluginOptions' => ['previewFileType' => 'any', 'uploadUrl' => Url::to(['/site/file-upload']),]
//    ]);

//    echo $form->field($image, 'file')->widget(FileInput::classname(), [
//        'name' => 'attachment_48[]',
//        'options'=>[
//            'multiple'=>true
//        ],
//        'pluginOptions' => [
//            'uploadUrl' => Url::to(['/site/file-upload']),
//            'uploadExtraData' => [
//                'album_id' => 20,
//                'cat_id' => 'Nature'
//            ],
//            'maxFileCount' => 10
//        ],
//    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>