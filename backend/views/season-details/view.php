<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\SeasonDetails */

Url::remember();

$this->title = $model->team->name . ' (' . $model->season->name . ')';
$this->params['breadcrumbs'][] = ['label' => 'Детали сезона', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-details-view">

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
            [
                'attribute' => 'season.name',
                'label' => 'Сезон',
            ],
            [
                'attribute' => 'team.name',
                'label' => 'Команда',
            ],
            'games',
            'wins',
            'draws',
            'lesions',
            'spectacles',
            'goals_scored',
            'goals_against',
        ],
    ]) ?>

</div>
