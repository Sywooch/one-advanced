<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\GamesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="games-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?php //echo $form->field($model, 'id') ?>

<!--    --><?php //echo $form->field($model, 'home_id') ?>

<!--    --><?php //echo $form->field($model, 'guest_id') ?>
    <div class="row">
        <div class="col-xs-6">
            <?php
            echo $form->field($model, 'season_id')->widget(Select2::classname(),[
                'data' => ArrayHelper::map($model->getAllSeasons(), 'id', 'name'),
                'options' => ['placeholder' => 'Выберите сезон ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]) ;
            ?>
        </div>
        <div class="col-xs-6">
            <div class="form-group" style="margin-top: 25px">
                <?php echo Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
<!--                --><?php //echo Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
                <?php echo Html::a('Сбросить', ['/games'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>


<!--    --><?php //echo $form->field($model, 'tour') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'stadium') ?>

    <?php // echo $form->field($model, 'referee') ?>

    <?php // echo $form->field($model, 'referee2') ?>

    <?php // echo $form->field($model, 'referee3') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'status') ?>


    <?php ActiveForm::end(); ?>

</div>
