<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\GuestBook */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Guest Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'body:ntext',
            'email:email',
            'user_id',
            'ip',
            'status',
            'date',
        ],
    ]) ?>

</div>
