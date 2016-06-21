<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BlackListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Черный список';
$this->params['breadcrumbs'][] = ['label' => 'Гостевая книга', 'url' => ['/guest-book']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить запись в список', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'user_id',
            'ip',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
