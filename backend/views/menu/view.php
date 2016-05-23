<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Меню', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить пункт меню?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'parent_id',
            [
                'attribute' => 'parent.name',
                'label' => 'Родитель',
            ],
            'name',
//            'url:url',
            'url',
//            [
//                'attribute' => 'url',
//                'label' => 'Ссылка',
//                'value' => function($model) {
//                    return Html::a($model->name, [$model->url]);
//                }
//            ],
            'position',
            'sort',
            'status',
        ],
    ]) ?>

</div>
