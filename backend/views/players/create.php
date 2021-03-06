<?php

use yii\helpers\Html;
use common\models\Teams;


/* @var $this yii\web\View */
/* @var $model common\models\Players */

$this->title = 'Создание игрока';
$this->params['breadcrumbs'][] = ['label' => 'Игроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'teams' => Teams::find()->all()
    ]) ?>

</div>
