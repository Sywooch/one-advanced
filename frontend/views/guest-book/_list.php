<?php
use yii\helpers\Html;
use kartik\icons\Icon;
Icon::map($this);
//Icon::map($this, 'custom');
//echo Icon::show('menu',[], 'custom');
//echo Icon::show('user');
//echo Icon::show('home');
//echo Icon::show('user', ['class' => 'fa-3x'], Icon::BSG);
//var_dump($model);
?>
<div class="guest-book-block">
<div class="row">
    <div class="col-xs-1">
        <div class="guest-book-block-icon">
            <?php echo Icon::show('user', ['class' => 'fa-3x'], Icon::BSG);?>
        </div>
    </div>
    <div class="col-xs-5">
        <div class="guest-book-block-name"><?php echo $model->name; ?></div>
        <div class="guest-book-block-date">
            <?php
            echo Yii::$app->formatter->asDatetime($model -> date, 'dd.MM.yyyy'/*'long'*/).' в '.
                Yii::$app->formatter->asDatetime($model -> date, 'php:H:i')
            ?>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="well guest-book-block-content">
            <?php echo $model->body ?>
        </div>
    </div>
</div>
</div>
