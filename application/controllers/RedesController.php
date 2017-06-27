<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RedesController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Redes_model','redes',true);
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('session');
	}
	public function index()
	{
		$datitos['redes']=$this->redes->findAll();
		$datitos['log']=$this->conf->findAllActivados();
		$this->load->view('redes',$datitos,FALSE);
	}

	public function agregarRedes(){
		if(isset($_POST['nombrered']) && isset($_POST['urlred']) || !empty($_POST['nombrered']) && !empty($_POST['urlred'])) {
			$nombrered 	= $this->input->post('nombrered');
			$urlred		= $this->input->post('urlred');
			$tipo = '';

			if($nombrered == 'Facebook'){
			
			$icono = 'fa fa-facebook';

			}
			if($nombrered == 'Twitter'){

			$icono = 'fa fa-twitter';	

			}
			if ($nombrered == 'Instagram') {
			
			$icono = 'fa fa-instagram';	
			}
			if ($nombrered == 'Google+') {
			
			$icono = 'fa fa-google';	
			}
			
			if($nombrered == 'Tumblr'){

			$icono = 'fa fa-tumblr';	
			}

			if($nombrered == 'Linkedin'){

			$icono = 'fa fa-linkedin';	
			}

			if($nombrered == 'GitHub'){

			$icono = 'fa fa-github';	
			}

			$datos = $this->redes->save($nombrered,$tipo,$urlred,$icono);
			$this->session->set_flashdata('notice', 'La red Social con nombre = '.$nombrered.' ha sido creada correctamente!');
			redirect('RedesController/index');
		}else{
			$this->session->set_flashdata('alert', 'La red Social no se ha podido crear');
			redirect('RedesController/index');
		}
	} //Fin agregar Redes

	public function eliminarRedes(){

		if(isset($_POST['idred'])){

		$idred 	= $this->input->post('idred');
		$redid  = intval($idred);
		$datos = $this->redes->delete($redid);
		$this->session->set_flashdata('notice', 'La red Social con la id = '.$redid.' ha sido eliminada correctamente!');
		redirect('RedesController','refresh');

		}else{
			$this->session->set_flashdata('alert', 'La red Social no se ha podido eliminar correctamente!');
			redirect('RedesController/index');
		}
		

	}

	public function editarRedes(){

		if(isset($_POST['editnombrered']) && isset($_POST['editurlred'])) {
			$idred 	= $this->input->post('editidred');
			$redid  = intval($idred);
			$nombrered 	= $this->input->post('editnombrered');
			$urlred		= $this->input->post('editurlred');
			$tipo = '';

			if($nombrered == 'Facebook'){
			
			$icono = 'fa fa-facebook';

			}
			if($nombrered == 'Twitter'){

			$icono = 'fa fa-twitter';	

			}
			if ($nombrered == 'Instagram') {
			
			$icono = 'fa fa-instagram';	
			}
			if ($nombrered == 'Google+') {
			
			$icono = 'fa fa-google';	
			}
			
			if($nombrered == 'Tumblr'){

			$icono = 'fa fa-tumblr';	
			}

			if($nombrered == 'Linkedin'){

			$icono = 'fa fa-linkedin';	
			}

			if($nombrered == 'GitHub'){

			$icono = 'fa fa-github';	
			}
		
			$datos = $this->redes->update($redid,$nombrered,$tipo,$urlred,$icono);
			$this->session->set_flashdata('notice', 'La red Social con nombre = '.$nombrered.' ha sido editada correctamente!');
			redirect('RedesController/index');
		}else{
			$this->session->set_flashdata('alert', 'La red Social no se ha podido editar');
			redirect('RedesController/index');
		}


	}

	public function detalleRedes(){

		if(isset($_POST['idred'])){

			$idred = $this->input->post('idred');
			$redid  = intval($idred);
			$redes = $this->redes->findById($redid);

			$redessociales = array('id' => $redes->get('red_id'),
                'nombre' => $redes->get('red_nom'),
                'tipo'=> $redes->get('red_tip'),
                'url' => $redes->get('red_url'),
                'icono' => $redes->get('red_ico'));
			echo json_encode($redessociales);
		
		 }else{
            return "existen campos vacíos";

        }
	}



}

/* End of file redesController.php */
/* Location: ./application/controllers/redesController.php */