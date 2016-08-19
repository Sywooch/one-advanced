<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use common\models\UploadForm;
use kartik\builder\Form;
use kartik\form\ActiveForm;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\Teams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php $image=new UploadForm(); ?>

<!--    --><?php //echo $form->field($image, 'file')->fileInput()->label('Upload image') ?>
    <div class="row">
        <div class="col-xs-4">
            <?php
            echo '<label>Лого</label>';
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
        <?php
        if ($model->name != Yii::$app->params['main-team']) {
            echo Html::tag(
                'div',
                $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'Введите имя команды...']),
                ['class' => 'col-xs-4']);
        }
        ?>
        <div class="col-xs-4">
            <?php
            echo $form->field($model, 'slug')->textInput(['maxlength' => true, 'placeholder'=>'Введите Url...']);
            ?>
        </div>
    </div>


    <?php

//    echo '<br>';
//    $name =
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [
//            'city' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите город...']],
//            'stadium' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите стадион...']],
            'year' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите год создания...']],
            'web_site' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите веб сайт...']],
        ]
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [
            'city' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите город...']],
            'stadium' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите стадион...']],
//            'year' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите год создания...']],
//            'web_site' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Введите веб сайт...']],
        ]
    ]);

    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>1,
        'attributes'=>[
            'description' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Введите описание...']],
        ]
    ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
