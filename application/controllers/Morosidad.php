<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Morosidad extends CI_Controller {
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
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Morosidad'), TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->template->content->view('morosidad', $this->data);
		$this->template->publish('template');
	}

	public function mes_corr(){
		//code
	}
	

}//end of class
