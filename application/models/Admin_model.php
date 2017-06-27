
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'adm_id' => 0,
'adm_user' => '',
'adm_pass' => '',
'adm_name' => '',
'adm_photo'=>''
);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $usuario =  new Admin_Model();
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
$this->db->insert('mypeweb_admin',$this->_columns);
}

  function update($id, $user,$pass,$name){
      $idusu = $id;
      $this->load->database();
      $data =  array(
        'adm_user' => $user,
        'adm_pass' => $pass,
        'adm_name' => $name,
        );

    $this->db->where('adm_id',$idusu);
    $this->db->update('mypeweb_admin',$data); 
    }
    function updateDos($id, $user,$pass,$name,$photo){
      $idusu = $id;
      $this->load->database();
      $data =  array(
        'adm_user' => $user,
        'adm_pass' => $pass,
        'adm_name' => $name,
        'adm_photo'=>$photo
        );

    $this->db->where('adm_id',$idusu);
    $this->db->update('mypeweb_admin',$data);
      
    }


public function delete($id){
  $sql="delete from mypeweb_admin WHERE adm_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}


public function findAll(){
  $result=array();
  $consulta = $this->db->get('mypeweb_admin');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

  public function findById($id){
    $query = $this ->db-> get_where('mypeweb_admin',array('adm_id'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $user = $this->create($row);
            return $user; 
         }
    return false;
  }

    function login($userName, $clave){
      
      $user = null;
      $result = $this->db->get_where('mypeweb_admin',array('adm_user'=>$userName));
      if ($result->num_rows() > 0) {
        $row = $result->row_object();
        if($row->adm_pass == $clave){
          $user = $this->create($row);
        }
      }
      return $user;

    }

    public function save($userName,$clave,$name,$photo){
          $this->load->database();    
          $redes = array(
          'adm_id' => null,
          'adm_user'=> $userName,
          'adm_pass'=> $clave,
          'adm_name'=> $name,
          'adm_photo'=> $photo
          );
      $this->db->insert('mypeweb_admin', $redes); 
  }
 
}
