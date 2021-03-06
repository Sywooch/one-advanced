<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cтраницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$image = $model->getImage();
?>
<div class="pages-view well">
    <img src="<?php echo $image->getUrl(); ?>" alt="" class="img-responsive">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту страницу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
//            'slug',
            [
                'attribute' => 'slug',
                'label' => 'Ссылка',
                'value' => '/page/'.$model->slug
            ],
            'status',
            'meta_title',
            'meta_keywords',
            'meta_descr',
            'content:html',
            'widget_bar:html',

        ],
    ]) ?>

</div>
