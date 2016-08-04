<?php
use yii\helpers\Html;
use kartik\icons\Icon;
Icon::map($this);
//Icon::map($this, 'custom');
//echo Icon::show('menu',[], 'custom');
//echo Icon::show('user');
//echo Icon::show('home');
//echo Icon::show('user', ['class' => 'fa-3x'], Icon::BSG);
//var_dump($model->addressee);
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
            <?php echo ($model->addressee != 'all' ? $model->addressee . ', ' : '') . $model->question ?>
        </div>
        <?php if ($model->answer != '') : ?>
            <div class="row">
                <div class="col-xs-11 col-xs-offset-1">
                    <p style="margin-top: -10px;">Ответ:</p>
                    <div class="well guest-book-block-content">
                        <?php echo $model->answer ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>
