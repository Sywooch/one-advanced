<?php

use frontend\widgets\NewsWidget;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use Madcoda\Youtube;
use Madcoda\Tests\YoutubeTest;

/* @var $this yii\web\View */

$this->title = 'Сайт Футбольного Клуба';
?>
<div class="site-index">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div style="font-size: 20px; display: inline-block;">НОВОСТИ</div>
            <div class="pull-right">
                <?php echo Html::a('Все Новости',['/news'],['style'=> 'color:inherit;font-size:12px; vertical-align: middle;'])?>
            </div>
        </div>
    </div>
<!--    <div class="row news-index">-->
    <div class="news-home">
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
//            'itemView' => '_list',
            'itemView' => function ($model, $key, $index, $widget) {
//                var_dump($widget);
                return $this->render('_list',['model' => $model, 'index' => $index]);

                // or just do some echo
                // return $model->title . ' posted by ' . $model->author;
            },
            'layout' => "{items}",
            'itemOptions' => [
                'class' => 'news'
            ]
        ]);
        ?>
        <div style="overflow: hidden">
            <div class="pull-right">
                <a href="<?php echo Url::toRoute(['/news']) ?>">Читать все материалы</a>
            </div>
        </div>
    </div>
    <div class="video-tv">
        <h3>Канал-ТВ</h3>
        <div class="well">
            <div class="row">
                <?php
                $key='AIzaSyAvDmtfH6P73IJzaV4bN0JyoJl--3Z4tc8';
                $youtube = new Youtube(array('key' => $key));
                $channel = $youtube->getChannelByName('fcbaltika');
                $playlist = $channel->contentDetails->relatedPlaylists->uploads;
                $playlistItems = $youtube->getPlaylistItemsByPlaylistId($playlist);
                $i = 0;
                foreach ($playlistItems as $item) {
            //        var_dump($item);
                    $i++;
                    if ($i <= 3) {
                        if ($i==1){
                            ?>
                            <div class="col-xs-9">
                                <div class="video-left-block">
                                    <iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $item->snippet->resourceId->videoId ?>?showinfo=0' width='100%' height='330' frameborder='0' allowfullscreen></iframe>
                                    <div class="video-name"><?php echo $item->snippet->title ?></div>
                                </div>
                            </div>
                            <?php
                        } elseif ($i==2) {
                           ?>
                            <div class="col-xs-3">
                                <div class="video-right-block">
                                    <div class="video-right-block-top">
                                        <iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $item->snippet->resourceId->videoId ?>?showinfo=0' width='100%' height='100' frameborder='0' allowfullscreen></iframe>
                                        <div class="video-name"><?php echo $item->snippet->title ?></div>
                                    </div>
                            <?php
                        } elseif ($i==3) {
                            ?>
                                    <div class="video-right-block-bottom">
                                        <iframe type='text/html' src='http://www.youtube.com/embed/<?php echo $item->snippet->resourceId->videoId ?>?showinfo=0' width='100%' height='100' frameborder='0' allowfullscreen></iframe>
                                        <div class="video-name"><?php echo $item->snippet->title ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                    ?>
            </div>
        </div>
    </div>