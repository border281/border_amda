<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Avisos_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	/***************************************
  SELECT case when L.id_instrumento = 0 then ""
  ********/
                        public function listavisos($fecha,$id_user)
                                {
                             $lista_avisos = $this->db->query('SELECT 
                                                              case when A.prioridad = 1 then "Normal" 
                                                              when A.prioridad = 2 then "24 hrs" end as prioridad ,  
                                                              A.idaviso,A.referencia,I.mes_reportado
                                                      FROM aviso A,informe I
                                                      WHERE A.idinforme = I.idinforme
                                                      AND I.id_user = '.$id_user.'
                                                      AND I.mes_reportado='.$fecha.'');
                                return $lista_avisos;

                                }
        /***********************************************/                
                     public function listarmeses($id)
                        {
                        
                   //$mes_reportado=  
                            $mes_reportado = $this->db->query('SELECT I.idinforme,I.mes_reportado,I.id_user FROM informe I WHERE I.id_user='.$id);
                          // foreach ($mes_reportado->result() as $row_meses)
                            //   {
                              //  $meses = $row_meses->mes_reportado;
                               //}
                        return $mes_reportado;
                        }
        /***********************************************/                
                        public function datos_usuario($role_id,$id_user) {
                            $datos_usuario = $this->db->query('SELECT U.display_name,U.rfc 
                                                            FROM am_users U
                                                            WHERE U.role_id = '.$role_id.'
                                                            AND  U.id = '.$id_user.'');
                            return $datos_usuario;
                            
                        }
        /***********************************************/                
                        public function alerta() {
                            $tipo_alerta=$this->db->query('SELECT idalerta,descripcion_alerta FROM alerta');
                            return $tipo_alerta;
                            
                        }  
        /****************************************************/
                        public function select_informe($mes,$id_usuario)
                                {
                                    $query= $this->db->query("Select I.idinforme,I.mes_reportado From informe I where mes_reportado=".$mes." and id_user=".$id_usuario."");
           
                                    if ($query->num_rows() > 0)
                                    {
                                        return $query;
                                    }else {
                                        return FALSE;

                                    }
                                }
                       public function create_informe($mes,$id_usuario)
                               {
                                 $query = $this->db->query("INSERT INTO informe (idinforme,mes_reportado,id_user) VALUES (NULL,'".$mes."','".$id_usuario."')");
                               }
                               
          /***************************************************************************/                     
                        public function create_aviso($data_aviso,$id_informe) 
                                {
                               $datos= array(
                                                'idaviso'=> NULL,
                                                'referencia'=> $data_aviso['referencia_aviso'],
                                                'prioridad' => $data_aviso['prioridad_aviso'],
                                                'idinforme' => $id_informe,
                                                'idalerta'  => $data_aviso['tipo_alerta'],
                                                'descripcion_alerta'=>$data_aviso['descripcion_alerta']
                                            );
                                 if($this->db->insert('aviso',$datos)){
                                      $idaviso=mysql_insert_id();
                                        return  $idaviso;
                                    }else {
                                        return FALSE;  
                                    }
                                   
                                }
                        public function check_referencia($ref)
                                {
                            //$sql = "select referencia from aviso where referencia = \'EMD201311A2U3\'";
                            $referencia = $this->db->query("SELECT referencia FROM aviso WHERE referencia = '".$ref."'");
                             if ($referencia->num_rows() > 0)
                                    {
                                        return FALSE;
                                    }else {
                                        return TRUE;

                                    }
                                }
                        /***************************************************************************/                         
}//fin clase
