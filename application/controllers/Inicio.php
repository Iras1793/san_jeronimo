<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Inicio extends CI_Controller {
    var $data = array('title'=>'Unión San Jerónimo - Bilbao');
	var $fields = array(
			'nombre' => array('value'=>'','validate' => array(
											'label'   => 'Nombre',
											'rules'   => 'trim|xss_clean|required'
										)),

			'correo' => array('value'=>'','validate' => array(
											'label'   => 'Correo',
											'rules'   => 'trim|xss_clean|valid_email'
										)),
			'telefono' => array('value'=>'','validate' => array(
											'label'   => 'Teléfono',
											'rules'   => 'trim|xss_clean|numeric'
										)),
			'mensaje' => array('value'=>'','validate' => array(
											'label'   => 'Mensaje',
											'rules'   => 'trim|xss_clean|required'
										))
	);


    var $javascript = array(
    );

    var $estilos = array(
	);

	public function __construct(){
	    parent::__construct();
		$this->data['javascript'] = $this->javascript;
		$this->data['estilos']    = $this->estilos;
	}


	public function index(){
		$this->template->content->view('inicio', $this->data);
		$this->template->publish('template');
	}

	public function contacto(){
		$result = array('result'=>false,'message'=>'Ocurrió un error al enviar la información, intente más tarde');
		$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean');
		$this->form_validation->set_rules('correo','Correo','trim|xss_clean');
		$this->form_validation->set_rules('mensaje','Mensaje','trim|required|xss_clean');
		$this->form_validation->set_rules('numero','Numero','trim|required|xss_clean');
		if( $this->form_validation->run() != FALSE ):
			log_message('error', json_encode($_POST));
			$body = "Nombre: ".$this->input->post('nombre', true)." | Correo: ".$this->input->post('correo', true)." | mensaje: ".$this->input->post('mensaje', true). " | Teléfono: ".$this->input->post('numero', true);
			if(!_send_mail("Tienes una nueva cotización", 'victorcruz1793@gmail.com', $body)):
				log_message("error", "Fallo al enviar correo a victorcruz1793@gmail.com");
			endif;
			if(!_send_mail("Tienes una nueva cotización", 'latrejocp@outlook.com', $body)):
				log_message("error", "Fallo al enviar correo a latrejocp@outlook.com");
			endif;
			$result['result'] = true;
			$result['message'] = 'Muchas gracias, en breve nos comunicaremos contigo';
		endif;
		echo json_encode($result);
	}

}
