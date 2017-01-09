<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\Teams;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GamesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Матчи';
$this->params['breadcrumbs'][] = $this->title;
$homeTeamId = Teams::find()->select('id')->where(['name' => Yii::$app->params['main-team']])->one()->id;

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
        'striped'=>false,
        'summary' => false,
        'rowOptions'=>function ($model, $key, $index, $grid) use ($homeTeamId){
//            var_dump($homeTeamId);
//            var_dump($model);
            $win = false;
            $draw = false;
            $defeat = false;
            if ($model->date < time()){
                $score = explode(':', $model->score);
//                var_dump($model);
                if ($model->home_id == $homeTeamId) {
                    if ($score[0] > $score[1]) {
                        $win = true;
                    } elseif($score[0] < $score[1]) {
                        $defeat = true;
                    } elseif($score[0] == $score[1]) {
                        $draw = true;
                    }
//                    var_dump($score);
//                    var_dump($win,$draw,$defeat);
                }
                if ($model->guest_id == $homeTeamId) {
                    if ($score[0] < $score[1]) {
                        $win = true;
                    } elseif($score[0] > $score[1]) {
                        $defeat = true;
                    } elseif($score[0] == $score[1]) {
                        $draw = true;
                    }
                }
            }
//            var_dump($win,$draw,$defeat);
            $class = '';
            if ($win) {
                $class = 'win';
            } elseif ($draw) {
                $class = 'draw';
            } elseif ($defeat) {
                $class = 'defeat';
            }
            return ['class' => $class];
//            if ($model->guest_id = $homeTeamId) {
//                var_dump($model->score);
//
//            }
//            var_dump($model->score);
//            $class=$index%2?'odd':'even';
////            var_dump($grid);
//            return [
//                'key'=>$key,
//                'index'=>$index,
//                'class'=>$class
//            ];
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
                    $result = '';
                    if ($model->tour != '0') {
                        $result = Html::tag('div', 'Тур '.$model->tour);
                    } else {
                        $result = $model->category->name;
                    }
                    return $result;
                },
                'format' => 'raw',
            ],
            [
                'label' => false,
                'value' => function ($model) {
                    $logoHome = '';
                    $logoGuest = '';
                    $imageHome = $model->home->getImage();
                    if($imageHome['urlAlias']!='placeHolder') {
                        $sizes = $imageHome->getSizesWhen('x30');
                        $logoHome = Html::tag('span', Html::img($imageHome->getUrl('x30'),[
                            'alt'=>$model->home->name,
                            'class' => 'hidden-sm',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]), ['class' => 'games-index-logo']);
                    }
                    $imageGuest = $model->guest->getImage();
                    if($imageGuest['urlAlias']!='placeHolder') {
                        $sizes = $imageGuest->getSizesWhen('x30');
                        $logoGuest = Html::tag('span', Html::img($imageGuest->getUrl('x30'),[
                            'alt'=>$model->guest->name,
                            'class' => 'hidden-sm',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]), ['class' => 'games-index-logo']);
                    }
                    return Html::tag('div', Html::a(
                        Html::tag('div', $model->home->name . ' ' . $logoHome, ['class' => 'games-index-teams text-right']).
                        Html::tag('div', ($model->score == '0:0' && $model->date > strtotime(date('d-m-Y')) ? '&nbsp;:&nbsp;' : $model->score), ['class' => 'games-index-teams-score text-center']).
                        Html::tag('div', $logoGuest . ' ' . $model->guest->name, ['class' => 'games-index-teams text-left']),
                        ['view', 'id' => $model->id]
                    ), ['class' => 'text-center games-index-team-score']);
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
//            [
//                'label' => false,
//                'value' => function ($model) {
//                    return Html::tag('div', 'Сезон ' . $model->season->name . ($model->tour != '0' ? ', Тур '.$model->tour : '')) . Html::tag('div', $model->category->name);
//                },
//                'format' => 'raw',
//            ],
            [
                'label' => false,
                'value' => function ($model) {
                    return Html::tag('div', Html::tag('div', $model->stadium) . Html::tag('div', $model->city), ['class' => 'stadium-city']);
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
