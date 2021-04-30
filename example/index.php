<?php
include __DIR__."/../vendor/autoload.php";

$activity = new \Elrod\UserActivity\Activity();


$activity->log('Look, I logged something');
$activity->save();
