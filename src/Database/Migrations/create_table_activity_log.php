<?php

$table = '
    CREATE TABLE activity_log(
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, 
        component TEXT,
        data_json_old LONGTEXT, 
        data_json_updated LONGTEXT, 
        table_name VARCHAR(255), 
        table_column_id VARCHAR(255), 
        model_name VARCHAR(500), 
        route VARCHAR(500), 
        description TEXT,
        context VARCHAR(40),
        response_code VARCHAR(255), 
        response_message TEXT, 
        type_activity VARCHAR(255), 
        created_at datetime,
        user_id BIGINT,
        user LONGTEXT,
    PRIMARY KEY (`id`) ) 
    ENGINE=INNODB CHARSET=utf8 
    COLLATE=utf8_spanish_ci
';