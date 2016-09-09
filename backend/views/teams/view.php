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
                echo Html::tag(
                    'p',
                    Html::img($image->getUrl(''),['class' => 'img-responsive',]),
                    ['class'=>'']
                );

            }
        ?>
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы действительно хотите удалить?',
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
                'city',
                'stadium',
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
