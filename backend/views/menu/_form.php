<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form well">

    <?php
    $form = ActiveForm::begin();
    if ($model->isNewRecord) {
        $model->position = 'headerTop';
        $model->status = 'on';
    }
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
            'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Имя...']],
            'url' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите url...']],
            'sort' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите sort...']],
            'parent_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllMenu(), 'id', 'name'),
                    'options'=>['placeholder'=>'Выберите меню']
                ],
                'hint'=>'Создайте подменю'
            ],
            'position' => [
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[ 'headerTop' => 'HeaderTop', 'headerBottom' => 'HeaderBottom'],
                'options'=>['inline'=>true]
            ],
            'status'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[ 'on' => 'On', 'off' => 'Off'],
                'options'=>['inline'=>true]
            ],
            'actions'=>[
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="margin-top: 20px">' .
                    Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>'
            ],
        ]
    ]);
    ?>

    <?php /*echo $form->field($model, 'parent_id')->textInput() */?><!--
    <?php /*echo $form->field($model, 'name')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'url')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'position')->dropDownList([ 'headerTop' => 'HeaderTop', 'headerBottom' => 'HeaderBottom', ], ['prompt' => '']) */?>
    <?php /*echo $form->field($model, 'sort')->textInput() */?>
    <?php /*echo $form->field($model, 'status')->dropDownList([ 'on' => 'On', 'off' => 'Off', ], ['prompt' => '']) */?>
    <div class="form-group">
        <?php /*echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) */?>
    </div>-->

    <?php ActiveForm::end(); ?>

</div>
