<?php

use yii\helpers\Html;
use yiister\gentelella\widgets\Panel;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Обновление новости: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
$this->params['panel'] = true;

$this->registerJsFile('@web/js/remove_image.js');

?>
<div class="news-update">

    <?php

    echo $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]);
    ?>

</div>