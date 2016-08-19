<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yiister\gentelella\assets\Asset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
Asset::register($this);
//$user['username'] ='';
//$user['email'] ='';
//$user['role'] ='';
//if(isset(Yii::$app->user->identity)) {
//    $user['username'] = Yii::$app->user->identity->username;
//    $user['email'] = Yii::$app->user->identity->email;
//    $user['role'] = Yii::$app->user->identity->role;
//}
//var_dump(Yii::$app->user);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login">
<?php $this->beginBody() ?>

            <div class="container">
                <?= $content ?>
            </div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
