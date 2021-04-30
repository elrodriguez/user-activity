<?php
namespace Elrod\UserActivity;

use Elrod\UserActivity\Models\ActivityLog;

class Activity {

    protected $URL;
    protected $HOST;
    protected $log;

    public function __construct()
    {
        $this->HOST = $_SERVER['HTTP_HOST'];
        $this->url = $_SERVER['REQUEST_URI'];
    }

    public function ActivityLogCreate(array $data){
        $route = $this->HOST.$this->url;
        $component = $this->arraykeyexists('component', $data);
        $data_json_old = $this->arraykeyexists('data_json_old', $data);
        $data_json_updated = $this->arraykeyexists('data_json_updated', $data);
        $table_name = $this->arraykeyexists('table_name', $data);
        $table_column_id = $this->arraykeyexists('table_column_id', $data);
        $model_name = $this->arraykeyexists('model_name', $data);
        //$route = $this->arraykeyexists('route', $data);
        $description = $this->arraykeyexists('description', $data);
        $context = $this->arraykeyexists('context', $data);
        $response_code = $this->arraykeyexists('response_code', $data);
        $response_message = $this->arraykeyexists('response_message', $data);
        $type_activity = $this->arraykeyexists('type_activity', $data);
        $created_at = date('Y-m-d H:i:s');
        $user_id = $this->arraykeyexists('user_id', $data);
        $user = $this->arraykeyexists('user', $data);
        

        $ActivityLog = new ActivityLog;
        $ActivityLog->__set('component',$component);
        $ActivityLog->__set('data_json_old',$data_json_old);
        $ActivityLog->__set('data_json_updated',$data_json_updated);
        $ActivityLog->__set('table_name',$table_name);
        $ActivityLog->__set('table_column_id',$table_column_id);
        $ActivityLog->__set('model_name',$model_name);
        $ActivityLog->__set('route',$route);
        $ActivityLog->__set('description',$description);
        $ActivityLog->__set('context',$context);
        $ActivityLog->__set('response_code',$response_code);
        $ActivityLog->__set('response_message',$response_message);
        $ActivityLog->__set('type_activity',$type_activity);
        $ActivityLog->__set('created_at',$created_at);
        $ActivityLog->__set('user_id',$user_id);
        $ActivityLog->__set('user',$user);
       
        $ActivityLog->create();
        
    }

    private function arraykeyexists($index,$search_array){
        if (array_key_exists($index, $search_array)) {
            return $search_array[$index];
        }else{
            return null;
        }
    }
}

