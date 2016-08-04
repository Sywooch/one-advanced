<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ClubQuestions */

$this->title = 'Создать вопрос клубу';
$this->params['breadcrumbs'][] = ['label' => 'Вопросы клубу', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="club-questions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
