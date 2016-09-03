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
    <?php
    $image = $model->getImage();
    //var_dump($images->isMain);die;
    if($image['urlAlias']!='placeHolder') {
        echo Html::beginTag('div',['class'=>'', 'style' => 'margin-bottom:20px']);
        echo Html::img($image->getUrl('x300'),['class' => 'img-responsive',]);
        echo Html::endTag('div');

    }
    ?>
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
