<?php

use frontend\widgets\NewsWidget;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use Madcoda\Youtube;
use frontend\widgets\GalleryWidget;
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
            <div class="pull-right">
                <?php echo Html::a('Все Новости',['/news'],['style'=> 'color:inherit;font-size:12px; vertical-align: middle;'])?>
            </div>
        </div>
    </div>
<!--    <div class="row news-index">-->
    <div class="news-home">
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider['news'],
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
//                var_dump($channel);
                $playlist = $channel->contentDetails->relatedPlaylists->uploads;
                $playlistItems = $youtube->getPlaylistItemsByPlaylistId($playlist);
                $i = 0;
                $playList = '';
                $video = '';
                foreach ($playlistItems as $item) {
//                    echo $item->thumbnails->medium;
//                    echo Html::img($item->snippet->thumbnails->medium->url, [
//                        'width' => $item->snippet->thumbnails->default->width,
//                        'height' => $item->snippet->thumbnails->default->height
//                    ]);
//                    var_dump($item->snippet->thumbnails);
                    if ($i==0) {
                        $video = $item->snippet->resourceId->videoId;
                    } else {
                        $playList .= $item->snippet->resourceId->videoId.',';
                    }

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
<!--                <div class="col-xs-12">-->
<!--                    <iframe type='text/html'-->
<!--                        src='http://www.youtube.com/watch?v=--><?php //echo $video ?><!--&list=--><?php //echo $playlist ?><!--' width='100%' height='450' frameborder='0' allowfullscreen></iframe>-->

<!--                    <iframe type='text/html'-->
<!--                        src='http://www.youtube.com/embed/--><?php //echo $video ?><!--?showinfo=1&playlist=--><?php //echo $playList ?><!--&plindex=0&layout=gallery' width='100%' height='450' frameborder='0' allowfullscreen></iframe>-->
<!--                    <object width="425" height="344">-->
<!--                        <param name="movie" value="https://www.youtube.com/v/u1zgFlCw8Aw?fs=1"</param>-->
<!--                        <param name="allowFullScreen" value="true"></param>-->
<!--                        <embed src="https://www.youtube.com/v/u1zgFlCw8Aw?fs=1"-->
<!--                               type="application/x-shockwave-flash"-->
<!--                               allowfullscreen="true"-->
<!--                               width="425" height="344">-->
<!--                        </embed>-->
<!--                    </object>-->

                    <!--                    <object width="640" height="390">-->
<!--                        <param name="movie"-->
<!--                               value="https://www.youtube.com/v/M7lc1UVf-VE?version=3&autoplay=0&enablejsapi=3"></param>-->
<!--                        <param name="allowScriptAccess" value="always"></param>-->
<!--                        <embed src="https://www.youtube.com/v/M7lc1UVf-VE?version=3&autoplay=0&enablejsapi=3"-->
<!--                               type="application/x-shockwave-flash"-->
<!--                               allowscriptaccess="always"-->
<!--                               width="640" height="390"></embed>-->
<!--                    </object>-->
<!--                <object width="640" height="390">-->
<!--                        <param name="movie"-->
<!--                               value="https://www.youtube.com/v/apiplayer?video_id=M7lc1UVf-VE&version=3&autoplay=0"></param>-->
<!--                        <param name="allowScriptAccess" value="always"></param>-->
<!--                        <embed src="https://www.youtube.com/v/apiplayer?video_id=M7lc1UVf-VE&version=3&autoplay=0"-->
<!--                               type="application/x-shockwave-flash"-->
<!--                               allowscriptaccess="always"-->
<!--                               width="640" height="390"></embed>-->
<!--                    </object>-->
<!--                </div>-->
            </div>
        </div>
    </div>
    <div class="gallery-home">
        <?php
        echo GalleryWidget::widget(['template' => 'gallery-index']);
        ?>
    </div>
</div>