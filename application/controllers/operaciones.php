<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operaciones extends CI_Controller {

	public function __construct() {
            parent::__construct();
           
            $this->load->model('catalogos_model');
            $this->load->model('xml_model');
            $this->load->library(array('session','form_validation'));
            $this->load->library('Amd');
            $this->load->helper(array('url','form'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->config('amda');
            $this->load->model('avisos_model');
            $this->load->model('operaciones_model');
            //
        }
 /***********************************************/       
        function index($datos_operacion = NULL) {
            if($this->session->userdata('role_id') == FALSE || $this->session->userdata('role_id') != '4')
                       {
                               redirect(base_url().'index.php/amda');
                               $this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
                               
                       }else{
          //tenemos que mostrar los datos de la operacion 
            //si existe el id datos de operacion hacemos consulta para ver si la operacion esiste 
            //si no existe mostraremos la vista para capturarla 
            //aunque en teoria no deberia haber operaciones vacias 
                if(isset($datos_operacion)&& $datos_operacion != NULL)
                    {
                    $this->amd->operaciones($datos_operacion);   
                    }else{// fin if datos de operacion
                         $data['token'] = $this->token();
                         $data['id_aviso'] = $this->session->userdata('id_aviso');
                            $data['usuario'] = $this->session->userdata('username');
                            //$data['idoperacion']=$datos_operacion;
                            $data['title']='Detalle de operaciones -:: AMDA ::';
                            $data['subtitle']='Detalle de operaciones';
                            $data['contentx']='operaciones';
                            $data['cargar_modal']= "form_liquidacion();";
                             
                           // $data['datos_usuario']= $this->CI->avisos_model->datos_usuario($role_id,$id_user);
                           // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                            $data['menu']='menu_create_1';
                            $data['fecha_operacion']=array('name'=>'fecha_operacion','id'=>'fecha_operacion','value'=> set_value("fecha_operacion"),'class'=>'form-control');
                             $data['cp_sucursal_operacion']=array('name'=>'cp_sucursal_operacion','value'=>set_value("cp_sucursal_operacion"),'class'=>'form-control');
                             $data['nom_sucursal_operacion']=array('name'=>'nom_sucursal_operacion','value'=>set_value("nom_sucursal_operacion"),'class'=>'form-control');
                             $data['select_tipo_operacion']=  $this->catalogos_model->tipo_operacion();
                             $data['marca_fabricante']=array('name'=>'marca_fabricante','value'=>  set_value("marca_fabricante"),'class'=>'form-control');
                             $data['modelo']=array('name'=>'modelo','value'=>  set_value("modelo"),'class'=>'form-control');
                             $data['anio']=array('name'=>'anio','value'=>  set_value("anio"),'class'=>'form-control');
                             $data['vin']=array('name'=>'vin','value'=>  set_value("vin"),'class'=>'form-control');
                             $data['repuve']=array('name'=>'repuve','value'=>  set_value("repuve"),'class'=>'form-control');
                             $data['placas']=array('name'=>'placas','value'=>  set_value("placas"),'class'=>'form-control');
                             $data['select_moneda']=$this->catalogos_model->moneda();
                             $data['monto']=array('name'=>'monto','value'=>  set_value("monto"),'class'=>'form-control');
                           $this->load->view('admin/template',$data);
                    } }
        
        }
/***********************************************guardaroperacion*/        
        public function guardaroperacion() {
            
            
            if($this->input->post("token") && $this->input->post('token')== $this->session->userdata('token'))
        {
          
           /*
            *   $this->form_validation->set_rules('referencia_aviso','Referencia del aviso','required|trim|min_length[10]|max_length[14]|xss_clean');
            */
            //lanzamos mensajes de error si hay
                
             $this->form_validation->set_message('required', 'El %s es requerido');
             $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
             $this->form_validation->set_message('max_length', 'El %s debe tener maximo %s carácteres');
             $this->form_validation->set_message('check_default', 'El campo %s esta vacio');
             $this->form_validation->set_message('exact_length','El campo %s debe contener %s caracteres exactamente');
           //  $this->form_validation->set_message('check_referencia','La referencia ya existe, ingresa otro numero de referencia');
             
             
            if($this->form_validation->run('operaciones/guardaroperacion') == FALSE)
            {
              //echo "entra y es false";
                
                $this->index();
            
        
           }else{
               
          //ya recibidos y formateados los valor del post
          //guardamos en la base de datos
                //primero insertamos los datos del vehiculo
                        //para recuperar el ultimo id insertado
                        $datos_vehiculo=array(
                            'iddatos_vehiculo'  => NULL,
                                        'marca' => $this->input->post('marca_fabricante'),
                                        'modelo'=> $this->input->post('modelo'),
                                        'anio'  => $this->input->post('anio'),
                                        'vin'   => $this->input->post('vin'),
                                        'repuve'=> $this->input->post('repuve'),
                                        'placas'=> $this->input->post('placas')
                        );
                        $this->operaciones_model->insert('datos_vehiculo',$datos_vehiculo);
                        $id_datos_vehiculo = mysql_insert_id();
                         //ya insertado los datos del vehiculo tenemos el id de los datos_vehiculo
                        //procedemos a insertar los datos en la tabla datos_operacion
                        $datos_op=array(
                                        'iddatos_operacion' => NULL,
                                        'fecha_operacion'   => $this->input->post("fecha_operacion"),
                                        'tipo_operacion'    => $this->input->post("tipo_operacion"),
                                        'id_datos_vehiculo' => $id_datos_vehiculo,
                                        'nivel_blindaje'    => $this->input->post('nivel_blindaje'),
                                        'idaviso'           => $this->input->post('id_aviso'),
                                        'cp_sucursal'       => $this->input->post("cp_sucursal_operacion"),
                                        'nombre_sucursal'   => $this->input->post("nom_sucursal_operacion")
                                    );
                        $this->operaciones_model->insert('datos_operacion',$datos_op);
                        $idoperacion = mysql_insert_id();
                        //$this->session->set_userdata('token',$token);
                        $this->session->set_userdata('datos_operacion',$idoperacion);  
                        //$this->session->set_flashdata('correcto', 'Usuario registrado correctamente!');
                        redirect(base_url('index.php/operaciones/index/'.$idoperacion));
                      // $this->index($this->session->set_userdata('datos_operacion',$iddatos_operacion));
                                           }
                                          //  redirect(base_url().'index.php/persona_aviso/crear_persona/');    
                 }//fin else run
        //} ///fin if
        else{
          //http://localhost/amda//index.php/distribuidor/nuevo_aviso
          redirect(base_url().'index.php/operaciones/');
        }
    }
    /***********************************************/
        //function 
         public function token()
                {
                $token = md5(uniqid(rand(),true));
                $this->session->set_userdata('token',$token);
                return $token;
                }
/***********************************************/                
        function add_liquidacion()
                {
            //array('name'=>'anio','value'=>  set_value("anio"),'class'=>'form-control');
            $data['fecha_pago'] = array('name'=>'fecha_pago','id'=>'fecha_pago','type'=>'hidden','class'=>'form-control');
            $data['forma_pago'] = $this->catalogos_model->forma_pago();
            $data['instrumento']= $this->catalogos_model->instrumento();
            $data['iddatos_operacion']= $this->session->set_userdata('operacion'); 
            $data['select_moneda']=$this->catalogos_model->moneda();
            $this->load->view('content/form_liquidacion',$data);
                } 
 /***********************************************/               
        function check_default($post_string)
               {
                 return $post_string == '0' ? FALSE : TRUE;
               }
  /***********************************************/  
  function forma_pago() {
      if($this->input->post('forma_pago')== '0') {
                       return false;
                   }
             switch ($this->input->post('forma_pago'))
                   {
                 case 1:
                      $data['instrumento']=$this->catalogos_model->instrumento();
                     $data['select_moneda']=$this->catalogos_model->moneda();
                     $data['monto']=array('name'=>'monto','class'=>'form-control');
                     $this->load->view('admin/pagoliquidacion',$data);
                     break;
                 case 2:    
                     $data['instrumento']=$this->catalogos_model->instrumento();
                     $data['select_moneda']=$this->catalogos_model->moneda();
                     $data['monto']=array('name'=>'monto','class'=>'form-control');
                     $this->load->view('admin/pagoliquidacion',$data);
                     break;
                 
                 case 3:
                      //$data['instrumento']=$this->catalogos_model->instrumento();
                     $data['select_moneda']=$this->catalogos_model->moneda();
                     $data['monto']=array('name'=>'monto','class'=>'form-control');
                     $this->load->view('admin/pagoliquidacion_1',$data);
                     break;
                 case 4:
                     // $data['instrumento']=$this->catalogos_model->instrumento();
                     $data['select_moneda']=$this->catalogos_model->moneda();
                     $data['monto']=array('name'=>'monto','class'=>'form-control');
                     $this->load->view('admin/pagoliquidacion_1',$data);
                     break;
                   }      
      
  }  
  
  function instrumento() {
      if($this->input->post('instrumento')==0)
          {
          return false;
          }
          switch ($this->input->post('instrumento'))
          {
              case 1:
             
                  return false;
                  break;
              case 2:
              case 3:
              case 4:
                  //2 credito
                  //3 debito
                  //4 prepago
                    $data['tarjeta']=array('name'=>'numero_tarjeta','class'=>'form-control');
                    $this->load->view('admin/tarjetas',$data);
                  break;
              case 5 :
              case 6 :
             // case 7 :
                  
                  //5 cheque nominativo
                  //6 cheque caja
                  $data['institucion_credito']=array('name'=>'institucion_credito','class'=>'form-control');
                  $data['numero_cuenta']=array('name'=>'numero_cuenta','class'=>'form-control');
                  $data['numero_cheque']=array('name'=>'numero_cheque','class'=>'form-control');
                  $this->load->view('admin/cheques',$data) ;
                  break;
             case 7 :
                  //7 cheque viajero
                  $data['institucion_credito']=array('name'=>'institucion_credito','class'=>'form-control');
                    
                  $data['numero_cheque']=array('name'=>'numero_cheque','class'=>'form-control');
                  $this->load->view('admin/cheques',$data);
                  break;
              case 8:
                  $data['tipo']='transferencia_interbancaria';
                  $data['clave_rastreo']=array('name'=>'clave_rastreo','class'=>'form-control');
                  $this->load->view('admin/transferencias',$data);
                  break;
              case 9:
                  //9 transferencia misma institucion
                  $data['tipo']='transferencia_misma_institucion';
                  $data['folio_interno']=array('name'=>'folio_interno','class'=>'form-control');
                  $this->load->view('admin/transferencias',$data);
                  break;
              case 10:
                  //9 transferencia internacional
                  $data['tipo']='transferencia_internacional';
                  $data['institucion_ordenante']=array('name'=>'institucion_ordenante','class'=>'form-control');
                  $data['pais_origen']=array('name'=>'pais_origen','class'=>'form-control');
                  $data['numero_cuenta']=array('name'=>'numero_cuenta','class'=>'form-control');
                  $this->load->view('admin/transferencias',$data);
                  break;
              
              case 11:  
                  //orden de pago 
                  $data['tipo']='orden_pago';
                  $data['institucion_ordenante']=array('name'=>'institucion_ordenante','class'=>'form-control');
                  $data['orden_pago']=array('name'=>'orden_pago','class'=>'form-control');
                  $data['numero_cuenta']=array('name'=>'numero_cuenta','class'=>'form-control');
                  $this->load->view('admin/transferencias',$data);
                  break;
              case 12:  
                  // giro
                  $data['tipo']='giro';
                  $data['institucion_ordenante']=array('name'=>'institucion_ordenante','class'=>'form-control');
                  $data['numero_giro']=array('name'=>'numero_giro','class'=>'form-control');
                  $data['numero_cuenta']=array('name'=>'numero_cuenta','class'=>'form-control');
                  $this->load->view('admin/transferencias',$data);
                  break;
              case 13:
                  $data['select_moneda']=$this->catalogos_model->moneda_oro();
                  $data['monto']=array('name'=>'monto','class'=>'form-control');
                  $this->load->view('admin/oro',$data);
                  break;
              case 14:
                  $data['select_moneda']=$this->catalogos_model->moneda_oro();
                  $data['monto']=array('name'=>'monto','class'=>'form-control');
                  $this->load->view('admin/oro',$data);
                  break;
                  break;
          } 
      
  }
  /***********************************************/  
   //*****************************************/
   function save_liquidacion($id_operacion = NULL) {
      // if(isset($this->input->post('datos_operacion')) && $this->input->post('datos_operacion')!= NULL){
       // $id_operacion=$this->input->post('datos_operacion');
      // }
         if (isset($id_operacion)&& $id_operacion != NULL)
           {
           //si existe el id de datos de operacion procedemos a insertar los datos de liquidacion para la operacion
            /* $monto=  $this->input->post('monto');
             if(is_int($monto))
                 {
               number_format($monto,2,'.',',');
                 }else
                     {
                   number_format($monto,2,'.',',');
              
                     }*/
            
             $datos_liquidacion= array(
                 'iddatos_liquidacion'  => NULL,
                 'iddatos_operacion'    => $id_operacion,
                 'fecha_pago'           => $this->input->post('fecha_pago'),
                 'forma_pago'           => $this->input->post('select_forma_pago'),
                 'id_instrumento'       => $this->input->post('select_instrumento'),
                 'moneda'               => $this->input->post('select_moneda'),
                 'monto_operacion'      => $this->input->post('monto')
                 
             );
            // print_r($datos_liquidacion);
             $this->operaciones_model->insert('datos_liquidacion',$datos_liquidacion);
            // echo $this->db->last_query();
             $id_datos_liquidacion=mysql_insert_id();
            //hacemos un switch para insertar en el instrumento correcto
            switch ($this->input->post('select_instrumento')) {
                case 1:
                case 13:
                case 14:
                    
                     redirect(base_url('index.php/operaciones/index/'.$id_operacion));

                 //   break;
                case 2:
                    //insert en tarjeta de credito
                    $data_i=array(
                        'id_tarjeta_credito'=> NULL,
                        'numero_tarjeta'=>  $this->input->post('numero_tarjeta'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('tarjeta_credito',$data_i);
                    break;
                case 3:
                    $data_i=array(
                        'id_tarjeta_debito'=> NULL,
                        'numero_tarjeta'=>  $this->input->post('numero_tarjeta'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('tarjeta_debito',$data_i);
                    break;
                
                case 4:
                    $data_i=array(
                        'id_tarjeta_prepagada'=> NULL,
                        'numero_tarjeta'=>  $this->input->post('numero_tarjeta'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('tarjeta_prepagada',$data_i);
                    break;
                case 5:
                    $data_i=array(
                        'id_cheque'=> NULL,
                        'institucion_credito'=>  $this->input->post('institucion_credito'),
                        'numero_cuenta'=>$this->input->post('numero_cuenta'),
                        'numero_cheque'=>$this->input->post('numero_cheque'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('cheque',$data_i);
                    break;
                case 6:
                     $data_i=array(
                        'id_cheque_caja'=> NULL,
                        'institucion_credito'=>  $this->input->post('institucion_credito'),
                        'numero_cuenta'=>$this->input->post('numero_cuenta'),
                        'numero_cheque'=>$this->input->post('numero_cheque'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('cheque_caja',$data_i);
                    break;
                case 7:
                     $data_i=array(
                        'id_cheque_viajero'=> NULL,
                        'institucion_credito'=>  $this->input->post('institucion_credito'),
                        'numero_cheque'=>$this->input->post('numero_cheque'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('cheque_viajero',$data_i);
                    break;
                case 8:
                    $data_i=array(
                        'id_transferencia_interbancaria'=> NULL,
                        'clave_rastreo'=>  $this->input->post('clave_rastreo'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('transferencia_interbancaria',$data_i);
                    break;
                case 9:
                    $data_i=array(
                        'id_transferencia_mismo_banco'=> NULL,
                        'folio_interno'=>  $this->input->post('folio_interno'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('transferencia_mismo_banco',$data_i);
                    break;
                case 10:
                     $data_i=array(
                         'id_transferencia_internacional'=> NULL,
                         'institucion_ordenante'=>  $this->input->post('institucion_ordenante'),
                         'numero_cuenta'=>  $this->input->post('institucion_ordenante'),
                         'pais_origen'=>  $this->input->post('pais_origen'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('transferencia_internacional',$data_i);
                    break;
                    case 11:
                     $data_i=array(
                         'id_orden_pago'=> NULL,
                         'institucion_ordenante'=>  $this->input->post('institucion_ordenante'),
                         'numero_cuenta'=>  $this->input->post('numero_cuenta'),
                         'numero_orden_pago'=>  $this->input->post('orden_pago'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('orden_pago',$data_i);
                    break;
                 case 12:
                     $data_i=array(
                         'id_giro'=> NULL,
                         'institucion_ordenante'=>  $this->input->post('institucion_ordenante'),
                         'numero_cuenta'=>  $this->input->post('numero_cuenta'),
                         'numero_giro'=>  $this->input->post('numero_giro'),
                        'iddatos_liquidacion'=>$id_datos_liquidacion
                    );
                    $this->operaciones_model->insert('giro',$data_i);
                    break;
                default :
                     redirect(base_url('index.php/operaciones/index/'.$id_operacion));
                    break;
            } //$datos_instrumento  
             redirect(base_url('index.php/operaciones/index/'.$id_operacion));
             //$this->index($id_operacion);
           }
          
           else{
                              $this->index();
                                      
           }
       
          
   }//fin save_liquidacion
    function  mostrar_instrumento()
   {
        $data['detalle_instrumento']=$this->xml_model->instrumento($this->input->post('id_instrumento'),$this->input->post('id_liquidacion')); 
        $this->load->view('content/detalle_instrumento',$data);
        
   }
   
   /***********************************************************************/
   function actualizar_datos() {
       //hacemos if para verificar si existe placas o repuve o ambos
       if($this->input->post("placas") != NULL && $this->input->post("repuve") == NULL)
           {
                
                $respuesta=$this->operaciones_model->repuvenulo();
                if($respuesta == TRUE)
                    {
                    return $respuesta;
                    }else
                        {
                        return FALSE;
                        }
               
           }
       if ($this->input->post("repuve") != NULL && $this->input->post("placas") == NULL)
           {
                if(strlen($this->input->post("repuve"))< 8)
                {
                    $respuesta = "Repuve debe tener 8 caracteres";
                   // return FALSE;
                    exit(1);
                }
                $respuesta = $this->operaciones_model->PlacasNulo();
                if($respuesta == TRUE)
                    {
                    return $respuesta;
                    }else
                        {
                        return FALSE;
                        }
           }
        if($this->input->post("repuve")!= NULL && $this->input->post("placas") != NULL)
        {
            $respuesta = $this->operaciones_model->PlacasRepuveNonulos();
            if($respuesta == TRUE)
                    {
                    return $respuesta;
                    }else
                        {
                        return FALSE;
                        }
        } 
        if($this->input->post("repuve") == NULL && $this->input->post("placas") == NULL)
            {
            $respuesta = $this->operaciones_model->PlacasRepuveNulos();
            if($respuesta == TRUE)
                    {
                    return $respuesta;
                    }else
                        {
                        return FALSE;
                        }
            }
            echo json_encode($respuesta);
      //$respuesta = "Se guardo correctamente";
      //echo json_encode($respuesta);
      // print_r($_POST);
      /* if($this->input->post('repuve')!= "" && $this->input->post('repuve') != NULL ){
           $rep=$this->input->post('repuve');
           
       }else{$rep=NULL;}
     if($this->input->post('placas')!= "" && $this->input->post('placas') != NULL ){
           $plac=$this->input->post('placas');
           
       }else{$plac=NULL;}
          
              $update = 'UPDATE datos_operacion as O 
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
	V.repuve = "'.$rep. '",
	V.placas = "'.$plac.'"
where O.idaviso = '.$this->input->post('id_aviso').'
and O.iddatos_operacion = '.$this->input->post('id_operacion').'';
       $act=$this->db->query($update);
      
    
             return $act; */  
      /* $update = 'UPDATE datos_operacion as O 
join datos_vehiculo as V 
on O.id_datos_vehiculo = V.iddatos_vehiculo
set O.fecha_operacion = "'.$this->input->post('fecha_operacion').'",
	O.tipo_operacion = "'.$this->input->post('tipo_operacion').'",
	O.nivel_blindaje = "'.$blindaje.'",
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
       $act=$this->db->query($update);
      echo $act;*/
      // redirect(base_url()."index.php/operaciones/index/".$this->input->post('id_operacion'));
    // echo $this->db->last_query();
   }
   
   function editar_liquidacion($id_operacion,$id_liquidacion,$indice)
   {
       
       $this->amd->editar_liquidacion($id_operacion,$id_liquidacion,$indice);  
   }
   function delete_liquidacion($id_operacion,$id_liquidacion,$tabla_instrumento=NULL)
   {
      // echo $id_operacion."<br>";
      // echo $id_liquidacion."<br>";
       if(isset($tabla_instrumento)){
           $tabla=$tabla_instrumento;
       
           
       }else
           {
           $tabla=NULL;
           }
       $this->amd->eliminar_liquidacion($id_operacion,$id_liquidacion,$tabla); 
       
   }
   function update_liquidacion()
   {
      
       /*
[fecha_pago] => 20140303
    [select_forma_pago] => 1
    [select_moneda] => 18
    [monto] => 0.00
    [id_aviso] => 8
    [id_op] => 6
    [id_li] => 17        */
       $sql = "UPDATE datos_liquidacion as L set L.fecha_pago = '".$this->input->post('fecha_pago')."',"
               . "L.forma_pago='".$this->input->post('select_forma_pago')."',"
               . "L.moneda ='".$this->input->post('select_moneda')."',"
               . "L.monto_operacion ='".$this->input->post('monto')."'"
               . "where iddatos_liquidacion = ".$this->input->post('id_li')." "
               . "AND iddatos_operacion = ".$this->input->post('id_op').""; 
    $query=$this->db->query($sql);
       return $query;
       
   }
   function truncateFloat($cantidad, $decimales)
{
   $dividir = explode(".", $cantidad);
if($dividir[1] == 0) {
return number_format($cantidad, $decimales);
}else{
$monto = number_format($dividir[0]);
$decimaltruncado=substr($dividir[1], 0, $decimales);

return $monto.".".$decimaltruncado;
} 
 
}            
}//fin clase operaciones
