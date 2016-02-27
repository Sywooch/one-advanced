<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<!--<div class="news-item">-->
<!--    <h2>--><?php //echo Html::encode($model->title) ?><!--</h2>-->
<!--    --><?php //echo HtmlPurifier::process($model->snippet) ?>
<!--</div>-->
<!--    <p class="bg-primary">...</p>-->
<?php
$img = $model->getImage();
echo Html::beginTag('a',['class'=>'', 'href'=>Url::toRoute(['view','id'=>$model->id])]);
    echo Html::beginTag('div',['class'=>'well']);
        echo Html::beginTag('div',['class'=>'row']);
            echo Html::beginTag('div',['class'=>'col-xs-6']);
                echo Html::img($img->getUrl('500x'),['alt' => $model->title,'width'=>'100%']); //, 'class' => 'img-thumbnail'
                echo Html::tag('p',Html::tag('span',date('d.m.y',$model -> date),['class'=>' ']).' | '.Html::tag('span',$model->category->name,['class'=>'']),['class'=>'bg-primary text-center','style'=>'padding:0 10px']);
            echo Html::endTag('div');
            echo Html::beginTag('div',['class'=>'col-xs-6']);
                echo Html::tag('h3',$model -> title);
                echo Html::tag('div',$model -> snippet,['class'=>'']);
            echo Html::endTag('div');
        echo Html::endTag('div');

    //    echo Html::tag('div',Html::tag('span',date('d.m.y',$model -> date),['class'=>'']).' | '.Html::tag('span',$model->category->name,['class'=>'']),['class'=>'text-center']);
    //    echo Html::tag('div',Html::img($img->getUrl('x120'),['alt' => $model->title, 'class' => 'img-thumbnail']),['class'=>'text-center']);
    //    echo Html::tag('h4',$model -> title,['class'=>'']);
    //    echo Html::tag('div',$model -> snippet,['class'=>'']);
echo Html::endTag('div');
echo Html::endTag('a');
