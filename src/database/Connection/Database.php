<?php

namespace Elrod\UserActivity\Database\Connection;

use PDO;
use PDOException;

class Database
{
    private $driver="mysql";
    private $host ="localhost";
    private $user="root";
    private $pass='';
    private $dbName="user_activity_log";
    private $charset="utf8";

    protected function conexion(){
        try{      
            $pdo = new PDO("{$this->driver}:host={$this->host};dbname={$this->dbName};charset={$this->charset}", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch (PDOException $e){
            die($e->getMessage());
        }
    }
}
