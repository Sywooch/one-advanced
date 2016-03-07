<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Teams */

$this->title = 'Команда '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-view well">
    <?php
        $images = $model->getImages();
        //var_dump($images->isMain);die;
        if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
            $image = $model->getImage();
            $sizes = $image->getSizesWhen('x100');
            echo Html::tag(
                'p',
                Html::img($image->getUrl('x100'),['class' => 'img-responsive','width'=>$sizes['width'], 'height'=>$sizes['height']]),
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
