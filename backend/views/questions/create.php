<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Questions */

$this->title = 'Создание опроса';
$this->params['breadcrumbs'][] = ['label' => 'Опросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
