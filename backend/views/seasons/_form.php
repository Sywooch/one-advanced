<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\Seasons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seasons-form well">
    <?php

    $form = ActiveForm::begin();
    if ($model->isNewRecord) {
        $model->status = 'on';
    }
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,

        'attributes' => [
            'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Имя...']],
            'slug' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите slug...']],
            'division' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Дивизион...']],
        ]
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
//        'autoGenerateColumns' => true,

        'attributes' => [
            'full_name' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Введите Полное Имя...']],
        ]
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
//        'autoGenerateColumns' => true,

        'attributes' => [
            'status'=>[
                'type'=>Form::INPUT_RADIO_BUTTON_GROUP,
                'items'=>[ 'on' => 'On', 'off' => 'Off'],
                'options'=>[
                    'inline'=>true,
                    'class'=>'show'
                ]
            ],
            'actions'=>[
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="text-align: right; margin-top: 20px">' .
                    Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>'
            ],
        ]
    ]);
    ActiveForm::end();
    ?>

</div>
