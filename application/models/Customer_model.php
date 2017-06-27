
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    public function __construct()
    {
    parent::__construct();
    }

      private  $_columns  =  array(
      'cus_id' => null,
      'cus_name' => '',
      'cus_email' => '',
      'cus_phonenumber' => '',
      'cus_datesystem' => ''
      );

      private  $columns  =  array(
      'cus_id' => 0,
      'cus_name' => '',
      'cus_email' => '',
      'cus_phonenumber' => '',
      'cus_datesystem' => '',
      'log_id'=>0,
      'log_datesystem'=>'',
      'log_cus_id'=>0,
      'log_new_id'=>0,
      'new_id'=>0,
      'new_subject'=>'',
      'new_text'=>''
      );

      public function get($attr){
        return $this->_columns[$attr];
      }

      public function create($row){
        $customer =  new Customer_Model();
        foreach ($row as $key => $value)
          {
            $customer->_columns[$key] = $value;
          }
        return $customer;
      }

       public function getCol($attr){
        return $this->columns[$attr];
      }

      public function createCol($row){
        $customer =  new Customer_Model();
        foreach ($row as $key => $value)
          {
            $customer->columns[$key] = $value;
          }
        return $customer;
      }

        public function setColumns ($row = null){
          foreach ($row as $key => $value) {
            $this->_columns[$key] = $value;
            }
          }

      public function insert(){
      $this->db->insert('mypeweb_customer',$this->_columns);
      $this->db->insert_id();
      }

      public function update($id, $data) {
        $customer = $this->db->get_where('mypeweb_customer',array('cus_id'=>$id));
        if($customer->num_rows() > 0){
          $this->db->where('cus_id', $id);
          return $this->db->update('mypeweb_customer', $data);
          }else{
        $data['cus_id'] = $id;
        return $this->db->insert('mypeweb_customer',$data);
        }
      }

      public function delete($id){
        $sql="delete from mypeweb_customer WHERE cus_id=".$id;
        $query = $this->db->query($sql);
        return 1;
      }


      public function findAll(){
        $result=array();
        $consulta = $this->db->get('mypeweb_customer');
          foreach ($consulta->result() as $row) {
          $result[] = $this->create($row);
        }
        return $result;
      }

        public function findById($id){
          $query = $this ->db-> get_where('mypeweb_customer',array('cus_id'=>$id));
         if($query -> num_rows() >= 1)
               {
                  $row = $query->row_object();
                  $customer=$this->create($row);
                  return $customer; 
               }
          return false;
        }
        public function findCusLogSleById($id){
         
          $sql =  "SELECT * FROM `mypeweb_customer` a INNER JOIN mypeweb_newslog b INNER JOIN mypeweb_newsletter c ON a.cus_id=b.log_cus_id AND b.log_new_id = c.new_id WHERE cus_id =".$id;
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

         public function findCusLogSleByType($id,$state){
         
          $sql =  "SELECT * FROM `mypeweb_customer` a INNER JOIN mypeweb_newslog b INNER JOIN mypeweb_newsletter c ON a.cus_id=b.log_cus_id AND b.log_new_id = c.new_id WHERE b.log_type =".$id." AND b.log_state=".$state;
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

        public function save($name,$mail,$number,$date){
        try {

            $this->load->database();
            $query = $this ->db-> get_where('mypeweb_customer',array('cus_email'=>$mail));
            $aux='';
            $id=0;

            $columns  =  array(
                      'cus_name' => $name,
                      'cus_email' => $mail,
                      'cus_phonenumber' => $number,
                      'cus_datesystem' => $date
                      );
            if($query -> num_rows() >= 1)
                   {
                      $row = $query->row_object();
                      $customer=$this->create($row);
                      $aux=$customer->get('cus_email'); 
                      $id=$customer->get('cus_id');
                   }
            if($columns['cus_email'] != $aux){
                $this->db->insert("mypeweb_customer",$columns);
                $columns['cus_name'] = $this->db->insert_id();
                return $this->db->insert_id();
            }else{
                $this->db->where('cus_id',$id);
                $this->db->update('mypeweb_customer',$columns);
                return $id;
            }
        } catch (Exception $e) {
            echo"se produjo una excepcion del tipo".$e->getMessage() ;
        }
      }  

}
