<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryGames */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-6">
        <div class="category-games-form well">

            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                <div class="row">
                    <div class="col-xs-6">
                        <?= $form->field($model, 'status')->dropDownList([ 'on' => 'On', 'off' => 'Off', ]) ?>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group" style="margin-top: 25px">
                            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>