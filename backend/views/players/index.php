<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PlayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Игроки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать игрока', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'label' => 'Фото',
//                'format' => 'raw',
//                'value' => function($data){
//                    $images = $data->getImages();
//                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
//                        $image = $data->getImage();
//                        $sizes = $image->getSizesWhen('x100');
//                        return Html::img($image->getUrl('x100'),[
//                            'alt'=>'yii2 - картинка в gridview',
//                            'class' => 'img-responsive',
//                            'width'=>$sizes['width'],
//                            'height'=>$sizes['height']
//                        ]);
//                    }
//                },
//            ],
            'id',
            'name',
            'surname',
            'number',
//            'nationality',
            // 'height',
            // 'weight',
            // 'date',
            // 'role',
            [
                'label' => 'Команда',
                'attribute' => 'teams.name'
            ],
            // 'goals',
            // 'transfers',
            // 'yellow_cards',
            // 'red_cards',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
