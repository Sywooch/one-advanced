<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BlackList */

$this->title = 'Обновление записи №' . $model->id . ' в черном списке';
$this->params['breadcrumbs'][] = ['label' => 'Гостевая книга', 'url' => ['/guest-book']];
$this->params['breadcrumbs'][] = ['label' => 'Черный список', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="black-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
