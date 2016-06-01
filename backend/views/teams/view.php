<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Teams */

$this->title = 'Команда '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Команды', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-view">
    <div class="well">
        <?php
            $images = $model->getImages();
            //var_dump($images->isMain);die;
            if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
                $image = $model->getImage();
                $sizes = $image->getSizesWhen('x100');
                echo Html::tag(
                    'p',
                    Html::img($image->getUrl('x100'),['class' => 'img-responsive thumbnail','width'=>$sizes['width'], 'height'=>$sizes['height']]),
                    ['class'=>'']
                );

            }
        ?>
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
    //            'id',
                'name',
                'slug',
                'year',
                'web_site',
                'description:ntext',
            ],
        ]) ?>
    </div>
    <h2>Состав</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'surname',
            'number',
//            'nationality',
            // 'height',
            // 'weight',
            // 'date',
            // 'role',
            // 'teams_id',
            // 'goals',
            // 'transfers',
            // 'yellow_cards',
            // 'red_cards',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
