<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuestBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Гостевая книга';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-book-index">

    <div class="pull-right"><a href="<?php echo Url::toRoute('/black-list') ?>" class="btn btn-danger">Чёрный список <span class="badge"><?php echo $blackList ?></span></a></div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
        <?php //echo Html::a('Создать запись в гостевой книге', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'body:ntext',
            'email:email',
//            'user_id',
            // 'ip',
            // 'status',
             'date:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
