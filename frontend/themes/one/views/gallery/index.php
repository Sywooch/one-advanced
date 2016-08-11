<?php

use kartik\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фотогалерея';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <div class="gallery-view-block">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'class' => 'row',
            ],
            'itemOptions' => ['class' => 'item col-xs-4'],
            'layout' => '{items}{pager}',
            'itemView' => function ($model, $key, $index, $widget) {
//                var_dump($model->getImage());
                $img = $model->getImage();
                return Html::a(
//                    Html::tag('div',Html::icon('folder-open')).
                    Html::tag('div', Html::img($img->getUrl('300x300'), ['width' => 300, 'height' => 300]), ['class' => 'gallery-preview-img']) .
                    Html::tag('div',Html::encode($model->name), ['class' => 'gallery-view-box-name']),
                    ['view', 'id' => $model->id],
                    ['class' => 'gallery-view-box text-center']
                );
            },
        ]) ?>
    </div>
    <?php Pjax::end(); ?></div>
