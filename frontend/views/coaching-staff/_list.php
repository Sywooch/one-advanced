<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$category = [
    'admin' => 'Администрация',
    'trainer' => 'Тренерский штаб',
];
$categories = [
    'admin' => 'administrations',
    'trainer' => 'coaches',
]
?>
<!--//            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);-->
<a href="<?php echo Url::toRoute(['view', 'id' => $model->id, 'category' => $categories[$model->category]])?>">
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
    </div>
</div>
</a>
