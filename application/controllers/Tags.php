<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Tags extends CI_Controller {
    var $data = array('title'=>'Unión San Jerónimo - Bilbao');
	var $fields = array(
			'numero_serie' => array('value'=>'','validate' => array(
											'label'   => 'Número de serie',
											'rules'   => 'trim|xss_clean|required'
										)),

			'tipo' => array('value'=>'','validate' => array(
											'label'   => 'Tipo',
											'rules'   => 'trim|xss_clean|required'
										)),
			'asignado_a' => array('value'=>'','validate' => array(
											'label'   => 'Asignado a',
											'rules'   => 'trim|xss_clean|numeric|required'
										)),
			'fecha_asignacion' => array('value'=>'','validate' => array(
											'label'   => 'Fecha de asignación',
											'rules'   => 'trim|xss_clean|required'
										)),
			'fecha_activacion' => array('value'=>'','validate' => array(
											'label'   => 'Fecha de activación',
											'rules'   => 'trim|xss_clean|required'
										)),
			'activado' => array('value'=>'','validate' => array(
											'label'   => 'Activado',
											'rules'   => 'trim|xss_clean|required'
										))
	);

	var $tabla = 'tags';
	var $id    = 'id';

	var $javascript = array(
		'assets/js/jquery.min.js',
		'assets/js/JSZip.min.js',
		'assets/js/pdfmake.min.js',
		'assets/js/datatables.min.js',
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
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Tags'), TRUE);
		$this->data['footer']        = $this->load->view('footer', '', TRUE);
		$this->general->table        = $this->tabla;
		$this->general->id           = 'tags.id';
		$this->data['tags']    = $this->general->get(null, array('tags.status'=>TRUE),'tags.*, viviendas.calle, viviendas.numero', '', true, array('viviendas'=>'tags.asignado_a=viviendas.id'));
		if($this->data['tags']):
			foreach ($this->data['tags'] as $key => $value):
				$value->numero_serie = $this->crypto->descifrar($value->numero_serie);
				$value->tipo         = $this->crypto->descifrar($value->tipo);
				$value->calle        = $this->crypto->descifrar($value->calle);
				$value->numero       = $this->crypto->descifrar($value->numero);
			endforeach;
		endif;
		$this->template->content->view('tags', $this->data);
		$this->template->publish('template');
	}

	public function agregar(){
		$this->data['javascript'] = array('assets/js/jquery.min.js', 'assets/js/jquery.validate.js');
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Tags / Agregar nuevo'), TRUE);
		
		$this->general->table ='viviendas';
		$this->general->id    = 'id';
		$viviendas = $this->general->get(null, array('status'=>TRUE), "id, calle, numero");
		$this->data['viviendas'] = array();
		# log_message('error', print_r($viviendas, TRUE));
		foreach ($viviendas as $key => $data):
			$data->calle = $this->crypto->descifrar($data->calle);
			$data->numero = $this->crypto->descifrar($data->numero);
			array_push($this->data['viviendas'], $data);
		endforeach;
		# log_message('error', print_r($this->data['viviendas'], TRUE));
		$this->messages->clear();
		$this->config_validates();
		if( $this->form_validation->run() != FALSE ):
			$this->general->table = $this->tabla;
			$this->general->id    = $this->id;
			# log_message('error', print_r($this->fields, TRUE));
			foreach( $this->fields as $key=>$field ):
				if($this->fields[$key]['value']!='' && ($key == 'numero_serie' || $key == 'tipo'))
					$this->fields[$key]['value'] = $this->crypto->cifrar($this->fields[$key]['value']);
			endforeach;
			$success = $this->general->insert($this->fields);
			if($success):
				$this->messages->add('Registro agregado', 'success');
				foreach( $this->fields as $key=>$field )
					$this->fields[$key]['value'] = '';
			else:
				$this->messages->add("<strong>Llene los campos</strong>","error");
			endif;
		endif;
		$this->data['action'] = 'agregar';
		$this->data['id']     = '';
		$this->data['fields'] = $this->fields;

		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->template->content->view('tags_form', $this->data);
		$this->template->publish('template');
	}
	
	private function config_validates(){
		$config = array();
		foreach( $this->fields as $key=>$field ){
			$field['validate']['field'] = $key;
			$config[] = $field['validate'];
		}
		$this->form_validation->set_rules($config);
		foreach( $this->fields as $key=>$field )
			$this->fields[$key]['value'] = $this->input->post($key,true);
	}//end config_validates


}//end of class
