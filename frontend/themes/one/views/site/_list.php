<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<?php
$img = $model->getImage();
//echo Html::beginTag('div',['class'=>'col-xs-4 ']);
echo Html::beginTag('a',['class'=>'col-xs-4 news','href'=>Url::toRoute(['/news/view','id'=>$model->id])]);
    echo Html::beginTag('div',['class'=>'well']);
        echo Html::beginTag('div',['class'=>'news-block']);
            echo Html::tag('div',Html::tag('span',Yii::$app->formatter->asDate($model -> date,'short'),['class'=>'news-date']).Html::tag('span',$model->category->name,['class'=>'news-category']),['class'=>'date-category']);
            echo Html::tag('div',Html::img($img->getUrl('x120'),['alt' => $model->title, 'class' => 'img-responsive']),['class'=>'text-center news-img']);
            echo Html::tag('h4',$model -> title,['class'=>'']);
            echo Html::tag('div',$model -> snippet,['class'=>'news-index-content']);
        echo Html::endTag('div');
    echo Html::endTag('div');
echo Html::endTag('a');
//echo Html::endTag('a'); ;date('d.m.y',$model -> date)

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
