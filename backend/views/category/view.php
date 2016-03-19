<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1>
        <?php
//        echo Html::encode($this->title).' - "'.$model->slug.'"" ('.$model->status_id.')';
        echo Html::encode($this->title);
        echo Html::tag('div',
            Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']),['class'=>'pull-right']);
//        .' '.Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],])

        ?>
    </h1>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'name',
            'slug',
            'status_id',
        ],
    ]) ?>
    <h2>Новости Категории</h2>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            'snippet',
            'date:datetime',
//            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);
    ?>

</div>
