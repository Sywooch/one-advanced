<?php

/* @var $content string */
use yii\helpers\Html;
?>
<head>
<!--    <meta name="viewport" content="width=1200">-->
    <link href="//fonts.googleapis.com/css?family=Exo+2:400,700" rel="stylesheet">
</head>
<style type="text/css">
    html, body {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    body {
        /*font-family: "Times New Roman", Times, serif;*/
        font-family: 'Exo 2', sans-serif;
        font-size: 14px;
        background: #FAFAFA;
    }

    .message
    {
        height: 100%;
        display: flex;
        /*justify-content: center;*/
        justify-content: flex-start;
        flex-direction: column;
        text-align: center;
        font-size: 20px;
    }

    .logo-text {
        overflow: hidden;
        margin: 50px 0;
        width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .logo {
        float: left;
        width: 37%;
        text-align: right;
    }

    .text {
        float: left;
        /*width: 60%;*/
        text-align: left;
        color: #004597;
        font-weight: bold;
        font-size: 40px;
        padding-left: 50px;
        margin-top: 20px;
    }

    .image-block {
        display: inline-block;
        position: relative;
    }

    .image-descr {
        position: absolute;
        right: 150px;
        top: 100px;
        /*bottom: 0;*/
        width: 310px;
        text-align: left;
        color: #ffffff;
        font-weight: bold;
        font-size: 18px;
    }
    .image-descr .one {
        text-align: center;
        font-size: 50px;
        padding-right: 100px;
    }

    .image-descr .two {
        margin: 30px 0;
    }

    .social {
        margin-top: 50px;
        padding-top: 50px;
        border-top: 1px solid #eeeeee;
        width: 200px;
        margin-left: auto;
        margin-right: auto;
        padding-bottom: 50px;
    }

    .social-img {
        height: 24px;
        width: 35px;
        background-position: center center;
        display: inline-block;
        background-repeat: no-repeat;
    }
    
    .social-img.vk { background-image: url("/themes/one/src/icons-bal/vk.png"); }
    .social-img.vk:hover { background-image: url("/themes/one/src/icons-bal/vk-hov.png"); }
    .social-img.facebook { background-image: url("/themes/one/src/icons-bal/face.png"); }
    .social-img.facebook:hover { background-image: url("/themes/one/src/icons-bal/face-hov.png"); }
    .social-img.twitter { background-image: url("/themes/one/src/icons-bal/tw.png"); }
    .social-img.twitter:hover { background-image: url("/themes/one/src/icons-bal/tw-hov.png"); }
    .social-img.youtube { background-image: url("/themes/one/src/icons-bal/you.png"); }
    .social-img.youtube:hover { background-image: url("/themes/one/src/icons-bal/you-hov.png"); }
    .social-img.instagramm { background-image: url("/themes/one/src/icons-bal/inst.png"); }
    .social-img.instagramm:hover { background-image: url("/themes/one/src/icons-bal/inst-hov.png"); }

</style>

<div class="message">
    <?= $content ?>
</div>
