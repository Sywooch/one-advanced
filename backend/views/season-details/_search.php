<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="season-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);

    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'season_id' => [
                'type' => Form::INPUT_WIDGET,
                'label' => 'Сезон',
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'data' => $model->getAllSeason(),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => 'Выберите сезон'
                    ],
                ]
            ],
            'team_id' => [
                'type' => Form::INPUT_WIDGET,
                'label' => 'Сезон',
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'data' => $model->getAllTeam(),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'options' => [
                        'placeholder' => 'Выберите команду'
                    ],
                ]
            ],
            'actions' => [
                'type' => Form::INPUT_RAW,
                'value' => '<div style="margin-top: 20px;margin-bottom: 20px;">' ./*text-align: right;*/
                    Html::a('Reset', ['index'], ['class' => 'btn btn-default']) . ' ' .
                    Html::submitButton('Search', ['class' => 'btn btn-primary']) .
                    '</div>'
            ],
        ]
    ]);

    ?>

<!--    --><?php //echo $form->field($model, 'id') ?>
<!--    <div class="row">-->
<!--        <div class="col-xs-6">--><?php //echo $form->field($model, 'season_id') ?><!--</div>-->
<!--        <div class="col-xs-6">--><?php //echo $form->field($model, 'team_id') ?><!--</div>-->
<!--    </div>-->




<!--    --><?php //echo $form->field($model, 'games') ?>

<!--    --><?php //echo $form->field($model, 'wins') ?>

    <?php // echo $form->field($model, 'draws') ?>

    <?php // echo $form->field($model, 'lesions') ?>

    <?php // echo $form->field($model, 'spectacles') ?>

    <?php // echo $form->field($model, 'goals_against') ?>

    <?php // echo $form->field($model, 'goals_scored') ?>

<!--    <div class="form-group">-->
<!--        --><?php //echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
<!--        --><?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
<!--    </div>-->

    <?php ActiveForm::end(); ?>

</div>
