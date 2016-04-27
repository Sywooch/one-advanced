<?php
use kartik\nav\NavX;

echo NavX::widget([
    'options'=>['class'=>'nav navbar-nav navbar-left menu-header-top'],
    'items' => $items,
    'activateParents' => true,
]);