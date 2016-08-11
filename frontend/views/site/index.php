<?php

use frontend\widgets\NewsWidget;
use yii\widgets\ListView;
use kartik\helpers\Html;
use yii\helpers\Url;
use Madcoda\Youtube;
use frontend\widgets\GalleryWidget;
use kartik\grid\GridView;
use MetzWeb\Instagram\Instagram;
use kartik\icons\Icon;
//use pollext\poll\Poll;
use common\widgets\PollWidget;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\bootstrap\Carousel;
use frontend\assets\CarouselAsset;
use frontend\widgets\StandingsWidget;
use pollext\poll\ajaxSubmitButton;

if(Yii::$app->params['gamesPreview3d']) {
    CarouselAsset::register($this);
}


Icon::map($this, Icon::FA);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сайт Футбольного Клуба';
$this->params['widget_bar'] = StandingsWidget::widget(['template' => 'smallTable']);

//$this->params['widget_bar'] = Html::tag(
//    'div',
//    Html::tag('h4', 'Турнирная таблица').
//    Html::tag('p', $data['season']['full_name']).
//    GridView::widget([
//        'dataProvider' => $dataProvider['standings'],
//        'bordered'=>false,
//        'striped'=>false,
//        'condensed'=>false,
//        'responsive'=>false,
//        'hover'=>false,
//        'layout' => '{items}',
//        'rowOptions'=>function ($model, $key, $index, $grid) use ($data) {
//            $class= $model->team_id == $data['mainTeam']->id ? 'main-team' : '';
//            return [
//                'key'=>$key,
//                'index'=>$index,
//                'class'=>$class
//            ];
//        },
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'label' => 'Команда',
//                'format' => 'raw',
//
//                'value' => function ($model) {
//                    $result = '';
//                    $images = $model->team->getImages();
//                    if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
//                        $image = $model->team->getImage();
//                        $sizes = $image->getSizesWhen('15x');
//                        $result .= Html::img($image->getUrl('15x'),[
//                            'alt'=>$model->team->name,
////                                'class' => 'img-responsive',
//                            'style' => 'margin-right:10px',
//                            'width'=>$sizes['width'],
//                            'height'=>$sizes['height']
//                        ]);
//                    }
////                    var_dump($model->team->web_site);
//                    if ($model->team->web_site != '') {
//                        $result .= Html::a($model->team->name, Url::to($model->team->web_site, true), ['target' => '_blank']);
//
//                    } else {
//                        $result .= $model->team->name;
//
//                    }
////                    $result .= Html::a($model->team->name, []);
//                    return $result;
//                },
//            ],
//            [
//                'label' => 'Игры',
//                'attribute' => 'games',
//            ],
//            'spectacles',
//        ],
//    ]),
//    ['class' => 'standings']);
if (!empty($data['allPlayers'])) {
    $playersBD = '';
    foreach ($data['allPlayers'] as $item) {
        if (date('m', $item->date) == date('m')) {
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
        }
    }
//    var_dump($data['allPlayers']);
    $this->params['widget_bar'] .= Html::tag('div', Html::tag('h4', 'Именинники') . $playersBD, ['players-bd']);
}
//$instagram = new Instagram(array(
//    'apiKey'      => '122e830161b4449c98371f3b313d39c3',
//    'apiSecret'   => '7580616fd35047dca99080628cae50d4',
//    'apiCallback' => 'http://test.fc-baltika.ru/'
//));
//new Instagram('122e830161b4449c98371f3b313d39c3');
//getLoginUrl(array(
//    'basic',
//    'likes'
//));
//$code = $_GET['code'];
////$data = $instagram->getOAuthToken($code);
////
//echo 'Your username is: ' . $data->user->username;
//        var_dump($data['gameLast']);
//var_dump(Yii::$app->formatter->asDate($data['gameLast']->date));
//var_dump($data['gameLast']->season->full_name);
//var_dump($data['gameLast']->home->name);
//var_dump($data['gameLast']->score);
//var_dump($data['gameLast']->guest->name);
//$image = $data['gameLast']->home->getImage();
//if($image['urlAlias']!='placeHolder') {
////    $image = $data['gameLast']->home->getImage();
//    $sizes = $image->getSizesWhen('x25');
//    echo Html::img($image->getUrl('x25'),[
//        'alt'=>$data['gameLast']->home->name,
//        'class' => 'img-responsive',
//        'width'=>$sizes['width'],
//        'height'=>$sizes['height']
//    ]);
//}

?>
<div class="site-index">
    <?php
    if (!is_null($data['gameLast']) && !is_null($data['gameLast'])) {
    ?>

<!--        <a href="--><?php //echo Url::to(['/games/view', 'id' => $data['gamesLast'][0]->id]);?><!--" class="promo-game-block">-->
<!--            link-->
<!--        </a>-->
        <?php if(Yii::$app->params['gamesPreview3d']) { ?>
            <div class="carousel-promo well">
                <ul class="carousel carousel-3d">
                    <div class="carousel-bg"></div>
                    <?php
                    $i = 1;
    //                $gamesPreview = array_merge($data['gamesFirst'], $data['gamesLast']);
                    $gamesPreview = array_merge(array_reverse($data['gamesLast']), $data['gamesFirst']);
                    foreach ($gamesPreview as $item) {
                        ?>
                        <li class="item <?php //echo $i==1 ? 'active' : '' ?>">
                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="<?php echo Url::to(['/games/view', 'id' => $item->id]);?>" class="promo-game-block" data-pjax="false">
    <!--                                <div data-link="--><?php //echo Url::to(['/games/view', 'id' => $item->id], true);?><!--" class="promo-game-block">-->
                                        <div class="promo-game-header text-center">
                                            <div class="row">
                                                <div class="promo-game-date col-xs-12 vtop">
                                                    <?php echo Yii::$app->formatter->asDatetime($item->date, 'php:d.m, H:i').', '.$item->city.', стадион '.$item->stadium ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="promo-game-row">
                                            <div class="col-xs-5 text-left promo-game-team vcenter">
                                                <?php
                                                $image = $item->home->getImage();
                                                if($image['urlAlias']!='placeHolder') {
                                                    $sizes = $image->getSizesWhen('x45');
                                                    echo Html::img($image->getUrl('x45'),[
                                                        'alt'=>$item->home->name,
                                                        'class' => 'hidden-sm',
                                                        'width'=>$sizes['width'],
                                                        'height'=>$sizes['height']
                                                    ]);
                                                }
                                                ?>
                                                <span>
                                                    <?php
                                                    echo ($item->home->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                    echo $item->home->name;
                                                    echo ($item->home->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-xs-2 text-center promo-game-score vcenter">
                                                <div><?php echo $item->score ?></div>
                                            </div>
                                            <div class="col-xs-5 text-right promo-game-team vcenter">
                                                <span>
                                                    <?php
                                                    echo ($item->guest->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                    echo $item->guest->name;
                                                    echo ($item->guest->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                    ?>
                                                </span>
                                                <?php
                                                $image = $item->home->getImage();
                                                if($image['urlAlias']!='placeHolder') {
                                                    $sizes = $image->getSizesWhen('x45');
                                                    echo Html::img($image->getUrl('x45'),[
                                                        'alt'=>$item->home->name,
                                                        'class' => 'hidden-sm',
                                                        'width'=>$sizes['width'],
                                                        'height'=>$sizes['height']
                                                    ]);
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php
                        $i++;
                    }
                    ?>
                    <div class="controls">

                    <a href="#" class="left carousel-control previous"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                    <a href="#" class="right carousel-control next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
                    </div>

                </ul>
            </div>
        <?php } else { ?>
            <div class="carousel-promo well">
                <?php
                $carIt = [
                    [$data['gamesLast'][2], $data['gamesLast'][1]],
                    [$data['gamesLast'][0], $data['gamesFirst'][0]],
                    [$data['gamesLast'][1], $data['gamesFirst'][2]],
                ];
                $i=0;
                ?>
                <div id="w5" class="carousel carousel-2d">
                    <div class="carousel-inner">
                        <?php foreach($carIt as $items) { $i++?>
                        <div class="item <?php echo $i==2 ? 'active' : ''?>">
                            <div class="row">
                            <?php foreach($items as $item) { ?>
                                <div class="col-xs-6">
                                    <a href="<?php echo Url::to(['/games/view', 'id' => $item->id]);?>" class="promo-game-block">
                                        <div class="promo-game-header">
                                            <div class="row">
                                                <div class="promo-game-date col-xs-12 vtop">
                                                    <?php echo Yii::$app->formatter->asDate($item->date).', '.$item->category->name ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="promo-game-row">
                                            <div class="col-xs-5 text-right promo-game-team vcenter">
                                                <span>
                                                    <?php
                                                    echo ($item->home->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                    echo $item->home->name;
                                                    echo ($item->home->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                    ?>
                                                </span>
                                                <?php
                                                $image = $item->home->getImage();
                                                if($image['urlAlias']!='placeHolder') {
//                                                    $sizes = $image->getSizesWhen('30x45');
                                                    echo Html::img($image->getUrl('30x'),[
                                                        'alt'=>$item->home->name,
                                                        'class' => 'hidden-sm',
//                                                        'width'=>$sizes['width'],
//                                                        'height'=>$sizes['height']
                                                    ]);
                                                }
                                                ?>
                                            </div>
                                            <div class="col-xs-2 text-center promo-game-score vcenter">
                                                <div><?php echo $item->score ?></div>
                                            </div>
                                            <div class="col-xs-5 text-left promo-game-team vcenter">
                                                <?php
                                                $image = $item->guest->getImage();
                                                if($image['urlAlias']!='placeHolder') {
//                                                    $sizes = $image->getSizesWhen('x45');
                                                    echo Html::img($image->getUrl('30x'),[
                                                        'alt'=>$item->guest->name,
                                                        'class' => 'hidden-sm',
//                                                        'width'=>$sizes['width'],
//                                                        'height'=>$sizes['height']
                                                    ]);
                                                }
                                                ?>
                                                <span>
                                                    <?php
                                                    echo ($item->guest->name == Yii::$app->params['main-team'] ? '<b>' : '');
                                                    echo $item->guest->name;
                                                    echo ($item->guest->name == Yii::$app->params['main-team'] ? '</b>' : '');
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <a class="left carousel-control" href="#w5" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    </a>
                    <a class="right carousel-control" href="#w5" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        <?php } ?>

    <?php
    }
//    $data['questions'] = null;
    echo \kartik\widgets\AlertBlock::widget([
        'type' => \kartik\widgets\AlertBlock::TYPE_ALERT,
        'useSessionFlash' => true
    ]);
    if (!is_null($data['questions'])) {
        $answersData = $data['questions']->answers;
        if (!empty($answersData)) {
        ?>
            <div class="vote-home" id="vote">
                <h4><?php echo $data['questions']->questions ?></h4>
                <?php echo $this->render('_poll',[
                    'answersData' => $answersData,
                    'questions' => $data['questions'],
                    'answerPoll' => $data['answerPoll'],
                    'alertMessage' => '',
                    ]
                );?>
                    <?php
//                        $answers = ArrayHelper::map($answersData, 'id', 'answer');
//                        Pjax::begin();
//                        echo PollWidget::widget([
//                            'pollName'=>$data['questions']->questions,
//                            'answerOptions'=> $answers,
//                        ]);
//                        Pjax::end();
                    ?>
            </div>
        <?php
        }
    }
    ?>
<!--    <script src="http://megatimer.ru/s/ee5f1eae51b2d310823adbb8ffa364be.js"></script>-->
    <p></p>
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
        echo GalleryWidget::widget(['template' => 'gallery-index', 'limit' => 3]);
        ?>
    </div>
    <div class="social-widgets">
        <div class="row">
            <div class="col-xs-4 instagram text-center">
                <h5><?php echo Icon::show('facebook'); ?>Instagram</h5>
                <!-- LightWidget WIDGET --><script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/2a92d1f462da5dc6988dc2e1dcffa778.html" id="lightwidget_2a92d1f462" name="lightwidget_2a92d1f462"  scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe><!--                        <script async src="https://d36hc0p18k1aoc.cloudfront.net/public/js/modules/tintembed.js"></script><div class="tintup" data-id="kusma007" data-columns="" data-mobilescroll="true"    data-infinitescroll="true" data-personalization-id="799765" style="height:500px;width:100%;"><a href="http://www.tintup.com/blog/the-best-instagram-wall-display" style="width:118px;height:31px;background-image:url(//d33w9bm0n1egwm.cloudfront.net/assets/logos/poweredbytintsmall.png);position:absolute;bottom:10px;right: 20px;text-indent: -9999px;z-index:9;">instagram event display</a></div>-->
<!--                        <iframe src="http://snapwidget.com/in/?u=ZmNiYWx0aWthfGlufDEyNXwyfDJ8fG5vfDE1fG5vbmV8b25TdGFydHxub3xubw==&ve=140416" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:280px; height:280px"></iframe>-->
<!--                        <iframe src="http://www.intagme.com/in/?u=ZmNiYWx0aWthfGlufDEwMHwyfDJ8fG5vfDI1fHVuZGVmaW5lZHxubw==" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:250px; height: 250px" ></iframe>-->
<!--                        <script src="http://snapwidget.com/js/snapwidget.js"></script>-->
            </div>
            <div class="col-xs-4 twitter">
                <h5><?php echo Icon::show('twitter'); ?>Официальный твитер ФК Балтика</h5>
                <!-- BEGIN: Twitter website widget (http://twitterforweb.com) -->
<!--                        <div style="width:236px;font-size:8px;text-align:right;"><script type="text/javascript">-->
<!--                                document.write(unescape("%3Cscript src='http://twitterforweb.com/twitterbox.js?username=fcbaltika&settings=1,0,3,236,428,0c3e7e,0,0c3e7e,ffffff,1,1,dbdbdb' type='text/javascript'%3E%3C/script%3E"));</script>Created by: <a href="http://twitterforweb.com" target="_blank">twitter website widget</a></div>-->
                <!-- END: Twitter website widget (http://twitterforweb.com) -->

                <!--                        <a href="https://twitter.com/fcbaltika" class="twitter-follow-button" data-size="large" data-lang="ru" data-show-count="false">Follow @fcbaltika</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>-->
                <a class="twitter-timeline" data-lang="ru" data-width="100%" data-height="393" data-dnt="true" href="https://twitter.com/fcbaltika"><!--Tweets by fcbaltika--></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script><!--                            #twitterStyled .tweet {-->
            </div>
            <div class="col-xs-4 vk">
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
<!--                        VK Widget-->
                <div id="vk_groups" class="block-center"></div>
                <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 0, width: "255", height: "433", color1: '0c3e7e', color2: 'ffffff', color3: '011b39'}, 26849788);
                </script>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs('$(\'.carousel-2d\').carousel({
        interval: false,
        wrap: false
    })'); ?>
<!--<script>-->
<!---->
<!--</script>-->