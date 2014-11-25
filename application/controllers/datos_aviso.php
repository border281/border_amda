<?php

class Datos_aviso extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
                 $this->load->database();
		 $this->load->library(array('session','form_validation'));
		 $this->load->helper(array('url','form'));
                 $this->load->model('avisos_model');
                 $this->load->model('login_model');
                 $this->load->model('xml_model');
                 $this->load->model('operaciones_model');
                 $this->lang->load('user');
                 $this->load->config('amda');
	}
        public function index($id_avisourl = NULL)
                {
                    if(isset($id_avisourl)&& $id_avisourl != NULL)
                
                {
               
                $this->session->set_userdata('id_aviso',$id_avisourl);
                $this->mostrar_datos_informe();
//$this->crear_persona($id_aviso1);
                }else{
                if($this->session->userdata('role_id') == FALSE || $this->session->userdata('role_id') != '4')
                       {
                               redirect(base_url().'index.php/amda');
                               $this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
                               
                       }else{
                         //  print_r($this->session);
                          // $idaviso= $this->session->set_userdata('idaviso',$id_aviso);
                           // $data['idaviso']= array('value'=> $this->session->set_userdata('idaviso',$id_aviso),'name'=> 'idaviso','type'=>'hidden');
                            //$data['id_aviso'] = $this->session->userdata('id_aviso');
                            $data['datos_informe'] = $this->xml_model->datos_informe($this->session->userdata('id_aviso'));
                            $datos_informe = $this->xml_model->datos_informe($this->session->userdata('id_aviso'));
                            if($datos_informe->num_rows > 0)
                                {
                                $row_datos_informe = $datos_informe->row();
                              $data['beneficiario'] =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                                                   

                                                    //recuperamos los datos de las operaciones 
                                                     $data['operaciones']= $this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);
                          
                                                     $data['alerta'] = $this->avisos_model->alerta();                          
                            $role_id = $this->session->userdata('role_id');
                            $id_user = $this->session->userdata('id_usuario');
                            $data['datos_usuario']= $this->avisos_model->datos_usuario($role_id,$id_user);
                            $data['id_aviso'] = $this->session->userdata('id_aviso');
                            $data['usuario'] = $this->session->userdata('username');
                            $data['mes_reportado'] = array('value'=>$row_datos_informe->mes_reportado,'name'=>'mes_reportado','class'=>'requerido form-control','id'=>'mes_reportado');
                            $data['referencia']= array('value'=>$row_datos_informe->referencia,'name'=>'referencia','id'=>'referencia','class'=>'requerido form-control');
                            $data['prioridad_value']=$row_datos_informe->prioridad;
                            $data['tipo_alerta_value']=$row_datos_informe->idalerta;
                            $data['title']='Detalle de informe -:: AMDA ::';
                            $data['subtitle']='Detalle de informe';
                            $data['contentx']='datos_aviso';
                            
                           // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                            $data['menu']='menu_create_1';
                           $this->load->view('admin/template',$data);
                          }
                       }
                }
             }
       public function mostrar_datos_informe()
               {
                 $datos_informe = $this->xml_model->datos_informe($this->session->userdata('id_aviso'));
                          if($datos_informe->num_rows > 0)
                                {
                                $row_datos_informe = $datos_informe->row();
                            $role_id = $this->session->userdata('role_id');
                            $id_user = $this->session->userdata('id_usuario');
                             $data['beneficiario'] =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                              $modificatorio = $this->xml_model->datos_modificatorio($this->session->userdata('id_aviso'));                     

                                                    //recuperamos los datos de las operaciones 
                            $data['operaciones']= $this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);
                              $total_operaciones =$this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);
                                                            if($total_operaciones->num_rows() > 0)
                                                                {
                                                                    foreach ($total_operaciones->result() as $row_total_operaciones)
                                                                        {
                                                                            $data['liquidaciones'][$row_total_operaciones->iddatos_operacion]=$this->xml_model->liquidacion_datos($row_total_operaciones->iddatos_operacion);
                                                                        }
                                                                }
                            $data['alerta'] = $this->avisos_model->alerta();                       
                            $data['datos_usuario']= $this->avisos_model->datos_usuario($role_id,$id_user);
                            $data['id_aviso'] = $this->session->userdata('id_aviso');
                            $data['usuario'] = $this->session->userdata('username');
                            $data['mes_reportado'] = array('value'=>$row_datos_informe->mes_reportado,'name'=>'mes_reportado','class'=>'requerido form-control','id'=>'mes_reportado');
                            $data['referencia']= array('value'=>$row_datos_informe->referencia,'name'=>'referencia','id'=>'referencia','class'=>'requerido form-control');
                            $data['prioridad_value']=$row_datos_informe->prioridad;
                            $data['tipo_alerta_value']=$row_datos_informe->idalerta;
                            if($row_datos_informe->descripcion_alerta != NULL){
                            $data['descripcion_alerta']=array('value'=>$row_datos_informe->descripcion_alerta,'name'=>'descripcion_alerta','class'=>'requerido form-control','id'=>'descripcion_alerta');
                            }// print_r($row_datos_informe);
                            if($modificatorio->num_rows > 0)
                                {
                                $row_modificatorio = $modificatorio->row();
                                    $data['folio_modificatorio']=array('name'=>'folio_modificatorio','value'=>$row_modificatorio->folio_modificacion,'id'=>'folio_modificatorio','class'=>'requerido form-control');
                                    $data['desc_modificatorio']=array('name'=>'desc_modificatorio','value'=>$row_modificatorio->descripcion_modificatorio,'id'=>'desc_modificatorio','class'=>'requerido form-control');
                                    $data['input_disable']='$("input").each(function(i, elem){ $(elem).prop("disabled","disabled");});';
                                    $data['select_disable']='$("select").each(function(i, elem){ $(elem).prop("disabled","disabled");});';
                                    $data['button_disable']='$("button").each(function(i, elem){ $(elem).prop("disabled","disabled");});';
                                }else{
                            $data['agregar_modificatorio']="<button type='button' id='addmodificatorio' class='scalable save' onclick='agregarmodificatorio();'><span>Agregar modificatorio</span></button>";
                                }
                            $data['actualizar_datos']="";
                            $data['title']='Detalle de informe -:: AMDA ::';
                            $data['subtitle']='Detalle de informe';
                            $data['contentx']='datos_aviso';
                            
                           // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                            $data['menu']='menu_create_1';
                           $this->load->view('admin/template',$data);  
                                }
                                
                                 
               }  
               
               
               public function addmodificatorio() {
                                    $this->load->view('content/modificatorio');
             
                             } 
                             
                public function UpdateAviso()
                        {
                   
                            if($this->input->post('folio_modificatorio')!= NULL )
                                    {
                                        $this->updateA_cmodificatorio();
                                    }else
                                     {
                                       $this->update_a();
                                     }
                                     
                   //return false;
                        }
                        
                        
                        function updateA_cmodificatorio()
                        {
                          $this->update_a();
                        
                        // INSERT INTO `amda`.`modificatorio` (``, ``, ``, ``, ``) VALUES (NULL, 'sfsd', '33', '545', NOW())   
                        $data_modif= array(
                               'id_modificatorio' => NULL,
                               'descripcion_modificatorio' => $this->input->post('desc_modificatorio'),
                               'idaviso'          => $this->input->post('id_aviso'),
                               'folio_modificacion'=> $this->input->post('folio_modificatorio'),
                               'fecha_modificacion'=> date('Y-m-d')
                               
                            );
                                 $insert_modific= $this->operaciones_model->insert('modificatorio',$data_modif); 
                        
                                echo "1";// $insert_modific;
                        }
                       function update_a()
                        {
                           $update = 'UPDATE informe as I
                                     JOIN aviso as V 
                                     on I.idinforme = V.idinforme
                                     set I.mes_reportado = "'.$this->input->post('mes_reportado').'", 
                                         V.referencia = "'.$this->input->post('referencia').'",
                                         V.prioridad = "'.$this->input->post('prioridad_aviso').'",
                                         V.idalerta  = "'.$this->input->post('tipo_alerta').'" ,
                                         V.descripcion_alerta="'.$this->input->post('descripcion_alerta').'"    
                                     WHERE V.idaviso = "'.$this->input->post('id_aviso').'" ';
                           $update_query = $this->db->query($update);
                           //return false;
                           
                        } 
                        
                        function flash()
                        {
                            $this->load->view('content/flashdata');
                        }
      
}//fin clase
 
