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

    public function causedBy(object $data){
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
    public function logType(array $type_activity){
        $this->ActivityLog->__set('type_activity',$type_activity);
    }

    public function save(){
        $this->ActivityLog->create();
    }
}

