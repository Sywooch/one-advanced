<?php

/* @var $content string */

?>
<style type="text/css">
    html, body {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    body {
        font-family: "Times New Roman", Times, serif;
    }

    .message
    {
        height: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        font-size: 30px;
    }
</style>

<div class="message">
    <?= $content ?>
</div>
