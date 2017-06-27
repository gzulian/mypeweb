
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multimedia_model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'mul_pro_id' => 0,
'mul_id' => 0,
'mul_name' => '',
'mul_route' => '',
'mul_position' => 0,
'mul_status' => 1

);
public function save($mulproid,$mulname,$mulroute,$position,$mulstatus){
          $this->load->database();    
          $multimedia = array(
'mul_pro_id' => $mulproid,
'mul_id' => null,
'mul_name' => $mulname,
'mul_route' => $mulroute,
'mul_position'=> $position,
'mul_status' => $mulstatus
          );
      $this->db->insert('mypeweb_multimedia', $multimedia); 
  }
public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $usuario =  new Multimedia_Model();
  foreach ($row as $key => $value)
    {
      $usuario->_columns[$key] = $value;
    }
  return $usuario;
}

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }

public function insert(){
  $this->db->insert('mypeweb_multimedia',$this->_columns);
  $this->_columns['mul_id'] = $this->db->insert_id();
}


function update2(){
    $this->db->where('mul_id',$this->_columns['mul_id']); 
  $this->db->update('mypeweb_multimedia',$this->_columns);  
}

function update($mulproid,$mulname,$mulroute,$mulstatus){
      $idusu = $id;
      $this->load->database();
      $data = array(
       'mul_pro_id' => $mulproid,
       'mul_name' => $mulname,
       'mul_route' => $mulroute,
       'mul_status' => $mulstatus
      );
    $this->db->where('mul_id',$idusu);
    $this->db->update('mypeweb_multimedia',$data);
      
    }

public function delete($id){
  $sql="delete from mypeweb_multimedia WHERE mul_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}


public function desactivar($id){
  $sql="update mypeweb_multimedia set mul_status =0 WHERE mul_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function activar($id){
  $sql="update mypeweb_multimedia set mul_status =1 WHERE mul_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function findAll(){
  $result=array();
  $this->db->select('*');
  $this->db->from('mypeweb_multimedia');
  $this->db->order_by("mul_position", "asc");
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

   public function findById($id){
    $query = $this ->db-> get_where('mypeweb_multimedia',array('mul_id'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $mul=$this->create($row);
            return $mul; 
         }
    return false;
  }
  public function find($search){
    $query = $this ->db-> get_where('mypeweb_multimedia',$search);
    $multimedia = null;
    if($query -> num_rows() >= 1){
        $row = $query->row_object();
        $multimedia=$this->create($row);
        
    }
    return $multimedia;
  }
   public function findByProId($id){
    $result = array();
    $this->db->order_by('mul_position','asc');
    $consulta = $this ->db-> get_where('mypeweb_multimedia',array('mul_pro_id'=>$id));
   foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
     return $result;
  }

  public function findbyProdAndSta($id,$stat){
    $result = array();
    $sql = 'SELECT * FROM mypeweb_multimedia WHERE mul_pro_id='.$id.' AND mul_position='.$stat.';';
    $consulta = $this->db->query($sql);
     foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
     return $result;
  }

public function set($key,$value)
  {
    $this->_columns[$key] = $value;
  }
 public function findAllActivados(){
  $result=array();  
  $this->db->select('*');
  $this->db->from('mypeweb_multimedia');
  $this->db->where('mul_status',1);
  $this->db->order_by("mul_position", "asc");
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

 public function findAllDesactivados(){
  $result=array();
  $consulta = $this->db->get_where('mypeweb_multimedia',array('mul_status'=>0));
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}
 private $promul="mypeweb_multimedia";
     public function updateOrder($id_array){
    $count = 1;
    foreach ($id_array as $id){
      $update = $this->db->query("UPDATE ".$this->promul." SET mul_position = $count WHERE mul_id = $id");
      $count ++;  
    }
    return TRUE;
  }


    public function reodenar($multimedia)
  {
      $update = $this->db->query("UPDATE mypeweb_multimedia SET mul_position = 2
       WHERE mul_pro_id=".$multimedia->get('mul_pro_id')." and mul_id != ".$multimedia->get('mul_id') );

      //echo $this->db->last_query();
    
  }
}
