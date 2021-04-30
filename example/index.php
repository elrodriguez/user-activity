<?php
include __DIR__."/../vendor/autoload.php";

$activity = new \Elrod\UserActivity\Activity();


$collection = $activity->getById(21);
echo $collection->description;
// foreach($collection as $item){
//     echo $item->description.'<br>';
// }