<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\widgets\Select2;

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
<!--        <div class="col-xs-8">-->
            <?php
            $addressee = [];
            $addressee['all'] = 'Всем';
//            $playersRole = ['вр' => 'Вратарь', 'зщ' => 'Защитник', 'пз' => 'Полузащитник', 'нп' => 'Нападающий'];
//            foreach($data['mainTeam']->players as $item) {
//                $addressee[$item['surname'] . ' ' . $item['name']] = $item['surname'] . ' ' . $item['name'] . ' ('.$playersRole[$item['role']].')';
//            }
//            foreach($data['mainTeam']->coachingStaff as $item) {
//                $addressee[$item['surname'] . ' ' . $item['name']] = $item['surname'] . ' ' . $item['name'] . ' (' . $item['role'] . ')';
//            }

            echo $form->field($model, 'addressee')->hiddenInput(['value'=> $addressee['all']])->label(false);

            //            echo $form->field($model, 'addressee')->dropDownList($addressee);
//            echo $form->field($model, 'addressee')->widget(Select2::classname(), [
//                'data' => $addressee,
//                'options' => ['placeholder' => 'Выбрать адресата ...'],
//                'pluginOptions' => [
//                    'allowClear' => true
//                ],
//            ]); ?>
<!--        </div>-->
        <div class="col-xs-12">
            <?php echo $form->field($model, 'question')->label('Сообщение')->textarea(['rows' => 6]) ?>

        <!--    --><?php //echo $form->field($model, 'user_id')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'ip')->textInput() ?>

        <!--    --><?php //echo $form->field($model, 'date')->textInput() ?>
        </div>
        <div class="col-xs-12">
            <?php echo $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha::className(),
                ['siteKey' => '6LedACkTAAAAAIOcJlOY_f3Nwa5Bl-l9-iRwe7WU']
            )->label(false) ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Опубликовать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
