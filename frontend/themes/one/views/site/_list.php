<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<?php
$img = $model->getImage();
//echo Html::beginTag('a',['class'=>'col-xs-4 news','href'=>Url::toRoute(['/news/view','id'=>$model->id])]);
//    echo Html::beginTag('div',['class'=>'well']);
//        echo Html::beginTag('div',['class'=>'news-block']);
//            echo Html::tag('div',Html::tag('span',Yii::$app->formatter->asDate($model -> date,'dd.MM.yy'),['class'=>'news-date']).Html::tag('span',$model->category->name,['class'=>'news-category']),['class'=>'date-category']);
//            echo Html::tag('div',Html::img($img->getUrl('x120'),['alt' => $model->title, 'class' => 'img-responsive']),['class'=>'text-center news-img']);
//            echo Html::tag('h4',$model -> title,['class'=>'']);
//            echo Html::tag('div',$model -> snippet,['class'=>'news-index-content']);
//        echo Html::endTag('div');
//    echo Html::endTag('div');
//echo Html::endTag('a');
if ($index == 0 || $index == 1) {
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
        <div class="<?php echo $classImgBlock ?> news-block-img">
            <img src="<?php echo $imgUrl ?>" alt="<?php echo $model->title ?>" class="img-responsive">
        </div>
        <div class="<?php echo $classContentBlock ?> news-block-content">
            <a href="<?php echo Url::toRoute(['/news/view','id'=>$model->id]) ?>" class="news-home-link">
                <h4><?php echo $model -> title ?></h4>
            </a>
            <div class="news-home-text"><?php echo $model -> snippet ?></div>
            <div class="news-date-category">
                <span class="news-date"><?php echo date('d.m.y',$model -> date) ?></span>
                <a href="#" class="news-category"><?php echo $model->category->name ?></a>
            </div>
        </div>
    </div>
</div>
<!--<div class="news-block">
    <div class="row">
        <div class="col-xs-4 news-block-img">
            <img src="<?php /*echo $img->getUrl('x250') */?>" alt="<?php /*echo $model->title */?>" class="img-responsive">
        </div>
        <div class="col-xs-8 news-block-content">
            <a href="<?php /*echo Url::toRoute(['/news/view','id'=>$model->id]) */?>" class="news-home-link">
                <h4><?php /*echo $model -> title */?></h4>
            </a>
            <div class="news-home-text"><?php /*echo $model -> snippet */?></div>
            <div class="news-date-category">
                <span class="news-date"><?php /*echo date('d.m.Y',$model -> date) */?></span>
                <a href="#" class="news-category"><?php /*echo $model->category->name */?></a>
            </div>
        </div>
    </div>
</div>-->
