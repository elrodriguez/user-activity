# User activities
records the activities of your application users in its own database

## installation
- download the project
	

    composer require elrod/user-activity
- database
	

    CREATE DATABASE `user_activity_log`
    CREATE TABLE `activity_log` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `component` text COLLATE utf8_spanish_ci DEFAULT NULL,
      `data_json_old` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
      `data_json_updated` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
      `table_name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
      `table_column_id` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
      `model_name` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
      `route` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
      `description` text COLLATE utf8_spanish_ci DEFAULT NULL,
      `context` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
      `response_code` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
      `response_message` text COLLATE utf8_spanish_ci DEFAULT NULL,
      `type_activity` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
      `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
      `user_id` bigint(20) DEFAULT NULL,
      `user` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

- simple example
	

    <?php
    include __DIR__."/../vendor/autoload.php";
    
    $activity = new \Elrod\UserActivity\Activity();
    
    
    $activity->log('Look, I logged something');
    $activity->save();

- advanced example:


     use Elrod\UserActivity\Activity;
            
        $user = array(
        	'id'=> $_SESSION["user_id"],
        	'name' => $_SESSION["user_name"]
        );
        
        //to register
        $activity = new Activity;
        $activity->modelOn(Product::class,$product->id);
        $activity->causedBy($user);
        $activity->routeOn(route('product_create'));
        $activity->componentOn('product-create-form');
        $activity->dataOld($product);
        $activity->logType('create');
        $activity->log('Look, I logged something');
        $activity->save();

in dataOld the data of the table is registered it can be when we register a new one or delete
dataUpdated can be used when we make changes for example in:


    $data_old = array('name'=>'Juan Lopez','number'=>'12345678') //lo que estubo antes
    $data_update = array('name'=>'Daniel Lopez ','number'=>'87654321') //los nuevos cambios
    $activity->dataOld($data_old); //what was before
    $activity->dataUpdated($data_update); //the new changes

methods for list and search by activity id

$activity->getAll();

$activity->getById($id)
