<?php
namespace Elrod\UserActivity\Database\Core;

use Elrod\UserActivity\Database\Connection\Database;
use PDO;
use PDOException;

abstract class Crud extends Database{

    private $table;
    public $pdo;
    public $app_name;

    public function __construct($table) {
        $this->table=(string) $table;
        $this->pdo=parent::conexion();
        $this->app_name = tenant('id');
    }

    public function getAll(){
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM $this->table WHERE tenant_id = $this->app_name");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }
    public function getByUser($user_id,$start,$end){
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM $this->table WHERE tenant_id = $this->app_name AND user_id=$user_id AND (DATE(created_at) >= $start AND DATE(created_at) <= $end)");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }
    public function getById($id){
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function delete($id){
        try
        {
            $stm = $this->pdo->prepare("DELETE FROM $this->table WHERE id=?");
            $stm->execute(array($id));
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }

    abstract function create();
    abstract function update();
}