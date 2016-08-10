<!--<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>-->
<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use common\models\UploadForm;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
if($model->errors) {
    var_dump($model->errors);
}
$model->date_create = Yii::$app->formatter->asDatetime(($model->isNewRecord ? time() : $model->date_create),'php:d-m-Y');

?>

<div class="news-form well">

    <?php

    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
//        'autoGenerateColumns' => true,

        'attributes' => [
            'title' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите title...']],
            'alias' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите alias...'], 'visible' => !$model->isNewRecord],
        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'snippet' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Введите короткое описание...']],
            'content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Введите контент...']],
        ]
    ]);
    $image=new UploadForm();
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
//    echo Form::widget([
//        'model'=>$image,
//        'form'=>$form,
//        'columns'=>1,
//        'attributes'=>[
//            'file' => [
//                'type'=>Form::INPUT_FILE,
//                'widgetClass'=>'\kartik\widgets\FileInput',
//                'label'=>'Загрузить картинку'
//            ],
//        ]
//    ]);

    if ($model->isNewRecord) {
        $model->status_id = 'on';
    }
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'category_id'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\Select2',
                'options'=>['data'=>ArrayHelper::map($model->getAllCategory(), 'id', 'name')],
                'hint'=>'Нажмите и выберите категорию'
            ],
            'date_create'=>[
                'type'=>Form::INPUT_WIDGET,
                'widgetClass'=>'\kartik\widgets\DatePicker',
                'hint'=>'Введите дату',
                'options' => [
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy'
                    ]
                ]
            ],
            'status_id'=>[
                'type'=>Form::INPUT_RADIO_LIST,
                'items'=>[ 'on' => 'On', 'off' => 'Off'],
                'options'=>['inline'=>true]
            ],
            'actions'=>[
                'type'=>Form::INPUT_RAW,
                'value'=>'<div style="text-align: right; margin-top: 20px">' .
                    Html::resetButton('Сбросить', ['class'=>'btn btn-default']) . ' ' .
                    Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) .
                    '</div>'
            ],
        ]
    ]);
    ActiveForm::end();
    ?>
</div>
<?php $this->registerJsFile('//cdn.ckeditor.com/4.5.7/full/ckeditor.js'); ?>
<?php $this->registerJs('
CKEDITOR.replace("news-content");
 CKEDITOR.filter.allowedContentRules = true;
 CKEDITOR.config.allowedContent=true;
'); ?>
<!--<script>-->
<!--    CKEDITOR.replace( 'news-content');-->
<!--</script>-->
