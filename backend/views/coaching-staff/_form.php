<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UploadForm;
use kartik\widgets\FileInput;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\CoachingStaff */
/* @var $form yii\widgets\ActiveForm */
if($model->errors) {
    var_dump($model->errors);
}
$model->date = Yii::$app->formatter->asDate(($model->isNewRecord ? time() : $model->date),'php:d.m.Y');
?>

<div class="players-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

            <?php
            if ($model->isNewRecord) {
                $model->status = 'on';
            }
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
                    'surname' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Фамилию...']],
                    'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Имя...']],
                    'patronymic' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Отчество...']],
                    'role' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Должность...']],
                    'teams_id'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'data'=>ArrayHelper::map($model->allTeams, 'id', 'name'),
                            'options'=>[
                                'placeholder'=>'Выберите Команду',
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ],
                    ],
                    'category_caches'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\Select2',
                        'options'=>[
                            'data'=>ArrayHelper::map($model->allCategoryCaches, 'id', 'name'),
                            'options'=>[
                                'placeholder'=>'Выберите Подраздел',
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
                    'sort' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите sort...']],
                ]
            ]);

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 2,
                //        'autoGenerateColumns' => true,
                //
                'attributes' => [
                    'category'=>[
                        'label'=>'Категория',
                        'items'=>[
                            'admin' => 'Администрация',
                            'trainer' => 'Тренерский штаб',
                        ],
                        'type'=>Form::INPUT_RADIO_BUTTON_GROUP,
                        'options'=>[
                            'class'=>'show'
                        ]
                    ],
                    'status'=>[
                        'label'=>'Статус',
                        'items'=>[
                            'on' => 'On',
                            'off' => 'Off'
                        ],
                        'type'=>Form::INPUT_RADIO_BUTTON_GROUP,
                        'options'=>[
                            'class'=>'show'
                        ]
                    ],
                ]
            ]);

            ?>
        </div>
        <div class="col-xs-12">
            <?php
            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
                //        'autoGenerateColumns' => true,
                //
                'attributes' => [
                    'content' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Введите Контент...']],
                ]
            ]);
            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 3,
                //        'autoGenerateColumns' => true,
                //
                'attributes' => [
                    'actions'=>[
                        'type'=>Form::INPUT_RAW,
                        'value'=>'<div style="margin-top: 25px">' .
                            Html::resetButton('Сбросить', ['class'=>'btn btn-default']) . ' ' .
                            Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                            '</div>'
                    ],
                ]
            ]);
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJsFile('//cdn.ckeditor.com/4.5.7/full/ckeditor.js'); ?>
<?php $this->registerJs('
CKEDITOR.replace("coachingstaff-content");
 CKEDITOR.filter.allowedContentRules = true;
 CKEDITOR.config.allowedContent=true;
'); ?>