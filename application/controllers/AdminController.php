<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model','admin',true);
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('session');
	}


	public function index(){

		if ($this->session->userdata('login') == TRUE) {
			$datitos['admin']=$this->admin->findAll();
			$datitos['log']=$this->conf->findAllActivados();
			$this->load->view('admin',$datitos,FALSE);
		}else{
			redirect('LoginController','refresh');
		}
	}

	public function agregarUsuarios(){

		if ($this->session->userdata('login') == TRUE) {

			if(isset($_POST['userName']) && isset($_POST['pass']) && isset($_POST['name']) && isset($_POST['photo'])  || !empty($_POST['userName']) && !empty($_POST['pass']) && !empty($_POST['name']) && !empty($_POST['photo']) && !empty($_FILES["logo"]["tmp_name"])) {

				$userName = $this->input->post('userName');
				$clave = $this->input->post('pass');
				$names= $this->input->post('name');
				$logo = $this->input->post('logo');
				$encriptado = sha1($clave);

				$tmp_name  = $_FILES["logo"]["tmp_name"];
				$name = basename($_FILES["logo"]["name"]);
				$explode = explode('.', $name);
				$extension = $explode['1'];
				$punto = ".";
				$img =  $_POST['userName'];
				$imagen = $img.$punto.$extension;
				$ruta = "./resources/images/{$imagen}";
				move_uploaded_file($tmp_name, "./resources/images/{$imagen}");

				$datos = $this->admin->save($userName,$encriptado,$names,$imagen);
				$this->session->set_flashdata('notice', 'El usuario con nombre = '.$names.' ha sido creado correctamente!');
				redirect('AdminController');
			}
		}else{
			redirect('LoginController','refresh');
		}
	}
	
	public function editarUsu(){
		if ($this->session->userdata('login') == TRUE) {
			if(empty($_FILES['logo']['tmp_name'])){

				if(isset($_POST['editAdmin']) && isset($_POST['editUserName'])&& isset($_POST['editPass']) && isset($_POST['editName'])) {

					$id = $this->input->post('editAdmin');
					$userName = $this->input->post('editUserName');
					$clave = $this->input->post('editPass');
					$names= $this->input->post('editName');
					$imagen = $this->input->post('photo');
					$encriptado = sha1($clave);

					$datos = $this->admin->updateDos($id,$userName,$encriptado,$names,$imagen);
					$this->session->set_flashdata('notice', 'El usuario con nombre = '.$names.' ha sido editado correctamente!');
					redirect('AdminController');
				}

			}else{

				if(isset($_POST['editAdmin']) && isset($_POST['editUserName'])&& isset($_POST['editPass']) && isset($_POST['editName'])&& !empty($_FILES["logo"]["tmp_name"])) {

					$id = $this->input->post('editAdmin');
					$userName = $this->input->post('editUserName');
					$clave = $this->input->post('editPass');
					$names= $this->input->post('editName');

					$tmp_name  = $_FILES["logo"]["tmp_name"];
					$name = basename($_FILES["logo"]["name"]);
					$explode = explode('.', $name);
					$extension = $explode['1'];
					$punto = ".";
					$img =  $_POST['editUserName'];
					$imagen = $img.$punto.$extension;
					$ruta = "./resources/images/{$imagen}";
					
					unlink("./resources/images/{$imagen}"); 
					clearstatcache(); 

					move_uploaded_file($tmp_name, "./resources/images/{$imagen}");

					$encriptado = sha1($clave);

					$datos = $this->admin->updateDos($id,$userName,$encriptado,$names,$imagen);
					$this->session->set_flashdata('notice', 'El usuario con nombre = '.$names.' ha sido editado correctamente!');
					redirect('AdminController');

					}else{
						$this->session->set_flashdata('alert', 'No se ha podido  modificar el usuario!');
					}
				}
			}else{
				redirect('LoginController','refresh');
			}
		}

	public function detallesUsu(){


		if(isset($_POST['adminId'])){

			$adminId = $this->input->post('adminId');
			$adId  = intval($adminId);
			$admin = $this->admin->findById($adId);

			$admin = array('id' => $admin->get('adm_id'),
                'nombreUsu' => $admin->get('adm_user'),
                'pass'=> $admin->get('adm_pass'),
                'nombre' => $admin->get('adm_name'),
                'imagen' =>  $admin->get('adm_photo'));
			echo json_encode($admin);
		
		 }else{
            return "existen campos vacíos";

        }
	}

	public function eliminarUsu(){

		if ($this->session->userdata('login') == TRUE) {
			if(isset($_POST['idUsu'])){
				$adminId= $this->input->post('idUsu');
				$this->admin->delete($adminId);
				$this->session->set_flashdata('notice', 'El usuario con la id = '.$adminId.' ha sido eliminado correctamente!');
				redirect('AdminController','refresh');
			}else{
				$this->session->set_flashdata('alert', 'El usuario no se ha podido eliminar ');
				redirect('AdminController');
			}
		}else{
			redirect('LoginController','refresh');
		}

		}
	}

/* End of file AdminController.php */
/* Location: ./application/controllers/AdminController.php */