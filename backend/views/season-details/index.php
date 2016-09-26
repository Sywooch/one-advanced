<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SeasonDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Url::remember();

$this->title = 'Таблица';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="season-details-index">

    <h1><?= Html::encode($this->title) ?></h1>
            <div style="overflow: hidden">
                <div class="" style="margin-bottom: 10px;">
                    <a class="btn btn-default" role="button" data-toggle="collapse"
                       href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Поиск <span class="caret"></span>
                    </a>
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="well">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>

    <p>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'season.name',
                'label' => 'Сезон',
            ],
            [
                'attribute' => 'team.name',
                'label' => 'Команда',
            ],
            'games',
            'wins',
            'draws',
            'lesions',
            'spectacles',
            'goals_scored',
            'goals_against',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
