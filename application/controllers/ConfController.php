<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('session');
	}

	public function index()
	{
		$datitos['conf']=$this->conf->findAll();
		$datitos['log']=$this->conf->findAllActivados();
		$this->load->view('config',$datitos,FALSE);
		
	}

	public function agregarConfiguracion(){

		if(isset($_POST['number']) && isset($_POST['background']) && isset($_POST['footer']) && isset($_POST['navbar']) && isset($_POST['name'])) {
			if($this->session->userdata('login') == TRUE){
			$number = $this->input->post('number');
			$email = $this->input->post('email');
			$background = $this->input->post('background');
			$footer = $this->input->post('footer');
			$navbar = $this->input->post('navbar');
			$video = $this->input->post('video');
			$nombre = $this->input->post('name');
			$fontcolor = $this->input->post('fontcolor');
			$fontstyle = $this->input->post('fontstyle');
			$fontsize = $this->input->post('fontsize');
			$productos = $this->input->post('productos');

			if($_FILES["logo"]["type"] == 'image/png' || $_FILES["logo"]["type"] == 'image/jpeg' || $_FILES["logo"]["type"] == 'image/jpg'){

			$tmp_name  = $_FILES["logo"]["tmp_name"];
			$name = basename($_FILES["logo"]["name"]);
			$explode = explode('.', $name);
			$extension = $explode['1'];
			$punto = ".";
			$img =  $_POST['name'];
			$imagen = $img.$punto.$extension;
			$ruta = "./resources/images/logo/{$imagen}";
			move_uploaded_file($tmp_name, "./resources/images/logo/{$imagen}");

		}else{
			$imagen = '';
		}

		if($_FILES["banner"]['type'] == 'image/png' || $_FILES["banner"]["type"] == 'image/jpeg' || $_FILES["banner"]["type"] == 'image/jpg' ){

			$tmp_banner  = $_FILES["banner"]["tmp_name"];
			$namebanner = basename($_FILES["banner"]["name"]);
			$explodebanner = explode('.', $namebanner);
			$extensionbanner = $explodebanner['1'];
			$puntobanner = ".";
			$imgbanner =  $_POST['name'];
			$imagenbanner = $imgbanner.$puntobanner.$extensionbanner;
			$ruta = "./resources/images/banner/{$imagenbanner}";
			move_uploaded_file($tmp_banner, "./resources/images/banner/{$imagenbanner}");	
		}else{
			$imagenbanner = '';
		}
			
			$datos = $this->conf->save($number,$email,$background,$footer,$navbar,$imagen,$video,$nombre,$fontcolor,$fontstyle,$fontsize,$imagenbanner,$productos);
			$this->session->set_flashdata('notice', 'Configuración registrada correctamente!');
			redirect('ConfController');
		}else{
			//por si intentan ingresar
				redirect('LoginController');
		}
	}else{
		//por si los datos vienen vacíos
		$this->session->set_flashdata('alert', 'Favor revisar los datos obligatorios');
		redirect('ConfController');
	}
	} //Fin agregar configuración

	public function editarConfiguracion(){
			if(isset($_POST['editnumber']) && isset($_POST['editbackground']) && isset($_POST['editfooter']) && isset($_POST['editnavbar']) && isset($_POST['editname'])) {
			if($this->session->userdata('login') == TRUE ){

			$id         = $this->input->post('editid');	
			$number     = $this->input->post('editnumber');
			$email      = $this->input->post('editemail');
			$background = $this->input->post('editbackground');
			$footer     = $this->input->post('editfooter');
			$navbar     = $this->input->post('editnavbar');
			$video      = $this->input->post('editvideo');
			$nombre     = $this->input->post('editname');
			$fontcolor  = $this->input->post('editfontcolor');
			$fontstyle  = $this->input->post('editfontstyle');
			$fontsize   = $this->input->post('editfontsize');
			$estado     = $this->input->post('editestado');
			$productos  = $this->input->post('productos');

			


			if($_FILES["editlogo"]["type"] == 'image/png' || $_FILES["editlogo"]["type"] == 'image/jpeg' || $_FILES["editlogo"]["type"] == 'image/jpg'){

			$tmp_name  = $_FILES["editlogo"]["tmp_name"];
			$name = basename($_FILES["editlogo"]["name"]);
			$explode = explode('.', $name);
			$extension = $explode['1'];
			$punto = ".";
			$img =  $_POST['editname'];
			$imagen = $img.$punto.$extension;
			$ruta = "./resources/images/logo/{$imagen}";

			unlink("./resources/images/logo/{$imagen}"); 
			clearstatcache(); 	
			move_uploaded_file($tmp_name, "./resources/images/logo/{$imagen}");

		}else{
			$imagen = $this->input->post('oldlogo');
		}

		if($_FILES["editbanner"]['type'] == 'image/png' || $_FILES["editbanner"]["type"] == 'image/jpeg' || $_FILES["editbanner"]["type"] == 'image/jpg' ){

			$tmp_banner      = $_FILES["editbanner"]["tmp_name"];
			$namebanner      = basename($_FILES["editbanner"]["name"]);
			$explodebanner   = explode('.', $namebanner);
			$extensionbanner = $explodebanner['1'];
			$puntobanner     = ".";
			$imgbanner       =  $_POST['editname'];
			$imagenbanner    = $imgbanner.$puntobanner.$extensionbanner;
			$ruta = "./resources/images/banner/{$imagenbanner}";
			unlink("./resources/images/banner/{$imagenbanner}"); 
			clearstatcache(); 
			move_uploaded_file($tmp_banner, "./resources/images/banner/{$imagenbanner}");	
		}else{
			$imagenbanner = $this->input->post('oldbanner');
		}
			

			$datos = $this->conf->update($id,$number,$email,$background,$footer,$navbar,$imagen,$video,$nombre,$fontcolor,$fontstyle,$fontsize, $estado,$imagenbanner,$productos);

			if ($estado == 1) {
			$this->conf->activar($id);
			$this->conf->desactivar($id);
			$this->session->set_flashdata('notice', 'La configuración con nombre = '.$nombre.' ha sido editada correctamente!');
			redirect('ConfController');
			}else{
				$this->session->set_flashdata('notice', 'La configuración con nombre = '.$nombre.' ha sido editada correctamente!');
				redirect('ConfController');
			} //fin if Estado		
			}else{
				//por si intentan ingresar
				redirect('LoginController');
			}
			}else{
			//si vienen vacíos los datos
			redirect('ConfController');
			}
	} //Fin editar configuración

	public function detallesConfiguracion(){
			if($this->session->userdata('login') == TRUE){
			if(isset($_POST['idconf'])){

			$idconf = $this->input->post('idconf');
			$confid  = intval($idconf);
			$conf = $this->conf->findById($confid);

			$configuration =  array(
          'number' => $conf->get('con_phonenumber'),
          'email'=> $conf->get('con_email'),
          'background' => $conf->get('con_background'),
          'footer' => $conf->get('con_footer'),
          'navbar' => $conf->get('con_navbar'),
          'logo' => $conf->get('con_logo'),
          'video' => $conf->get('con_video'),
          'nombre' => $conf->get('con_nombrefantasia'),
          'fontcolor' => $conf->get('con_fontcolor'),
          'fontstyle' => $conf->get('con_fontstyle'),
          'fontsize' => $conf->get('con_fontsize'),
          'estado' => $conf->get('con_status'),
          'banner' => $conf->get('con_banner'),
          'products' => $conf->get('con_products')
          );
			echo json_encode($configuration);
		
		 }else{
            return "existen campos vacíos";

        }
        }else{
        	redirect('LoginController');
        }
	} //Fin detalles configuración

	public function eliminarConfiguracion(){
		if($this->session->userdata('login') == TRUE){

		if(isset($_POST['idconf'])){

		$idconf 	= $this->input->post('idconf');
		$redid  = intval($idconf);
		$datos = $this->conf->delete($redid);
		$this->session->set_flashdata('notice', 'La configuración con id= '.$redid.' ha sido eliminada correctamente!');
		redirect('ConfController','refresh');
		}else{
			$this->session->set_flashdata('alert', 'No se ha podido eliminar la configuración');
			redirect('ConfController');
		}
		

	}else{
		redirect('LoginController');
	}
}//Fin eliminar configuración
}

/* End of file confController.php */
/* Location: ./application/controllers/confController.php */