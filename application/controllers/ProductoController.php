<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductoController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('login')){
		$this->load->model('Product_model','productos',true);
		$this->load->model('Multimedia_model','multimedia',true);
		$this->load->model('Category_model','categoria',true);
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('form_validation');

		$config['upload_path']          = './resources/images/products/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 20480;
        $config['overwrite']            = true;
        $this->upload->initialize($config);
        $this->load->library('upload');
    	}else{
    		redirect('/','refresh');
	    }
		
	}
	public function index()
	{

		$datitos['productos']=$this->productos->findAll();
		$datitos['multimedia']=$this->multimedia->findAll();
		$datitos['categoria']=$this->categoria->findAll();
		$datitos['log']=$this->conf->findAllActivados();
		$this->load->view('productos',$datitos,FALSE);

	}
	public function agregarProductos(){
	   	$datitos['productos']=$this->productos->findAll();
		$datitos['multimedia']=$this->multimedia->findAll();
		$datitos['categoria']=$this->categoria->findAll();
		$datitos['subcategorias']=$this->categoria->findAllSubcat();
		$datitos['categoriaspadres']=$this->categoria->findAllCatvac();
		$datitos['log']=$this->conf->findAllActivados();
    	$this->load->view('nuevoproducto',$datitos,FALSE);

		}
	public function agregarProductoslisto(){
	   
		if($this->session->userdata('login') == TRUE ){
		if($this->input->post()){	
			$product= $this->productos->create($this->input->post('product'));
	    	$product->insert();
	    	$this->session->set_flashdata('notice', 'Elemento editado exitosamente');
		/*Manipulación y archivos*/
		if(isset($_FILES) && count($_FILES) >= 1){
    		$errors = array();
    		foreach ($_FILES as $key => $file) {
    			//obtenemos número de imagen
    			$imageNumber = explode("_", $key);
    			if(isset($imageNumber[1])){
    				//creamos nombre
    				$imageNumber = $imageNumber[1];
	    			$name 		 = "PRO-".$product->get('pro_id')."-".$imageNumber;
	    			if ($this->upload->do_upload($key,$name)) {
	                    $succesFile = $this->upload->data();
	                	$multimediaData = array(
	                		'mul_pro_id' => $product->get('pro_id'),
							'mul_name' => $succesFile['file_name'],
							'mul_route' => $succesFile['full_path'],
							'mul_position' => $imageNumber  ,
							'mul_status' => 1
							);
	                	$multimedia = $this->multimedia->create($multimediaData);
	                	$multimedia->insert();
	                	$this->session->set_flashdata('notice', 'El Producto con nombre = '.$multimedia->get('mul_name').' ha sido creado correctamente!');
	                }
	                else{
	                    $errors[] = "Archivo: ".$key." inválido";
	                }	
    			}else{
    				$errors[] = "Archivo: ".$key." inválido";
    			}
	    	}
	    	//enviamos errores
	    	if(count($errors) > 0){
	    		foreach($errors as  $error){
					$this->session->set_flashdata('alert', $error);
	    		}
	    	}
	    }
		/*fin manipulación de archivos*/
		redirect('ProductoController/index');

			}else{
		$this->session->set_flashdata('alert', 'El producto no se ha podido añadir, favor verificar los datos ingresados');
		redirect('ProductoController/index');
		}
		
		}else{
			redirect('LoginController');	
		}
	}
	public function editarProductos(){
		$idpro                       = $this->input->post('idpro');
		$proid                       = intval($idpro);	
		
		if($proid > 0){
			$cookie_name = "proid";
			$cookie_value = $proid ;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		}else{
			$proid = $_COOKIE['proid'];
		}
		//$datitos['productos']        =$this->productos->findAll();
		$product = $this->productos->findById($proid);
		//print_r($product); exit();
		if($product){	
			if($this->input->post('edit')){	
		    	$product->setColumns($this->input->post('product'));
		    	$product->update();
		    	$this->session->set_flashdata('notice', 'Elemento editado exitosamente');
				//manipulación de archivos
		    	if(isset($_FILES) && count($_FILES) >= 1){
		    		$errors = array();
		    		foreach ($_FILES as $key => $file) {
		    			//obtenemos número de imagen
		    			if($file['error'] == 0){
		    				$imageNumber = explode("_", $key);
			    			if(isset($imageNumber[1])){
			    				//creamos nombre
			    				$imageNumber = $imageNumber[1];
				    			$name 		 = "PRO-".$product->get('pro_id')."-".$imageNumber;
				    			if ($this->upload->do_upload($key,$name)) {
				                    $succesFile = $this->upload->data();
				                    $search = array('mul_pro_id'=>$product->get('pro_id'),'mul_position'=>$imageNumber);
				                    $multimedia = $this->multimedia->find($search);
				                    if(is_null($multimedia)){
				                    	$multimediaData = array(
				                		'mul_pro_id' => $product->get('pro_id'),
										'mul_name' => $succesFile['file_name'],
										'mul_route' => $succesFile['full_path'],
										'mul_position' => $imageNumber  ,
										'mul_status' => 1
										);
					                	$multimedia = $this->multimedia->create($multimediaData);
					                	$multimedia->insert();
				                    }else{
				               			$multimedia->set('mul_name', $succesFile['file_name']);     	
				               			$multimedia->set('mul_route', $succesFile['full_path']);   
				               			$multimedia->update2();  	
				                    }
				                	$this->session->set_flashdata('notice', 'El Imagen cargada  exitosamente!');
				                }
				                else
				                {
				                    $errors[] = "Archivo: ".$key." inválido";
				                }	
			    			}else{
			    				$errors[] = "Archivo: ".$key." inválido";
			    			}
			    		}
			    	}
			    	//enviamos errores
			    	if(count($errors) > 0){
			    		foreach($errors as  $error){
							$this->session->set_flashdata('alert', $error);
			    		}
			    	}

			    }
			    
			    if($this->input->post('orden')){
			    	$multimedia =  $this->multimedia->findById($this->input->post('orden'));
			    	if($multimedia){
			    		$multimedia->set("mul_position",1);
			    		$multimedia->update2();
			    		$this->multimedia->reodenar($multimedia);
			    		$this->session->set_flashdata('notice', 'Imagen '.$multimedia->get('mul_name').' ha sido asignada como portada de producto');
			    	}
			    }
			}
			//datos pata vista
			$datitos['categoria']        =$this->categoria->findAll();
			$datitos['subcategorias']    =$this->categoria->findAllSubcat();
			$datitos['categoriaspadres'] =$this->categoria->findAllCatvac();
			$datitos['productoseditar']  =$product;
			$datitos['log']              =$this->conf->findAllActivados();
			$datitos['multimedia']       = $this->multimedia->findByProId($proid);
			$datitos['proid']            = $proid;
			//fin datos para vista
			$this->load->view('editarproducto',$datitos,FALSE);
		}else{
			redirect('/','refresh');
		}
	}

	public function detalleProductos(){
		if($this->session->userdata('login')){

			if($this->input->post()){

			$idpro = $this->input->post('idpro');
			$proid  = intval($idpro);
			$productos = $this->productos->findById($proid);

			$Prodet = array(
				'id' => $productos->get('pro_id'),
                'nombre' => $productos->get('pro_name'),
                'subtitulo'=> $productos->get('pro_subtitle'),
                'descripcion' => $productos->get('pro_description'),
                'precio' => $productos->get('pro_price'),
                'moneda' => $productos->get('pro_currency'),
                'estado' => $productos->get('pro_status'),
                'categoria' => $productos->get('pro_cat_id'),
                'descuento' => $productos->get('pro_discount'),
                'precio' => $productos->get('pro_total'));
				echo json_encode($Prodet); 
				
			}
		}else{
			redirect('LoginController','refresh');
		}
          
	}
	public function eliminarProductos(){

		$idpro 	= $this->input->post('idpro');
		$proid  = intval($idpro);
		$datos = $this->productos->delete($proid);
		redirect('ProductoController/index');
	}
	public function viewPosProd(){

		$datitos['productos']=$this->productos->findAll();
		$datitos['categoria']=$this->categoria->findAll();
		$datitos['log']=$this->conf->findAllActivados();
		$datitos['multimedia']=$this->multimedia->findAll();
		$this->load->view('editprodPosition',$datitos,FALSE);

	}

	public function guardar(){
		$idArray = explode(",",$_POST['ids']);
        $db = $this->productos->updateOrder($idArray);
        redirect('ProductoController/index');
	} 
	}?>
