<?php
namespace Elrod\UserActivity;

use Elrod\UserActivity\Models\ActivityLog;

class Activity {

    protected $URL;
    protected $HOST;
    protected $log;
    protected $ActivityLog;

    public function __construct()
    {
        $this->HOST = $_SERVER['HTTP_HOST'];
        $this->url = $_SERVER['REQUEST_URI'];
        $this->ActivityLog = new ActivityLog;
    }

    public function log(String $description){
        $this->ActivityLog->__set('description',$description);
        $this->ActivityLog->__set('created_at',date('Y-m-d H:i:s'));
    }
    public function modelOn($model, $id = null, $table = null){
        $this->ActivityLog->__set('context',$this->HOST);
        $this->ActivityLog->__set('table_column_id',$id);
        $this->ActivityLog->__set('table_name',$table);
        $this->ActivityLog->__set('model_name',$model);
    }

    public function causedBy($data){
        $this->ActivityLog->__set('user_id',$data->id);
        $this->ActivityLog->__set('user',$data);
    }

    public function routeOn($route = null){
        $route = ($route?$route:$this->HOST.$this->url);
        $this->ActivityLog->__set('route',$route);
    }

    public function componentOn($component){
        $this->ActivityLog->__set('component',$component);
    }

    public function dataOld($data_json_old){
        $this->ActivityLog->__set('data_json_old',$data_json_old);
    }
    public function dataUpdated($data_json_updated){
        $this->ActivityLog->__set('data_json_updated',$data_json_updated);
    }

    public function respond($response_code,$response_message){
        $this->ActivityLog->__set('response_code',$response_code);
        $this->ActivityLog->__set('response_message',$response_message);
    }
    public function logType($type_activity){
        $this->ActivityLog->__set('type_activity',$type_activity);
    }

    public function save(){
        $this->ActivityLog->create();
    }

    public function getAll(){
        return $this->ActivityLog->getAll();
    }

    public function getById($id){
        return $this->ActivityLog->getById($id);
    }

    public function paginate($rows = 10){
        $length = isset($_REQUEST['length'])?$_REQUEST['length']:$rows;
        $this->ActivityLog->__set('NRO_REGISTROS',$length);
        $page = isset($_REQUEST['draw'])?$_REQUEST['draw']:1;
        $search_value = isset($_REQUEST['search'])?$_REQUEST['search']:null;
        $this->ActivityLog->__set('page',$page);
        $this->ActivityLog->__set('search_value',$search_value);
        return $this->ActivityLog->__paginate();
    }

    public function id(){
        return $this->ActivityLog->showColumn('id',true);
    }
    public function component(){
        return $this->ActivityLog->showColumn('component',true);
    }
    public function data_json_old(){
        return $this->ActivityLog->showColumn('data_json_old',true);
    }
    public function data_json_updated(){
        return $this->ActivityLog->showColumn('data_json_updated',true);
    }
    public function table_name(){
        return $this->ActivityLog->showColumn('table_name',true);
    }
    public function table_column_id(){
        return $this->ActivityLog->showColumn('table_column_id',true);
    }
    public function model_name(){
        return $this->ActivityLog->showColumn('model_name',true);
    }
    public function route(){
        return $this->ActivityLog->showColumn('route',true);
    }
    public function description(){
        return $this->ActivityLog->showColumn('description',true);
    }
    public function context(){
        return $this->ActivityLog->showColumn('context',true);
    }
    public function response_code(){
        return $this->ActivityLog->showColumn('response_code',true);
    }
    public function response_message(){
        return $this->ActivityLog->showColumn('response_message',true);
    }
    public function type_activity(){
        return $this->ActivityLog->showColumn('type_activity',true);
    }
    public function created_at(){
        return $this->ActivityLog->showColumn('created_at',true);
    }
    public function user_id(){
        return $this->ActivityLog->showColumn('user_id',true);
    }
    public function user(){
        return $this->ActivityLog->showColumn('user',true);
    }
    public function getByUserAndDate($user_id,$start,$end){
        return $this->ActivityLog->getByUser($user_id,$start,$end);
    }
}

