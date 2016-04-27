<?php
use kartik\nav\NavX;

echo NavX::widget([
    'options'=>['class'=>'nav nav-pills menu-header-top'],
    'items' => $items,
    'activateParents' => true,
]);