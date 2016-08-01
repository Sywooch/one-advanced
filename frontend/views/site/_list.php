<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<?php
//var_dump($index);

$img = $model->getImage();
//echo Html::beginTag('a',['class'=>'news','href'=>Url::toRoute(['/news/view','id'=>$model->id])]);
//    echo Html::beginTag('div',['class'=>'well']);
//        echo Html::beginTag('div',['class'=>'news-block']);
//            echo Html::tag('div',Html::tag('span',date('d.m.y',$model -> date),['class'=>'']).' | '.Html::tag('span',$model->category->name,['class'=>'']),['class'=>'text-center']);
//            echo Html::tag(
//                'div',
//                Html::img(
//                    $img->getUrl('x120'),
//                    ['alt' => $model->title, 'class' => 'img-thumbnail']
//                ),
//                ['class'=>'text-center']
//            );
//            echo Html::tag('h4',$model -> title,['class'=>'']);
//            echo Html::tag('div',$model -> snippet,['class'=>'news-index-content']);
//        echo Html::endTag('div');
//    echo Html::endTag('div');
//echo Html::endTag('a');
if ($index == 0 || $index == 1 || $index == 2 || $index == 3) {
    $classBlock = 'news-first-blocks';
    $imgUrl = $img->getUrl('x320');
    $classImgBlock = 'col-xs-12';
    $classContentBlock = 'col-xs-12';
} else {
    $classBlock = '';
    $imgUrl = $img->getUrl('x120');
    $classImgBlock = 'col-xs-4';
    $classContentBlock = 'col-xs-8';

}
?>
    <div class="news-block news-block-<?php echo $index.' '.$classBlock ?> ">
        <div class="row">
            <?php if($img->urlAlias != 'placeHolder') :?>
            <div class="<?php echo $classImgBlock ?> news-block-img">
                <a href="<?php echo Url::toRoute(['/news/view', 'slug' => $model->alias]) ?>">
                    <img src="<?php echo $imgUrl ?>" alt="<?php echo $model->title ?>" class="img-responsive">
                </a>
            </div>
            <?php endif; ?>
            <div class="<?php echo $classContentBlock ?> news-block-content">
                <a href="<?php echo Url::toRoute(['/news/view', 'slug' => $model->alias]) ?>" class="news-home-link">
                    <h4>
                        <?php
                        echo $model -> title.' ';
                        $date = date('d.m.Y',$model -> date_create);
                        if ($date == date('d.m.Y')) {
                            ?><span class="label label-primary">Сегодня</span><?php
                        } elseif ($date == date('d.m.Y', strtotime('-1 day'))) {
                            ?><span class="label label-primary">Вчера</span><?php
                        }
                        ?>

                    </h4>
                </a>
                <div class="news-home-text"><?php echo $model -> snippet ?></div>
                <div class="news-date-category">
                    <span class="news-date"><?php echo date('d.m.y',$model -> date_create) ?></span>
                    <a href="#" class="news-category"><?php echo $model->category->name ?></a>
                </div>
            </div>
        </div>
    </div>
<?php

//echo Html::beginTag('a',['class'=>'', 'href'=>Url::toRoute(['view','id'=>$model->id])]);
//    echo Html::beginTag('div',['class'=>'well']);
//        echo Html::beginTag('div',['class'=>'row']);
//            echo Html::beginTag('div',['class'=>'col-sm-6 col-md-4']);
//                echo Html::img($img->getUrl('500x'),['alt' => $model->title,'width'=>'100%'/*, 'class' => 'img-thumbnail'*/]);
//                echo Html::tag(
//                    'div',
//                        Html::tag('span',Yii::$app->formatter->asDate($model -> date, 'dd.MM.yy'/*'long'*/),['class'=>' ']).
//                        ' | '.
//                        Html::tag('span',$model->category->name,['class'=>'']),
//                    ['class'=>'bg-primary text-center','style'=>'padding:0 10px']
//                );
//            echo Html::endTag('div');
//            echo Html::beginTag('div',['class'=>'col-sm-6 col-md-8']);
//                echo Html::tag('h3',$model -> title);
//                echo Html::tag('div',$model -> snippet,['class'=>'']);
//            echo Html::endTag('div');
//        echo Html::endTag('div');
//echo Html::endTag('div');
//echo Html::endTag('a');
