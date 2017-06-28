
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'con_id' => 0,
'con_background' => '',
'con_footer' => '',
'con_navbar' => '',
'con_logo' => '',
'con_video' => '',
'con_fontcolor' => '',
'con_fontstyle' => '',
'con_fontsize' => 0,
'con_status' => 1,
'con_banner'=> '',
'con_products'=>0

);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $configuration =  new Configuration_Model();
  foreach ($row as $key => $value)
    {
      $configuration->_columns[$key] = $value;
    }
  return $configuration;
}

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->columns[$key] = $value;
      }
    }

public function insert(){
$this->db->insert('mypeweb_configuration',$this->_columns);
}

function update($id,$background,$footer,$navbar,$logo,$video,$fontcolor,$fontstyle,$fontsize,$status,$banner,$products){
      $idconf = $id;
      $this->load->database();
      $data = array(
          'con_background'     => $background,
          'con_footer'         => $footer,
          'con_navbar'         => $navbar,
          'con_logo'           => $logo,
          'con_video'          => $video,
          'con_fontcolor'      => $fontcolor,
          'con_fontstyle'      => $fontstyle,
          'con_fontsize'       => $fontsize,
          'con_status'         => $status,
          'con_banner'         =>$banner,
          'con_products'       =>$products
          );
    $this->db->where('con_id',$idconf);
    $this->db->update('mypeweb_configuration',$data);
      
    }

  public function save($background,$footer,$navbar,$logo,$video,$fontcolor,$fontstyle,$fontsize,$banner,$products){
          $this->load->database();    
          $configuration = array(
          'con_background'     => $background,
          'con_footer'         => $footer,
          'con_navbar'         => $navbar,
          'con_logo'           => $logo,
          'con_video'          => $video,
          'con_fontcolor'      => $fontcolor,
          'con_fontstyle'      => $fontstyle,
          'con_fontsize'       => $fontsize,
          'con_status'         => 0,
          'con_banner'         => $banner,
          'con_products'       => $products

          );
      $this->db->insert('mypeweb_configuration', $configuration); 
  }


public function delete($id){
  $sql="delete from mypeweb_configuration WHERE con_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function desactivar($id){
  $sql="update mypeweb_configuration set con_status =0 WHERE con_id!=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function activar($id){
  $sql="update mypeweb_configuration set con_status =1 WHERE con_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function findAll(){
  $result=array();
  $consulta = $this->db->get('mypeweb_configuration');
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

   public function findById($id){
    $query = $this ->db-> get_where('mypeweb_configuration',array('con_id'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $con=$this->create($row);
            return $con; 
         }
    return false;
  }


 public function findAllActivados(){
  $result=array();
  $consulta = $this->db->get_where('mypeweb_configuration',array('con_status'=>1));
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

 public function findAllDesactivados(){
  $result=array();
  $consulta = $this->db->get_where('mypeweb_configuration',array('con_status'=>0));
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}
 
}
