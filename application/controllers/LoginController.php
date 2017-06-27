<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model','user',true);
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('session');
	}

	public function index()
	{
		$datitos['log']=$this->conf->findAllActivados();
		$this->load->view('login',$datitos,FALSE);
	}

	public function volverIndex(){
		$datitos['log']=$this->conf->findAllActivados();
		$datitos['conf']=$this->conf->findAll();
		$this->load->view('config',$datitos,FALSE);
	}

	public function checkLoginUser(){
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

   		 $this->form_validation->set_rules('clave', 'Contraseña', 'required|callback_verifyUser');

   		 if($this->form_validation->run() == false){
   		 	$this->session->set_flashdata('alert', 'Email o Contraseña Incorrecta.');
   		 	$datitos['log']=$this->conf->findAllActivados();
   		 	$this->load->view('login.php',$datitos,FALSE);

		}else{
   		 	$userName = $this->input->post('userName');
			$clave = $this->input->post('clave');
			$encriptado = sha1($clave);
			$a=$this->user->login($userName,$encriptado);
			$buena = array(
				'idusername'=>$a->get('adm_id'),
				'username' => $a->get('adm_name'),
				'login'=>TRUE,
				'userName'=>$a->get('adm_user'),
				'imagen'=>$a->get('adm_photo'));
			$id = $a->get('adm_id');
			$this->session->set_userdata($buena);
			$user = $this->user->findById($id);
			$datitos['user'] = $user;
			$datitos['log']=$this->conf->findAllActivados();
			$datitos['conf']=$this->conf->findAll(); 
			redirect('ConfController/index','refresh');
			//$this->load->view('config',$datitos,FALSE);
   		 } 
		
	}


	public function verifyUser(){
		$userName = $this->input->post('userName');
		$clave = $this->input->post('clave');
		$encriptado = sha1($clave);
		
		if($userName == ''){
			$this->session->set_flashdata('alert', 'Ingresar nombre de usuario.');
			redirect('LoginController/index','refresh');
		}
		if($clave == ''){
			$this->session->set_flashdata('alert', 'Ingresar Clave');
			redirect('LoginController/index','refresh');
		}

		if($a=$this->user->login($userName, $encriptado)){
			return true;

		}else{
			$this->form_validation->set_message('verifyUser','Correo o Contraseña Incorrecta, Por favor intentar de nuevo');
			return false; 	
		}

	}


		public function logoutUser(){
		$this->session->unset_userdata('idusername','username','login','userName','imagen');
		redirect('LoginController/index','refresh');
	}


}

/* End of file loginController.php */
/* Location: ./application/controllers/loginController.php */