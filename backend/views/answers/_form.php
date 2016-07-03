<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Answers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answers-form well">

    <?php
    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
            'questions_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllQuestions(), 'id', 'questions'),
                    'options'=>[
                        'placeholder'=>'Выберите Вопрос',
                        'id'=>'season-id',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ],
            ],
            'answer' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите ответ...']],
            'actions'=>[
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="margin-top: 20px">' .
                    Html::resetButton('Сбросить', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>'
            ],
        ],
    ]);
    ActiveForm::end();
    ?>

</div>
