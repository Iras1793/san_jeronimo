<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Propietarios extends CI_Controller {
    var $data = array('title'=>'Unión San Jerónimo - Bilbao');
	var $fields = array(
			'nombres' => array('value'=>'','validate' => array(
											'label'   => 'Nombres',
											'rules'   => 'trim|xss_clean|required|min_length[3]'
										)),

			'apellido_paterno' => array('value'=>'','validate' => array(
											'label'   => 'Apellido Paterno',
											'rules'   => 'trim|xss_clean|required|min_length[3]'
										)),
			'apellido_materno' => array('value'=>'','validate' => array(
											'label'   => 'Apellido Materno',
											'rules'   => 'trim|xss_clean|required|min_length[3]'
										)),			
			'numero_celular_1' => array('value'=>'','validate' => array(
											'label'   => 'Número celular 1',
											'rules'   => 'trim|xss_clean'
										)),
			'numero_celular_2' => array('value'=>'','validate' => array(
											'label'   => 'Número celular 2',
											'rules'   => 'trim|xss_clean'
										)),			
			'email' => array('value'=>'','validate' => array(
											'label'   => 'Email',
											'rules'   => 'trim|xss_clean|valid_email'
										)),
			'rfc' => array('value'=>'','validate' => array(
											'label'   => 'RFC',
											'rules'   => 'trim|xss_clean'
										)),
			'curp' => array('value'=>'','validate' => array(
											'label'   => 'CURP',
											'rules'   => 'trim|xss_clean'
										))
	);

	var $tabla = 'propietarios';
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
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Propietarios'), TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->general->table = $this->tabla;
		$this->general->id    = $this->id;
		$this->data['propietarios'] = $this->general->get(null, array('status'=>TRUE));
		if($this->data['propietarios']):
			foreach($this->data['propietarios'] as $key=>$value):
				$value->nombres = $this->crypto->descifrar($value->nombres);
				$value->apellido_paterno = $this->crypto->descifrar($value->apellido_paterno);
				$value->apellido_materno = $this->crypto->descifrar($value->apellido_materno);
				$value->numero_celular_1 = $this->crypto->descifrar($value->numero_celular_1);
				$value->numero_celular_2 = $this->crypto->descifrar($value->numero_celular_2);
				$value->email = $this->crypto->descifrar($value->email);
				$value->rfc = $this->crypto->descifrar($value->rfc);
				$value->curp = $this->crypto->descifrar($value->curp);
			endforeach;
		endif;
		$this->template->content->view('propietarios', $this->data);
		$this->template->publish('template');
	}

	public function agregar(){
		$this->data['javascript'] = array('assets/js/jquery.min.js', 'assets/js/jquery.validate.js');
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Propietarios / Agregar nuevo'), TRUE);
		$this->messages->clear();
		$this->config_validates();
		if( $this->form_validation->run() != FALSE ):
			$this->general->table = $this->tabla;
			$this->general->id = $this->id;
			foreach( $this->fields as $key=>$field ):
				if($this->fields[$key]['value']!='')
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
		$this->data['id'] = '';
		$this->data['fields'] = $this->fields;
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->template->content->view('propietarios_form', $this->data);
		$this->template->publish('template');
	}


	public function editar($id=''){
		if( is_null($id) || !is_numeric($id) || $id <= 0):
			redirect('propietarios');
		endif;
		$this->data['javascript'] = array('assets/js/jquery.min.js', 'assets/js/jquery.validate.js');
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Propietarios / Editar registro'), TRUE);
		$this->data['footer'] = $this->load->view('footer', '', TRUE);		
		$this->general->table = $this->tabla;
		$this->general->id    = $this->id;		
		//logica
		$this->messages->clear();
		$this->config_validates();		
		if( $this->form_validation->run() != FALSE && $id > 0):
			foreach($this->fields as $key=>$field):
				if($this->fields[$key]['value']!='')
					$this->fields[$key]['value'] = $this->crypto->cifrar($this->fields[$key]['value']);
			endforeach;
			$success = $this->general->update($this->fields, $id);
			if ($success):
				$this->messages->add("Registro actualizado","success");
			else:
				$this->messages->add("Ingrese toda la información solicitada","error");
			endif;
		endif;
		$info = $this->general->get($id,array('status'=>TRUE), 'id, nombres, apellido_paterno, apellido_materno, numero_celular_1, numero_celular_2, rfc, curp, email');
		foreach($this->fields as $key => $value):
			if( $info[0]->$key=='')
				continue;
			$this->fields[$key]['value'] = $this->crypto->descifrar($info[0]->$key);
		endforeach;		
		//termina logica
		$this->data['action'] = 'editar';
		$this->data['id']     = $id;
		$this->data['fields'] = $this->fields;
		$this->data['info'] = $info;
		$this->template->content->view('propietarios_form', $this->data);
		$this->template->publish('template');
	}


	public function eliminar($id=null){
		if( is_null($id) || !is_numeric($id) || $id <= 0)
			redirect("propietarios");

		$this->messages->clear();
		$this->general->table = $this->tabla;
		$this->general->id    = $this->id;
		$campos['status']['value'] = 0;
		$success = $this->general->update($campos, $id);
		if ($success):
			$this->messages->add("<strong>Registro eliminado</strong>","success");
			log_message("error", "\nPasa la eliminación");
		else:
			$this->messages->add("<strong>Error, intente más tarde</strong>","error");
		endif;
		redirect("propietarios");
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
