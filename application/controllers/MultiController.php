<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MultiController extends CI_Controller{
public function __construct()
	{
		parent::__construct();
		$this->load->model('Multimedia_model','multimedia',true);
		$this->load->model('Product_model','productos',true);
	}
	public function index()
	{

		$datitos['multimedia']=$this->multimedia->findAll();
		$datitos['productos']=$this->productos->findAll();

		
		$this->load->view('multimedia',$datitos,FALSE);
	}
		public function agregarMulti(){
    	
    	$mulproid = $this->input->post('mulpro');
		$nommuli= $this->input->post('nommul');
		$rutamul= $this->input->post('rutmul');
		$estadomul = $this->input->post('estmul');
		$datos = $this->multimedia->save($mulproid,$nommuli,$rutamul,$estadomul);
			redirect('MultiController/index');
		
		}
		 public function eliminarMulti(){

		

		$idmul 	= $this->input->post('idmul');
		$mulid  = intval($idmul);
		$datos = $this->multimedia->delete($mulid);
		redirect('MultiController/index');
		
		

	}
	public function editarMultimedia(){
		    $idmul 	= $this->input->post('editmul');
		    $mulid  = intval($idmul);
		    $mulproid = $this->input->post('editpromul');
			$mulnom	= $this->input->post('editnommul');
		    $mulrut = $this->input->post('editrutmul');
		    $mulest = $this->input->post('editestmul');
		    $datos = $this->multimedia->update($mulproid,$mulid,$mulnom,$mulrut,$mulest);
			redirect('MultiController/index');
		}
	public function guardar(){
		$idArray = explode(",",$_POST['ids']);
        $db = $this->multimedia->updateOrder($idArray);
        redirect('MultiController/index');
	} 
	
			
		
	public function detalleMulti(){
            $idmul = $this->input->post('idmul');
			$mulid  = intval($idmul);
			$multimedia = $this->multimedia->findById($mulid);

			$Muldet= array(
				'producto' => $multimedia->get('mul_pro_id'),
				'id'=> $multimedia->get('mul_id'),
                'nombre' => $multimedia->get('mul_name'),
                'ruta'=> $multimedia->get('mul_route'),
                'estado' => $multimedia->get('mul_status'),
                );
			echo json_encode($Muldet);
		
        
	}


}?>