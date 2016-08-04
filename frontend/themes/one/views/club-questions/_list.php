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
    <div class="panel panel-default radius-null">
        <div class="panel-heading">
            <div class="guest-book-date pull-right">
                <?php
                echo Yii::$app->formatter->asDatetime($model -> date, 'dd.MM.yyyy'/*'long'*/).' в '.
                    Yii::$app->formatter->asDatetime($model -> date, 'php:H:i')
                ?>
            </div>
            <div class="guest-book-block-name"><?php echo $model->name; ?></div>

        </div>
        <div class="panel-body">
            <div class="guest-book-content">
                <?php echo ($model->addressee != 'all' ? $model->addressee . ', ' : '') .$model->question ?>
            </div>
        </div>
    </div>
</div>
<?php if ($model->answer != '') : ?>
    <div class="row">
        <div class="col-xs-11 col-xs-offset-1">
            <div class="guest-book-block">
                <div class="panel panel-default radius-null">
                    <div class="panel-heading">
                        <div class="guest-book-block-name">Ответ:</div>
                    </div>
                    <div class="panel-body">
                        <div class="guest-book-content">
                            <?php echo $model->answer ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>