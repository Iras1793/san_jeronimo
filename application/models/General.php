<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class General extends CI_Model {

	var $table  = '';
	var $id     = '';
	var $fields = array();

	function __construct(){
		parent::__construct();
	}

	function insert( $cliente = null ){
		$this->fields = array();
		if( $cliente != null && is_array($cliente) ){
			foreach( $cliente as $key => $info )
				$this->fields[$key] = $info['value'];
			$this->fields['fecha_creacion'] = date('Y-m-d');
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
			$fields['fecha_actualizacion'] = date('Y-m-d H:i:s');
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



    function actualiza($object = null, $idobject = null, $other_tables = null){
        // ── Validaciones ──────────────────────────────────────────────────────────
        if ($object === null || $idobject === null || !is_numeric($idobject) || (int)$idobject <= 0) {
            return false;
        }

        $object = is_object($object) ? (array)$object : $object;
        if (!is_array($object)) {
            return false;
        }

        $idobject = (int)$idobject;

        // ── 1. Actualizar tabla principal ─────────────────────────────────────────
        $fields = [];
        foreach ($object as $key => $info) {
            $fields[$key] = (is_array($info) && array_key_exists('value', $info))
                ? $info['value']
                : $info;
        }

        $this->db->where($this->id, $idobject);
        $main_ok = $this->db->update($this->table, $fields);

        if (!$main_ok || $other_tables === null) {
            return $main_ok;
        }

        // ── 2. Procesar cada tabla pivote ─────────────────────────────────────────
        $all_ok = true;

        foreach ($other_tables as $pivot_table => $config) {

            $fk_local     = $config['fk_local']     ?? null;
            $status_field = $config['status_field']  ?? 'status';

            if (empty($fk_local)) {
                continue;
            }

            // ── MODO 2: UPDATE directo de campos ──────────────────────────────────
            if (!empty($config['update']) && is_array($config['update'])) {
                $this->db->where($fk_local, $idobject);
                if (!$this->db->update($pivot_table, $config['update'])) {
                    $all_ok = false;
                }
            }

            // ── MODO 1: Sync lógico de IDs ────────────────────────────────────────
            if (isset($config['sync']) && is_array($config['sync']) && !empty($config['fk_related'])) {
                $fk_related = $config['fk_related'];
                $new_ids    = $config['sync'];
                $extra      = $config['extra'] ?? [];

                if (!$this->_sync_pivot_logical(
                    $pivot_table,
                    $fk_local,
                    $idobject,
                    $fk_related,
                    $new_ids,
                    $extra,
                    $status_field
                )) {
                    $all_ok = false;
                }
            }
        }

        return $all_ok;
    }


    private function _sync_pivot_logical($pivot_table, $fk_local, $idobject, $fk_related, array $new_ids, array $extra = [], $status_field = 'status') {
        $this->db->select("{$fk_related}, {$status_field}");
        $this->db->where($fk_local, $idobject);
        $existing_rows = $this->db->get($pivot_table)->result_array();

        $existing_map = [];
        foreach ($existing_rows as $row) {
            $existing_map[$row[$fk_related]] = (int)$row[$status_field];
        }

        $existing_ids = array_keys($existing_map);
        $to_insert    = array_diff($new_ids, $existing_ids);   // Nunca han existido
        $to_activate  = array_diff($new_ids, $to_insert);      // Ya existen (activos o no)
        $to_deactivate= array_diff($existing_ids, $new_ids);   // Ya no deben estar activos

        if (!empty($to_deactivate)) {
            $this->db->where($fk_local, $idobject);
            $this->db->where_in($fk_related, array_values($to_deactivate));
            if (!$this->db->update($pivot_table, [$status_field => 0])) {
                return false;
            }
        }

        if (!empty($to_activate)) {
            $this->db->where($fk_local, $idobject);
            $this->db->where_in($fk_related, array_values($to_activate));
            if (!$this->db->update($pivot_table, [$status_field => 1])) {
                return false;
            }
        }

        if (!empty($to_insert)) {
            $rows = [];
            foreach ($to_insert as $related_id) {
                $rows[] = array_merge(
                    [
                        $fk_local   => $idobject,
                        $fk_related => $related_id,
                        $status_field => 1
                    ],
                    $extra
                );
            }
            if (!$this->db->insert_batch($pivot_table, $rows)) {
                return false;
            }
        }
        return true;
    }


}//end class

