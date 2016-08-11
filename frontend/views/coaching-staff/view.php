<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CoachingStaff */

$this->title = $model->surname . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Просмотр', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-staff-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'surname',
            'name',
            'patronymic',
            'date:date',
            'role',
            'teams.name',
            'status',
        ],
    ]) ?>

</div>
