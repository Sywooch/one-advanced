<?php

use frontend\widgets\NewsWidget;
use yii\widgets\ListView;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use frontend\widgets\StandingsWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сайт Футбольного Клуба';

$this->params['widget_bar'] = StandingsWidget::widget(['template' => 'smallTable']);
if (!empty($data['allPlayers'])) {
    $playersBD = '';
    foreach ($data['allPlayers'] as $item) {
        $image = $item->getImage();
        $img = '';
        if($image['urlAlias']!='placeHolder') {
            $sizes = $image->getSizesWhen('x60');
            $img = Html::img($image->getUrl('x60'),[
                'alt'=> $item->surname . ' ' .$item->name,
                'class' => '',
                'width'=>$sizes['width'],
                'height'=>$sizes['height']
            ]);
        }
        $playersBD .= Html::tag('div',
                Html::tag('div', $img, ['class' => 'col-xs-4 text-center']).
                Html::tag('div',
                    Html::tag('div', $item->name).
                    Html::tag('div', Html::tag('b', $item->surname)).
                    Html::tag('div', Yii::$app->formatter->asDatetime($item->date, 'php:d.m.Y'), ['class' => 'players-bd-date']),
                    ['class' => 'col-xs-8']),
                ['class' => 'row']).Html::tag('hr');
//        var_dump($item);
    }
//    var_dump($data['allPlayers']);
    $this->params['widget_bar'] .= Html::tag('div', Html::tag('h4', 'Именинники') . $playersBD, ['class' => 'players-bd']);
}
$this->params['gamesPreview'] = array_merge(array_reverse($data['gamesLast']), $data['gamesFirst']);
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
