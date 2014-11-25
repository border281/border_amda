<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Catalogos_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
        
         public function tipo_identificacion() {
                            $tipo_identificacion=$this->db->query('SELECT id_clave,descrip FROM clave_identificacion order by descrip asc');
                            return $tipo_identificacion;
                            
                        } 
         public function clave_actividad() {
                            $clave_actividad=$this->db->query('SELECT id_clave,descrip FROM clave_actividad order by descrip asc');
                            return $clave_actividad;
                            
                        } 
         public function pais() {
                            $pais=$this->db->query('SELECT id_clave,descrip FROM clave_pais order by descrip asc');
                            return $pais;
                            
                        } 
        public function tipo_operacion()
                {
                $tipo_operacion = $this->db->query('SELECT id_clave,descrip  FROM clave_toperacion order by descrip asc');
                return $tipo_operacion;
                }
        public function moneda()
                {
                $moneda = $this->db->query('SELECT id_clave,descrip  FROM clave_moneda order by descrip asc');
                return $moneda;
                }
        public function moneda_oro()
                {
            $moneda_oro = $this->db->query('SELECT *
                                            FROM clave_moneda
                                            WHERE id_clave
                                            BETWEEN 159
                                            AND 179');
            return $moneda_oro;
                }        
        public function forma_pago() {
                    $forma_pago = $this->db->query('SELECT id_clave,descrip FROM clave_pago order by descrip asc');
                    return $forma_pago;
                    
                } 
        public function instrumento() {
                $instrumento = $this->db->query('SELECT id_clave,descrip FROM clave_instrumento order by descrip asc');
                return $instrumento;
                    
                }        
}//fin clase     
