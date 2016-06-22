<?php

use frontend\widgets\NewsWidget;
use yii\widgets\ListView;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сайт Футбольного Клуба';

$this->params['widget_bar'] = Html::tag(
    'div',
    Html::tag('h4', 'Турнирная таблица').
    Html::tag('p', $data['season']['full_name']).
    GridView::widget([
        'dataProvider' => $dataProvider['standings'],
        'bordered'=>false,
        'striped'=>false,
        'condensed'=>false,
        'responsive'=>true,
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
                    $result .= $model->team->name;
                    return $result;
                },
            ],
            [
                'label' => 'Игры',
                'attribute' => 'games',
            ],
            'spectacles',
        ],
    ]),
    ['class' => 'standings']);
?>
<div class="site-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div style="font-size: 20px; display: inline-block;">НОВОСТИ</div>

        </div>
        <div class="panel-body">
<!--            <div class="news-index">-->
            <div class="news-home">

                <?php
//                yii\widgets\Pjax::begin(['options' => ['id'=>123, 'timeout'=>3000]]);
//                \yii\widgets\Pjax::begin();
                echo ListView::widget([
                    'dataProvider' => $dataProvider['news'],
//                    'itemView' => '_list',
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_list',['model' => $model, 'index' => $index]);
                    },
                    'layout' => "{items}",
                    'itemOptions' => [
                        'class' => 'news'
                    ]
                ]);
//                \yii\widgets\Pjax::end();
//                yii\widgets\Pjax::end();
                ?>
            </div>
            <div class="text-center all-news-link">
                <?php echo Html::a('Показать все новости',['/news'])?>
            </div>
        </div>
    </div>



    <?php // echo NewsWidget::widget(['template'=>'news-index']); ?>

    <!--<div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>-->

    <!--<div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>-->
</div>
