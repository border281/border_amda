<?php if (!defined('BASEPATH')) exit('No se permite el acceso directo');
   
class CI_Librarybeneficiario
{
    public function __construct() {
        $this->CI =& get_instance();
        // $this->load->model('catalogos_model');
       $this->CI->load->library('session');
       $this->CI->load->model('xml_model');
       $this->CI->load->model('catalogos_model');
         }
         
         public function beneficiario($id_aviso,$id_beneficiario)
                 {
             //recuperamos el numero de beneficiarios que existen
                    //debemos saber que tipo de persona es para mostrar la vista 
                    $tipo_ben = $this->CI->xml_model->count_beneficiario_1($id_aviso,$id_beneficiario);

                    if($tipo_ben->num_rows() > 0)
                        {
                          $row_tipo = $tipo_ben->row();
                          $tipo_persona = $row_tipo->tipo_persona;
                          $tipo_domicilio = $row_tipo->tipo_domicilio;
                        }
                        switch ($tipo_persona) {
                            case 1:
                                    $this->persona_fisica($id_beneficiario);

                                break;
                            
                            case 2 : 
                                    $this->persona_moral($id_beneficiario);
                                break;
                            case 3 :
                                    $this->fideicomiso($id_beneficiario);
                                    
                                break;
                            
                        }
                        switch ($tipo_domicilio)
                        {
                            case 1:
                                $this->nacional($id_beneficiario);
                                break;
                            case 2:
                                $this->extranjero($id_beneficiario);
                                break;
                            
                        }
                 } // fin beneficiario
                 
                 public function persona_fisica($idbeneficiario)
                         {
                            
                            $persona_fisica = $this->CI->xml_model->persona_fisica_beneficiario($idbeneficiario);
                            if( $persona_fisica->num_rows() > 0 )
                                {
                                foreach ( $persona_fisica->result() as $row_fisica)
                                    {
                                    $data['tipo_persona']=1;
                                    $data['id_aviso'] =  $this->CI->session->userdata('id_aviso');
                                   $data['oculta_select']= "$('#dia_nacimiento_beneficiario').remove(); $('#mes_nacimiento_beneficiario').remove(); $('#anio_nacimiento_beneficiario').remove();";
                                      $data['clave_pais']=  $this->CI->catalogos_model->pais(); 
                                      $data['clave_actividad']= $this->CI->catalogos_model->clave_actividad();
                                      $data['fecha_datepicker']=$row_fisica->fecha_nacimiento;
                                    $data['nombre']=array('name'=>'nombre_persona','value'=> $row_fisica->nombre,'class'=>'form-control');
                                    $data['fecha_nacimiento_beneficiario']=array('name'=>'fecha_nacimiento_beneficiario','id'=>'fecha_nacimiento_beneficiario','value'=> $row_fisica->fecha_nacimiento,'class'=>'form-control');
                                    $data['ap_paterno']=array('name'=>'ap_paterno','value'=> $row_fisica->ap_paterno,'class'=>'form-control');
                                    $data['ap_materno']=array('name'=>'ap_materno','value'=> $row_fisica->ap_materno,'class'=>'form-control');
                                    $data['rfc']=array('name'=>'rfc','value'=> $row_fisica->rfc,'class'=>'form-control');
                                    $data['curp']=array('name'=>'curp','value'=> $row_fisica->curp,'class'=>'form-control');
                                    $data['aut_identif']=array('name'=>'aut_identif','value'=> $row_fisica->autoridad_identificacion,'class'=>'form-control');
                                    $data['numero_identif']=array('name'=>'numero_identif','value'=> $row_fisica->numero_identificacion,'class'=>'form-control');
                                    $data['actividad_economica']=$row_fisica->actividad_economica;
                                    $data['nacionalidad']=$row_fisica->pais_nacionalidad;    
                                    $data['nacimiento']=$row_fisica->pais_nacimiento;
                                    $data['idb']=$idbeneficiario;
                                    $this->CI->load->view('tipo_persona/beneficiario/persona_fisica_beneficiario',$data);
                            
                                    }
                                }
                                    
                         }
                         
     function persona_moral($idbeneficiario)
                         {
                $persona_moral = $this->CI->xml_model->persona_moral_beneficiario($idbeneficiario);
                    if($persona_moral->num_rows() > 0)
                        {
                        foreach ($persona_moral->result() as $row_persona_moral)
                            {
                                   $data['tipo_persona']=2;
                                   $data['id_aviso'] =  $this->CI->session->userdata('id_aviso');
                                   $data['clave_pais']=  $this->CI->catalogos_model->pais(); 
                                   $data['clave_actividad']= $this->CI->catalogos_model->clave_actividad();
                                   
                                   $data['razon_social']= array('name'=>'razon_social','value'=>$row_persona_moral->razon_social,'class'=>'form-control');
                                   $data['oculta_select']= "$('#dia_nacimiento_beneficiario').remove(); $('#mes_nacimiento_beneficiario').remove(); $('#anio_nacimiento_beneficiario').remove();";
                                   $data['fecha_constitucion'] = array('id'=>'fecha_constitucion','name'=>'fecha_constitucion','value'=> $row_persona_moral->fecha_constitucion,'class'=>'form_control');
                                   $data['fecha_datepicker']=$row_persona_moral->fecha_constitucion;
                                   $data['rfc']= array('name'=>'rfc','value'=>$row_persona_moral->rfc,'class'=>'form-control');
                                   $data['pais_nacionalidad']= array('name'=>'pais_nacionalidad','value'=>$row_persona_moral->pais_nacionalidad,'class'=>'form-control');
                                   $data['nacionalidad']=$row_persona_moral->pais_nacionalidad;
                                   $data['giro']=$row_persona_moral->giro_mercantil;
                                   $data['giro_mercantil']= array('name'=>'giro_mercantil','value'=>$row_persona_moral->giro_mercantil,'class'=>'form-control');
                                   $data['idb']=$idbeneficiario;
                                $this->CI->load->view('tipo_persona/beneficiario/persona_moral_beneficiario',$data);
                            }
                        }
                      } 
      function fideicomiso($idbeneficiario)
                      {
                    $fideicomiso = $this->CI->xml_model->fideicomiso_beneficiario($idbeneficiario);
                    if($fideicomiso->num_rows() > 0)
                        {
                        foreach ($fideicomiso-> result() as $row_fideicomiso)
                            {
                                    $data['tipo_persona']=3;
                                    $data['clave_pais']=  $this->CI->catalogos_model->pais(); 
                                    $data['clave_actividad']= $this->CI->catalogos_model->clave_actividad();
                                    $data['id_aviso'] =  $this->CI->session->userdata('id_aviso');
                                    $data['idb']=$idbeneficiario;
                                    $data['razon_social']= array('name'=>'razon_social','value'=>$row_fideicomiso->razon_social,'class'=>'form-control');
                                    $data['rfc'] = array('name'=>'rfc','value'=>$row_fideicomiso->rfc,'class'=>'form-control');
                                    $data['identificador_fideicomiso'] = array('name'=>'id_fideicomiso','value'=>$row_fideicomiso->identificador_fideicomiso,'class'=>'form-control');
                                $this->CI->load->view('tipo_persona/beneficiario/fideicomiso_beneficiario',$data);
                            }
                        }
                      }                
     function nacional($idbeneficiario)
           {
            $dom_nacional= $this->CI->xml_model->nacional_beneficiario($idbeneficiario);
            if($dom_nacional->num_rows()> 0)
            {
                foreach ($dom_nacional->result() as $row_dom_nacional)
                {
                     $data['pais'] = $row_dom_nacional->clave_pais;
                $data['clave_pais'] = $this->CI->catalogos_model->pais();
                $data['tipo_domicilio'] = 1;
                $data['codigo_postal'] = array('name' => 'codigo_postal', 'value' => $row_dom_nacional->cp, 'class' => 'form-control');
                $data['colonia'] = array('name' => 'colonia', 'value' => $row_dom_nacional->colonia, 'class' => 'form-control');
                $data['calle'] = array('name' => 'calle', 'value' => $row_dom_nacional->calle, 'class' => 'form-control');
                $data['num_ext'] = array('name' => 'num_ext', 'value' => $row_dom_nacional->numero_exterior, 'class' => 'form-control');
                $data['num_int'] = array('name' => 'num_int', 'value' => $row_dom_nacional->numero_interior, 'class' => 'form-control');
                $data['clave_pais_java'] = array('name' => 'clave_pais', 'value' => $row_dom_nacional->clave_pais, 'class' => 'form-control');
                $data['clave_pais_java1'] = $row_dom_nacional->clave_pais;
                $data['numero_telefono'] = array('name' => 'telefono', 'value' => $row_dom_nacional->numero_tel, 'class' => 'form-control');
                $data['mail'] = array('name' => 'email', 'value' => $row_dom_nacional->correo_electronico, 'class' => 'form-control');
                $this->CI->load->view('tipo_persona/beneficiario/nacional_beneficiario', $data);
            }
            }
                             
           }//fin function nacional
           function extranjero($id_beneficiario)
           {
               $dom_extranjero =$this->CI->xml_model->extranjero_beneficiario($id_beneficiario);
               if($dom_extranjero->num_rows()>0)
                   {
                   foreach ($dom_extranjero->result() as $row_dom_extranjero)
                   {
                       $data['tipo_domicilio'] = 2;
                $data['clave_pais'] = $this->CI->catalogos_model->pais();
                $data['pais'] = $row_dom_extranjero->idpais;
                $data['estado'] = array('name' => 'estado', 'value' => $row_dom_extranjero->provincia, 'class' => 'form-control');
                $data['ciudad'] = array('name' => 'ciudad', 'value' => $row_dom_extranjero->ciudad, 'class' => 'form-control');
                $data['codigo_postal'] = array('name' => 'codigo_postal', 'value' => $row_dom_extranjero->cp, 'class' => 'form-control');
                $data['colonia'] = array('name' => 'colonia', 'value' => $row_dom_extranjero->colonia, 'class' => 'form-control');
                $data['calle'] = array('name' => 'calle', 'value' => $row_dom_extranjero->calle, 'class' => 'form-control');
                $data['num_ext'] = array('name' => 'num_ext', 'value' => $row_dom_extranjero->numero_exterior, 'class' => 'form-control');
                $data['num_int'] = array('name' => 'num_int', 'value' => $row_dom_extranjero->numero_interior, 'class' => 'form-control');
                $data['clave_pais_java'] = $row_dom_extranjero->clave_pais;
                $data['clave_pais_java1'] = $row_dom_extranjero->clave_pais;
                $data['numero_telefono'] = array('name' => 'telefono', 'value' => $row_dom_extranjero->numero_tel, 'class' => 'form-control');
                $data['mail'] = array('name' => 'email', 'value' => $row_dom_extranjero->correo_electronico, 'class' => 'form-control');
                $this->CI->load->view('tipo_persona/beneficiario/extranjero_beneficiario',$data);
                      
                   }
                   }
               
           }//fin function extranjero
                         
}//fin clase