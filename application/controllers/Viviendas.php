<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Viviendas extends CI_Controller {
    var $data = array('title'=>'Unión San Jerónimo - Bilbao');
	var $fields = array(
			'calle' => array('value'=>'','validate' => array(
											'label'   => 'Calle',
											'rules'   => 'trim|xss_clean|required'
										)),
			'numero' => array('value'=>'','validate' => array(
											'label'   => 'Número',
											'rules'   => 'trim|xss_clean|required|is_natural_no_zero'
										)),
			'lote' => array('value'=>'','validate' => array(
											'label'   => 'Lote',
											'rules'   => 'trim|xss_clean|required|is_natural_no_zero'
										)),
			'mz' => array('value'=>'','validate' => array(
											'label'   => 'Manzana',
											'rules'   => 'trim|xss_clean|required|is_natural_no_zero'
										)),
			'prototipo' => array('value'=>'','validate' => array(
											'label'   => 'Prototipo',
											'rules'   => 'trim|xss_clean|required'
										)),
			'codigo_identificador' => array('value'=>'','validate' => array(
											'label'   => 'Código identificador',
											'rules'   => 'trim|xss_clean|required'
										)),
			'numero_marbetes_autorizados' => array('value'=>'','validate' => array(
											'label'   => 'Número de marbetes autorizados',
											'rules'   => 'trim|xss_clean|required|is_natural_no_zero'
										)),
			'fecha_entrega' => array('value'=>'','validate' => array(
											'label'   => 'Fecha de entrega',
											'rules'   => 'trim|xss_clean|required'
										)),
			'propietario' => array('value'=>'','validate' => array(
											'label'   => 'Propietario',
											'rules'   => 'trim|xss_clean|required|is_natural_no_zero'
										)),

	);

	var $tabla = 'viviendas';
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
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Viviendas'), TRUE);
		$this->data['footer']        = $this->load->view('footer', '', TRUE);
		$this->general->table        = $this->tabla;
		$this->general->id           = $this->id;
		$this->data['records']       = $this->general->get(null, array('status'=>TRUE));
		if($this->data['records']):
			foreach($this->data['records'] as $key=>$value):
				$value->calle                       = $this->crypto->descifrar($value->calle);
				$value->numero                      = $this->crypto->descifrar($value->numero);
				$value->lote                        = $this->crypto->descifrar($value->lote);
				$value->mz                          = $this->crypto->descifrar($value->mz);
				$value->prototipo                   = $this->crypto->descifrar($value->prototipo);
				$value->numero_marbetes_autorizados = $this->crypto->descifrar($value->numero_marbetes_autorizados);
				$value->codigo_identificador        = $this->crypto->descifrar($value->codigo_identificador);
				$value->fecha_entrega               = $this->crypto->descifrar($value->fecha_entrega);
			endforeach;
		endif;
		$this->template->content->view('viviendas', $this->data);
		$this->template->publish('template');
	}

	public function agregar(){
		$this->data['javascript']    = array('assets/js/jquery.min.js', 'assets/js/jquery.validate.js');
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Viviendas / Agregar nuevo'), TRUE);
		$this->messages->clear();
		$this->config_validates();
		
		$this->general->table = 'propietarios';
		$this->general->id    = 'id';
		$lista_propietarios = $this->general->get(null, array('status'=>TRUE), 'id, nombres, apellido_paterno, apellido_materno');
		$this->data['lista_propietarios'] = array();
		foreach ($lista_propietarios as $key => $data):
			# log_message("error", print_r($data, TRUE));
			$data->nombres = $this->crypto->descifrar($data->nombres);
			$data->apellido_paterno = $this->crypto->descifrar($data->apellido_paterno);
			$data->apellido_materno = $this->crypto->descifrar($data->apellido_materno);
			array_push($this->data['lista_propietarios'], $data);
		endforeach;

		if( $this->form_validation->run() != FALSE ):

			#log_message('error', print_r($this->fields, TRUE));
			#Retiramos la clave 'propietarios' pues es FK de otra tabla
			$propietario = $this->fields['propietario']['value'];
			unset($this->fields['propietario']);

			$this->general->table = $this->tabla;
			$this->general->id    = $this->id;
			foreach( $this->fields as $key=>$field ):
				if($this->fields[$key]['value']!='')
					$this->fields[$key]['value'] = $this->crypto->cifrar($this->fields[$key]['value']);
			endforeach;
			
			$success = $this->general->insert($this->fields);
			if($success):
				$id = $this->db->insert_id();
				log_message('error', "ultimo id: ".$id);
				$this->general->table = 'viviendas_propietarios';
				$this->general->id    = 'id';

				if($this->general->insert(
						array(
							'vivienda'    => array('value'=>$id),
							'propietario' => array('value'=>$propietario)
						)
					)
				):
					$this->messages->add('Registro agregado', 'success');
					foreach( $this->fields as $key=>$field ):
						$this->fields[$key]['value'] = '';
					endforeach;
					$this->fields['propietario']['value'] = ''; #se vuelve a crear la clave
				endif;

			else:
				$this->messages->add("<strong>Llene los campos</strong>","error");
			endif;
		endif;
		$this->data['action'] = 'agregar';
		$this->data['id']     = '';
		$this->data['fields'] = $this->fields;
		$this->data['footer'] = $this->load->view('footer', '', TRUE);
		$this->template->content->view('viviendas_form', $this->data);
		$this->template->publish('template');
	}
	
	public function editar($id=''){
		if( is_null($id) || !is_numeric($id) || $id <= 0):
			redirect('viviendas');
		endif;
		$this->data['javascript']    = array('assets/js/jquery.min.js', 'assets/js/jquery.validate.js');
		$this->data['menu_superior'] = $this->load->view('menu_superior', array('breadcrumb' => 'Viviendas / Editar registro'), TRUE);
		$this->data['footer']        = $this->load->view('footer', '', TRUE);		

		//logica
		$this->general->table = 'propietarios';
		$this->general->id    = 'id';
		$lista_propietarios = $this->general->get(null, array('status'=>TRUE), 'id, nombres, apellido_paterno, apellido_materno');
		$this->data['lista_propietarios'] = array();
		foreach ($lista_propietarios as $key => $data):
			# log_message("error", print_r($data, TRUE));
			$data->nombres = $this->crypto->descifrar($data->nombres);
			$data->apellido_paterno = $this->crypto->descifrar($data->apellido_paterno);
			$data->apellido_materno = $this->crypto->descifrar($data->apellido_materno);
			array_push($this->data['lista_propietarios'], $data);
		endforeach;
		# log_message("error", print_r($this->data['lista_propietarios'], TRUE));
		$this->general->table = $this->tabla;
		$this->general->id    = $this->id;
		$this->messages->clear();
		$this->config_validates();		
		if( $this->form_validation->run() != FALSE && $id > 0):
			log_message('error', print_r($this->fields, TRUE));
			$propietario = $this->fields['propietario']['value'];
			unset($this->fields['propietario']);
			
			foreach($this->fields as $key=>$field):
				if($this->fields[$key]['value']!='')
					$this->fields[$key]['value'] = $this->crypto->cifrar($this->fields[$key]['value']);
			endforeach;
			

			log_message('error','=======>mendigo propietario: '.$propietario);
			$success = $this->general->actualiza($this->fields, $id, [
			    'viviendas_propietarios' => [
			        'fk_local' => 'vivienda',   // filtra por id de vivienda = $id
			        'update'   => [
			            'propietario'              => $propietario,
			            'fecha_actualizacion' => date('Y-m-d H:i:s')
			        ],
			        'where_conditions' => [
			            'propietario' => $propietario      // además filtra por id del propietario = 5, sin cifrar para no pex
			        ]
			    ]
			]);
			log_message('error', "==========>Success: ".$success);
			if($success):
				$this->messages->add("Registro actualizado","success");
			else:
				$this->messages->add("Ingrese toda la información solicitada","error");
			endif;
			/*
			$success = $this->general->update($this->fields, $id);
			if ($success):
				$this->general->table = 'viviendas_propietarios';
				$this->general->id    = 'id';
				if($this->general->update(
						array(
						'vivienda'     => array('value'=>$this->crypto->cifrar($id))
						,'propietario' => array('value'=>$propietario) #ya viene cifrado
						),

					)

				):
					*/			
		endif;
		$info = $this->general->get($id,array('status'=>TRUE), '*');
		# log_message('error', print_r($info, TRUE));
		foreach($this->fields as $key => $value):
			if($key=='propietario')
				continue;
			if( $info[0]->$key!='')
				$this->fields[$key]['value'] = $this->crypto->descifrar($info[0]->$key);
		endforeach;
		$this->fields['propietario']['value'] = '';
		#obtenemos propietario de vivienda
		$this->general->table='viviendas_propietarios';
		$propietario = $this->general->get(null,array('status'=>TRUE, 'vivienda'=>$id), 'propietario');
		if($propietario):
			$this->fields['propietario']['value'] = $propietario[0]->propietario;
		endif;
		
		//termina logica
		$this->data['action'] = 'editar';
		$this->data['id']     = $id;
		$this->data['fields'] = $this->fields;
		$this->data['info']   = $info;
		$this->template->content->view('viviendas_form', $this->data);
		$this->template->publish('template');
	}


	public function eliminar($id=null){
		if( is_null($id) || !is_numeric($id) || $id <= 0)
			redirect("viviendas");

		$this->messages->clear();
		$this->general->table = $this->tabla;
		$this->general->id    = $this->id;
		$campos['status']['value'] = 0;
		$success = $this->general->update($campos, $id);
		if ($success):
			#if($this->general->update($campos, $id))
			/*
			Cuidado, revisar si es funcional así o de plano eliminar también de la tabla pivote
			*/
			$this->messages->add("<strong>Registro eliminado</strong>","success");
			log_message("error", "\nPasa la eliminación");
			#endif;
		else:
			$this->messages->add("<strong>Error, intente más tarde</strong>","error");
		endif;
		redirect("viviendas");
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
