<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <?php
        echo Html::tag(
            'div',
                Html::tag('span',Yii::$app->formatter->asDate($model -> date_create, 'dd.MM.yy'/*'long'*/),['class'=>' ']).
                ' | '.
                Html::tag('span',$model->category->name,['class'=>'']),
            /*['class'=>'bg-primary center-block text-center','style'=>'width:'.$sizes['width'].'px']*/
            ['class'=>'']
        );
        ?>
    </div>
    <div class="panel-body">
        <?php
        $images = $model->getImages();
        if($images[0]['urlAlias']!='placeHolder' && $images[0]->isMain) {
            $image = $model->getImage();
            $sizes = $image->getSizesWhen('x300');
            //            echo Html::img($image->getUrl('x300'),['class' => 'center-block img-responsive','width'=>$sizes['width'], 'height'=>$sizes['height']]);
            echo Html::img($image->getUrl('x900'),['class' => 'center-block img-responsive','width'=>'100%']);
        }
        ?>
    </div>
</div>
<div class="news-view  well">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <?php echo Html::tag('div',$model->content,['class'=>'']); ?>
</div>
