<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

echo Html::tag(
    'div',
    Html::tag('h4', 'Турнирная таблица').
    Html::tag('p', $data['season']['full_name']).
    GridView::widget([
        'dataProvider' => $dataProvider['standings'],
        'bordered'=>false,
        'striped'=>false,
        'condensed'=>false,
        'responsive'=>false,
        'hover'=>false,
        'layout' => '{items}',
        'rowOptions'=>function ($model, $key, $index, $grid) use ($data) {
            $class= $model->team_id == $data['mainTeam']->id ? 'main-team' : '';
            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Команда',
                'format' => 'raw',

                'value' => function ($model) {
                    $result = '';
                    $images = $model->team->getImages();
                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
                        $image = $model->team->getImage();
                        $sizes = $image->getSizesWhen('15x');
                        $result .= Html::img($image->getUrl('15x'),[
                            'alt'=>$model->team->name,
//                                'class' => 'img-responsive',
                            'style' => 'margin-right:10px',
                            'width'=>$sizes['width'],
                            'height'=>$sizes['height']
                        ]);
                    }
//                    var_dump($model->team->web_site);
                    if ($model->team->web_site != '') {
                        $result .= Html::a($model->team->name, Url::to($model->team->web_site, true), ['target' => '_blank']);

                    } else {
                        $result .= $model->team->name;

                    }
//                    $result .= Html::a($model->team->name, []);
                    return $result;
                },
            ],
            [
                'label' => 'Игры',
                'attribute' => 'games',
            ],
            'spectacles',
        ],
    ]) .
    Html::tag('div', Html::a('Просмотреть всю таблицу', ['/season-details']), ['class' => 'text-center']),
    ['class' => 'standings']);