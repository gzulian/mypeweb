<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('class.phpmailer.php');
require('class.smtp.php');

class MsjController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Newsletter_model','newsletter',true);
		$this->load->model('Newslog_model','newslog',true);
		$this->load->model('Customer_model','customer',true);
		$this->load->model('Configuration_model','conf',true);
		$this->load->library('session');
	}


	public function index()
	{
		if ($this->session->userdata('login') == TRUE) {
			$datitos['customer']=$this->customer->findCusLogSleByType(1,1);
			$datitos['log']=$this->conf->findAllActivados();
			$this->load->view('msj',$datitos,FALSE);
		}else{
			redirect('LoginController','refresh');
		}
	}

	public function msjRespondidos(){
		if ($this->session->userdata('login') == TRUE) {
			$datitos['customer']=$this->customer->findCusLogSleByType(2,2);
			$datitos['log']=$this->conf->findAllActivados();
			$this->load->view('msjRes',$datitos,FALSE);
		}else{
			redirect('LoginController','refresh');
		}
	}
		
	public function msjAll(){
			if ($this->session->userdata('login') == TRUE) {
				$datitos['customer']=$this->customer->findAllCusLogSle();
				$datitos['log']=$this->conf->findAllActivados();
				$this->load->view('msjAll',$datitos,FALSE);
			}else{
				redirect('LoginController','refresh');
			}
		}
			
	public function eliminarMsj(){
		if ($this->session->userdata('login')==TRUE) {
			if(isset($_POST['logId'])&&isset($_POST['newId'])){
				$datos = $this->input->post();
				$logId=$datos['logId'];
				$newId=$datos['newId'];

				$comprobar=$this->newslog->delete($logId);
				$comprobarDos=$this->newsletter->delete($newId);
				var_dump($comprobar.$comprobarDos);
				$this->session->set_flashdata('notice', 'Mensaje eliminado correctamente!');
				redirect('MsjController');

			}else{
				$this->session->set_flashdata('alert', 'El mensaje no se ha podido eliminar');
				redirect('MsjController','refresh');
			}
		}
	}

	public function viewCorreos(){
		if ($this->session->userdata('login')==TRUE) {
			
			$datitos['customer']=$this->customer->findAll();
			$datitos['log']=$this->conf->findAllActivados();
			$this->load->view('correos',$datitos,FALSE);
		}
	}

	public function enviarMsj(){

		if ($this->session->userdata('login')==TRUE) {
			if(isset($_POST['mailToSend']) && isset($_POST['subject']) && isset($_POST['text'])) {

				$username='correo@dominio.cl';
				$clave='clave123';
				$name='nombre admin elección';
				$number='58585425';

				$datos = $this->input->post();
				$tema = $datos['subject'];
				$cuerpo=$datos['text'];
				$newslogid=$datos['newlogid'];
				date_default_timezone_set("America/Santiago");
				$date = date("Y-m-d H:i:s");

				$cusId=$this->customer->save($name,$username,$number,$date);
				$newId=$this->newsletter->save($tema,$cuerpo);
				$this->newslog->save($date,$cusId,$newId,2,2);
				$newlogUp  =  array(
							'log_state'=>2
							);
				$this->newslog->update($newslogid,$newlogUp);

				$this->session->set_flashdata('notice', 'Mensaje enviado correctamente!');
				redirect('MsjController','refresh');
				/*

				Aplicar esto  en Servidor .
				$email = $datos['mailToSend'];
			
		  		//Configuración de correo
				$mail = new PHPMailer();
				$mail->IsSMTP();                                      // el método
				$mail->Host = "www.dominio.cl";  // nombre del dominio
				$mail->SMTPAuth = true;     // no cambiar
				$mail->Username = $username;  // SMTP nombre del correo en el servidor
				$mail->Password = $clave; // SMTP contraseña
				$mail->From = $username;
				$mail->FromName = $name;        // remitente
				$mail->AddAddress($email);        // destinatario
				$mail->AddCC($email,"Copia Correo"); //copia

				//$mail->AddReplyTo("correo@correo.cl", "respuesta a:");    // responder a

				$mail->WordWrap = 50;     // set word wrap to 50 characters
				$mail->IsHTML(true);     // set email
				$mail->Subject = $tema;
				$mail->Body    = $cuerpo;


				if(!$mail->Send()){
				   echo "El correo no se pudo enviar. <p>";
				   echo "Error de envío: " . $mail->ErrorInfo;

				}*/



			}
		}
	}
	

}

/* End of file msjController.php */
/* Location: ./application/controllers/msjController.php */