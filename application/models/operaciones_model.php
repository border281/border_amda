<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Operaciones_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function operacion()
	{
		
	}
        //recupera el ultimo id ingresado en la tabla 
        public function last_id($table,$pk) {
                    $id = $this->db->query("SELECT MAX(".$pk.") AS id
                                             FROM ".$table."");
                    foreach ($id->result() as $id_row)
                        {
                        $last_id=$id_row->id;
                        }
                        return $last_id;
                    
                } 
        public function insert($tabla,$datos)
                {
                  $this->db->set_dbprefix(''); 
                  if($this->db->insert($tabla,$datos)){
                      return TRUE;
                  }else {
                      return FALSE;  
                  }
                  
                }
        public function repuvenulo()
                {
                        $update='UPDATE datos_operacion as O 
                                join datos_vehiculo as V 
                                on O.id_datos_vehiculo = V.iddatos_vehiculo
                                set O.fecha_operacion = "'.$this->input->post('fecha_operacion').'",
                                        O.tipo_operacion = "'.$this->input->post('tipo_operacion').'",
                                        O.cp_sucursal = "'.$this->input->post('cp_sucursal_operacion').'",
                                        O.nombre_sucursal = "'.$this->input->post('nom_sucursal_operacion').'",
                                        V.marca = "'.$this->input->post('marca_fabricante').'",
                                        V.modelo = "'.$this->input->post('modelo').'",
                                        V.anio = "'.$this->input->post('anio').'",
                                        V.vin = "'.$this->input->post('vin').'",
                                        V.repuve = NULL,
                                        V.placas = "'.$this->input->post('placas').'"
                                where O.idaviso = '.$this->input->post('id_aviso').'
                                and O.iddatos_operacion = '.$this->input->post('id_operacion').'';
            $query_update=$this->db->query($update);
            
            if($query_update)
		{
			return TRUE;
		}else{
			return FALSE;
		}
            
            
                }//fin function
                
        public function PlacasNulo()
                {
             $update='UPDATE datos_operacion as O 
join datos_vehiculo as V 
on O.id_datos_vehiculo = V.iddatos_vehiculo
set O.fecha_operacion = "'.$this->input->post('fecha_operacion').'",
	O.tipo_operacion = "'.$this->input->post('tipo_operacion').'",
	O.cp_sucursal = "'.$this->input->post('cp_sucursal_operacion').'",
	O.nombre_sucursal = "'.$this->input->post('nom_sucursal_operacion').'",
	V.marca = "'.$this->input->post('marca_fabricante').'",
	V.modelo = "'.$this->input->post('modelo').'",
	V.anio = "'.$this->input->post('anio').'",
	V.vin = "'.$this->input->post('vin').'",
	V.repuve ="'.$this->input->post('repuve').'",
	V.placas = NULL
where O.idaviso = '.$this->input->post('id_aviso').'
and O.iddatos_operacion = '.$this->input->post('id_operacion').'';
             
              $query_update=$this->db->query($update);
            
            if($query_update)
		{
			return TRUE;
		}else{
			return FALSE;
		}
                
                } //fin function
                
        public function PlacasRepuveNonulos()
                {
             $update='UPDATE datos_operacion as O 
join datos_vehiculo as V 
on O.id_datos_vehiculo = V.iddatos_vehiculo
set O.fecha_operacion = "'.$this->input->post('fecha_operacion').'",
	O.tipo_operacion = "'.$this->input->post('tipo_operacion').'",
	O.cp_sucursal = "'.$this->input->post('cp_sucursal_operacion').'",
	O.nombre_sucursal = "'.$this->input->post('nom_sucursal_operacion').'",
	V.marca = "'.$this->input->post('marca_fabricante').'",
	V.modelo = "'.$this->input->post('modelo').'",
	V.anio = "'.$this->input->post('anio').'",
	V.vin = "'.$this->input->post('vin').'",
	V.repuve = "'.$this->input->post('repuve').'",
	V.placas = "'.$this->input->post('placas').'"
where O.idaviso = '.$this->input->post('id_aviso').'
and O.iddatos_operacion = '.$this->input->post('id_operacion').'';
             
              $query_update=$this->db->query($update);
            
            if($query_update)
		{
			return TRUE;
		}else{
			return FALSE;
		}
                }//fin function
                
        public function PlacasRepuveNulos()
                {
            
            $update='UPDATE datos_operacion as O 
join datos_vehiculo as V 
on O.id_datos_vehiculo = V.iddatos_vehiculo
set O.fecha_operacion = "'.$this->input->post('fecha_operacion').'",
	O.tipo_operacion = "'.$this->input->post('tipo_operacion').'",
	O.cp_sucursal = "'.$this->input->post('cp_sucursal_operacion').'",
	O.nombre_sucursal = "'.$this->input->post('nom_sucursal_operacion').'",
	V.marca = "'.$this->input->post('marca_fabricante').'",
	V.modelo = "'.$this->input->post('modelo').'",
	V.anio = "'.$this->input->post('anio').'",
	V.vin = "'.$this->input->post('vin').'",
	V.repuve = NULL,
	V.placas = NULL
where O.idaviso = '.$this->input->post('id_aviso').'
and O.iddatos_operacion = '.$this->input->post('id_operacion').'';
             $query_update=$this->db->query($update);
                //print_r($query_update);
                
                //}
            if($query_update==1)
		{
                return TRUE;
		}else{
			return FALSE;
		}
                }  //fin function      
}
