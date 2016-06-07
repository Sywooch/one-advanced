<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
//use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form well">
    <?php

    $form = ActiveForm::begin();
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
//        'autoGenerateColumns' => true,

        'attributes' => [
            'name' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите Имя...']],
            'meta_title' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите meta title...']],
            'meta_keywords' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите meta keywords...']],
            'meta_descr' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите meta description...']],
        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'slug' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите slug...']],
            'content'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Введите контент...']],
        ]
    ]);

    if ($model->isNewRecord) {
        $model->status = 'on';
    }
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        'attributes'=>[
            'status'=>[
                'type'=>Form::INPUT_RADIO_BUTTON_GROUP,
                'items'=>[ 'on' => 'On', 'off' => 'Off'],
                'options'=>
                    ['inline'=>true,
//                    'class'=>'show'
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
    <?php /*$form = ActiveForm::begin(); */?><!--
    <?php /*echo $form->field($model, 'name')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'meta_title')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'content')->textarea(['rows' => 6]) */?>
    <?php /*echo $form->field($model, 'slug')->textInput(['maxlength' => true]) */?>
    <?php /*echo $form->field($model, 'status')->dropDownList([ 'on' => 'On', 'off' => 'Off', ], ['prompt' => '']) */?>
    <div class="form-group">
        <?php /*echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) */?>
    </div>
    --><?php /*ActiveForm::end(); */?>

</div>
<?php $this->registerJsFile('//cdn.ckeditor.com/4.5.7/full/ckeditor.js'); ?>
<?php $this->registerJs('
CKEDITOR.replace("pages-content");
 CKEDITOR.filter.allowedContentRules = true;
 CKEDITOR.config.allowedContent=true;
'); ?>