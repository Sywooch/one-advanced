<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use common\models\UploadForm;
use kartik\file\FileInput;

$model->date = Yii::$app->formatter->asDatetime(($model->isNewRecord ? time() : $model->date),'php:d-m-Y H:i');


/* @var $this yii\web\View */
/* @var $model common\models\Games */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model->getAllSeasons());
//var_dump(ArrayHelper::map($model->getAllSeasons(), 'id', 'name'));
?>

<div class="games-form well">

    <?php
    $seasonTeams = [];
    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    if ($model->isNewRecord) {
        $model->status = 'будет';
    } else {
        foreach ($model->season->seasonDetails as $seasonDetails) {
//            $seasonTeams[] = ['id'=>$seasonDetails->team->id, 'name' => $seasonDetails->team->name];
            $seasonTeams[$seasonDetails->team->id] =  $seasonDetails->team->name;
        }
    }
    $image=new UploadForm();

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
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
            'home_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\DepDrop',
                'options'=>[
                    'data' => $seasonTeams,
                    'id'=>'home-id',
                    'pluginOptions'=>[
                        'depends'=>['season-id'],
                        'placeholder'=>'Выберите Команду',
                        'url'=>\yii\helpers\Url::to(['/seasons/teams']),

                    ]

                ],
            ],
            'guest_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\DepDrop',
                'options'=>[
                    'data' => $seasonTeams,
                    'id'=>'guest-id',
                    'pluginOptions'=>[
                        'depends'=>['season-id'],
                        'placeholder'=>'Выберите Команду',
                        'url'=>\yii\helpers\Url::to(['/seasons/teams']),

                    ]

                ],
            ],
        ]
    ]);

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
//        'autoGenerateColumns' => true,
//
        'attributes' => [
            'category_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllCategories(), 'id', 'name'),
                    'options'=>['placeholder'=>'Выберите Категорию'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ],
            ],
            'gallery_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>[
                    'data'=>ArrayHelper::map($model->getAllGallery(), 'id', 'name'),
                    'options'=>['placeholder'=>'Выберите Галерею'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ],
            ],
            'tour' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Тур...']],
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
            'referee' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Первого Судью...']],
            'referee2' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Второго Судью...']],
            'referee3' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Третьего Судью...']],
        ]
    ]);
    if (!$model->isNewRecord) {
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 3,
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
                'score' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Счёт...']],

            ]
        ]);
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 1,
            'attributes' => [
                'translation' => [
                    'type'=>Form::INPUT_TEXTAREA,
                ],
                'recaps' => [
                    'type'=>Form::INPUT_TEXTAREA,
                ],
            ]
        ]);
//        var_dump($model->home->name);
//        var_dump(Yii::$app->params['main-team']);
        if ($model->home->name == Yii::$app->params['main-team']) {
            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
                'attributes' => [
                    'behavior_rules' => [
                        'type'=>Form::INPUT_TEXTAREA,
                    ],
                    'prizes' => [
                        'type'=>Form::INPUT_TEXTAREA,
                    ],
                ]
            ]);

        }
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'video_id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите ID...']],
                'ticket_id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите ID...']],

            ]
        ]);
    }

    ?>
    <div class="row">
        <div class="col-xs-4">
            <?php
            echo '<label>Превью</label>';
            echo FileInput::widget([
                'model' => $image,
                'attribute' => 'file',
                'options' => ['multiple' => false],
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => true,
                    'showRemove' => true,
                    'showUpload' => false
                ]
            ]);
            ?>
        </div>
        <div class="col-xs-8">
            <?php

                echo Form::widget([       // 1 column layout
                    'model'=>$model,
                    'form'=>$form,
                    'columns'=>2,
                    'attributes'=>[
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
<?php $this->registerJsFile('//cdn.ckeditor.com/4.5.7/standard/ckeditor.js'); ?>
<?php $this->registerJs(
    <<<JS
CKEDITOR.replace("games-content");
//CKEDITOR.replace("games-translation");
CKEDITOR.replace("games-recaps");
CKEDITOR.replace("games-behavior_rules");
CKEDITOR.replace("games-prizes");
 CKEDITOR.filter.allowedContentRules = true;
 CKEDITOR.config.allowedContent=true;
JS
); ?>