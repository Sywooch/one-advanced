<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Games */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-view">

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
            [
                'attribute' => 'home.name',
                'label' => 'Команда дома',
            ],
            [
                'attribute' => 'guest.name',
                'label' => 'Команда в гостях',
            ],
            [
                'attribute' => 'season.name',
                'label' => 'Сезон',
            ],
            'tour',
            'score',
            'city',
            'stadium',
            'referee',
            'referee2',
            'referee3',
            'content:html',
            'date:datetime',
            'status',
        ],
    ]) ?>

</div>
