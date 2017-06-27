<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmpresaController extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->model('Empresa_model','empresa',true);
	$this->load->model('Configuration_model','conf',true);
	$this->load->library('session');
}
	public function index()
	{
		$datitos['empresa']=$this->empresa->findAll();
		$datitos['log']=$this->conf->findAllActivados();
		$this->load->view('empresa',$datitos,FALSE);
	}

	public function agregarEmpresa(){
		if ($this->session->userdata('login') == TRUE) {

		if(isset($_POST['mision']) && isset($_POST['vision']) && isset($_POST['objetivo']) && isset($_POST['descripcion'])){

			$mision 	 = $this->input->post('mision');
			$vision		 = $this->input->post('vision');
			$objetivo    = $this->input->post('objetivo');
			$descripcion = $this->input->post('descripcion');
			$slogan 	 = $this->input->post('slogan');

			$datos = $this->empresa->save($mision,$vision,$objetivo,$descripcion,$slogan);
			$this->session->set_flashdata('notice', 'Los datos de empresa  han sido creados correctamente!');
			redirect('EmpresaController/index');
		}		
		}else{
			redirect('LoginController','refresh');
		}
	}

	public function editarEmpresa(){
		if ($this->session->userdata('login') == TRUE) {

		if(isset($_POST['editmision']) && isset($_POST['editvision']) && isset($_POST['editobjetivo']) && isset($_POST['editdescripcion'])){
			$id          = $this->input->post('editempid');
			$mision 	 = $this->input->post('editmision');
			$vision		 = $this->input->post('editvision');
			$objetivo    = $this->input->post('editobjetivo');
			$descripcion = $this->input->post('editdescripcion');
			$slogan 	 = $this->input->post('editslogan');
			$estado      = $this->input->post('editestado');

			$datos = $this->empresa->update($id,$mision,$vision,$objetivo,$descripcion,$estado,$slogan);
			if ($estado == 1) {
			$this->empresa->activar($id);
			$this->empresa->desactivar($id);
			$this->session->set_flashdata('notice', 'Los datos de empresa han sido editados correctamente!');
			redirect('EmpresaController');
			}else{
				$this->session->set_flashdata('alert', 'Los datos de empresa no se han podido editar');
				redirect('EmpresaController');
			} //fin if Estado	

		}	
		}else{
			redirect('LoginController','refresh');
		}
	}


	public function detallesEmpresa(){

		if(isset($_POST['empid'])){

			$idred = $this->input->post('empid');
			$redid  = intval($idred);
			$empresa = $this->empresa->findById($redid);
			$empre = array(	
    		  'mision' => $empresa->get('emp_mision'),
    		  'vision' => $empresa->get('emp_vision'),
    		  'objetivo' => $empresa->get('emp_objetivo'),
    		  'descripcion' => $empresa->get('emp_descripcion'),
    		  'estado'=> $empresa->get('emp_estado'),
    		  'slogan'=> $empresa->get('emp_slogan')
    		  );
			echo json_encode($empre);
		
		 }else{
            return "existen campos vacíos";

        }

	}

	public function eliminarEmpresa(){
		if($this->session->userdata('login') == TRUE){

		if(isset($_POST['empid'])){

		$empid 	= $this->input->post('empid');
		$redid  = intval($empid);
		$datos = $this->empresa->delete($redid);
		$this->session->set_flashdata('notice', 'Los datos de empresa con id= '.$redid.' han sido eliminados correctamente!');
		redirect('EmpresaController','refresh');
		}else{
			$this->session->set_flashdata('alert', 'No se han podido eliminar los datos de empresa');
			redirect('EmpresaController');
		}
			
		}else{
			redirect('LoginController','refresh');
		}
	}

}

/* End of file empresaController.php */
/* Location: ./application/controllers/empresaController.php */