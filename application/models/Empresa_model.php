<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'emp_id' => 0,
'emp_mision' => '',
'emp_vision' => '',
'emp_objetivo' => '',
'emp_descripcion' => '',
'emp_estado'=>0,
'emp_slogan'=>''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $usuario =  new Empresa_model();
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
$this->db->insert('mypeweb_empresa',$this->_columns);
}

  function update($id, $mision,$vision,$objetivo,$descripcion,$estado,$slogan){
      $idusu = $id;
      $this->load->database();
      $data = array(
		'emp_mision' => $mision,
		'emp_vision' => $vision,
		'emp_objetivo' => $objetivo,
		'emp_descripcion' => $descripcion,
    'emp_estado'=> $estado,
		'emp_slogan'=> $slogan
		);

    $this->db->where('emp_id',$idusu);
    $this->db->update('mypeweb_empresa',$data); 
    }

public function delete($id){
  $sql="delete from mypeweb_empresa WHERE emp_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}


public function findAll(){
  $result=array();
  $consulta = $this->db->get('mypeweb_empresa');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

  public function findById($id){
    $query = $this ->db-> get_where('mypeweb_empresa',array('emp_id'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $user = $this->create($row);
            return $user; 
         }
    return false;
  }
 public function save($mision,$vision,$objetivo,$descripcion,$slogan){
          $this->load->database();    
          $empresa = array(
          'emp_id' => null,	
    		  'emp_mision' => $mision,
    		  'emp_vision' => $vision,
    		  'emp_objetivo' => $objetivo,
    		  'emp_descripcion' => $descripcion,
    		  'emp_estado'=> 0,
          'emp_slogan'=> $slogan

    		  );
      $this->db->insert('mypeweb_empresa', $empresa); 
  }	

  public function desactivar($id){
  $sql="update mypeweb_empresa set emp_estado =0 WHERE emp_id!=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function activar($id){
  $sql="update mypeweb_empresa set emp_estado =1 WHERE emp_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}
public function getActive(){
  $this->db->limit(1);
  $query = $this ->db-> get_where('mypeweb_empresa',array('emp_estado'=>1));
  $empresa = null;
  if($query -> num_rows() == 1){
    $row = $query->row_object();
    $empresa = $this->create($row); 
  }
  return $empresa;

}
}

/* End of file Empresa_model.php */
/* Location: ./application/models/Empresa_model.php */