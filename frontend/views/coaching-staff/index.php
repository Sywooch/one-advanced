<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CoachingStaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тренерский штаб';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coaching-staff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>
    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'row',
        ],
        'itemOptions' => ['class' => 'item col-xs-4'],
        'itemView' => '_list',
        'summary' => false,
        //
        //        'itemView' => function ($model, $key, $index, $widget) {
        //            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        //        },
    ]);
    ?>
<?php Pjax::end(); ?></div>
