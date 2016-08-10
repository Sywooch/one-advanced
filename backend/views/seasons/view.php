<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Seasons */

$this->title = 'Сезон '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сезоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seasons-view">

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

    <?php
    $imgBlock = '';
    $img = $model->getImage();
    if($img['urlAlias']!='placeHolder') {
        $imgBlock = Html::img($img->getUrl('x30'));
    }

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            [
                'attribute' => 'full_name',
                'value' => $imgBlock . $model->full_name,
                'format' => 'html'
            ],
            'division',
            'slug',
            'status',
        ],
    ]) ?>

</div>
