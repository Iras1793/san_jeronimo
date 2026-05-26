<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Propietarios extends CI_Controller {
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
		'assets/js/datatables.min.js'
	);

	var $estilos = array(
		'assets/css/datatables.min.css'
	);

	public function __construct(){
	    parent::__construct();
		$this->data['javascript'] = $this->javascript;
		$this->data['estilos']    = $this->estilos;
	}


	public function index(){
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Propietarios'), TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->template->content->view('propietarios', $this->data);
		$this->template->publish('template');
	}

	public function agregar(){
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Propietarios / Agregar nuevo'), TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->template->content->view('propietarios_agregar', $this->data);
		$this->template->publish('template');
	}
	

}//end of class
