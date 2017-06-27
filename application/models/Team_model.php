<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	private $columns = array(
		'team_id' => 0,
		'team_nom'=> '',
		'team_desc'=>'',
		'team_cargo'=>'',
		'team_foto'=>''
		);


	public function get($attr){
  return $this->columns[$attr];
}

	public function create($row){
	  $team =  new Team_model();
	  foreach ($row as $key => $value)
	    {
	      $team->columns[$key] = $value;
	    }
	  return $team;
	}

	  public function setColumns ($row = null){
	    foreach ($row as $key => $value) {
	      $this->columns[$key] = $value;
	      }
	    }

	public function insert(){
	$this->db->insert('team',$this->columns);
	}

	public function delete($id){
	  $sql="delete from team WHERE team_id=".$id;
	  $query = $this->db->query($sql);
	  return 1;
	}

	public function findAll(){
	  $result=array();
	  $consulta = $this->db->get('team');
	    foreach ($consulta->result() as $row) {
	    $result[] = $this->create($row);
	  }
	  return $result;
	}

	  public function findById($id){
	    $query = $this ->db-> get_where('team',array('team_id'=>$id));
	   if($query -> num_rows() >= 1)
	         {
	            $row = $query->row_object();
	            $log=$this->create($row);
	            return $log; 
	         }
	    return false;
	  }
	 
	  public function save($userName,$desc,$cargo,$photo){
          $this->load->database();    
          $team = array(
		'team_id' => null,
		'team_nom'=> $userName,
		'team_desc'=> $desc,
		'team_cargo'=>$cargo,
		'team_foto'=>$photo
		);
      $this->db->insert('team', $team); 
  }

	
	function update($id, $user,$desc,$cargo){
      $idusu = $id;
      $this->load->database();
      $data =  array(
		'team_nom'=> $user,
		'team_desc'=>$desc,
		'team_cargo'=>$cargo
		);

    $this->db->where('team_id',$idusu);
    $this->db->update('team',$data);
      
    }
    function updateDos($id, $user,$desc,$cargo,$photo){
      $idusu = $id;
      $this->load->database();
      $data =  array(
		'team_nom'=> $user,
		'team_desc'=>$desc,
		'team_cargo'=>$cargo,
		'team_foto'=>$photo
		);

    $this->db->where('team_id',$idusu);
    $this->db->update('team',$data);
      
    }


}

/* End of file Team_model.php */
/* Location: ./application/models/Team_model.php */