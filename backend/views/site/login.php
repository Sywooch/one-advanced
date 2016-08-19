<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet" type="text/css">
<div class="site-login">
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <h1><?= Html::encode($this->title) ?></h1>

                <?= $form->field($model, 'username')->textInput(['autofocus' => '', 'placeholder' => 'Логин'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

                <div class="form-group">
                    <div class="pull-right">
                        <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
                    </div>
                    <div class="pull-left">
                        <?= Html::submitButton('Вход', ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
                    </div>
                </div>


                <div class="clearfix"></div>

                <div class="separator">
                    <!--                        <p class="change_link">New to site?-->
                    <!--                            <a href="#signup" class="to_register"> Create Account </a>-->
                    <!--                        </p>-->

                    <div class="clearfix"></div>
                    <br>

                    <div>
                        <h1 style="font-family: 'Roboto',sans-serif">Pixlet.ru</h1>
                        <p>&copy;  <?= date('Y') ?> All Rights Reserved.</p>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>

                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="">
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br>

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>