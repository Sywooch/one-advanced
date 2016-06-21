<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<?php
Yii::$app->formatter->locale = 'ru-RU';
//Yii::$app->formatter->locale = 'en-EN';
//echo Yii::$app->formatter->asDate('2014-01-01');
$img = $model->getImage();
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
?>
<div class="news-list-block">
    <!--        <div class="well">-->
    <div class="row">
        <div class="col-xs-2">
            <div class="news-list-date text-center">
                <div class="day"><?php echo Yii::$app->formatter->asDate($model -> date,'dd') ?></div>
                <div class="month"><?php echo Yii::$app->formatter->asDate($model -> date,'php:M') ?></div>
                <div class="year"><?php echo Yii::$app->formatter->asDate($model -> date,'yyyy') ?></div>
            </div>
        </div>
        <div class="col-xs-3">
            <img src="<?php echo $img->getUrl('x150') ?>" alt="<?php echo $model->title; ?>" class="img-responsive">
        </div>
        <div class="col-xs-7">
            <a href="<?php echo Url::toRoute(['view','id'=>$model->id]) ?>" class="news-list-block-link">
                <h3><?php echo $model -> title ?></h3>
            </a>
            <div class="news-list-descr"><?php echo $model -> snippet ?></div>
        </div>
    </div>
    <!--        </div>-->
</div>
