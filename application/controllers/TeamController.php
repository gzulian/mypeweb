<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeamController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Team_model','team',true);
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('login') == TRUE) {
			$datitos['team']=$this->team->findAll();
			$datitos['log']=$this->conf->findAllActivados();
			$this->load->view('team',$datitos,FALSE);
			}else{
			redirect('LoginController','refresh');
		}
		
	}
	public function agregarUsuEqui(){

		if ($this->session->userdata('login') == TRUE) {
				if(isset($_POST['userName']) && isset($_POST['desc']) && isset($_POST['cargo'])  || !empty($_POST['userName']) && !empty($_POST['desc']) && !empty($_POST['cargo']) && !empty($_FILES["logo"]["tmp_name"])) {

					$userName = $this->input->post('userName');
					$desc = $this->input->post('desc');
					$cargo= $this->input->post('cargo');
					$logo = $this->input->post('logo');

					$tmp_name  = $_FILES["logo"]["tmp_name"];
					$name = basename($_FILES["logo"]["name"]);
					$explode = explode('.', $name);
					$extension = $explode['1'];
					$punto = ".";
					$img =  $_POST['userName'];
					$imagen = $img.$punto.$extension;
					$ruta = "./resources/imagesTeam/{$imagen}";
					move_uploaded_file($tmp_name, "./resources/imagesTeam/{$imagen}");

					$datos = $this->team->save($userName,$desc,$cargo,$imagen);
					$this->session->set_flashdata('notice', 'El usuario con nombre = '.$userName.' ha sido creado correctamente!');
					redirect('TeamController');
		}
	}else{
			redirect('LoginController','refresh');
		}
}
	public function detallesEquiUsu(){

		if(isset($_POST['editUsu'])){

			$editUsu = $this->input->post('editUsu');
			$adId  = intval($editUsu);
			$team = $this->team->findById($adId);

			$team = array('usuId' => $team->get('team_id'),
                'usuName' => $team->get('team_nom'),
                'usuDesc'=> $team->get('team_desc'),
                'usuCargo' => $team->get('team_cargo'),
                'imagen'  => $team->get('team_foto')
                );
			echo json_encode($team);
		
		 }else{
            return "existen campos vacíos";

        }
	}

	public function editarUsu(){

		if ($this->session->userdata('login') == TRUE) {

			if(empty($_FILES['logo']['tmp_name'])){

				if(isset($_POST['editUsu']) && isset($_POST['editUserName'])&& isset($_POST['editDesc']) && isset($_POST['editCargo'])) {

					$id = $this->input->post('editUsu');
					$userName = $this->input->post('editUserName');
					$desc = $this->input->post('editDesc');
					$cargo= $this->input->post('editCargo');
					$imagen = $this->input->post('photo');

					$datos = $this->team->updateDos($id,$userName,$desc,$cargo,$imagen);
					$this->session->set_flashdata('notice', 'El usuario con nombre = '.$userName.' ha sido editado correctamente!');
					redirect('TeamController');
				}

			}else{

				if(isset($_POST['editUsu']) && isset($_POST['editUserName'])&& isset($_POST['editDesc']) && isset($_POST['editCargo'])){

					$id = $this->input->post('editUsu');
					$userName = $this->input->post('editUserName');
					$desc = $this->input->post('editDesc');
					$cargo= $this->input->post('editCargo');

					$tmp_name  = $_FILES["logo"]["tmp_name"];
					$name = basename($_FILES["logo"]["name"]);
					$explode = explode('.', $name);
					$extension = $explode['1'];
					$punto = ".";
					$img =  $_POST['editUserName'];
					$imagen = $img.$punto.$extension;
					$ruta = "./resources/imagesTeam/{$imagen}";

					unlink("./resources/imagesTeam/{$imagen}"); 
					clearstatcache(); 
					move_uploaded_file($tmp_name, "./resources/imagesTeam/{$imagen}");
					$datos = $this->team->updateDos($id,$userName,$desc,$cargo,$imagen);
					$this->session->set_flashdata('notice', 'El usuario con nombre = '.$userName.' ha sido editado correctamente!');
					redirect('TeamController');

				}
			}
		}else{
			redirect('LoginController','refresh');
		}
	}

	public function eliminarUsuTeam(){
		if ($this->session->userdata('login') == TRUE) {
			if(isset($_POST['editUsu'])){
				$teamUsuId= $this->input->post('editUsu');
				$this->team->delete($teamUsuId);
				$this->session->set_flashdata('notice', 'El usuario con la id = '.$teamUsuId.' ha sido eliminado correctamente!');
				redirect('TeamController','refresh');
			}else{
				$this->session->set_flashdata('alert',"error al eliminar el usuario");
				redirect('TeamController');
			}
		}else{
			redirect('LoginController','refresh');
		}
	}




}

/* End of file teamController.php */
/* Location: ./application/controllers/teamController.php */