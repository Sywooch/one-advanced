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
        'options' => ['name' => 'search']
    ]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'season_id' => [
                'type' => Form::INPUT_WIDGET,
                'label' => false,
                'widgetClass' => '\kartik\widgets\Select2',
                'options' => [
                    'data' => $model->getAllTeamSeason(),
                    'options' => [
                        'placeholder' => 'Турнир',
                        'onchange' => 'document.forms[\'search\'].submit();'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]
            ],
//            'actions' => [
//                'type' => Form::INPUT_RAW,
//                'value' => '<div style="margin-top: 20px;margin-bottom: 20px;">' ./*text-align: right;*/
//                    Html::a('Reset', ['index'], ['class' => 'btn btn-default']) . ' ' .
//                    Html::submitButton('Search', ['class' => 'btn btn-primary']) .
//                    '</div>'
//            ],
        ]
    ]);

    ?>


    <?php ActiveForm::end(); ?>

</div>
