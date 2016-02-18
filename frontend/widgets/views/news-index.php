<?php
//var_dump($news);
use yii\helpers\Html;


echo Html::beginTag('div',['class'=>'row news-index']);
    foreach($news as $new) {
        $img = $new->getImage();
        echo Html::beginTag('div',['class'=>'col-xs-4']);
            echo Html::beginTag('div',['class'=>'well']);
                echo Html::tag('div',date('d.m.y',$new -> date),['class'=>'']);
                echo Html::img($img->getUrl('x120'),['alt' => $new->title, 'class' => 'img-thumbnail']);
                echo Html::tag('h4',$new -> title,['class'=>'']);
                echo Html::tag('div',$new -> snippet,['class'=>'']);
            echo Html::endTag('div');
        echo Html::endTag('div');
//                $new -> id.', '.$new -> title;

    }
echo Html::endTag('div');

?>

<!--<div class="row">-->
<!---->
<!--    <div class="col-xs-4"></div>-->
<!--</div>-->
<!--$new -> id-->
<!--title-->
<!--alias-->
<!--category_id-->
<!--snippet-->
<!--content-->
<!--views-->
<!--comments-->
<!--status_id-->
<!--date-->