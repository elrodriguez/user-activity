<?php
namespace Elrod\UserActivity\Models;

use Elrod\UserActivity\Database\Core\Crud;
use PDOException;

class ActivityLog extends Crud {

    private $id;
    private $component;
    private $data_json_old;
    private $data_json_updated;
    private $table_name;
    private $table_column_id;
    private $model_name;
    private $route;
    private $description;
    private $context;
    private $response_code;
    private $response_message;
    private $type_activity;
    private $created_at;
    private $user_id;
    private $user;
    const TABLE = 'activity_log';
    public $pdo;

    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->pdo=parent::conexion();
    }

    public function __set($name,$value){
        $this->$name=$value;
    }
    public function __get($name){
        return $this->$name;
    }

    public function create(){
        try{
        $stm=$this->pdo->prepare("INSERT INTO ".self::TABLE." (component,
                data_json_old,
                data_json_updated,
                table_name,
                table_column_id,
                model_name,
                route,
                description,
                context,
                response_code,
                response_message,
                type_activity,
                created_at,
                user_id,
                user
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stm->execute(array(
                    $this->component,
                    $this->data_json_old,
                    $this->data_json_updated,
                    $this->table_name,
                    $this->table_column_id,
                    $this->model_name,
                    $this->route,
                    $this->description,
                    $this->context,
                    $this->response_code,
                    $this->response_message,
                    $this->type_activity,
                    $this->created_at,
                    $this->user_id,
                    $this->user
                )
            );
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    
    }

    public function update(){
        try{
            $stm=$this->pdo->prepare("UPDATE ".self::TABLE." SET name=?, specie=?,  
            breed=?,gender=?,color=?,age=? WHERE id=?");
            $stm->execute(array($this->name,$this->specie,$this->breed,$this->gender,$this->color,$this->age,$this->id));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}