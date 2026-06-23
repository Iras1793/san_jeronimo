<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {
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
		$this->load->view('login', $this->data);
	}



}
