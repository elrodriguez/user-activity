<?php
namespace Elrod\UserActivity\Models;

use Elrod\UserActivity\Database\Core\Crud;
use PDO;
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

    private $search_value;
    private $search_column;
    private $order_column;
    private $order_dir;
    private $ORDER;
    private $NRO_REGISTROS = 10;
    private $page;
    private $columns;

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

    public function showColumn($name,$value){
        $this->columns[$name]=$value;
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
                    json_encode($this->data_json_old),
                    json_encode($this->data_json_updated),
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
                    json_encode($this->user)
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

    public function __paginate()
    {
        $nav = '';
        $formod = '<div class"row">';
        $formod = '<div class"col-12">';

        $where = '';
        if($this->search_column){
            $where = ' WHERE '.$this->search_column.' LIKE "%'.$this->search_value.'%"';
        }

        $TAMANO_PAGINA = $this->NRO_REGISTROS; 

        $pagina = 1;
        $inicio = 0;

        if($this->page){
            (int) $pagina = $this->page;
            $inicio = ($pagina - 1) * $TAMANO_PAGINA;
        }
        $sql = 'SELECT * FROM '.self::TABLE.$where;
            
        try{
            $rs = $this->pdo->prepare($sql);
            $rs->execute();
            $num_total_registros = $rs->rowCount();

        }catch(PDOException $error){
                $formod = 'Connection error: ' . $error;
                $formod .= "An error has occurred and the data from the DB could not be downloaded.";
        }
        try{
            $order = '';
            if($this->ORDER){
                $order = ' ORDER BY '.$this->order_column.' '.$this->order_dir;
            }
            $ssqsl = $sql = 'SELECT * FROM '.self::TABLE.$where.$order.' limit ' .$inicio.',' .$TAMANO_PAGINA;
            $rs = $this->pdo->prepare($ssqsl);

            $rs->execute();
            $formod.='<div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-info-900">
                                <tr>';
                                if(isset($this->columns['id'])){
                                    $formod.='<th>ID</th>';
                                }
                                if(isset($this->columns['component'])){
                                    $formod.='<th>component</th>';
                                }
                                if(isset($this->columns['data_json_old'])){
                                    $formod.='<th>data_json_old</th>';
                                }
                                if(isset($this->columns['data_json_updated'])){
                                    $formod.='<th>data_json_updated</th>';
                                }
                                if(isset($this->columns['table_name'])){
                                    $formod.='<th>table_name</th>';
                                }
                                if(isset($this->columns['table_column_id'])){
                                    $formod.='<th>table_column_id</th>';
                                }
                                if(isset($this->columns['model_name'])){
                                    $formod.='<th>model_name</th>';
                                }
                                if(isset($this->columns['route'])){
                                    $formod.='<th>route</th>';
                                }
                                if(isset($this->columns['description'])){
                                    $formod.='<th>description</th>';
                                }
                                if(isset($this->columns['context'])){
                                    $formod.='<th>context</th>';
                                }
                                if(isset($this->columns['response_code'])){
                                    $formod.='<th>response_code</th>';
                                }
                                if(isset($this->columns['response_message'])){
                                    $formod.='<th>response_message</th>';
                                }
                                if(isset($this->columns['type_activity'])){
                                    $formod.='<th>type_activity</th>';
                                }
                                if(isset($this->columns['created_at'])){
                                    $formod.='<th>created_at</th>';
                                }
                                if(isset($this->columns['user_id'])){
                                    $formod.='<th>user_id</th>';
                                }
                                if(isset($this->columns['user'])){
                                    $formod.='<th>user</th>';
                                }
                                $formod.='</tr>
                            </thead>
                            <tbody>';
            while ($fila = $rs->fetchAll(PDO::FETCH_ASSOC)){
                foreach($fila as $row){
                    $formod .= '<tr >';
                    if(isset($this->columns['id'])){
                        $formod.='<td >'.$row['id'].'</td>';
                    }
                    if(isset($this->columns['component'])){
                        $formod.='<td >'.$row['component'].'</td>';
                    }
                    if(isset($this->columns['data_json_old'])){
                        $formod.='<td ><code>'.$row['data_json_old'].'</code></td>';
                    }
                    if(isset($this->columns['data_json_updated'])){
                        $formod.='<td ><code>'.$row['data_json_updated'].'</code></td> ';
                    }
                    if(isset($this->columns['table_name'])){
                        $formod.='<td >'.$row['table_name'].'</td> ';
                    }
                    if(isset($this->columns['table_column_id'])){
                        $formod.='<td >'.$row['table_column_id'].'</td>';
                    }
                    if(isset($this->columns['model_name'])){
                        $formod.='<td >'.$row['model_name'].'</td>';
                    }
                    if(isset($this->columns['route'])){
                        $formod.='<td >'.$row['route'].'</td> ';
                    }
                    if(isset($this->columns['description'])){
                        $formod.='<td >'.$row['description'].'</td>';
                    }
                    if(isset($this->columns['context'])){
                        $formod.='<td >'.$row['context'].'</td>';
                    }
                    if(isset($this->columns['response_code'])){
                        $formod.='<td >'.$row['response_code'].'</td>';
                    }
                    if(isset($this->columns['response_message'])){
                        $formod.='<td >'.$row['response_message'].'</td>';
                    }
                    if(isset($this->columns['type_activity'])){
                        $formod.='<td >'.$row['type_activity'].'</td>';
                    }
                    if(isset($this->columns['created_at'])){
                        $formod.='<td >'.$row['created_at'].'</td>';
                    }
                    if(isset($this->columns['user_id'])){
                        $formod.='<th>'.$row['user_id'].'</td></th>';
                    }
                    if(isset($this->columns['user'])){
                        $formod.='<td ><code>'.$row['user'].'</code></td>';
                    }
                    $formod.='</tr>';
                }
            }

        }catch(PDOException $error){
            $formods = 'Connection error: ' . $error;
            $formods .= "An error has occurred and the data from the DB could not be downloaded.";
            return $formods;
        }

        $formod .= '</tbody>';
        $formod .= '</table>
                    </div>
                    <div class="mt-3">'.$this->pager($num_total_registros,$pagina).'</div>';
        $formod .= '</div>';
        $formod .= '</div>';
        return $formod;
    }

    public function pager($totalRegs, $pagActual,$cantPag = 5) {
        $html = '';
        $cantPag = ($cantPag == 0 ? 5 : $cantPag);
        $numReg = $this->NRO_REGISTROS;
        $href = ''; 
        if ($totalRegs > 0) {
   
            $html = '<div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="dt_basic_info" role="status" aria-live="polite">
                                <input type="hidden" id="pphpagact" value="' . $pagActual . '">
                                <table>
                                    <tr>
                                        <td>Mostrando&nbsp;</td>
                                        <td>
                                            <span class="txt-color-darken">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        '.$numReg.'
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <a class="dropdown-item ' . ($numReg == 5 ? 'active' : '') . '" href="?draw=1&search=' . $this->search_value.'&length=5">5</a>
                                                            <a class="dropdown-item ' . ($numReg == 10 ? 'active' : '') . '" href="?draw=1&search=' . $this->search_value.'&length=10">10</a>
                                                            <a class="dropdown-item ' . ($numReg == 20 ? 'active' : '') . '" href="?draw=1&search=' . $this->search_value.'&length=20">20</a>
                                                            <a class="dropdown-item ' . ($numReg == 50 ? 'active' : '') . '" href="?draw=1&search=' . $this->search_value.'&length=50">50</a>
                                                            <a class="dropdown-item ' . ($numReg == 100 ? 'active' : '') . '" href="?draw=1&search=' . $this->search_value.'&length=100">100</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </span> 
                                        </td>
                                        <td>&nbsp;de un total de <span class="text-primary">' . $totalRegs . '</span>
                                            registros / Pag. <span class="txt-color-darken">' . $pagActual . '</span> de <span class="txt-color-darken">' . ceil($totalRegs / $numReg) . '</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">';
    
            $paginas = ceil($totalRegs / $numReg); #determining the number of pages
            if($paginas == $pagActual){
                $mediaPag = ceil($cantPag / 2) + 1;
            }else{
                $mediaPag = ceil($cantPag / 2);
            }
            $pagInicio = ($pagActual - $mediaPag);
            $pagInicio = ($pagInicio <= 0 ? 1 : $pagInicio);
            $pagFinal = ($pagInicio + ($cantPag - 1));
    
            if ($pagActual > 1) {
                $href = '?draw='.($pagActual - 1).'&search=' . $this->search_value.'&length='.$numReg;
                $html .= '<li class="page-item"><a class="page-link" href="'.$href.'" ><span aria-hidden="true">&laquo;</span></a></li>';
                if($pagActual > $cantPag){
                    $href = '?draw=1&search=' . $this->search_value.'&length='.$numReg;
                    $html .= '<li class="page-item"><a class="page-link" href="'.$href.'" >1</a></li>';
                    $html .= '<li class="page-item disabled"><a class="page-link" href="javascript:void(0);" disabled><span>...</span></a></li>';
                }
            } else {
                $html .= '<li class="page-item disabled"><a class="page-link" href="javascript:void(0);"><span aria-hidden="true">&laquo;</span></a></li>';
            }
    
            $sw = true;

            for ($i = $pagInicio; $i <= $pagFinal; $i++) {
                if ($i <= $paginas) {
                    $href = '?draw='.$i.'&search=' . $this->search_value.'&length='.$numReg;
                    $a = '<a class="page-link" href="'.$href.'"><span>' . $i . '</span></a>';
    
                    $css = 'class="page-item"';
                    if ($i == $pagActual) {
                        $a = '<a class="page-link" href="javascript:void(0);"><span>' . $i . '</span></a>';
                        $css = 'class="page-item active" ';
                    }
                    $html .= '<li ' . $css . '>' . $a . '</li>';
                } else {
                    $sw = false;
                    break;
                }
            }
            if($paginas > $pagFinal){
                $html .= '<li class="page-item disabled"><a class="page-link" href="javascript:void(0);" disabled><span>...</span></a></li>';
                $href = '?draw='.$paginas.'&search=' . $this->search_value.'&length='.$numReg;
                $html .= '<li class="page-item"><a class="page-link" href="'.$href.'"><span>'.$paginas.'</span></a></li>';
            }
            if ($paginas > 1 && $pagActual != $paginas) {
    
                $href = '?draw='.($pagActual + 1).'&search=' . $this->search_value.'&length='.$numReg;
                $html .= '<li class="page-item"><a class="page-link" href="'.$href.'"><span aria-hidden="true">&raquo;</span></a></li>';

            } else {
                $html .= '<li class="page-item disabled"><a class="page-link" href="javascript:void(0);"><span aria-hidden="true">&raquo;</span></a></li>';
            }
    
            $html .= '</ul>
                </div>
            </div>            
        </div>';
        }
        return $html;
    }
}