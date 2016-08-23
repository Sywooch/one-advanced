<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
//Yii::$app->formatter->locale = 'ru-RU';
?>

<?php
$img = $model->getImage();
//echo Html::beginTag('a',['class'=>'col-xs-3 news','href'=>Url::toRoute(['/news/view','id'=>$model->id])]);
//    echo Html::beginTag('div',['class'=>'well']);
//        echo Html::beginTag('div',['class'=>'news-block']);
//            echo Html::tag('div',Html::tag('span',Yii::$app->formatter->asDate($model -> date,'dd.MM.yy'),['class'=>'news-date']).Html::tag('span',$model->category->name,['class'=>'news-category']),['class'=>'date-category']);
//            echo Html::tag('div',Html::img($img->getUrl('x110'),['alt' => $model->title, 'class' => 'img-responsive']),['class'=>'text-center news-img']);
//            echo Html::tag('h4',$model -> title,['class'=>'']);
//            echo Html::tag('div',$model -> snippet,['class'=>'news-index-content']);
//        echo Html::endTag('div');
//    echo Html::endTag('div');
//echo Html::endTag('a');
?>
    <a href="<?php echo Url::toRoute(['view', 'slug' => $model->alias]) ?>" class="news-list-block-link">
    <div class="news-list-block">
<!--        <div class="well">-->

            <div class="row">
                <div class="col-xs-2">
                    <div class="news-list-date">
                        <div class="day"><?php echo Yii::$app->formatter->asDate($model -> date_create,'dd') ?></div>
                        <div class="month"><?php echo Yii::$app->formatter->asDate($model -> date_create,'php:M') ?></div>
                        <div class="year"><?php echo Yii::$app->formatter->asDate($model -> date_create,'yyyy') ?></div>
                    </div>
                </div>
                <div class="col-xs-3">

                    <img src="<?php echo $img->getUrl('235x') ?>" alt="<?php echo $model->title; ?>" class="img-responsive">

                </div>
                <div class="col-xs-7">
<!--                    <a href="--><?php //echo Url::toRoute(['view', 'slug' => $model->alias]) ?><!--" class="news-list-block-link">-->
                        <h3><?php echo $model -> title ?></h3>
<!--                    </a>-->
                    <div class="news-list-descr"><?php echo $model -> snippet ?></div>
                </div>
            </div>
<!--        </div>-->
    </div>
    </a>

<?php
//echo Html::beginTag('a',['class'=>'', 'href'=>Url::toRoute(['view','id'=>$model->id])]);
//    echo Html::beginTag('div',['class'=>'well']);
//        echo Html::beginTag('div',['class'=>'row']);
//            echo Html::beginTag('div',['class'=>'col-sm-6 col-md-3']);
//                echo Html::tag('div',Html::tag('span',Yii::$app->formatter->asDate($model -> date,'dd.MM.yy'),['class'=>'news-date']).Html::tag('span',$model->category->name,['class'=>'news-category']),['class'=>'date-category news-index-date']);
//
//                echo Html::img($img->getUrl('500x'),['alt' => $model->title,'width'=>'100%'/*, 'class' => 'img-thumbnail'*/]);
////                echo Html::tag(
////                    'div',
////                        Html::tag('span',Yii::$app->formatter->asDate($model -> date, 'dd.MM.yy'/*'long'*/),['class'=>' ']).
////                        ' | '.
////                        Html::tag('span',$model->category->name,['class'=>'']),
////                    ['class'=>'bg-primary text-center','style'=>'padding:0 10px']
////                );
//
//            echo Html::endTag('div');
//            echo Html::beginTag('div',['class'=>'col-sm-6 col-md-7 news-index-descr']);
//                echo Html::tag('h3',$model -> title);
//                echo Html::tag('div',$model -> snippet,['class'=>'']);
//            echo Html::endTag('div');
//        echo Html::endTag('div');
//echo Html::endTag('div');
//echo Html::endTag('a');
