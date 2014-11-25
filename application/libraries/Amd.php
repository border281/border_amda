<?php if (!defined('BASEPATH')) exit('No se permite el acceso directo');
   
class CI_Amd
{
    public function __construct() {
        $this->CI =& get_instance();
        // $this->load->model('catalogos_model');
       $this->CI->load->library('session');
       $this->CI->load->model('xml_model');
       $this->CI->load->model('catalogos_model');
         }

    public function operaciones($datos_operacion)
            {
                //recuperamos los datros del aviso 
        //personas aviso}
       // $datos_aviso=$this->CI->xml_model->datos_aviso($this->CI->session->userdata('id_aviso'));
       // 
       //debemos chekar si existen datos de liquidacion para la operacion 
        
       $liquidaciones = $this->CI->xml_model->liquidacion_datos($datos_operacion);
       //echo $this->CI->db->last_query();
      //  if($liquidaciones->num_rows() > 0)
        //   {
            //$row_liq = $liquidaciones->row();
            
              //echo $this->CI->db->last_query();  
//    foreach ($liquidaciones->result() as $row_liq){
            
                    
            
            $data['liquidacion']=$liquidaciones;
        //    }
       //    }
       // 
            
          $this->CI->session->set_userdata('datos_operacion',$datos_operacion);                                   //recuperamos los datos de los beneficiarios
         $operacion = $this->CI->xml_model->operaciones($this->CI->session->userdata('id_aviso'),$datos_operacion); 
         
         // echo $this->CI->db->last_query();                   
         
         $row_operacion = $operacion->row();                //'$("#save").empty().html("Actualizar Datos");  $("button#save").attr({"onclick":"actualizar_operaciones()","type":"submit"}); $("#form_operacion").attr("action","#"); $(".content-buttons").append("<button id=agregar_operacion type=button ><span>Agregar operaci&oacute;n</span></button>"); $("#agregar_operacion").attr("onclick","agrega_operacion_nueva()");';
                                                       $data['actualizar_datos']='$("#save").empty().html("Actualizar Datos");  $("button#save").attr({"onclick":"","type":"submit"}); $("#form_operacion").attr("action","#"); $(".content-buttons").append("<button id=agregar_operacion type=button ><span>Agregar operaci&oacute;n</span></button>"); $("#agregar_operacion").attr("onclick","agrega_operacion_nueva()");';
                                                       $data['cargar_modal']= "form_liquidacion();";
                                                    $data['id_aviso'] = $this->CI->session->userdata('id_aviso');
                                                     $data['beneficiario']=  $this->CI->xml_model->count_beneficiario($this->CI->session->userdata('id_aviso'));
                                                      $data['token'] = $this->token();
                                                     $data['fecha_operacion']=array('name'=>'fecha_operacion','id'=>'fecha_operacion','placeholder'=>$row_operacion->fecha_operacion,'value'=> $row_operacion->fecha_operacion,'class'=>'requerido form-control');
                                                     $data['fecha_datepicker']=$row_operacion->fecha_operacion;
                                                 $data['cp_sucursal_operacion']=array('name'=>'cp_sucursal_operacion','value'=>$row_operacion->cp_sucursal,'class'=>'requerido form-control');
                                                 $data['nom_sucursal_operacion']=array('name'=>'nom_sucursal_operacion','value'=>$row_operacion->nombre_sucursal,'class'=>'requerido form-control');
                                                 $data['select_tipo_operacion']=  $this->CI->catalogos_model->tipo_operacion();
                                                 $data['tipo_operacion']= $row_operacion->tipo_operacion;
                                                 $data['marca_fabricante']=array('name'=>'marca_fabricante','value'=> $row_operacion->marca,'class'=>'requerido form-control');
                                                 $data['modelo']=array('name'=>'modelo','value'=>  $row_operacion->modelo,'class'=>'requerido form-control');
                                                 $data['anio']=array('name'=>'anio','value'=>  $row_operacion->anio,'class'=>'requerido form-control');
                                                 $data['vin']=array('name'=>'vin','value'=>  $row_operacion->vin,'class'=>'requerido form-control');
                                                 $data['repuve']=array('name'=>'repuve','value'=>  $row_operacion->repuve,'class'=>'form-control');
                                                 $data['placas']=array('name'=>'placas','value'=>  $row_operacion->placas,'class'=>'form-control');
                                                 $data['blindaje']=$row_operacion->nivel_blindaje;
                                                 $data['select_moneda']=$this->CI->catalogos_model->moneda();
                                                 $data['monto']=array('name'=>'monto','value'=>  '','class'=>'form-control');   
                                                    //recuperamos los datos de las operaciones 
                                                     $data['operaciones']= $this->CI->xml_model->operaciones($this->CI->session->userdata('id_aviso'),NULL);
                                                     $total_operaciones =$this->CI->xml_model->operaciones($this->CI->session->userdata('id_aviso'),NULL);
                                                            if($total_operaciones->num_rows() > 0)
                                                                {
                                                                    foreach ($total_operaciones->result() as $row_total_operaciones)
                                                                        {
                                                                            $data['liquidaciones'][$row_total_operaciones->iddatos_operacion]=$this->CI->xml_model->liquidacion_datos($row_total_operaciones->iddatos_operacion);
                                                                        }
                                                                }
                                                     $data['usuario'] = $this->CI->session->userdata('username');
                                                     $data['datos_operacion']=$this->CI->session->userdata('datos_operacion');
                                                     $data['title']='Crear aviso -> persona_aviso:: AMDA ::';
                                                     $data['subtitle']='Persona aviso';
                                                     $data['contentx']='operaciones';
                                                    // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                                                     $data['menu']='menu_create_1';
                                                     $data['idoperacion']=$datos_operacion;
                                                    
                                                     $this->CI->load->view('admin/template',$data); 
                                                      
                                                     foreach ($liquidaciones->result() as $row_liquidacion){
            //$instrumentos=  $this->CI->xml_model->instrumento($row_liquidacion->tipo_instrumento,$row_liquidacion->iddatos_liquidacion);
                $instrumento['idinstrumento']=$row_liquidacion->tipo_instrumento;
                $instrumento['iddatos_liquidacion']=$row_liquidacion->iddatos_liquidacion;
                $data['dinstrumento']= $this->CI->load->view('content/instrumento',$instrumento);
                }
                                                     /*if($liquidaciones->num_rows() > 0)
                                                       
           {
            //$row_liq = $liquidaciones->row();
            foreach ($liquidaciones->result() as $row_liq){
            $instrumento['idinstrumento'] = $row_liq->id_instrumento;//$this->instrumento($row_liq->id_instrumento,$row_liq->iddatos_liquidacion);
            $instrumento['iddatos_liquidacion']=$row_liq->iddatos_liquidacion; 
            $this->CI->load->view('content/instrumento',$instrumento);
            $data['liquidaciones']=$liquidaciones;
            }
           }*/
                                               //$datos_cliente = $this->xml_model->persona_fisica($row_datos_aviso->idcliente);
                                              // $row_datos_cliente = $datos_cliente->row();
                                             // $datos_cli['nombre']=array('name'=>'nombre_persona','value'=>$row_datos_cliente->nombre ,'class'=>'form-control');
                      //                              //recuperammos que tipo de domiciio tiene
                                                     //$row_datos_aviso->tipo_domicilio;
                                                     
                                                    // $datos['tipo_p'] =1;
                                                    // $this->CI->load->view('ajax_persona',$datos);
                                                    // $dom['t_domicilio']=$row_datos_aviso->tipo_domicilio;
                                                   //  $this->CI->load->view('ajax_domicilio',$dom);
                     //  $this->load->view('tipo_persona/persona_aviso/persona_fisica',$data);
                                                    
                                     
            }
             public function token()
                {
                $token = md5(uniqid(rand(),true));
                $this->CI->session->set_userdata('token',$token);
                return $token;
                }
             public function instrumento($id_instrumento ,$iddatos_liquidacion)
                        {
                        //hacemos un switch para recuperar los datos del instrumento
                        switch ($id_instrumento) {
                            case 1:
                              $dinstrumento ="";
                              return $dinstrumento;
                              
                             break;
                            case 2:
                                //recuperamos los datos del instrumento y le pasamos los datos en un array
                                $dinstrumento=$this->CI->xml_model->instrumento('tarjeta_credito',$iddatos_liquidacion);
                                //$this->CI->load->view('instrumento/tarjeta',$data);
                               return $dinstrumento;
                                break;
                            
                            case 3:
                                //echo $id_instrumento;
                                $dinstrumento = $this->CI->xml_model->instrumento('tarjeta_debito',$iddatos_liquidacion);
                               // echo $this->db->last_query();
                               return $dinstrumento;
                                break;
                            
                            case 4:
                                
                                $dinstrumento =  $this->CI->xml_model->instrumento('tarjeta_prepagada',$iddatos_liquidacion);
                                return $dinstrumento;
                                
                                break;
                            case 5:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('cheque',$iddatos_liquidacion);
                                return $dinstrumento;
                                
                                break;
                            
                            case 6:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('cheque_caja',$iddatos_liquidacion);
                                return  $dinstrumento;
                                
                                break;
                            
                            case 7:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('cheque_viajero',$iddatos_liquidacion);
                                return $dinstrumento;
                                
                                break;
                            
                            case 8:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('transferencia_internacional',$iddatos_liquidacion);
                                return $dinstrumento;
                                break;
                            
                            case 9:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('transferencia_internacional',$iddatos_liquidacion);
                               return $dinstrumento;
                                    
                                break;
                            
                            case 10:
                                $dinstrumento = $this->CI->xml_model->instrumento('transferencia_mismo_banco',$iddatos_liquidacion);
                                return $dinstrumento;
                                
                                break;
                            
                            case 11:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('orden_pago',$iddatos_liquidacion);
                                return $dinstrumento;
                                
                                break;
                            case 12:
                                
                                $dinstrumento = $this->CI->xml_model->instrumento('giro',$iddatos_liquidacion);
                                return $dinstrumento;
                                
                                break;
                            
                            case 13:
                                
                                return FALSE;
                                
                              break;
                            
                           case 14:
                               
                               return FALSE;
                               
                               break;
                                
                           
                        }
                   }
                   
                  public function editar_liquidacion($id_datos_operacion,$id_datos_liquidacion,$indice)
                   {
                          
         //$operacion = $this->CI->xml_model->operaciones($this->CI->session->userdata('id_aviso'),$datos_operacion); 
         
         // echo $this->CI->db->last_query();                   
         
         
                                                       $data['actualizar_datos']='$("#save").empty().html("Actualizar liquidacion");  $("button#save").attr({"onclick":"actualizar_liquidacion()","type":"submit"}); $("#form_operacion").attr("action","http://localhost/amda/index.php/operaciones/actualizar_liquidacion");';
                                                       $data['operaciones']= $this->CI->xml_model->operaciones($this->CI->session->userdata('id_aviso'),NULL);
                                                   $total_operaciones =$this->CI->xml_model->operaciones($this->CI->session->userdata('id_aviso'),NULL);
                                                            if($total_operaciones->num_rows() > 0)
                                                                {
                                                                    foreach ($total_operaciones->result() as $row_total_operaciones)
                                                                        {
                                                                            $data['liquidaciones'][$row_total_operaciones->iddatos_operacion]=$this->CI->xml_model->liquidacion_datos($row_total_operaciones->iddatos_operacion);
                                                                        }
                                                                }
                                                  $data['indice']=$indice;
                                                  $data['id_op']=$id_datos_operacion;
                                                  $data['id_li']=$id_datos_liquidacion;
                                                    $data['id_aviso'] = $this->CI->session->userdata('id_aviso');
                                                     $data['beneficiario']=  $this->CI->xml_model->count_beneficiario($this->CI->session->userdata('id_aviso'));
                                                      $data['token'] = $this->token();
                                                     //$data['fecha_pago']=array('name'=>'fecha_pago','id'=>'fecha_pago','placeholder'=>$row_liquidacion->fecha_pago,'value'=> $row_liquidacion->fecha_pago,'class'=>'form-control');
                                                     //$data['fecha_datepicker']=$row_operacion->fecha_operacion;
                                                      $datos_liquidacion = $this->CI->xml_model->liquidacion_editar($id_datos_operacion,$id_datos_liquidacion);
                                                       $liquidaciones = $this->CI->xml_model->liquidacion_editar($id_datos_operacion,$id_datos_liquidacion);
                                                        if($datos_liquidacion->num_rows() > 0)
                                                            {
                                                            $rowdatos_liquidacion=$datos_liquidacion->row();
                                                            }
                                                      $data['fecha_pago'] = array('name'=>'fecha_pago','id'=>'fecha_pago','class'=>'form-control');
                                                      $data['fecha_datepicker']=  str_replace("-","",$rowdatos_liquidacion->fecha_pago);
                                                      $data['forma_pago_js']=$rowdatos_liquidacion->f_pago;
                                                      $data['id_instrumento']=$rowdatos_liquidacion->id_instrumento;
                                                      $data['forma_pago'] = $this->CI->catalogos_model->forma_pago();
                                                        $data['instrumento']= $this->CI->catalogos_model->instrumento();
                                                       // $data['iddatos_operacion']= $this->session->set_userdata('operacion'); 
                                                        $data['select_moneda']=$this->CI->catalogos_model->moneda();
                                                        $data['id_moneda']=$rowdatos_liquidacion->id_moneda;
                                                     $data['monto']=array('name'=>'monto','value'=> $rowdatos_liquidacion->monto_operacion,'class'=>'form-control');   
                                                    //recuperamos los datos de las operaciones 
                                                     $data['usuario'] = $this->CI->session->userdata('username');
                                                     $data['datos_operacion']=$this->CI->session->userdata('datos_operacion');
                                                     $data['title']='Editar liquidacion -> operaciones:: AMDA ::';
                                                     $data['subtitle']='Editar liquidacion';
                                                     $data['contentx']='editar_liquidacion';
                                                    // $data['id_aviso']= array('name'=>'id_aviso','value'=>$idaviso,'type'=>'hidden');
                                                     $data['menu']='menu_create_1';
                                                     //$data['idoperacion']=$datos_operacion;
                                                    
                                                     $this->CI->load->view('admin/template',$data); 
                                                      
                                                     foreach ($liquidaciones->result() as $row_liquidacion){
            //$instrumentos=  $this->CI->xml_model->instrumento($row_liquidacion->tipo_instrumento,$row_liquidacion->iddatos_liquidacion);
                $instrumento['idinstrumento']=$row_liquidacion->tipo_instrumento;
                $instrumento['iddatos_liquidacion']=$row_liquidacion->iddatos_liquidacion;
                $data['dinstrumento']= $this->CI->load->view('content/instrumento_1',$instrumento);
                }
                                                                         
               
                   }
                   
             public function eliminar_liquidacion($id_operacion,$id_liquidacion,$tabla_instrumento)
                     {
                   echo $id_operacion."<br>";
                   echo $id_liquidacion."<br>";
                   echo $tabla_instrumento."<br>";
                     }
                   

}