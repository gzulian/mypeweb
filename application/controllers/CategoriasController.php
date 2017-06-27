<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model','categorias',true);
		$this->load->model('Configuration_model','conf',true);
	}
	public function index()
	{

		$datitos['categorias']=$this->categorias->findAll();
		$datitos['catParents']=$this->categorias->findAllCatvacias();
		$datitos['log']=$this->conf->findAllActivados();
		$this->load->view('categorias',$datitos,FALSE);
	}
    public function agregarCategorias(){
    	if(isset($_POST['nomcat']) && isset($_POST['estcat'])) {
    	$catname 	= $this->input->post('nomcat');
		$catparent	= $this->input->post('parcat');
		$catstatus = $this->input->post('estcat');
			
		
		$this->categorias->save($catname,$catparent,$catstatus);

			redirect('CategoriasController/index');
		}else{

			redirect('CategoriasController/index');
		}
	}

    public function eliminarCategorias(){

		

		$idcat 	= $this->input->post('idcat');
		$catid  = intval($idcat);
		$datos = $this->categorias->delete($catid);
		redirect('CategoriasController/index');
		
		

	}
	public function editarCategorias(){
		$idcat 	= $this->input->post('editcat');
			$catid  = intval($idcat);
			$catname 	= $this->input->post('editnomcat');
		    $catparent	= $this->input->post('editparcat');
		    $catstatus = $this->input->post('editestcat');
		    $datos = $this->categorias->update($catid,$catname,$catparent,$catstatus);
			redirect('CategoriasController/index');
	}
	public function guardar(){
		$idArray = explode(",",$_POST['ids']);
        $db = $this->categorias->updateOrder($idArray);
        redirect('CategoriasController/index');
	} 

	

public function detalleCategorias(){

			$idcat = $this->input->post('idcat');
			$catid  = intval($idcat);
			$categorias = $this->categorias->findById($catid);

			$Catdet = array(
				'id' => $categorias->get('cat_id'),
                'nombre' => $categorias->get('cat_name'),
                'parent'=> $categorias->get('cat_parent'),
                'estado' => $categorias->get('cat_status'),
                'posicion' => $categorias->get('cat_position'));
			echo json_encode($Catdet);
        
	}
 }?>
