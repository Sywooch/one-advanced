<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\Questions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-form">

    <?php
    $form = ActiveForm::begin();
    if ($model->isNewRecord) {
        $model->status = 'on';
    }
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'questions'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter вопрос...']],
        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'description'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter описание...']],
            'content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter контент...']],
        ]
    ]);

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
            'url' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите url...']],
            'status'=>[
                'label'=>'Статус',
                'items'=>[
                    'on' => 'On',
                    'off' => 'Off',
                ],
                'type'=>Form::INPUT_RADIO_BUTTON_GROUP,
                'options'=>[
                    'class'=>'show'
                ]
            ],
            'actions'=>[
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="margin-top: 20px" class="pull-right">' .
                    Html::resetButton('Сбросить', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>',
            ],
        ]
    ]);
    ActiveForm::end();
    ?>

</div>
<?php $this->registerJsFile('//cdn.ckeditor.com/4.5.7/full/ckeditor.js'); ?>
<?php $this->registerJs('
CKEDITOR.replace("questions-content");
 CKEDITOR.filter.allowedContentRules = true;
 CKEDITOR.config.allowedContent=true;
'); ?>