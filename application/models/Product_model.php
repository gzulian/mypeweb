  
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

public function __construct()
{
parent::__construct();
}

private  $_columns  =  array(
'pro_id' => 0,
'pro_name' => '',
'pro_subtitle' => '',
'pro_description' => '',
'pro_price' => 0,
'pro_currency' => '',
'pro_position' => 0,
'pro_status' => 1,
'pro_cat_id' => 0,
'pro_discount' => 0,
'pro_total' => 0,
'pro_discounttype' => '',
'pro_stock' => 0

);

public function get($attr){
  return $this->_columns[$attr];
}
private $proposi="mypeweb_product";
public function save($proname,$prosub,$prodes,$propri,$procur,$prosta,$procat,$prodis,$prot,$prodiscounttype,$prostock){
          $this->load->database();    
          $productos = array(
          'pro_id' => null,
          'pro_name'=> $proname,
          'pro_subtitle'=> $prosub,
          'pro_description'=> $prodes,
          'pro_price'=> $propri,
          'pro_currency'=> $procur,
          'pro_position'=> 0,
          'pro_status'=> $prosta,
          'pro_cat_id'=> $procat,
          'pro_discount'=> $prodis,
          'pro_total'=> $prot,
          'pro_discounttype'=> $prodiscounttype,
          'pro_stock'=> $prostock
          );
      $this->db->insert('mypeweb_product', $productos); 
      return $this->db->insert_id();
  }

public function create($row){
  $product =  new Product_model();
  foreach ($row as $key => $value)
    {
      $product->_columns[$key] = $value;
    }
  return $product;
}

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->_columns[$key] = $value;
      }
    }

public function insert(){
  $this->db->insert('mypeweb_product',$this->_columns);
  $this->_columns['pro_id'] = $this->db->insert_id();
}

function update(){
    $this->load->database();
    $this->db->where('pro_id',$this->_columns['pro_id']);
    $this->db->update('mypeweb_product',$this->_columns);
}

public function delete($id){
  $sql="delete from mypeweb_product WHERE pro_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}
public function desactivar($id){
  $sql="update mypeweb_product set pro_status =0 WHERE pro_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}
public function activar($id){
  $sql="update mypeweb_product set pro_status =1 WHERE pro_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}


public function findAll(){
  $result=array();
  $this->db->select('*');
  $this->db->from('mypeweb_product');
  $this->db->order_by("pro_position", "asc");
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

    public function findById($id){
    $query = $this ->db-> get_where('mypeweb_product',array('pro_id'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $pro=$this->create($row);
            return $pro; 
         }
    return false;
  }


 public function findAllActivados($limit = null){
  $result=array();  
  $this->db->select('*');
  $this->db->from('mypeweb_product');
  $this->db->where('pro_status',1);
  $this->db->order_by("pro_position", "asc");
  if(!is_null($limit)){
    $this->db->limit($limit);
  }
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

 public function findAllDesactivados(){
  $result=array();
  $consulta = $this->db->get_where('mypeweb_product',array('pro_status'=>0));
    foreach ($consulta->result() as $row) {
      $result[] = $this->create($row);
    }
    return $result;
  }
  public function updateOrder($id_array){
    $count = 1;
    foreach ($id_array as $id){
      $update = $this->db->query("UPDATE ".$this->proposi." SET pro_position = $count WHERE pro_id = $id");
      $count ++;  
    }
    return TRUE;
  }

  function getFront(){
    $CI         =& get_instance();
    $CI->load->model('Multimedia_model');
    $this->db->limit(1);
    $consulta =  $this->db->get_where('mypeweb_multimedia',
      array('mul_pro_id'=> $this->_columns['pro_id'], 'mul_position'=>1 ));
    $multimedia = null;
    if($consulta->num_rows() == 1){
      $multimedia = $CI->Multimedia_model->create($consulta->row_object());
    }
    return $multimedia;
    //return $CI->Multimedia_model->findById2($this->_columns['pro_usu_id']);  
  }
}
