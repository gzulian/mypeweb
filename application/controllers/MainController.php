<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class MainController extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Config_model', 'conf');
		$this->load->model('Empresa_model', 'empresa');
		$this->configuration  = $this->conf->findAllActivados();
		$this->empresa = $this->empresa->getActive();
		if($this->configuration && $this->empresa){
			$this->load->model('Category_model', 'cat');
			$this->load->model('Multimedia_model', 'mul');
			$this->load->model('Product_model', 'prod');
			$this->load->model('Redes_model', 'redes');
			$this->load->model('Team_model', 'team');	
		}else{
			$this->load->view('web/default');
			//exit();
		}
		
	}
	
	public function index()
	{
		$data['config']         =$this->configuration ;
		$data['categoryParent'] =$this->cat->findAllParentActivados();
		//Productos para portada
		$limit                  = $data['config'][0]->get('con_products');
		$data['products']       =$this->prod->findAllActivados($limit);
		

		//print_r($data['multimedia']); exit();
		$data['redes']=$this->redes->findAll();
		$data['empresa']        = $this->empresa;	
		$this->load->view('web/header', $data);
		$this->load->view('web/home', $data);
		$this->load->view('web/footer', $data);

	}

	public function contacto(){
		$data['config']  =	$this->configuration ;
		$data['redes']   =	$this->redes->findAll();
		$data['empresa'] = 	$this->empresa;
		
		$this->load->view('web/header', $data);
		$this->load->view('web/contacto', $data);
		$this->load->view('web/footer', $data);

	}

	public function categoria($idcat=null){

		$categories = array();
		$data['categoryParent']=$this->cat->findAllParentActivados();
		if(!is_null($idcat) && is_numeric($idcat)){
			$cat=$this->cat->findById($idcat);
			if($cat){
				$categories[] =  $cat;
			}else{
				$this->session->flashdata('notice',"Categoría no encontrada.");
			}
		}else {
			$categories = $data['categoryParent'];
		}
		$data['config']     =$this->configuration ;
		$data['redes']      =$this->redes->findAll();
		$data['categories'] = $categories;
		$data['empresa']    = 	$this->empresa;
		$this->load->view('web/header',$data);
		$this->load->view('web/categoria',$data);
		$this->load->view('web/footer',$data);
	}
	public function productos($id=0){
		if($id!=0 && is_numeric($id)){
			$data['config']         =$this->configuration ;
			$data['categoryParent'] =$this->cat->findAllParentActivados();
			$data['product']        =$this->prod->findById($id);
			$data['empresa']        = 	$this->empresa;
			$data['redes']          =$this->redes->findAll();		
			$this->load->view('web/header',$data);
			$this->load->view('web/preview',$data);
			$this->load->view('web/footer',$data);

		}else{
			$data['config']         =$this->configuration ;
			$data['categoryParent'] =$this->cat->findAllParentActivados();
			$data['subCat']         =array();
			foreach ($data['categoryParent'] as $key) {
				$data['subCat'][$key->get('cat_id')]=$this->cat->findByParent($key->get('cat_id'));
			}
			$data['product']=$this->prodig;
			foreach ($data['product'] as $key) {
				$data['multimedia'][$key->get('pro_id')]=$this->mul->findByProId($key->get('pro_id'));
			}
			$data['redes']=$this->redes->findAll();
			$data['empresa'] = 	$this->empresa;
			$this->load->view('web/header', $data);
			$this->load->view('web/productos', $data);
			$this->load->view('web/footer', $data);
		}




	}
	public function Nosotros(){
		$data['config']			=$this->configuration ;		
		$data['redes']          =$this->redes->findAll();
		$data['equipo']         =$this->team->findAll();
		$data['cant']           =count($data['equipo']);
		$data['empresa']        = 	$this->empresa;
		$data['categoryParent'] =$this->cat->findAllParentActivados();
		$this->load->view('web/header',$data);
		$this->load->view('web/desc',$data);
		$this->load->view('web/footer',$data);

	}

	public function sendmail()
	{
		$this->load->library('email');
		$this->email->from('example@example.com', 'Daryl');
		$this->email->to($this->input->post('email'), $this->input->post('name'));

		$this->email->subject('Email Test');
		$this->email->message($this->input->post('message'));
		$this->email->send();
		var_dump($this->email->print_debugger());

	}
	public function search(){
		$results =  array();
		if($this->input->post('Product')){
			$parameter = str_replace("'", "", str_replace("/", "", $this->input->post('Product')));
			$results = $this->prod->find($parameter);

		}
		$data['results']        =  $results;
		$data['config']         =	$this->configuration ;		
		$data['redes']          =	$this->redes->findAll();
		$data['empresa']        = 	$this->empresa;
		$data['categoryParent'] =	$this->cat->findAllParentActivados();

		$this->load->view('web/header',$data);
		$this->load->view('web/search',$data);
		$this->load->view('web/footer',$data);
	}

}
