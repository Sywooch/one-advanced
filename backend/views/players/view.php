<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Players */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-view well">

    <?php
    $images = $model->getImages();
    //var_dump($images->isMain);die;
    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
        echo Html::beginTag('div',['class'=>'']);
            $image = $model->getImage();
            $sizes = $image->getSizesWhen('x150');
            echo Html::tag(
                'p',
                Html::img($image->getUrl('x150'),['class' => 'img-responsive thumbnail','width'=>$sizes['width'], 'height'=>$sizes['height']]),
                ['class'=>'']
            );
        echo Html::endTag('div');

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
            'surname',
            'number',
            'nationality',
            'height',
            'weight',
            'date',
            'role',
            'teams.name',
            'goals',
            'transfers',
            'yellow_cards',
            'red_cards',
        ],
    ]) ?>

</div>
