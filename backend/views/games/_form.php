<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

$model->date = Yii::$app->formatter->asDatetime($model->date,'php:d-m-Y H:i');

/* @var $this yii\web\View */
/* @var $model common\models\Games */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model->getAllSeasons());
//var_dump(ArrayHelper::map($model->getAllSeasons(), 'id', 'name'));
?>

<div class="games-form well">

    <?php
    $form = ActiveForm::begin();
    if ($model->isNewRecord) {
//        $model->position = 'headerTop';
        $model->status = 'будет';
    }
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,
//
        'attributes' => [

//            'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Имя...']],
//            'url' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите url...']],
//            'sort' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите sort...']],
            'category_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllCategories(), 'id', 'name'),
                    'options'=>['placeholder'=>'Выберите Категорию']
                ],
            ],
            'season_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllSeasons(), 'id', 'name'),
                    'options'=>[
                        'placeholder'=>'Выберите Сезон',
                        'id'=>'season-id',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ],
            ],
//            echo $form->field($model, 'subcat')->widget(DepDrop::classname(), [
//                'options'=>['id'=>'subcat-id'],
//                'pluginOptions'=>[
//                    'depends'=>['cat-id'],
//                    'placeholder'=>'Select...',
//                    'url'=>Url::to(['/site/subcat'])
//                ]
//            ]);
        ]
    ]);
    echo $form->field($model, 'home_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'home-id'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions'=>[
            'depends'=>['season-id'],
            'placeholder'=>'Выберите Команду',
            'url'=>\yii\helpers\Url::to(['/seasons/teams']),

        ]
    ]);
    echo $form->field($model, 'guest_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'guest-id'],
        'pluginOptions'=>[
            'depends'=>['season-id'],
            'placeholder'=>'Выберите Команду',
            'url'=>\yii\helpers\Url::to(['/seasons/teams'])

        ]
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
//            'home_id'=>[
//                'type'=>Form::INPUT_WIDGET,
//                'widgetClass'=>'\kartik\widgets\DepDrop',
//                'options'=>[
//                    'data'=>ArrayHelper::map($model->getAllTeams(), 'id', 'name'),
//                    'options'=>[
//                        'placeholder'=>'Выберите Команду',
//                        'depends'=>['season-id'],
//                        'url'=>\yii\helpers\Url::to(['/site/subcat'])
//
//                    ],
//
//                ],
//            ],
//            'home_id'=>[
//                'type'=>Form::INPUT_WIDGET,
//                'widgetClass'=>'\kartik\widgets\Select2',
//                'options'=>[
//                    'data'=>ArrayHelper::map($model->getAllTeams(), 'id', 'name'),
//                    'options'=>['placeholder'=>'Выберите Команду']
//                ],
//            ],
            'guest_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllTeams(), 'id', 'name'),
                    'options'=>['placeholder'=>'Выберите Команду']
                ],
            ],
            'tour' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Тур...']],
            'score' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Счёт...']],
            'date'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\DateTimePicker',
                'hint'=>'Введите дату матча',
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy hh:ii'
                    ]
                ]
            ],
            'referee' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Первого Судью...']],
            'referee2' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Второго Судью...']],
            'referee3' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Третьего Судью...']],

//            'position' => [
//                'type'=>Form::INPUT_RADIO_LIST,
//                'items'=>[ 'headerTop' => 'HeaderTop', 'headerBottom' => 'HeaderBottom'],
//                'options'=>['inline'=>true]
//            ],
//            'status'=>[
//                'type'=>Form::INPUT_RADIO_LIST,
//                'items'=>[ 'on' => 'On', 'off' => 'Off'],
//                'options'=>['inline'=>true]
//            ],
//            'actions'=>[
//                'type'=>Form::INPUT_RAW,
//                'value'=>'<div style="margin-top: 20px">' .
//                    Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
//                    Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
//                    '</div>'
//            ],
        ]
    ]);

    echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter notes...']],
        ]
    ]);

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
            'city' => [
                'type'=>Form::INPUT_TEXT,
                'options'=>['placeholder'=>'Введите Город...'],
                'hint'=>'Город Проведения Матча'
            ],
            'stadium' => [
                'type'=>Form::INPUT_TEXT,
                'options'=>['placeholder'=>'Введите Стадион...'],
                'hint'=>'Стадион Проведения Матча'
            ],
            'status'=>[
                'label'=>'Статус',
                'items'=>[
                    'будет' => 'будет',
                    'был' => 'был',
                    'отменён' => 'отменён',
                    'перенесён' => 'перенесён',
                ],
                'type'=>Form::INPUT_RADIO_BUTTON_GROUP,
                'options'=>[
                    'class'=>'show'
                ]
            ],

        ]
    ]);
    echo Form::widget([       // 1 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'actions'=>[
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="margin-top: 20px">' .
                    Html::resetButton('Сбросить', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>'
            ],
        ]
    ]);
    ?>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('//cdn.ckeditor.com/4.5.7/full/ckeditor.js'); ?>
<?php $this->registerJs('
CKEDITOR.replace("games-content");
 CKEDITOR.filter.allowedContentRules = true;
 CKEDITOR.config.allowedContent=true;
'); ?>