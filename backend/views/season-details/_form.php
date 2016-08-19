<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-6">
        <div class="season-details-forml">

            <?php $form = ActiveForm::begin(); ?>
            <?php // echo $form->field($model, 'season_id')->textInput() ?>
            <?php // echo $form->field($model, 'team_id')->textInput() ?>
            <div class="row">
                <div class="col-xs-3"><?php echo $form->field($model, 'games')->textInput() ?></div>
                <div class="col-xs-3"><?php echo $form->field($model, 'wins')->textInput() ?></div>
                <div class="col-xs-3"><?php echo $form->field($model, 'draws')->textInput() ?></div>
                <div class="col-xs-3"><?php echo $form->field($model, 'lesions')->textInput() ?></div>
            </div>
            <div class="row">
                <div class="col-xs-4"><?php echo $form->field($model, 'goals_against')->textInput() ?></div>
                <div class="col-xs-4"><?php echo $form->field($model, 'goals_scored')->textInput() ?></div>
                <div class="col-xs-4"><?php echo $form->field($model, 'spectacles')->textInput() ?></div>
            </div>


            <div class="form-group">
                <?php echo Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
