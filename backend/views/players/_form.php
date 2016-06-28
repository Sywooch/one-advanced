<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UploadForm;
use kartik\widgets\FileInput;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\Players */
/* @var $form yii\widgets\ActiveForm */
if($model->errors) {
    var_dump($model->errors);
}
$model->date = Yii::$app->formatter->asDate(($model->isNewRecord ? time() : $model->date),'php:d.m.Y');

?>

<div class="players-form well">

    <div class="row">
        <div class="col-xs-3">
            <?php
            $images = $model->getImage();
            if($images['urlAlias']!='placeHolder') {
                echo Html::img($images->getUrl('x350'), ['alt' => $model->name, 'class' => 'thumbnail img-responsive']);
            }
            ?>
        </div>
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?php

            $image=new UploadForm();
            echo '<label>Превью</label>';
            echo FileInput::widget([
                'model' => $image,
                'attribute' => 'file',
                'options' => ['multiple' => false,],
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]);
            echo '<br>';

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 3,
        //        'autoGenerateColumns' => true,
        //
                'attributes' => [
                    'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Имя...']],
                    'surname' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Фамилию...']],
                    'teams_id'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'data'=>ArrayHelper::map($teams, 'id', 'name'),
                            'options'=>[
                                'placeholder'=>'Выберите Позицию Игрока',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    'role'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'data'=>['вр' => 'Вратарь', 'зщ' => 'Защитник', 'пз' => 'Полузащитник', 'нп' => 'Нападающий', ],
                            'options'=>[
                                'placeholder'=>'Выберите Позицию Игрока',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    'date'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\DatePicker',
        //                'hint'=>'Введите дату рождения',
                        'options' => [
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd.mm.yyyy'
                            ]
                        ]
                    ],
                    'number' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Номер...']],
                    'nationality' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Гражданство...']],
                    'height' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Рост Игрока...']],
                    'weight' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Вес Игрока...']],
                ]
            ]);

            ?>


            <?php // echo $form->field($model, 'goals')->textInput() ?>

            <?php // echo $form->field($model, 'transfers')->textInput() ?>

            <?php // echo $form->field($model, 'yellow_cards')->textInput() ?>

            <?php // echo $form->field($model, 'red_cards')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
