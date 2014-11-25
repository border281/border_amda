<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona_aviso extends CI_Controller {

	public function __construct() {
            parent::__construct();
           define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

            $this->load->model('catalogos_model');
            $this->load->model('operaciones_model');
            $this->load->model("xml_model");
            $this->load->library(array('session','form_validation'));
            $this->load->library('Librarybeneficiario');
            $this->load->helper(array('url','form'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->config('amda');
            
            //
        }
        public function index($id_avisourl=NULL)
                {
            if(isset($id_avisourl)&& $id_avisourl != NULL)
                
                {
               
                $this->session->set_userdata('id_aviso',$id_avisourl);
               
//$this->crear_persona($id_aviso1);
                }
            $this->crear_persona();
                }
        public function crear_persona()
                {
                    if($this->session->userdata('role_id') == FALSE || $this->session->userdata('role_id') != '4')
                       {
                               redirect(base_url().'index.php/amda');
                               $this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
                               
                       }else{
                         //  print_r($this->session);
                          // $idaviso= $this->session->set_userdata('idaviso',$id_aviso);
                           // $data['idaviso']= array('value'=> $this->session->set_userdata('idaviso',$id_aviso),'name'=> 'idaviso','type'=>'hidden');
                            $data['id_aviso'] = $this->session->userdata('id_aviso');
                            
                            $datos_aviso = $this->xml_model->datos_aviso($this->session->userdata('id_aviso'));
                            //si existe el array de datos aviso emmpezamos.
                                if($datos_aviso->num_rows() > 0)
                                    {
                                        $row_datos_aviso = $datos_aviso->row();
                                        
                                         switch ($row_datos_aviso->tipo_persona)
                                        {
                                            case 1:
                                                //recuperamos los datos de los beneficiarios
                                                    $data['beneficiario'] =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                                                   

                                                    //recuperamos los datos de las operaciones 
                                                     $data['operaciones']= $this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);
                                                        ///crear el array datos de liquidacion
                                                        $total_operaciones =$this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);
                                                            if($total_operaciones->num_rows() > 0)
                                                                {
                                                                    foreach ($total_operaciones->result() as $row_total_operaciones)
                                                                        {
                                                                            $data['liquidaciones'][$row_total_operaciones->iddatos_operacion]=$this->xml_model->liquidacion_datos($row_total_operaciones->iddatos_operacion);
                                                                            //$total_liquidaciones=$this->xml_model->liquidacion_datos($row_total_operaciones->iddatos_operacion);
                                                                        }
                                                                }
                                                     $data['usuario'] = $this->session->userdata('username');
                                                     $data['title']='Crear aviso -> persona_aviso:: AMDA ::';
                                                     $data['subtitle']='Persona aviso';
                                                     $data['contentx']='persona_aviso';
                                                    // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                                                     $data['menu']='menu_create_1';
                                                 
                                                     $this->load->view('admin/template',$data); 
                                               //$datos_cliente = $this->xml_model->persona_fisica($row_datos_aviso->idcliente);
                                              // $row_datos_cliente = $datos_cliente->row();
                                             // $datos_cli['nombre']=array('name'=>'nombre_persona','value'=>$row_datos_cliente->nombre ,'class'=>'form-control');
                      //                              //recuperammos que tipo de domiciio tiene
                                                     //$row_datos_aviso->tipo_domicilio;
                                                     
                                                     $datos['tipo_p'] =1;
                                                     $datos['tipo_dom']=$row_datos_aviso->tipo_domicilio;
                                                     $this->load->view('ajax_persona',$datos);
                                                     $dom['t_domicilio']=$row_datos_aviso->tipo_domicilio;
                                                     $this->load->view('ajax_domicilio',$dom);
                                                     
                     //  $this->load->view('tipo_persona/persona_aviso/persona_fisica',$data);
                                                    
                                                break;
                                            case 2:
                                                $data['beneficiario'] =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                                                   

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
                                                $data['usuario'] = $this->session->userdata('username');
                                                     $data['title']='Crear aviso -> persona_aviso:: AMDA ::';
                                                     $data['subtitle']='Persona aviso';
                                                     $data['contentx']='persona_aviso';
                                                    // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                                                     $data['menu']='menu_create_1';
                                                 
                                                     $this->load->view('admin/template',$data); 
                                               //$datos_cliente = $this->xml_model->persona_fisica($row_datos_aviso->idcliente);
                                              // $row_datos_cliente = $datos_cliente->row();
                                             // $datos_cli['nombre']=array('name'=>'nombre_persona','value'=>$row_datos_cliente->nombre ,'class'=>'form-control');
                      //                                
                                                     
                                                            
                                                        
                                                     $datos['tipo_p'] =2;
                                                       $datos['tipo_dom']=$row_datos_aviso->tipo_domicilio;
                                                   
                                                     $this->load->view('ajax_persona',$datos);
                                                     $dom['t_domicilio']=$row_datos_aviso->tipo_domicilio;
                                                     $this->load->view('ajax_domicilio',$dom);
                                                break;
                                            case 3:
                                                $data['beneficiario'] =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                                                   

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
                                                $data['usuario'] = $this->session->userdata('username');
                                                     $data['title']='Crear aviso -> persona_aviso:: AMDA ::';
                                                     $data['subtitle']='Persona aviso';
                                                     $data['contentx']='persona_aviso';
                                                    // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                                                     $data['menu']='menu_create_1';
                                                 
                                                     $this->load->view('admin/template',$data); 
                                               //$datos_cliente = $this->xml_model->persona_fisica($row_datos_aviso->idcliente);
                                              // $row_datos_cliente = $datos_cliente->row();
                                             // $datos_cli['nombre']=array('name'=>'nombre_persona','value'=>$row_datos_cliente->nombre ,'class'=>'form-control');
                                                        
                                                     
                                                     
                                                     $datos['tipo_p'] =3;
                                                       $datos['tipo_dom']=$row_datos_aviso->tipo_domicilio;
                                                   
                                                     $this->load->view('ajax_persona',$datos);
                                                     $dom['t_domicilio']=$row_datos_aviso->tipo_domicilio;
                                                     $this->load->view('ajax_domicilio',$dom);
                                                break;
                                        }//fin switch
                                        
                                        //vistas de beneficiario
                                           //$datos_beneficiario =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                                           // $row_datos_beneficiario =$datos_beneficiario ->row();
                                           // $persona_b['tipo_p']=$row_datos_beneficiario->tipo_persona;
                                           // $this->load->view('ajax_persona_beneficiario',$persona_b);
                                           // $dom_b['t_domicilio']=$row_datos_beneficiario->tipo_domicilio;
                                           // $this->load->view('ajax_dom_beneficiario',$dom_b);
                                        
                                    }else{
                            $data['usuario'] = $this->session->userdata('username');
                            $data['title']='Crear aviso -> persona_aviso:: AMDA ::';
                            $data['subtitle']='Persona aviso';
                            $data['contentx']='persona_aviso';
                           // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                            $data['menu']='menu_create_1';
                           $this->session->set_flashdata('valido','Acceso exitoso!');
                           $this->load->view('admin/template',$data);
                                    }//fin else
                       }
                }
       public function tipo_persona() {
           // verificamos si la sesion existe y asignamos el valor
           
           
           
           if($this->input->post('tipo_persona')== '0') {
                       return false;
                   }
                   
                   
                   if($this->input->post('tipo_persona')== '1' || $this->session->userdata('sess_tipo_persona'== '1') ) {
                        //aqui creamos la sesion de el tipo de persona 
                        $this->session->set_userdata('sess_tipo_persona', $this->input->post('tipo_persona'));
                       $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $data['clave_actividad']= $this->catalogos_model->clave_actividad();
                       $data['clave_pais']=  $this->catalogos_model->pais();
                       /****************obtenemos los datos de el cliente**************************/
                            $datos_aviso = $this->xml_model->datos_aviso($this->session->userdata('id_aviso'));
                            //si existe el array de datos aviso emmpezamos.
                                if($datos_aviso->num_rows() > 0)
                                    {
                                        $row_datos_aviso = $datos_aviso->row();
                                         $datos_cliente = $this->xml_model->persona_fisica($row_datos_aviso->idcliente);
                                    
                         
                            
                   
                             
                          if($datos_cliente->num_rows()>0){
                            $row_datos_cliente = $datos_cliente->row();
                            $data['actualizar_datos']='$("#save_persona").empty().html("Actualizar Datos");  $("button#save").attr({"onclick":"actualizar_persona()"}); $("form#form_persona_aviso").attr("action","http://localhost/amda/index.php/persona_aviso/actualizar_datos")';
                            $data['tipo_domicilio1']=$row_datos_aviso->tipo_domicilio; 
                            $data['cl']=$row_datos_aviso->idcliente;
                            $data['t']=$row_datos_aviso->id_telefono;
                            $data['nombre']=array('name'=>'nombre_persona','value'=> $row_datos_cliente->nombre,'class'=>'form-control');
                            $data['fecha_nac']=array('name'=>'fecha_nac','id'=>'fecha_nacimientop','value'=> $row_datos_cliente->fecha_nacimiento,'class'=>'form-control');
                            $data['fecha_datepicker']= $row_datos_cliente->fecha_nacimiento;
                            $data['ap_paterno']=array('name'=>'ap_paterno','value'=> $row_datos_cliente->ap_paterno,'class'=>'form-control');
                            $data['ap_materno']=array('name'=>'ap_materno','value'=> $row_datos_cliente->ap_materno,'class'=>'form-control');
                            $data['rfc']=array('name'=>'rfc','value'=> $row_datos_cliente->rfc,'class'=>'form-control','onblur'=>'ValidaRfc(this.value)');
                            $data['curp']=array('name'=>'curp','value'=> $row_datos_cliente->curp,'class'=>'form-control');
                            $data['aut_identif']=array('name'=>'aut_identif','value'=> $row_datos_cliente->autoridad_identificacion,'class'=>'form-control');
                            $data['numero_identif']=array('name'=>'numero_identif','value'=>$row_datos_cliente->numero_identificacion,'class'=>'form-control');
                            if($row_datos_cliente->identificacion_otro != NULL && $row_datos_cliente->identificacion_otro != "0" )
                                {
                            $data['identif_otro']=array('name'=>'identif_otro','value'=>$row_datos_cliente->identificacion_otro,'class'=>'form-control');
                                }
                            $data['pais_nacionalidad']=$row_datos_cliente->pais_nacionalidad;
                   $data['pais_nacimiento']=$row_datos_cliente->pais_nacimiento;
                   $data['identificacion']=$row_datos_cliente->tipo_identificacion;
                   $data['actividad_economica']=$row_datos_cliente->actividad_economica;
                            //$data['colonia']=array();
                     // $data['calle']=array();
                     // $data['c']=array();
                     // $data['colonia']=array();
                      $this->load->view('tipo_persona/persona_aviso/persona_fisica',$data);
                      }
                   }else{
                       //$data['mes'] = array('name' => 'mes', 'placeholder' => 'mes','class' => 'form-control');
                       
                      $data['nombre']=array('id'=>'nombre_persona','name'=>'nombre_persona','value'=> set_value("nombre_persona"),'class'=>'requerido form-control');
                      $data['fecha_nac']=array('name'=>'fecha_nac','id'=>'fecha_nacimiento','value'=> set_value("fecha_nac"),'class'=>'form-control requerido');
                      $data['ap_paterno']=array('id'=>'ap_paterno','name'=>'ap_paterno','value'=> set_value("ap_paterno"),'class'=>'form-control requerido');
                      $data['ap_materno']=array('id'=>'ap_materno','name'=>'ap_materno','value'=> set_value("ap_materno"),'class'=>'form-control requerido');
                      $data['rfc']=array('id'=>'rfc','name'=>'rfc','value'=> set_value("rfc"),'class'=>'form-control','onblur'=>'ValidaRfc(this.value)');
                      $data['curp']=array('id'=>'curp','name'=>'curp','value'=> set_value("curp"),'class'=>'form-control');
                      $data['aut_identif']=array('id'=>'aut_identif','name'=>'aut_identif','value'=> set_value("aut_identif"),'class'=>'form-control requerido');
                      $data['numero_identif']=array('id'=>'numero_identif','name'=>'numero_identif','value'=> set_value("numero_identif"),'class'=>'form-control requerido');
                      //$data['']=array();
                     // $data['calle']=array();
                     // $data['c']=array();
                     // $data['colonia']=array();
                      $this->load->view('tipo_persona/persona_aviso/persona_fisica',$data);
                   }
                   }//fin tipo de persona =1
                   
                   if($this->input->post('tipo_persona')== '2') {
                       
                                 $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                                 $data['clave_actividad']= $this->catalogos_model->clave_actividad();
                                $data['clave_pais']=  $this->catalogos_model->pais();
                               $datos_aviso = $this->xml_model->datos_aviso($this->session->userdata('id_aviso'));
                            //si existe el array de datos aviso emmpezamos.
                                if($datos_aviso->num_rows() > 0)
                                    {
                                        $row_datos_aviso = $datos_aviso->row();
                                    
                         
                             $datos_cliente_mo = $this->xml_model->persona_moral($row_datos_aviso->idcliente);
                   
                             if($datos_cliente_mo->num_rows()>0){
                                    //creamos el row de la consulta obtenida
                                     $row_datos_cliente_mo = $datos_cliente_mo->row();
                                      $data['tipo_domicilio1']=$row_datos_aviso->tipo_domicilio;          
                          
                                      $data['razon_social']=array('name'=>'razon_social','value'=> $row_datos_cliente_mo->razon_social,'class'=>'form-control');
                                      // $data['razon_social']=array('name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'form-control');
                                      $data['fecha_constitucion']=array('name'=>'fecha_constitucion','id'=>'fecha_constitucion','value'=> $row_datos_cliente_mo->fecha_constitucion,'class'=>'form-control');
                                     $data['fecha_constitucion_datepicker']= $row_datos_cliente_mo->fecha_constitucion;
                                      $data['rfc_moral']=array('name'=>'rfc_moral','value'=>$row_datos_cliente_mo->rfc_moral,'class'=>'requerido form-control','onblur'=>'ValidaRfc(this.value)');
                                      //$data['']
                                      //representante apoderado
                                       $data['actualizar_datos']='$("#save_persona").empty().html("Actualizar Datos");  $("button#save").attr({"onclick":"actualizar_persona()"}); $("form#form_persona_aviso").attr("action","http://localhost/amda/index.php/persona_aviso/actualizar_datos")';
                                      //$data['clave_pais']=  $this->catalogos_model->pais();      
                                     $data['rep']=$row_datos_cliente_mo->idrepresentante_apoderado;       
                                     $data['nombre']=array('name'=>'nombre_persona','value'=> $row_datos_cliente_mo->nombre,'class'=>'form-control');
                                     $data['fecha_nac']=array('name'=>'fecha_nac','id'=>'fecha_nacimiento','value'=> $row_datos_cliente_mo->fecha_nac,'class'=>'form-control');
                                      $data['fecha_datepicker']= $row_datos_cliente_mo->fecha_nac;
                                     $data['ap_paterno']=array('name'=>'ap_paterno','value'=> $row_datos_cliente_mo->ap_paterno,'class'=>'form-control');
                                     $data['ap_materno']=array('name'=>'ap_materno','value'=> $row_datos_cliente_mo->ap_materno,'class'=>'form-control');
                                     $data['rfc']=array('name'=>'rfc','value'=> $row_datos_cliente_mo->rfc,'class'=>'form-control');
                                     $data['curp']=array('name'=>'curp','value'=> $row_datos_cliente_mo->curp,'class'=>'form-control');
                                     $data['aut_identif']=array('name'=>'aut_identif','value'=> $row_datos_cliente_mo->autoridad_identificacion,'class'=>'form-control');
                                     $data['numero_identif']=array('name'=>'numero_identif','value'=> $row_datos_cliente_mo->numero_identificacion,'class'=>'form-control');
                                     if($row_datos_cliente_mo->identificacion_otro != NULL && $row_datos_cliente_mo->identificacion_otro != 0)
                                {
                                     $data['identif_otro']=array('name'=>'identif_otro','value'=>$row_datos_cliente_mo->identificacion_otro,'class'=>'form-control');
                                }
                                     $data['p_nacionalidad']=$row_datos_cliente_mo->pais_nacionalidad;
                                      $data['giro_mercantil']=$row_datos_cliente_mo->giro_mercantil;
                                      $data['identificacion']=$row_datos_cliente_mo->tipo_identificacion;
                                     
                                     $this->load->view('tipo_persona/persona_aviso/persona_moral',$data);
                             }   
                             }else{
                       //PERSONA MORAL
                       $data['razon_social']=array('id'=>'razon_social','name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'requerido form-control');
                     // $data['razon_social']=array('name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'form-control');
                       $data['fecha_constitucion']=array('name'=>'fecha_constitucion','id'=>'fecha_constitucion','value'=> set_value("fecha_constitucion"),'class'=>'requerido form-control');
                     //
                      $data['rfc_moral']=array('id'=>'rfc_moral','name'=>'rfc_moral','value'=>set_value('rfc_moral'),'class'=>'requerido form-control');
                       //$data['']
                       //representante apoderado
                      $data['nombre']=array('id'=>'nombre_persona','name'=>'nombre_persona','value'=> set_value("nombre_persona"),'class'=>'requerido form-control');
                      $data['fecha_nac']=array('name'=>'fecha_nac','id'=>'fecha_nacimiento','value'=> set_value("fecha_nac"),'class'=>'requerido form-control');
                      $data['ap_paterno']=array('id'=>'ap_paterno','name'=>'ap_paterno','value'=> set_value("ap_paterno"),'class'=>'requerido form-control');
                      $data['ap_materno']=array('id'=>'ap_materno','name'=>'ap_materno','value'=> set_value("ap_materno"),'class'=>'requerido form-control');
                      $data['rfc']=array('id'=>'rfc','name'=>'rfc','value'=> set_value("rfc"),'class'=>'form-control','onblur'=>'ValidaRfc(this.value)');
                      $data['curp']=array('id'=>'curp','name'=>'curp','value'=> set_value("curp"),'class'=>'form-control');
                      $data['aut_identif']=array('id'=>'aut_identif','name'=>'aut_identif','value'=> set_value("aut_identif"),'class'=>'requerido form-control');
                      $data['numero_identif']=array('id'=>'numero_identif','name'=>'numero_identif','value'=> set_value("numero_identif"),'class'=>'requerido form-control');
                      /*if($row_datos_cliente->identificacion_otro != NULL)
                                {
                            $data['identif_otro']=array('name'=>'identif_otro','value'=>$row_datos_cliente->identificacion_otro,'class'=>'form-control');
                                }*/
                        //**********
                       $data['clave_pais']=  $this->catalogos_model->pais();
                       $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $data['clave_actividad']= $this->catalogos_model->clave_actividad();
                      $this->load->view('tipo_persona/persona_aviso/persona_moral',$data);
                   }//fin else
                   }//fin tipo de persona =2
                   if($this->input->post('tipo_persona')== '3') {
                       
                                 $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $data['clave_actividad']= $this->catalogos_model->clave_actividad();
                       $data['clave_pais']=  $this->catalogos_model->pais();
                                $datos_aviso = $this->xml_model->datos_aviso($this->session->userdata('id_aviso'));
                            //si existe el array de datos aviso emmpezamos.
                                if($datos_aviso->num_rows() > 0)
                                    {
                                        $row_datos_aviso = $datos_aviso->row();
                                    
                         
                                 $datos_cliente = $this->xml_model->fideicomiso($row_datos_aviso->idcliente);
                   
                             
                                 if($datos_cliente->num_rows()>0){
                                             $row_datos_cliente = $datos_cliente->row();
                                              $data['tipo_domicilio1']=$row_datos_aviso->tipo_domicilio;          
                                              
                                              $data['razon_social']=array('name'=>'razon_social','value'=>  $row_datos_cliente->razon_social,'class'=>'requerido form-control');

                                            //  $data['razon_social']=array('name'=>'razon_social','value'=>  set_value('razon_social'),'class'=>'form_control');
                                              $data['rfc_fideicomiso']=array('name'=>'rfc','value'=>  $row_datos_cliente->rfc,'class'=>'form_control','onblur'=>'ValidaRfc(this.value)');
                                               $data['actualizar_datos']='$("#save_persona").empty().html("Actualizar Datos");  $("button#save").attr({"onclick":"actualizar_persona()"}); $("form#form_persona_aviso").attr("action","http://localhost/amda/index.php/persona_aviso/actualizar_datos")';
                           
                                             // $data['identificador_fideicomiso']=array('name'=>'identificador_fideicomiso','value'=>set_value('identificador_fideicomiso'),'class'=>'form_control');
                                                 $data['ad']=$row_datos_cliente->idapoderado_delegado;
                                                //$data['t']=$row_datos_aviso->id_telefono;
                                              $data['identificador_fideicomiso']=array('name'=>'identificador_fideicomiso','value'=> $row_datos_cliente->identificador_fideicomiso,'class'=>'form-control');
                                             $data['nombre']=array('name'=>'nombre_persona','value'=> $row_datos_cliente->nombre,'class'=>'form-control');
                                             $data['fecha_nac']=array('name'=>'fecha_nac','id'=>'fecha_nacimiento','value'=> $row_datos_cliente->fecha_nac,'class'=>'form-control');
                                              $data['fecha_datepicker']= $row_datos_cliente->fecha_nac;
                                             $data['ap_paterno']=array('name'=>'ap_paterno','value'=> $row_datos_cliente->ap_paterno,'class'=>'form-control');
                                             $data['ap_materno']=array('name'=>'ap_materno','value'=> $row_datos_cliente->ap_materno,'class'=>'form-control');
                                             $data['rfc']=array('name'=>'rfc','value'=> $row_datos_cliente->rfcad,'class'=>'form-control');
                                             $data['curp']=array('name'=>'curp','value'=>$row_datos_cliente->curp,'class'=>'form-control');
                                             $data['aut_identif']=array('name'=>'aut_identif','value'=> $row_datos_cliente->autoridad_identificacion,'class'=>'form-control');
                                             $data['numero_identif']=array('name'=>'numero_identif','value'=> $row_datos_cliente->numero_identificacion,'class'=>'form-control');
                                              $data['identificacion']=$row_datos_cliente->tipo_identificacion; 
                                              if($row_datos_cliente->identificacion_otro != NULL && $row_datos_cliente->identificacion_otro != 0)
                                                {
                                            $data['identif_otro']=array('name'=>'identif_otro','value'=>$row_datos_cliente->identificacion_otro,'class'=>'form-control');
                                                }
                                             // $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                                              $this->load->view('tipo_persona/persona_aviso/fideicomiso',$data);
                                 }          
                                 }else{

                       //FIDEICOMISO
                        $data['razon_social']=array('id'=>'razon_social','name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'requerido form-control');
                     
                     //  $data['razon_social']=array('name'=>'razon_social','value'=>  set_value('razon_social'),'class'=>'form_control');
                       $data['rfc_fideicomiso']=array('id'=>'rfc_fideicomiso','name'=>'rfc_fideicomiso','value'=>  set_value('rfc_fideicomiso'),'class'=>'requerido form-control');
                      
                      // $data['identificador_fideicomiso']=array('name'=>'identificador_fideicomiso','value'=>set_value('identificador_fideicomiso'),'class'=>'form_control');
                       $data['identificador_fideicomiso']=array('id'=>'identificador_fideicomiso','name'=>'identificador_fideicomiso','value'=> set_value("identificador_fideicomiso"),'class'=>'requerido form-control');
                      $data['nombre']=array('id'=>'nombre_persona','name'=>'nombre_persona','value'=> set_value("nombre_persona"),'class'=>'requerido form-control');
                      $data['fecha_nac']=array('name'=>'fecha_nac','id'=>'fecha_nacimiento','value'=> set_value("fecha_nac"),'class'=>'requerido form-control');
                      $data['ap_paterno']=array('id'=>'ap_paterno','name'=>'ap_paterno','value'=> set_value("ap_paterno"),'class'=>'requerido form-control');
                      $data['ap_materno']=array('id'=>'ap_materno','name'=>'ap_materno','value'=> set_value("ap_materno"),'class'=>'requerido form-control');
                      $data['rfc']=array('id'=>'rfc','name'=>'rfc','value'=> set_value("rfc"),'class'=>'form-control','onblur'=>'ValidaRfc(this.value)');
                      $data['curp']=array('id'=>'curp','name'=>'curp','value'=> set_value("curp"),'class'=>'form-control');
                      $data['aut_identif']=array('id'=>'aut_identif','name'=>'aut_identif','value'=> set_value("aut_identif"),'class'=>'requerido form-control');
                      $data['numero_identif']=array('id'=>'numero_identif','name'=>'numero_identif','value'=> set_value("numero_identif"),'class'=>'requerido form-control');
                     
                       $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $this->load->view('tipo_persona/persona_aviso/fideicomiso',$data);
                                 }//fin else
                   }//fin tipo de persona = 3
        } //fin tipo persona
     public function tipo_domicilio()
             {
                 if($this->input->post('tipo_domicilio')== '0') {
                       return false;
                   }
                   if($this->input->post('tipo_domicilio')== '1') {
                                            
                                 $datos_aviso = $this->xml_model->datos_aviso($this->session->userdata('id_aviso'));
                            //si existe el array de datos aviso emmpezamos.
                                 if($datos_aviso->num_rows() > 0)
                                    {
                                        $row_datos_aviso = $datos_aviso->row();
                                    
                         
                                 $t_domicilio = $this->xml_model->nacional($row_datos_aviso->idcliente);
                   
                             
                                 if($t_domicilio->num_rows()>0){
                                             $row_t_domicilio = $t_domicilio->row();
                                             $data['clave_pais']=  $this->catalogos_model->pais();
                                             $data['pais']=$row_t_domicilio->clave_pais;    
                                               $data['colonia']=array('name'=>'colonia','value'=> $row_t_domicilio->colonia,'class'=>'requerido form-control');
                                                $data['calle']=array('name'=>'calle','value'=>  $row_t_domicilio->calle,'class'=>'requerido form-control');
                                                $data['num_ext']=array('name'=>'num_ext','value'=>  $row_t_domicilio->numero_exterior,'class'=>'requerido form-control');
                                                $data['num_int']=array('name'=>'num_int','value'=>  $row_t_domicilio->numero_interior,'class'=>'form-control');  
                                                $data['cp']=array('name'=>'cp','value'=>  $row_t_domicilio->cp,'class'=>'requerido form-control');
                                                $data['lada']=array('name'=>'lada','value'=>  $row_t_domicilio->clave_pais,'class'=>'requerido form-control');
                                                $data['num_tel']=array('name'=>'num_tel','value'=>  $row_t_domicilio->numero_tel,'class'=>'requerido form-control');
                                                $data['correo']=array('type'=>'email' ,'name'=>'correo','value'=>  $row_t_domicilio->correo_electronico,'class'=>'form-control');
                                                 $this->load->view('tipo_domicilio/persona_aviso/nacional',$data);
                                 
                                    }            
                                 }else{             
                      $data['clave_pais']=  $this->catalogos_model->pais(); 
                      $data['colonia']=array('name'=>'colonia','value'=>  set_value("colonia"),'class'=>'requerido form-control');
                      $data['calle']=array('name'=>'calle','value'=>  set_value("calle"),'class'=>'requerido form-control');
                      $data['num_ext']=array('name'=>'num_ext','value'=>  set_value("num_ext"),'class'=>'requerido form-control');
                      $data['num_int']=array('name'=>'num_int','value'=>  set_value("num_int"),'class'=>'form-control');  
                      $data['cp']=array('name'=>'cp','value'=>  set_value("cp"),'class'=>'requerido form-control');
                      $data['lada']=array('name'=>'lada','value'=>  set_value("lada"),'class'=>'requerido form-control');
                      $data['num_tel']=array('name'=>'num_tel','value'=>  set_value("num_tel"),'class'=>'requerido form-control');
                      $data['correo']=array('type'=>'email' ,'name'=>'correo','value'=>  set_value("correo"),'class'=>'form-control');
                        $this->load->view('tipo_domicilio/persona_aviso/nacional',$data);
                                 }//fin else
                   } //fin if domicilio nacional
                  if($this->input->post('tipo_domicilio')=='2')
                      {
                      
                      
                      
                                 $datos_aviso = $this->xml_model->datos_aviso($this->session->userdata('id_aviso'));
                            //si existe el array de datos aviso emmpezamos.
                                 if($datos_aviso->num_rows() > 0)
                                    {
                                        $row_datos_aviso = $datos_aviso->row();
                                    
                         
                                 $t_domicilio = $this->xml_model->extranjero($row_datos_aviso->idcliente);
                   
                             
                                 if($t_domicilio->num_rows()>0){
                                             $row_t_domicilio = $t_domicilio->row();
                                             $data['clave_pais']=  $this->catalogos_model->pais();
                                                $data['estado']=array('name'=>'estado','value'=> $row_t_domicilio->provincia,'class'=>'requerido form-control');
                                                $data['ciudad']=array('name'=>'ciudad','value'=>  $row_t_domicilio->ciudad,'class'=>'requerido form-control');
                                                $data['colonia']=array('name'=>'colonia','value'=>  $row_t_domicilio->colonia,'class'=>'requerido form-control');
                                                $data['calle']=array('name'=>'calle','value'=>  $row_t_domicilio->calle,'class'=>'requerido form-control');
                                                $data['num_ext']=array('name'=>'num_ext','value'=>  $row_t_domicilio->numero_exterior,'class'=>'requerido form-control');
                                                $data['num_int']=array('name'=>'num_int','value'=>  $row_t_domicilio->numero_interior,'class'=>'form-control');  
                                                $data['cp']=array('name'=>'cp','value'=>  $row_t_domicilio->cp,'class'=>'requerido form-control');
                                                $data['lada_tel']=$row_t_domicilio->clave_pais;
                                                $data['pais_origen']=$row_t_domicilio->idpais;
                                                $data['num_tel']=array('name'=>'num_tel','value'=>  $row_t_domicilio->numero_tel,'class'=>'form-control');
                                                $data['correo']=array('type'=>'email' ,'name'=>'correo','value'=>  $row_t_domicilio->correo_electronico,'class'=>'form-control');

                                                $this->load->view('tipo_domicilio/persona_aviso/extranjero',$data);
                                    }         
                                 }else{
                        $data['clave_pais']=  $this->catalogos_model->pais();
                        $data['estado']=array('name'=>'estado','value'=> set_value("estado"),'class'=>'requerido form-control');
                        $data['ciudad']=array('name'=>'ciudad','value'=>  set_value("ciudad"),'class'=>'requerido form-control');
                        $data['colonia']=array('name'=>'colonia','value'=>  set_value("colonia"),'class'=>'requerido form-control');
                        $data['calle']=array('name'=>'calle','value'=>  set_value("calle"),'class'=>'requerido form-control');
                        $data['num_ext']=array('name'=>'num_ext','value'=>  set_value("num_ext"),'class'=>'requerido form-control');
                        $data['num_int']=array('name'=>'num_int','value'=>  set_value("num_int"),'class'=>'form-control');  
                        $data['cp']=array('name'=>'cp','value'=>  set_value("cp"),'class'=>'requerido form-control');
                        $data['lada']=array('name'=>'lada','value'=>  set_value("lada"),'class'=>'requerido form-control');
                        $data['num_tel']=array('name'=>'num_tel','value'=>  set_value("num_tel"),'class'=>'requerido form-control');
                        $data['correo']=array('type'=>'email' ,'name'=>'correo','value'=>  set_value("correo"),'class'=>'form-control');
                      
                        $this->load->view('tipo_domicilio/persona_aviso/extranjero',$data);
                               
                                 }//fin else
                      } //fin if domicilio extranjero
             }
     public function guardardatospersona() {
         
             $this->form_validation->set_message('required', 'El %s es requerido');
             $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
             $this->form_validation->set_message('max_length', 'El %s debe tener al maximo %s carácteres');
             $this->form_validation->set_message('check_default', 'El campo %s esta vacio');
             
             if($this->form_validation->run('persona_aviso/guardardatospersona')== FALSE)
                 {
                    //entra y es false
                           // $data['id_aviso'] = $this->session->userdata('id_aviso');
                            //$data['usuario'] = $this->session->userdata('username');
                           // $data['title']='Crear aviso -> persona_aviso:: AMDA ::';
                           // $data['subtitle']='Persona aviso';
                           // $data['contentx']='persona_aviso';
                           // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                           // $data['menu']='menu_create_1';
                           //$this->session->set_flashdata('valido','Acceso exitoso!');
                          // $this->load->view('admin/template',$data);
                   // $this->tipo_persona();
                   // $this->tipo_domicilio();
                
                // $this->operaciones->index();
                // echo "2";
               //  echo validation_errors();
                 }else
                     {
                     //print_r($_POST);
                     $id_aviso=$this->input->post('id_aviso');
                    // $data_aviso['referencia_aviso']= $this->input->post('referencia_aviso');
                    if (isset($id_aviso)&& $id_aviso != NULL)
                        
                    {
                        //si existe el aviso //primero recuperamos el ultimo id de la tabla de telefono
                        //para poder insertarlo en la tabla de clientes 
                        //ya sea fisica moral o fideicomiso 
                        $table="telefono";
                        $pk ="idtelefono";
                        $last_id_tel = $this->operaciones_model->last_id($table,$pk);
                        $id_tel=$last_id_tel+1;
                        //con el id del telefono recuperado procedemos a insertar en la tabla cliente
                        $tabla_cliente = "cliente";
                            $data_cliente = array(
                                'idcliente'=> NULL,
                                'tipo_persona'=> $this->input->post('tipo_persona'),
                                'tipo_domicilio'=> $this->input->post('selecttipo_domicilio'),
                                'id_telefono'=> $id_tel,
                                'idaviso'=>$id_aviso
                            );

                            //if($insert_aviso == TRUE){
                            $insert_cliente = $this->operaciones_model->insert($tabla_cliente,$data_cliente);
                            $id_cliente=mysql_insert_id();
                            /******************************/
                            $data_tel = array(
                                    'idtelefono' => NULL,
                                    'clave_pais' => $this->input->post('lada'),
                                    'numero_tel' => $this->input->post('num_tel'),
                                    'correo_electronico' => $this->input->post('correo'),
                                    'idcliente'  => $id_cliente,
                                    'idbeneficiario' => NULL
                            );
                            $this->operaciones_model->insert('telefono',$data_tel);
                        //si existe el aviso hacemos un switch para el tipo de persona
                        switch ($this->input->post('tipo_persona'))
                        {
                            case 1 :
                                //persona fisica
                                //recuperamos los datos para la persona fisica 
                                 $tabla="persona_fisica";
                                //$identif_otro=
                                /*if(isset($this->input->post('descripcion_identificacion')) && $this->input->post('descripcion_identificacion') != NULL)
                                    {
                                    $identif_otro = $this->input->post('descripcion_identificacion');
                                    }else
                                    {
                                        $identif_otro = NULL;
                                    }*/
                              $data_persona = array(
                                'id_persona_fisica' => NULL,
                                'nombre'            => $this->input->post('nombre_persona'),
                                'ap_paterno'        =>  $this->input->post('ap_paterno'),
                                'ap_materno'        =>  $this->input->post('ap_materno'),
                                'fecha_nacimiento'  =>  $this->input->post('fecha_nac'),
                                'rfc'               =>  $this->input->post('rfc'),
                                'curp'              =>  $this->input->post('curp'),
                                'pais_nacionalidad' =>  $this->input->post('nacionalidad') ,
                                'pais_nacimiento'   =>  $this->input->post('pais_nacimiento'),
                                'actividad_economica'=> $this->input->post('clave_actividad'),
                                'tipo_identificacion'=> $this->input->post('tipo_identificacion'),
                                'identificacion_otro'=> $this->input->post('descripcion_identificacion'),
                                'autoridad_identificacion'=>    $this->input->post('aut_identif'),
                                'numero_identificacion' =>   $this->input->post('numero_identif'),
                                'idcliente'             => $id_cliente,
                                'idbeneficiario'        =>  NULL
                            );
                           //$insert = 
                           $this->operaciones_model->insert($tabla,$data_persona);  
                            
                               
                                
                                break;
                            case 2 :
                                //persona moral
                                //insertamos primero los datos del representante apoderado
                              /* if(isset($this->input->post('descripcion_identificacion')) && $this->input->post('descripcion_identificacion') != NULL)
                                    {
                                    $identif_otro = $this->input->post('descripcion_identificacion');
                                    }else
                                    {
                                        $identif_otro = NULL;
                                    }*/
                                 $data_representante=array(
                                     'idrepresentante_apoderado' => NULL,
                                                        'nombre' => $this->input->post('nombre_persona'),
                                                    'ap_paterno' => $this->input->post('ap_paterno'),
                                                    'ap_materno' => $this->input->post('ap_materno'),
                                                     'fecha_nac' => $this->input->post('fecha_nac'),
                                                           'rfc' => $this->input->post('rfc'),
                                                          'curp' => $this->input->post('curp'),
                                           'tipo_identificacion' => $this->input->post('tipo_identificacion'),
                                           'identificacion_otro' => $this->input->post('descripcion_identificacion'),
                                      'autoridad_identificacion' => $this->input->post('aut_identif'),
                                         'numero_identificacion' => $this->input->post('numero_identif')
                                 );
                                 $this->operaciones_model->insert('representante_apoderado',$data_representante);
                                 $id_apoderado=mysql_insert_id();
                                 //recuperamos el id del representante insertado
                                 $data_persona_moral=array(
                                    'idpersonamoral'    => NULL,
                                    'idcliente'         => $id_cliente,
                                    'idbeneficiario'    => NULL,
                                    'razon_social'      => $this->input->post('razon_social'),
                                    'fecha_constitucion'=> $this->input->post('fecha_constitucion'),
                                    'rfc'               => $this->input->post('rfc_moral'),
                                    'pais_nacionalidad' => $this->input->post('nacionalidad'),
                                    'giro_mercantil'    => $this->input->post('clave_actividad'),
                                    'idrepresentante_apoderado'=> $id_apoderado,
                                
                                            );
                                 $this->operaciones_model->insert('persona_moral',$data_persona_moral);
                            
                                break;
                            case 3 :
                                //fideicomiso
                               /*  if(isset($this->input->post('descripcion_identificacion')) && $this->input->post('descripcion_identificacion') != NULL)
                                    {
                                    $identif_otro = $this->input->post('descripcion_identificacion');
                                    }else
                                    {
                                        $identif_otro = NULL;
                                    }*/
                                 $data_apoderado=array(
                                     'idapoderado_delegado' => NULL,
                                      'nombre'              => $this->input->post('nombre_persona'),
                                      'ap_paterno'          => $this->input->post('ap_paterno'),
                                      'ap_materno'          => $this->input->post('ap_materno'),
                                      'fecha_nac'           => $this->input->post('fecha_nac'),
                                      'rfc'                 => $this->input->post('rfc'),
                                      'curp'                => $this->input->post('curp'),
                                      'tipo_identificacion' => $this->input->post('tipo_identificacion'),
                                      'identificacion_otro' => $this->input->post('descripcion_identificacion'),
                                      'autoridad_identificacion' => $this->input->post('aut_identif'),
                                      'numero_identificacion'    => $this->input->post('numero_identif')
                                 );
                                 $this->operaciones_model->insert('apoderado_delegado',$data_apoderado);
                                  $id_apoderado_del=mysql_insert_id();
                                 $data_fideicomiso=array(
                                    'idfideicomiso'         => NULL,
                                    'razon_social'          => $this->input->post('razon_social'),
                                    'rfc'                   => $this->input->post('rfc_fideicomiso'),
                                    'identificador_fideicomiso'  => $this->input->post('identificador_fideicomiso'),
                                    'idapoderado_delegado'       => $id_apoderado_del,
                                    'idcliente'                  => $id_cliente,
                                    'idbeneficiario'             => NULL
                                                                   
                                            );
                                            $this->operaciones_model->insert('fideicomiso',$data_fideicomiso);
                                
                                break;
                            
                        }//fin switch tipo de persona 
                        switch ($this->input->post('selecttipo_domicilio'))
                        {
                            case 1:
                                //domicilio nacional
                                 $tabla="dom_nacional";
                            $data_dom = array(
                               'iddom_nacional' => NULL,
                               'colonia'        => $this->input->post('colonia'),
                               'calle'          => $this->input->post('calle'),
                               'numero_interior'=> $this->input->post('num_int'),
                               'numero_exterior'=> $this->input->post('num_ext'),
                               'cp'             => $this->input->post('cp'),
                               'idcliente'      => $id_cliente,
                               'idbeneficiario'=>  NULL
                            );
                           //$insert = 
                           $this->operaciones_model->insert($tabla,$data_dom); 
                                break;
                            case 2:
                                //domicilio extranjero
                                 $tabla="dom_extranjero";
                            $data_dom = array(
                               'iddom_extranjero'   => NULL,
                               'idpais'             => $this->input->post('pais_nacimiento'),
                               'provincia'          => $this->input->post('estado'),
                               'ciudad'             => $this->input->post('ciudad'),
                               'colonia'            => $this->input->post('colonia'),
                               'calle'              => $this->input->post('calle'),
                               'numero_exterior'    => $this->input->post('num_ext'),
                               'numero_interior'    => $this->input->post('num_int'),
                               'cp'                 => $this->input->post('cp'),
                               'idcliente'          => $id_cliente,
                               'idbeneficiario'     => NULL,
                            );
                           //$insert = 
                           $this->operaciones_model->insert($tabla,$data_dom); 
                                break;
                            
                        }//fin tipo de domicilio
                      // redirect(base_url().'index.php/persona_aviso/');
                        //$this->input->post('tipo_persona');
                         echo "1";
                    }else
                        {
                        //echo 'nulo';
                        //redirigimos a crear el aviso y mandamos un mensaje de error
                        }
                     
                     
                     }
         
     }  
     function check_default($post_string)
               {
                 return $post_string == '0' ? FALSE : TRUE;
               }
    function add_beneficiario()
                {
           
            $this->load->view('content/form_beneficiario');
                } 
   
     /****************************************************/
     function actualizar_datos() {
        //configuracion de variablestipo de persona y tipo de domicilio
         //switch para tipo de persona
         switch($this->input->post('tipo_persona'))
         {
             case 1:
                    $this->update_persona_fisica();
                 break;
             case 2:
                 $this->update_persona_moral();
                 break;
             case 3:
                 $this->update_fideicomiso();
                 break;
         }
         //switch para tipo de domicilio
         switch ($this->input->post('selecttipo_domicilio')) {
             case 1:
                    $this->update_nacional();

                 break;

             case 2:
                 $this->update_extranjero();
                 break;
         }
         $this->update_telefono();
         
     }   
     function update_persona_fisica()
     {
        $update = 'UPDATE cliente as C 
                    JOIN persona_fisica as F
                    on C.idcliente = F.idcliente
                    set F.nombre = "'.$this->input->post('nombre_persona').'",
                            F.ap_paterno = "'.$this->input->post('ap_paterno').'",
                            F.ap_materno = "'.$this->input->post('ap_materno').'",
                            F.fecha_nacimiento = "'.$this->input->post('fecha_nac').'",
                            F.rfc= "'.$this->input->post('rfc').'",
                            F.curp = "'.$this->input->post('curp').'",
                            F.identificacion_otro = "'.$this->input->post('identif_otro').'",    
                            F.autoridad_identificacion = "'.$this->input->post('aut_identif').'",
                            F.numero_identificacion = "'.$this->input->post('numero_identif').'"
                    WHERE C.idaviso='.$this->input->post('id_aviso').';'; 
        $act=$this->db->query($update);
       return $act;
     }
     function update_persona_moral()
     {
       $update_moral = 'UPDATE cliente as C
                        JOIN persona_moral as M
                        on C.idcliente = M.idcliente
                        set M.razon_social= "'.$this->input->post('razon_social').'",
                            M.fecha_constitucion = "'.$this->input->post('fecha_constitucion').'",
                            M.rfc = "'.$this->input->post('rfc').'",
                            M.pais_nacionalidad = "'.$this->input->post('nacionalidad').'",
                            M.giro_mercantil = "'.$this->input->post('clave_actividad').'"
                            WHERE C.idaviso = '.$this->input->post('id_aviso').';';  
       $act_moral = $this->db->query($update_moral);
       echo 'moral '.$act_moral;
       $this->update_representante_apoderado();
         
     }
     function update_fideicomiso()
     {
         $update_fideicomiso = 'UPDATE cliente as C 
                                JOIN fideicomiso as F
                                on C.idcliente = F.idcliente
                                set F.razon_social = "'.$this->input->post('razon_social').'",
                                    F.rfc = "'.$this->input->post('rfc').'",
                                    F.identificador_fideicomiso = "'.$this->input->post('identificador_fideicomiso').'" 
                                   WHERE  C.idaviso = "'.$this->input->post('id_aviso').'";';
         $act_fideicomiso = $this->db->query($update_fideicomiso);
         echo "f".$act_fideicomiso;
         $this->update_apoderado_delegado();
     }                                  
     function update_nacional()
     {
         $update_nac= 'UPDATE cliente  as C 
                        JOIN dom_nacional as N 
                        on C.idcliente = N.idcliente
                        set N.colonia = "'.$this->input->post('colonia').'",
                            N.calle = "'.$this->input->post('calle').'",
                            N.numero_interior ="'.$this->input->post('num_int').'",
                            N.numero_exterior="'.$this->input->post('num_ext').'",
                            N.cp="'.$this->input->post('cp').'"
                            WHERE C.idaviso = '.$this->input->post('id_aviso').';';
         $act_nac = $this->db->query($update_nac);
        echo $act_nac;
     }
     function update_extranjero()
     {
         $update_ext= 'UPDATE cliente  as C 
                        JOIN dom_extranjero as E 
                        on C.idcliente = E.idcliente
                        set E.idpais = "'.$this->input->post('pais_nacimiento').'",
                            E.provincia = "'.$this->input->post('estado').'",
                            E.ciudad ="'.$this->input->post('ciudad').'",
                            E.colonia ="'.$this->input->post('colonia').'",    
                            E.calle ="'.$this->input->post('calle').'",    
                            E.numero_interior ="'.$this->input->post('num_int').'",    
                            E.numero_exterior="'.$this->input->post('num_ext').'",
                            E.cp="'.$this->input->post('cp').'"
                            WHERE C.idaviso = '.$this->input->post('id_aviso').';';
         $act_ext = $this->db->query($update_ext);
        echo $act_ext; 
     }
     
     function update_telefono()
     {
         $update_tel = 'UPDATE cliente as C 
                         JOIN telefono as T
                          on C.idcliente= T.idcliente
                            set T.clave_pais = "'.$this->input->post('lada').'",
                                T.numero_tel="'.$this->input->post('num_tel').'",
                                T.correo_electronico="'.$this->input->post('correo').'"
                                WHERE C.idaviso = '.$this->input->post('id_aviso').';';
         $act_tel = $this->db->query($update_tel);
         echo $act_tel;
     }
     function update_representante_apoderado()
        {
           $update_ra = 'UPDATE persona_moral as M 
            JOIN representante_apoderado as R
            on M.idrepresentante_apoderado = R.idrepresentante_apoderado
            set R.nombre = "'.$this->input->post('nombre_persona').'",
                R.ap_paterno = "'.$this->input->post('ap_paterno').'",
                R.ap_materno = "'.$this->input->post('ap_materno').'",
                R.fecha_nac = "'.$this->input->post('fecha_nac').'",
                R.rfc = "'.$this->input->post('rfc').'",
                R.curp = "'.$this->input->post('curp').'",
                R.identificacion_otro = "'.$this->input->post('identificacion_otro').'",
                R.autoridad_identificacion = "'.$this->input->post('aut_identif').'",
                R.numero_identificacion = "'.$this->input->post('numero_identif').'"
              WHERE M.idrepresentante_apoderado = '.$this->input->post('rep').';';
           $act_ra= $this->db->query($update_ra);
           echo "rep apoder".$act_ra;
        }
        
      function update_apoderado_delegado()
        {
          $update_ad = 'UPDATE fideicomiso as F
                        JOIN apoderado_delegado as A
                        on F.idapoderado_delegado = A.idapoderado_delegado
                        set A.nombre = "'.$this->input->post('nombre_persona').'",
                            A.ap_paterno = "'.$this->input->post('ap_paterno').'",
                            A.ap_materno = "'.$this->input->post('ap_materno').'",
                            A.fecha_nac = "'.$this->input->post('fecha_nac').'",
                            A.rfc = "'.$this->input->post('rfc').'",
                            A.curp = "'.$this->input->post('curp').'",
                            A.identificacion_otro = "'.$this->input->post('identificacion_otro').'",
                            A.autoridad_identificacion = "'.$this->input->post('aut_identif').'",
                            A.numero_identificacion = "'.$this->input->post('numero_identif').'" 
                             WHERE F.idapoderado_delegado = "'.$this->input->post('ad').'"' ;
                    $actad = $this->db->query($update_ad);
                    echo "ad ".$actad;
                  
                        
        }
        
       
}//fin clase persona aviso
