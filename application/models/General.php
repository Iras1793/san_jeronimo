<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class General extends CI_Model {

	var $table  = 'tab_data';
	var $id     = 'iddata';
	var $fields = array();

	function __construct(){
		parent::__construct();
	}

	function insert( $cliente = null ){
		$this->fields = array();
		if( $cliente != null && is_array($cliente) ){
			foreach( $cliente as $key => $info )
				$this->fields[$key] = $info['value'];
			$this->fields['fecha'] = date('Y-m-d H:i:s');
			return $this->db->insert($this->table, $this->fields);
		}
		return false;
	}



	function get( $id = null, $filter = null, $select = "*", $limit = "", $escape = true, $join=null){

		if( $id != null )
			$this->db->where($this->id,$id);

		if( $limit != "" )
			$this->db->limit( $limit );

		if( $filter != null && is_array($filter) )
			foreach( $filter as $key=>$data )
				$this->db->where($key,$data,$escape);

		if ( $join != null && is_array($join) ) 
			foreach ($join as $key => $data) 
				$this->db->join($key, $data, $escape);
			
		$this->db->order_by($this->id,"desc");
		$this->db->select( $select, false );
		
		$query = $this->db->get( $this->table );

		if ($query->num_rows() >= 1)
			return $query->result();
		else
			return false;
	}


 
	public function update( $object = null, $idobject = null ){
		$fields = array();
		if( $object != null && is_array($object) && $idobject != null && is_numeric($idobject) ){

			foreach( $object as $key => $info )
				$fields[$key] = $info['value'];

			if( is_numeric($idobject) && $idobject > 0 )
				$this->db->where($this->id,$idobject);

			return $this->db->update($this->table, $fields);
		}

		return false;
	}


	function delete( $idobject = null ){

		if( $idobject != null && is_numeric($idobject) ){
			$this->db->where($this->id, $idobject);
			$this->db->delete($this->table);
			return true;
		}
		return false;
	}



	/**
	* Servicio encargado de buscar un usuario para login
	*/
	public function getLogin($usuario = '',$pwd='') {
		$this->db->where("username",$usuario);
		$this->db->where("password",md5($pwd));
		$query = $this->db->get( $this->table );
		if ($query->num_rows() >= 1)
			return $query->result();
		else
			return false;
	}


	public function getStock($value=''){
		$this->db->from('productos');
		$this->db->select('nombre, stock, codigo');
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() >= 1)
			return $query->result();
		else
			return false;
	}//end reporte function

	public function getVentasByCarrito(){
		$totales = array();
		$current_year = date('Y');
		for ($i=1; $i <= 3; $i++) { 
			$query = "
				select count(*) as total from ventas
				where idcarrito != 0 
				and status = 1 
				and YEAR(fecha_venta) = $current_year
				;
			";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0)
				array_push($totales, current($query->result()));
			$current_year = date("Y", strtotime("+".$i." year"));
		}
		return $totales;
	}//end getVentasByCarrito function

	public function getVentasExternas(){
		$totales = array();
		$current_year = date('Y');
		for ($i=1; $i <= 3; $i++) { 
			$query = "
				select count(*) as total from ventas
				where idcarrito = 0 
				and status = 1 
				and YEAR(fecha_venta) = $current_year
				;
			";
			$query = $this->db->query($query);
			if ($query->num_rows() > 0)
				array_push($totales, current($query->result()));
			$current_year = date("Y", strtotime("+".$i." year"));
		}
		return $totales;
	}//end getVentasExternas function


	//funcion que registra una visita
	public function visitas($user_token='', $ip='', $bulk = null){
		$result = false;
		if( !empty($user_token) && !empty($ip) && !empty($bulk)  ){
			$this->table = 'visitas';
			$this->id    = 'id';
			$campos = array();
			$campos['user_token']['value']  = $user_token;
			$campos['ip']['value']          = $ip;
			$campos['server_info']['value'] = $bulk;
			//primero buscamos si es un usuario nuevo, si es asi se
			//agrega su informacion
			$user = $this->get(null,array('status'=>1,'user_token'=>$user_token));
			if( !$user )
				$result = $this->insert($campos);
		}
		return $result;
	}//end clientInfo

	//obtiene visitas por mes
	public function getVisitasByMonth(){
		$year = date('Y');
		$mes  = date('m');
		$dias = date('t');//obtiene el numero total de dias
		$fecha_inicio = "$year-$mes-01";//2019-06-01
		$fecha_fin    = "$year-$mes-$dias";//2019-06-31
		
		$this->db->select('id');
		$this->db->from('visitas');
		$this->db->where('fecha >=', $fecha_inicio);
		$this->db->where('fecha <=', $fecha_fin);
		$this->db->where('status',1);

		return $this->db->count_all_results();
	}//end getVisitasByMonth



	public function getGananciasByMonth(){
		$year = date('Y');
		$mes  = date('m');
		$dias = date('t');//obtiene el numero total de dias
		$fecha_inicio = "$year-$mes-01";//2019-06-01
		$fecha_fin    = "$year-$mes-$dias";//2019-06-31

		$this->db->from('ventas');
		$this->db->where('fecha >=', $fecha_inicio);
		$this->db->where('fecha <=', $fecha_fin);
		$this->db->where('status',1);

		$this->db->select_sum('costo_total');
		$query = $this->db->get();
		if ($query->num_rows() >= 1)
			return $query->result();
		else
			return false;
	}//end getGananciasByMonth


	public function getVentasByMonth(){
		
		$year = date('Y');
		$mes  = date('m');
		$dias = date('t');//obtiene el numero total de dias
		$fecha_inicio = "$year-$mes-01";//2019-06-01
		$fecha_fin    = "$year-$mes-$dias";//2019-06-31
		
		$this->db->select('id');
		$this->db->from('ventas');
		$this->db->where('fecha >=', $fecha_inicio);
		$this->db->where('fecha <=', $fecha_fin);
		$this->db->where('status',1);

		return $this->db->count_all_results();
	}//end getVentasByMonth


	public function getInscritos(){		
		$this->db->select('id');
		$this->db->from('inscritos');
		$this->db->where('status',1);
		return $this->db->count_all_results();
	}//end getInscritos


	//obtiene visitas por mes
	public function getVisitasByAllMonths(){
		$totales = array();
		$year = date('Y');
		//$mes  = date('m');
		//$dias = date('t');//obtiene el numero total de dias
		
		for ($i=0; $i < 12; $i++) { 
			
			switch ($i) {
				case 0:
					$mes = '01';
					$dias = '31';
					break;
				
				case 1:
					$mes = '02';
					$dias = '28';
					break;
				
				case 2:
					$mes = '03';
					$dias = '31';
					break;
				
				case 3:
					$mes = '04';
					$dias = '30';
					break;
				
				case 4:
					$mes = '05';
					$dias = '31';
					break;
				
				case 5:
					$mes = '06';
					$dias = '30';
					break;

				case 6:
					$mes = '07';
					$dias = '31';
					break;
				
				case 7:
					$mes = '08';
					$dias = '31';
					break;
				
				case 8:
					$mes = '09';
					$dias = '30';
					break;

				case 9:
					$mes = '10';
					$dias = '31';
					break;

				case 10:
					$mes = '11';
					$dias = '30';
					break;

				case 11:
					$mes = '12';
					$dias = '31';
					break;

				default:
					# code...
					break;
			}//end switch

			$fecha_inicio = "$year-$mes-01";
			$fecha_fin    = "$year-$mes-$dias";

			$this->db->select('id');
			$this->db->from('visitas');
			$this->db->where('fecha >=', $fecha_inicio);
			$this->db->where('fecha <=', $fecha_fin);
			$this->db->where('status',1);			
			array_push($totales, $this->db->count_all_results());
		}//end for

		return $totales;
	}//end getVisitasByAllMonths



}//end class

