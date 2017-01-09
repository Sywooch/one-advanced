<?php
use kartik\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>

<?php
$img = $model->getImage();
if ($index == 1 || $index == 2 || $index == 3 || $index == 4) {
    $classBlock = 'news-first-blocks';
    $imgUrl = $img->getUrl('400x235');
    $classImgBlock = 'col-xs-12';
    $classContentBlock = 'col-xs-12';
} else {
    $classBlock = '';
    $imgUrl = $img->getUrl('235x150');
    $classImgBlock = 'col-xs-4';
    $classContentBlock = 'col-xs-8';
}
?>
<a href="<?php echo Url::toRoute(['/news/view', 'slug' => $model->alias]) ?>">
    <div class="news-block news-block-<?php echo $index . ' ' . $classBlock ?> ">
        <div class="row">
            <div class="<?php echo $classImgBlock ?> news-block-img">

                <img src="<?php echo $imgUrl ?>" alt="<?php echo $model->title ?>" class="img-responsive">
            </div>
            <div class="<?php echo $classContentBlock ?> news-block-content">
                <!--            <a href="-->
                <?php //echo Url::toRoute(['/news/view', 'slug' => $model->alias]) ?><!--" class="news-home-link">-->
                <h4><?php echo $model->title ?></h4>

                <div class="news-home-text"><?php echo $model->snippet ?></div>
                <div class="news-date-category">
                    <span class="news-date"><?php echo date('d.m.y', $model->date_create) ?></span>
                    <div class="news-category">
                        <?php echo $model->category->name ?>
                    </div>
                <span class="news-date-box">
                    <?php
                    $date = date('d.m.Y', $model->date_create);
                    //                        var_dump($date);
                    if ($date == date('d.m.Y')) {
                        ?><span class="label label-primary">Сегодня</span><?php
                    } elseif ($date == date('d.m.Y', strtotime('-1 day'))) {
                        ?><span class="label label-primary">Вчера</span><?php
                    }
                    ?>
                </span>
                    <?php
                    echo Html::tag('span', Html::icon('eye-open') . ' ' . $model->views, ['class' => 'news-view'])
                    ?>
                </div>
            </div>
        </div>
    </div>
</a>
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