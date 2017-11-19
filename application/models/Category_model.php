
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_Model extends CI_Model {

public function __construct()
{
parent::__construct();
}
private $catpos="mypeweb_category";
private  $_columns  =  array(
'cat_id' => 0,
'cat_name' => '',
'cat_parent' => 0,
'cat_status' => 1,
'cat_position' => 0
);

private $contar = array(
  'cat_count'=>0);

public function get($attr){
  return $this->_columns[$attr];
}

public function create($row){
  $category =  new Category_Model();
  foreach ($row as $key => $value)
    {
      $category->_columns[$key] = $value;
    }
  return $category;
}

  public function setColumns ($row = null){
    foreach ($row as $key => $value) {
      $this->_columns[$key] = $value;
      }
    }

public function getContar($attr){
  return $this->contar[$attr];
}

public function createContar($row){
  $category =  new Category_Model();
  foreach ($row as $key => $value)
    {
      $category->contar[$key] = $value;
    }
  return $category;
}

  public function setColCon ($row = null){
    foreach ($row as $key => $value) {
      $this->contar[$key] = $value;
      }
    }

    public function save($catname,$catparent,$catstatus){
          $this->load->database();    
          $categorias = array(
          'cat_id' => null,
          'cat_name'=> $catname,
          'cat_parent'=> $catparent,
          'cat_status'=> $catstatus,
          );
      $this->db->insert('mypeweb_category', $categorias); 
  }
public function insert(){
$this->db->insert('mypeweb_category',$this->_columns);
}

function update($id,$catname,$catparent,$catstatus){
      $idusu = $id;
      $this->load->database();
      $data = array(
       'cat_name'=> $catname,
          'cat_parent'=> $catparent,
          'cat_status'=> $catstatus
      );
    $this->db->where('cat_id',$idusu);
    $this->db->update('mypeweb_category',$data);
      
    }

public function delete($id){
  $sql="delete from mypeweb_category WHERE cat_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function desactivar($id){
  $sql="update mypeweb_category set cat_status =0 WHERE cat_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function activar($id){
  $sql="update mypeweb_category set cat_status =1 WHERE cat_id=".$id;
  $query = $this->db->query($sql);
  return 1;
}

public function findAll(){
  $result=array();
  $this->db->select('*');
  $this->db->from('mypeweb_category');
  $this->db->order_by("cat_position", "asc");
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

  public function findById($id){
    $query = $this ->db-> get_where('mypeweb_category',array('cat_id'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $cat=$this->create($row);
            return $cat; 
         }
    return false;
  }

    public function findByParent($id){
    $query = $this ->db-> get_where('mypeweb_category',array('cat_parent'=>$id));
   if($query -> num_rows() >= 1)
         {
            $row = $query->row_object();
            $cat=$this->create($row);
            return $cat; 
         }
    return null;
  }

 public function findAllActivados(){
  $result=array();  
  $this->db->select('*');
  $this->db->from('mypeweb_category');
  $this->db->where('cat_status',1);
  $this->db->order_by("cat_position", "asc");
  $consulta = $this->db->get();
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
  }
  return $result;
}

public function findAllDesactivados(){
  $result=array();
  $consulta = $this->db->get_where('mypeweb_category',array('cat_status'=>0));
   $result = array();
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
    $result[] = $this->create($row);
    }
  }
  return $result;
}


      public function findAllCusLogSle(){
         
          $sql =  "SELECT * FROM `mypeweb_customer` a INNER JOIN mypeweb_newslog b INNER JOIN mypeweb_newsletter c ON a.cus_id=b.log_cus_id AND b.log_new_id = c.new_id;";
          $this->load->database();
          $query = $this->db->query($sql);
          $customer = null;
          if($query->num_rows()>0){
                foreach ($query->result() as $value) {
                  $customer[] = $this->createCol($value);
                }
              }
          return $customer;
        }

  public function updateOrder($id_array){
    $count = 1;
    foreach ($id_array as $id){
      $update = $this->db->query("UPDATE ".$this->catpos." SET cat_position = $count WHERE cat_id = $id");
      $count ++;  
    }
    return TRUE;
  }


  
public function findAllSubcat(){
$result = array();
$consulta = $this->db->query('SELECT a.cat_id AS ID, a.cat_name AS SubCategoria, b.cat_name AS Categoria FROM mypeweb_category a INNER JOIN mypeweb_category b ON b.cat_id = a.cat_parent WHERE a.cat_status=1 AND b.cat_status=1');
  $result = array();
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
      $result[] = $this->create($row);
    }
  }
  return $result;
}

public function findAllCatvac(){
  $result = array();
  $consulta = $this->db->query('SELECT cat_id, cat_name, cat_status FROM mypeweb_category WHERE cat_parent IS NULL AND cat_status = 1');
  $result = array();
  if($consulta->num_rows() > 0){
    foreach ($consulta->result() as $row) {
      $result[] = $this->create($row);
    }
  }
  return $result;
}
public function findAllCatvacias(){
    $result = array();
    $consulta = $this->db->query('SELECT * FROM mypeweb_category WHERE cat_parent IS NULL OR cat_parent<1');
    
    $result = array();
    if($consulta->num_rows() > 0){
      foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
    }
    return $result;
  }
  public function findAllParentActivados(){
    $this->db->select('*');
    $this->db->from('mypeweb_category');
    $this->db->where('cat_parent',null);
    $this->db->or_where('cat_parent',0);
    $this->db->where('cat_status',1);
    $this->db->order_by("cat_position", "asc");
    $consulta = $this->db->get();
    $result = array();
    if($consulta->num_rows() > 0){
      foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
    }  
    return $result;
  }
  public function getSubcategoryActive()
  {
    $this->db->order_by('cat_name','asc');
    $consulta = $this->db->get_where('mypeweb_category',array('cat_parent'=>$this->_columns['cat_id'] , 'cat_status'=> 1));

    $result = array();
    if($consulta->num_rows() > 0){
      foreach ($consulta->result() as $row) {
        $result[] = $this->create($row);
      }
    }  
    return $result; 

  }
  public function getProducts(){
      $this->db->order_by('pro_name','asc');
      $consulta = $this->db->get_where('mypeweb_product',array('pro_cat_id'=>$this->_columns['cat_id'], 'pro_status'=>1 ));
      $result = array();
      if($consulta->num_rows() > 0){
        $CI         =& get_instance();
        $CI->load->model('Product_model');
        foreach ($consulta->result() as $row) {
          $result[] = $CI->Product_model->create($row);
        }
      }  
      return $result; 
  }



}
