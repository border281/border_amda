<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beneficiario extends CI_Controller {

	public function __construct() {
            parent::__construct();
           
            $this->load->model('catalogos_model');
            $this->load->model('xml_model');
            $this->load->model('operaciones_model');
            $this->load->library(array('session','form_validation'));
            $this->load->library('Librarybeneficiario');
            $this->load->helper(array('url','form'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->config('amda');
            //
        }
        public function index()
                {
            //  $data['id_aviso'] = $this->session->userdata('id_aviso');
         //   $data['id_aviso']= $this->session->userdata('id_aviso');
          //  $data['contentx']='beneficiario';
           // $data['index_beneficiario']=$num_benef;
            // $data['usuario'] = $this->session->userdata('username');
            // $data['menu']='menu_create';
            //   $this->load->view('admin/template',$data);
            //$this->load->view('admin/template',$data);
                }
         public function tipo_persona() {
             
              $datos_beneficiario = $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
             
                   if($this->input->post('tipo_persona')== '0') {
                       return false;
                   }
                   if($this->input->post('tipo_persona')== '1') {
                       
                       $datos_beneficiario = $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
             
                       
                       $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $data['clave_actividad']= $this->catalogos_model->clave_actividad();
                       $data['clave_pais']=  $this->catalogos_model->pais();
                       $data['id_aviso'] = $this->session->userdata('id_aviso');
                       
                       
                        //$datos_beneficiario = $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
             
             
                       //si existen datos de beneficiario hacemos
                     //  $row_datosbeneficiario = $datos_beneficiario->row();
                       
                      // $p_fisica = $this->xml_model->persona_fisica_beneficiario($row_datosbeneficiario->idbeneficiario);
                      //  echo $this->db->last_query();
                     /*  if($datos_beneficiario->num_rows() > 0)
                            {
                             //   $row_fisica = $p_fisica->row();$beneficiario->result() as $row_beneficiario
                             foreach ($datos_beneficiario->result() as $row_fisica){
                                    $data['nombre']=array('name'=>'nombre_persona','value'=> $row_fisica->nombre,'class'=>'form-control');
                                    $data['fecha_nac']=array('name'=>'fecha_nac','value'=> $row_fisica->fecha_nacimiento,'class'=>'form-control');
                                    $data['ap_paterno']=array('name'=>'ap_paterno','value'=> $row_fisica->ap_paterno,'class'=>'form-control');
                                    $data['ap_materno']=array('name'=>'ap_materno','value'=> $row_fisica->ap_materno,'class'=>'form-control');
                                    $data['rfc']=array('name'=>'rfc','value'=> $row_fisica->rfc,'class'=>'form-control');
                                    $data['curp']=array('name'=>'curp','value'=> $row_fisica->curp,'class'=>'form-control');
                                    $data['aut_identif']=array('name'=>'aut_identif','value'=> $row_fisica->autoridad_identificacion,'class'=>'form-control');
                                    $data['numero_identif']=array('name'=>'numero_identif','value'=> $row_fisica->numero_identificacion,'class'=>'form-control');
                                     $this->load->view('tipo_persona/beneficiario/persona_fisica_beneficiario',$data);
                             }
                            }else{*/
                       //$data['mes'] = array('name' => 'mes', 'placeholder' => 'mes','class' => 'form-control');
                      $data['nombre']=array('name'=>'nombre_persona','value'=> set_value("nombre_persona"),'class'=>'form-control');
                      $data['fecha_nacimiento_beneficiario']=array('name'=>'fecha_nacimiento_beneficiario','id'=>'fecha_nacimiento_beneficiario','class'=>'form-control','type'=>'hidden');
                      $data['ap_paterno']=array('name'=>'ap_paterno','value'=> set_value("ap_paterno"),'class'=>'form-control');
                      $data['ap_materno']=array('name'=>'ap_materno','value'=> set_value("ap_materno"),'class'=>'form-control');
                      $data['rfc']=array('name'=>'rfc','value'=> set_value("rfc"),'class'=>'form-control','onblur'=>'ValidaRfcb(this.value)');
                      $data['curp']=array('name'=>'curp','value'=> set_value("curp"),'class'=>'form-control');
                      $data['aut_identif']=array('name'=>'aut_identif','value'=> set_value("aut_identif"),'class'=>'form-control');
                      $data['numero_identif']=array('name'=>'numero_identif','value'=> set_value("numero_identif"),'class'=>'form-control');
                      //$data['colonia']=array();
                     // $data['calle']=array();
                     // $data['c']=array();
                     // $data['colonia']=array();
                      $this->load->view('tipo_persona/beneficiario/persona_fisica_beneficiario',$data);
                          //  }
                            
                            }
                   if($this->input->post('tipo_persona')== '2') {
                       //PERSONA MORAL
                       $data['razon_social']=array('name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'form-control');
                     // $data['razon_social']=array('name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'form-control');
                       $data['fecha_constitucion']=array('name'=>'fecha_constitucion','id'=>'fecha_constitucion','class'=>'form-control','type'=>'hidden');
                     //
                      $data['rfc']=array('name'=>'rfc','value'=>set_value('rfc'),'class'=>'form_control');
                       //$data['']
                       //representante apoderado
                      $data['id_aviso'] = $this->session->userdata('id_aviso');
                      $data['nombre']=array('name'=>'nombre_persona','value'=> set_value("nombre_persona"),'class'=>'form-control');
                      $data['fecha_nacimiento_beneficiario']=array('name'=>'fecha_nacimiento_beneficiario','id'=>'fecha_nacimiento_beneficiario','value'=> set_value("fecha_nacimiento_beneficiario"),'class'=>'form-control');
                      $data['ap_paterno']=array('name'=>'ap_paterno','value'=> set_value("ap_paterno"),'class'=>'form-control');
                      $data['ap_materno']=array('name'=>'ap_materno','value'=> set_value("ap_materno"),'class'=>'form-control');
                      $data['rfc']=array('name'=>'rfc','value'=> set_value("rfc"),'class'=>'form-control','onblur'=>'ValidaRfcb(this.value)');
                      $data['curp']=array('name'=>'curp','value'=> set_value("curp"),'class'=>'form-control');
                      $data['aut_identif']=array('name'=>'aut_identif','value'=> set_value("aut_identif"),'class'=>'form-control');
                      $data['numero_identif']=array('name'=>'numero_identif','value'=> set_value("numero_identif"),'class'=>'form-control');
                      //**********
                       $data['clave_pais']=  $this->catalogos_model->pais();
                       $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $data['clave_actividad']= $this->catalogos_model->clave_actividad();
                      $this->load->view('tipo_persona/beneficiario/persona_moral_beneficiario',$data);
                   }
                   if($this->input->post('tipo_persona')== '3') {
                       //FIDEICOMISO
                        $data['razon_social']=array('name'=>'razon_social','value'=> set_value("razon_social"),'class'=>'form-control');
                     
                     //  $data['razon_social']=array('name'=>'razon_social','value'=>  set_value('razon_social'),'class'=>'form_control');
                       $data['rfc']=array('name'=>'rfc','value'=>  set_value('rfc'),'class'=>'form_control');
                      $data['id_aviso'] = $this->session->userdata('id_aviso');
                      // $data['identificador_fideicomiso']=array('name'=>'identificador_fideicomiso','value'=>set_value('identificador_fideicomiso'),'class'=>'form_control');
                       $data['identificador_fideicomiso']=array('name'=>'identificador_fideicomiso','value'=> set_value("identificador_fideicomiso"),'class'=>'form-control');
                      $data['nombre']=array('name'=>'nombre_persona','value'=> set_value("nombre_persona"),'class'=>'form-control');
                      $data['fecha_nacimiento_beneficiario']=array('name'=>'fecha_nacimiento_beneficiario','id'=>'fecha_nacimiento_beneficiario','value'=> set_value("fecha_nacimiento_beneficiario"),'class'=>'form-control');
                      $data['ap_paterno']=array('name'=>'ap_paterno','value'=> set_value("ap_paterno"),'class'=>'form-control');
                      $data['ap_materno']=array('name'=>'ap_materno','value'=> set_value("ap_materno"),'class'=>'form-control');
                      $data['rfc']=array('name'=>'rfc','value'=> set_value("rfc"),'class'=>'form-control','onblur'=>'ValidaRfcb(this.value)');
                      $data['curp']=array('name'=>'curp','value'=> set_value("curp"),'class'=>'form-control');
                      $data['aut_identif']=array('name'=>'aut_identif','value'=> set_value("aut_identif"),'class'=>'form-control');
                      $data['numero_identif']=array('name'=>'numero_identif','value'=> set_value("numero_identif"),'class'=>'form-control');
                     
                       $data['tipo_identificacion']= $this->catalogos_model->tipo_identificacion();
                       $this->load->view('tipo_persona/beneficiario/fideicomiso_beneficiario',$data);
                   }
        } //fin tipo persona
     public function tipo_domicilio()
             {
          $datos_beneficiario = $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
             
                 if($this->input->post('tipo_domicilio')== '0') {
                       return false;
                   }
                   if($this->input->post('tipo_domicilio')== '1') {
                       
                        $data['clave_pais']=  $this->catalogos_model->pais();
                      $data['colonia']=array('name'=>'colonia','value'=>  set_value("colonia"),'class'=>'form-control');
                      $data['calle']=array('name'=>'calle','value'=>  set_value("calle"),'class'=>'form-control');
                      $data['num_ext']=array('name'=>'num_ext','value'=>  set_value("num_ext"),'class'=>'form-control');
                      $data['num_int']=array('name'=>'num_int','value'=>  set_value("num_int"),'class'=>'form-control');  
                      $data['cp']=array('name'=>'cp','value'=>  set_value("cp"),'class'=>'form-control');
                      $data['lada']=array('name'=>'lada','value'=>  set_value("lada"),'class'=>'form-control');
                      $data['num_tel']=array('name'=>'num_tel','value'=>  set_value("num_tel"),'class'=>'form-control');
                      $data['correo']=array('name'=>'correo','value'=>  set_value("correo"),'class'=>'form-control');
                        $this->load->view('tipo_domicilio/beneficiario/nacional',$data);
                   } 
                  if($this->input->post('tipo_domicilio')=='2')
                      {
                      
                        $data['clave_pais']=  $this->catalogos_model->pais();
                        $data['estado']=array('name'=>'estado','value'=> set_value("estado"),'class'=>'form-control');
                        $data['ciudad']=array('name'=>'ciudad','value'=>  set_value("ciudad"),'class'=>'form-control');
                        $data['colonia']=array('name'=>'colonia','value'=>  set_value("colonia"),'class'=>'form-control');
                        $data['calle']=array('name'=>'calle','value'=>  set_value("calle"),'class'=>'form-control');
                        $data['num_ext']=array('name'=>'num_ext','value'=>  set_value("num_ext"),'class'=>'form-control');
                        $data['num_int']=array('name'=>'num_int','value'=>  set_value("num_int"),'class'=>'form-control');  
                        $data['cp']=array('name'=>'cp','value'=>  set_value("cp"),'class'=>'form-control');
                        $data['lada']=array('name'=>'lada','value'=>  set_value("lada"),'class'=>'form-control');
                        $data['num_tel']=array('name'=>'num_tel','value'=>  set_value("num_tel"),'class'=>'form-control');
                        $data['correo']=array('name'=>'correo','value'=>  set_value("correo"),'class'=>'form-control');
                      
                        $this->load->view('tipo_domicilio/beneficiario/extranjero',$data);
                               
                      
                      } 
             }
        public function save_beneficiario() {
          //  print_r($_POST);
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
                       
                            $data_beneficiario = array(
                                'idbeneficiario'=> NULL,
                                'tipo_persona'=> $this->input->post('tipo_persona_beneficiario'),
                                'tipo_domicilio'=> $this->input->post('selecttipo_domicilio_beneficiario'),
                                'id_telefono'=> $id_tel,
                                'idaviso'=>$id_aviso
                            );

                            //if($insert_aviso == TRUE){
                            //$insert_beneficiario = 
                             $this->operaciones_model->insert('beneficiario',$data_beneficiario);
                            $id_beneficiario=mysql_insert_id();
                            /******************************/
                            $data_tel = array(
                                    'idtelefono' => NULL,
                                    'clave_pais' => $this->input->post('lada'),
                                    'numero_tel' => $this->input->post('num_tel'),
                                    'correo_electronico' => $this->input->post('correo'),
                                    'idcliente'  => NULL,
                                    'idbeneficiario' => $id_beneficiario
                            );
                            $this->operaciones_model->insert('telefono',$data_tel);
                        //si existe el aviso hacemos un switch para el tipo de persona
                        switch ($this->input->post('tipo_persona_beneficiario'))
                        {
                            case 1 :
                                //persona fisica
                                //recuperamos los datos para la persona fisica 
                                // $tabla="persona_fisica";
                              $data_persona = array(
                                'id_persona_fisica' => NULL,
                                'nombre'            => $this->input->post('nombre_persona'),
                                'ap_paterno'        =>  $this->input->post('ap_paterno'),
                                'ap_materno'        =>  $this->input->post('ap_materno'),
                                'fecha_nacimiento'  =>  $this->input->post('fecha_nacimiento_beneficiario'),
                                'rfc'               =>  $this->input->post('rfc'),
                                'curp'              =>  $this->input->post('curp'),
                                'pais_nacionalidad' =>  $this->input->post('nacionalidad') ,
                                'pais_nacimiento'   =>  $this->input->post('pais_nacimiento'),
                                'actividad_economica'=> $this->input->post('actividad_economica'),
                                'tipo_identificacion'=> NULL,
                                'identificacion_otro'=> NULL,
                                'autoridad_identificacion'=>  NULL,
                                'numero_identificacion' =>   NULL,
                                'idcliente'             => NULL,
                                'idbeneficiario'        => $id_beneficiario
                            );
                           //$insert = 
                           $this->operaciones_model->insert('persona_fisica',$data_persona);  
                            
                                
                                
                                break;
                            case 2 :
                                //persona moral
                                //insertamos primero los datos del representante apoderado
                               
                                
                                 //recuperamos el id del representante insertado
                                 $data_persona_moral=array(
                                    'idpersonamoral'    => NULL,
                                    'idcliente'         => NULL,
                                    'idbeneficiario'    => $id_beneficiario,
                                    'razon_social'      => $this->input->post('razon_social'),
                                    'fecha_constitucion'=> $this->input->post('fecha_constitucion'),
                                    'rfc'               => $this->input->post('rfc'),
                                    'pais_nacionalidad' => $this->input->post('nacionalidad'),
                                    'giro_mercantil'    => $this->input->post('clave_actividad'),
                                    'idrepresentante_apoderado'=> NULL,
                                
                                            );
                                 $this->operaciones_model->insert('persona_moral',$data_persona_moral);
                            
                                break;
                            case 3 :
                                //fideicomiso
                                
                                 $data_fideicomiso=array(
                                    'idfideicomiso'         => NULL,
                                    'razon_social'          => $this->input->post('razon_social'),
                                    'rfc'                   => $this->input->post('rfc'),
                                    'identificador_fideicomiso'  => $this->input->post('identificador_fideicomiso'),
                                    'idapoderado_delegado'       => NULL,
                                    'idcliente'                  => NULL,
                                    'idbeneficiario'             => $id_beneficiario
                                                                   
                                            );
                                            $this->operaciones_model->insert('fideicomiso',$data_fideicomiso);
                                
                                break;
                            
                        }//fin switch tipo de persona 
                        switch ($this->input->post('selecttipo_domicilio_beneficiario'))
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
                               'idcliente'      => NULL,
                               'idbeneficiario'=>  $id_beneficiario
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
                               'idcliente'          => NULL,
                               'idbeneficiario'     => $id_beneficiario
                            );
                           //$insert = 
                           $this->operaciones_model->insert($tabla,$data_dom); 
                                break;
                            
                        }//fin tipo de domicilio
                        
                        redirect(base_url().'index.php/persona_aviso/');
                    }else
                        {
                        //echo 'nulo';
                        //redirigimos a crear el aviso y mandamos un mensaje de error
                        redirect(base_url().'index.php/');
                        }
            
            
        }//fin save beneficiario     
              
        public function mostrar_datos($idaviso,$idbeneficiario)
                {
                    //recibimos los datos y rendereamos para mostrar la vista con los datos correspondientes 
                    // se podran actualizar los datos
            // $datos_beneficiario = $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
             
                    //$general_benef = $this->xml_model->count_beneficiario($idaviso);
                    //if($general_benef->num_rows() > 0)
                      //  {
                        //    $row_benef=$general_benef->row();
                          //  $tipo_persona= $row_benef->tipo_persona;
                            //$tipo_domicilio = $row_benef->tipo_domicilio;
                        //}
                //recuperamos los datos de las operaciones 
                         $data['beneficiario'] =  $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                          $dat_benef= $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                           $data['clave_pais']=  $this->catalogos_model->pais();
                         $data['id_aviso'] = $this->session->userdata('id_aviso');
                         $data['operaciones']= $this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);        
                          $total_operaciones =$this->xml_model->operaciones($this->session->userdata('id_aviso'),NULL);
                                                            
                         $data['usuario'] = $this->session->userdata('username');
                         $data['title']='Datos Beneficiario -> persona_aviso:: AMDA ::';
                         $data['subtitle']='Datos Beneficiario';
                         $data['contentx']='datos_beneficiario';
                         $data['menu']='menu_create_1';
                         $data['idaviso']=$idaviso;
                        // $this->librarybeneficiario->beneficiario($idaviso,$idbeneficiario);
                         $data['idbeneficiario']=$idbeneficiario; 
                         $this->load->view('admin/template',$data); 
                            if($dat_benef->num_rows() > 0)
                              {
                               $row_data_benef = $dat_benef->row(); 
                            $data_ben['tipo_p']=$row_data_benef->tipo_persona;
                              }
                            $data_ben['id_aviso']=$this->session->userdata('id_aviso');
                                    $data_ben['id_beneficiario'] = $idbeneficiario;
                         $this->load->view('ajax_persona_beneficiario',$data_ben);   
               // $data['idbeneficiario']=$idbeneficiario;
                   // $this->load->view('beneficiario/datos_beneficiario',$data);
                  
                }
                public function datos($id_aviso,$id_beneficiario) {
                  // $benef= $this->xml_model->count_beneficiario($this->session->userdata('id_aviso'));
                      //                          
                     $this->librarybeneficiario->beneficiario($id_aviso,$id_beneficiario);
                }
                
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
         switch ($this->input->post('selecttipo_domicilio_beneficiario')) {
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
        // print_r($_POST);
 
        $update = 'UPDATE beneficiario AS B
                    JOIN persona_fisica AS F
                   ON B.idbeneficiario = F.idbeneficiario
                    set F.nombre = "'.$this->input->post('nombre_persona').'",
                            F.ap_paterno = "'.$this->input->post('ap_paterno').'",
                            F.ap_materno = "'.$this->input->post('ap_materno').'",
                            F.fecha_nacimiento = "'.$this->input->post('fecha_nac').'",
                            F.rfc= "'.$this->input->post('rfc').'",
                            F.curp = "'.$this->input->post('curp').'"
                       WHERE B.idaviso ='.$this->input->post('id_aviso').'
                        AND  B.idbeneficiario = '.$this->input->post('idb').';'; 
       // echo $update;
        $act=$this->db->query($update);
       return $act;
     }
     function update_persona_moral()
     {
       $update_moral = 'UPDATE beneficiario as B 
                        JOIN persona_moral as M
                        on B.idbeneficiario = M.idbeneficiario
                        set M.razon_social= "'.$this->input->post('razon_social').'",
                            M.fecha_constitucion = "'.$this->input->post('fecha_constitucion').'",
                            M.rfc = "'.$this->input->post('rfc').'"                      
                           WHERE B.idaviso = '.$this->input->post('id_aviso').'
                             AND B.idbeneficiario = '.$this->input->post('idb').';';    
       $act_moral = $this->db->query($update_moral);
       echo $this->db->last_query();//'moral '.$act_moral;
       //$this->update_representante_apoderado();
         
     }
     function update_fideicomiso()
     {
         $update_fideicomiso = 'UPDATE beneficiario as B 
                                JOIN fideicomiso as F
                                on B.idbeneficiario = F.idbeneficiario
                                set F.razon_social = "'.$this->input->post('razon_social').'",
                                    F.rfc = "'.$this->input->post('rfc').'",
                                    F.identificador_fideicomiso = "'.$this->input->post('id_fideicomiso').'" 
                                   WHERE  B.idaviso = '.$this->input->post('id_aviso').'
                                   AND B.idbeneficiario = '.$this->input->post('idb').';';
         $act_fideicomiso = $this->db->query($update_fideicomiso);
         echo "f".$act_fideicomiso;
        // $this->update_apoderado_delegado();
     }                                  
     function update_nacional()
     {
         $update_nac= 'UPDATE beneficiario  as B 
                        JOIN dom_nacional as N 
                        on B.idbeneficiario = N.idbeneficiario
                        set N.colonia = "'.$this->input->post('colonia').'",
                            N.calle = "'.$this->input->post('calle').'",
                            N.numero_interior ="'.$this->input->post('num_int').'",
                            N.numero_exterior="'.$this->input->post('num_ext').'",
                            N.cp="'.$this->input->post('codigo_postal').'"
                            WHERE B.idaviso = '.$this->input->post('id_aviso').'
                            AND B.idbeneficiario = '.$this->input->post('idb').';';
         $act_nac = $this->db->query($update_nac);
       // echo $update_nac;
     }
     function update_extranjero()
     {
         $update_ext= 'UPDATE beneficiario  as B 
                        JOIN dom_extranjero as E 
                        on B.idbeneficiario = E.idbeneficiario
                        set E.idpais = "'.$this->input->post('pais_nacimiento').'",
                            E.provincia = "'.$this->input->post('estado').'",
                            E.ciudad ="'.$this->input->post('ciudad').'",
                            E.colonia ="'.$this->input->post('colonia').'",    
                            E.calle ="'.$this->input->post('calle').'",    
                            E.numero_interior ="'.$this->input->post('num_int').'",    
                            E.numero_exterior="'.$this->input->post('num_ext').'",
                            E.cp="'.$this->input->post('cp').'"
                            WHERE B.idaviso = '.$this->input->post('id_aviso').'
                             AND B.idbeneficiario = '.$this->input->post('idb').';';    
         $act_ext = $this->db->query($update_ext);
        echo 'ext'.$act_ext; 
     }
     
     function update_telefono()
     {
         $update_tel = 'UPDATE beneficiario as B 
                         JOIN telefono as T
                          on B.idbeneficiario = T.idbeneficiario
                            set T.numero_tel="'.$this->input->post('telefono').'",
                                T.correo_electronico="'.$this->input->post('email').'"
                                WHERE B.idaviso = '.$this->input->post('id_aviso').'
                                AND B.idbeneficiario = '.$this->input->post('idb').';';
         $act_tel = $this->db->query($update_tel);
        // echo $update_tel;
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
                
}//fin beneficiario