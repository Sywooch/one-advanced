<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\GamesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Матчи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="games-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive'=>true,
        'hover'=>true,
        'bordered'=>false,
        'striped'=>true,
        'rowOptions'=>function ($model, $key, $index, $grid){
            $class=$index%2?'odd':'even';
//            var_dump($grid);
            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'date',
                'label' => false,
                'format' => 'date'
            ],
            [
                'label' => false,
                'value' => function ($model) {
                    $logoHome = '';
                    $logoGuest = '';
                    $imageHome = $model->home->getImage();
                    if($imageHome['urlAlias']!='placeHolder') {
                        $sizes = $imageHome->getSizesWhen('x30');
                        $logoHome = Html::img($imageHome->getUrl('x30'),[
                            'alt'=>$model->home->name,
                            'class' => 'hidden-sm',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]);
                    }
                    $imageGuest = $model->guest->getImage();
                    if($imageGuest['urlAlias']!='placeHolder') {
                        $sizes = $imageGuest->getSizesWhen('x30');
                        $logoGuest = Html::img($imageGuest->getUrl('x30'),[
                            'alt'=>$model->guest->name,
                            'class' => 'hidden-sm',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]);
                    }
                    return Html::a(
                        $model->home->name . ' ' . $logoHome .
                        '&nbsp;' . ($model->score == '0:0' ? '&nbsp;:&nbsp;' : $model->score) . '&nbsp;' .
                        $logoGuest . ' ' . $model->guest->name,
                        ['view', 'id' => $model->id]
                    );
//                    return $model->home->name . '&nbsp;' . ($model->score == '0:0' ? '&nbsp;:&nbsp;' : $model->score) . '&nbsp;' . $model->guest->name;
                },
                'format' => 'raw',
            ],
//            [
//                'label' => false,
//                'value' => function ($model) {
//                    if ($model->tour != '0') {
//                        return $model->tour;
//                    } else {
//                        return false;
//                    }
//                },
//                'format' => 'raw',
//            ],
            [
                'label' => false,
                'value' => function ($model) {
                    return Html::tag('div', 'Сезон ' . $model->season->name . ($model->tour != '0' ? ', Тур '.$model->tour : '')) . Html::tag('div', $model->category->name);
                },
                'format' => 'raw',
            ],
            [
                'label' => false,
                'value' => function ($model) {
                    return Html::tag('div', $model->stadium) . Html::tag('div', $model->city);
                },
                'format' => 'raw'
            ],

//            [
//                'attribute' => 'guest.name',
//                'label' => 'Команда в гостях',
//            ],
//            'season_id',
//            'score',
//            'tour',
            // 'city',
            // 'stadium',
            // 'referee',
            // 'referee2',
            // 'referee3',
            // 'content:ntext',
//             'status',

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view}'
//            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
