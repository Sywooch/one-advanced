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

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Матч',
                'value' => function ($model) {
                    return $model->home->name.'&nbsp;:&nbsp;'.$model->guest->name;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'category.name',
                'label' => 'Тип матча',
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
             'date:date',
             'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
