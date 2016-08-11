<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\GuestBook */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_record").on("pjax:end", function() {
            $.pjax.reload({container:"#guest_records"});  //Reload GridView
        });
    });'
);
?>

<div class="guest-book-form "><!--well-->
    <?php Pjax::begin(['id' => 'new_record']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <div class="row">
        <?php if (Yii::$app->user->isGuest): ?>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xs-12">
            <?php echo $form->field($model, 'body')->label('Введите сообщение')->textarea(['rows' => 6]) ?>

        <!--    --><?php //echo $form->field($model, 'user_id')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'ip')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'date')->textInput() ?>
        </div>
    </div>
    <div class="form-group text-right">
        <?php echo Html::submitButton($model->isNewRecord ? 'Опубликовать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
