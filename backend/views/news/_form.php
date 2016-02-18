<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UploadForm;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
if($model->errors) {
    var_dump($model->errors);
}
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'snippet')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'image_url')->textInput(['maxlength' => true]) ?>

    <?php $image=new UploadForm(); ?>

    <?= $form->field($image, 'file')->fileInput()->label('Upload image') ?>

    <?php // echo $form->field($model, 'views')->textInput() ?>

    <?php // echo $form->field($model, 'comments')->textInput() ?>

    <?= $form->field($model, 'status_id')->dropDownList([ 'on' => 'On', 'off' => 'Off', ]) ?>

    <?php // echo $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    CKEDITOR.replace( 'news-content');
</script>
