<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

//var_dump($model);
?>
<!--//            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);-->
<a href="<?php echo Url::toRoute(['view', 'id' => $model->id])?>">
<div class="row">
    <div class="col-xs-5 players-img-block text-center">
        <div class="players-img-box">
            <?php
            $images = $model->getImage();
            if($images['urlAlias']!='placeHolder') {
                echo Html::img($images->getUrl('x100'), ['alt' => $model->name, 'class' => '']);//thumbnail img-responsive
            }
            ?>
        </div>
    </div>
    <div class="col-xs-7 players-info-block">
        <div class="players-name"><?php echo $model->name ?></div>
        <div class="players-surname"><?php echo $model->surname ?></div>
        <div class="players-number-block">Номер <span class="players-number"><?php echo $model->number ?></span></div>

    </div>
</div>
</a>
