<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SeasonDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Season Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Season Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'season_id',
            'team_id',
            'games',
            'wins',
            // 'draws',
            // 'lesions',
            // 'spectacles',
            // 'goals_against',
            // 'goals_scored',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
