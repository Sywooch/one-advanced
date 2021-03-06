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

<div class="guest-book-form well">
    <?php Pjax::begin(['id' => 'new_record']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
    <div class="row">
        <?php if (Yii::$app->user->isGuest): ?>
            <div class="col-xs-6">
                <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-6">
                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        <?php endif; ?>
        <div class="col-xs-12">
            <?php echo $form->field($model, 'body')->textarea(['rows' => 6]) ?>

        <!--    --><?php //echo $form->field($model, 'user_id')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'ip')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'date')->textInput() ?>
        </div>
        <div class="col-xs-12">
            <?php echo $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha::className(),
                ['siteKey' => '6LedACkTAAAAAIOcJlOY_f3Nwa5Bl-l9-iRwe7WU']
            )->label(false) ?>
<!--            --><?php //echo \himiklab\yii2\recaptcha\ReCaptcha::widget([
//                'name' => 'reCaptcha',
//                'siteKey' => 'ваш siteKey',
//                'widgetOptions' => ['class' => 'col-sm-offset-3']
//            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
