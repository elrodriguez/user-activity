<?php
include __DIR__."/../vendor/autoload.php";

$activity = new \Elrod\UserActivity\Activity();

$data = array(
    'description' => 'Registro de prueba',
    'component' => 'livewire'
);

$collection = $activity->ActivityLogCreate($data);

