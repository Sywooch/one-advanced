<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\GamesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Матчи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать матч', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Матч',
                'value' => function ($model) {
                    return $model->home->name.'&nbsp;:&nbsp;'.$model->guest->name;
                },
                'format' => 'raw',
            ],
//            [
//                'attribute' => 'guest.name',
//                'label' => 'Команда в гостях',
//            ],
//            'season_id',
            'score',
            'tour',
            // 'city',
            // 'stadium',
            // 'referee',
            // 'referee2',
            // 'referee3',
            // 'content:ntext',
            [
                'attribute' => 'category.name',
                'label' => 'Категория',
            ],
             'date:datetime',
//             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
