<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//var_dump($model->category);
//$model -> date = date('d.m.y',$model -> date);
?>
<div class="news-view  well">


    <?php

    $images = $model->getImages();
//var_dump($images->isMain);die;
    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
        $image = $model->getImage();
        $sizes = $image->getSizesWhen('x300');
        echo Html::tag(
            'p',
            Html::img($image->getUrl('x300'),['class' => 'img-responsive  thumbnail','width'=>$sizes['width'], 'height'=>$sizes['height']]),
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
            'title',
            'alias',
            'category.name',
//            [
//                'attribute' => 'category_id',
//                'value' => function ($model, $key, $index, $widget) {
//                    return $model->categoty->name;
//                },
//                'format' => 'raw',
//            ],
            'snippet:ntext',
            'content:html',
            'views',
            'comments',
            'status_id',
            'date:date',
            'date_create:date',
        ],
    ]) ?>

</div>
