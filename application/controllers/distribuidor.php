<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Distribuidor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
                
            $this->load->library(array('session','form_validation'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->helper(array('url','form'));
            $this->load->config('amda');
            
            $this->load->model('avisos_model');
            $this->load->model('xml_model');
            
	}
	
	public function index($fechaurl = NULL)
	{
		if($this->session->userdata('role_id') == FALSE || $this->session->userdata('role_id') != '4')
		{
			redirect(base_url().'index.php/amda');
                        $$this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
			
		}
                if (isset($fechaurl))
                    {
                    $fecha=$fechaurl;
                    }else{
                $fecha = date('Ym');//YYYYmm
                }
                $id_user = $this->session->userdata('id_usuario');
                //***//
                $data['token'] = $this->token();
                $data['mes'] = array('name' => 'mes', 'placeholder' => 'mes','class' => 'form-control');
                $data['submit'] = array('name' => 'submit', 'value' => 'continuar', 'title' => 'continuar','class' => 'btn btn-large btn-primary');
                $list_avisos=$this->avisos_model->listavisos($fecha,$id_user);    
                if($list_avisos->num_rows() > 0)
                    {
                        
                        foreach($list_avisos->result() as $row_list_avisos){
                        $data['is_modific'][$row_list_avisos->idaviso]= $this->xml_model->datos_modificatorio($row_list_avisos->idaviso);
                        }
                    }
                 //recuperamos datos de aviso modificado
                 
                $data['id_usuario']=  $this->session->userdata('id_usuario');
                $data['mes_reportado'] = $this->avisos_model->listarmeses($id_user);
                $data['lista_avisos'] = $this->avisos_model->listavisos($fecha,$id_user);
                
                $data['menu']='menu_inicio';
                $data['contentx']= 'inicio_informes';
                $data['usuario'] = $this->session->userdata('username');
		$data['title'] = 'Administracion de avisos ::Amda::';
		$this->load->view('admin/template',$data);
	}
         public function token()
                {
                $token = md5(uniqid(rand(),true));
                $this->session->set_userdata('token',$token);
                return $token;
                }
        public function nuevo_aviso()
                {
            
            
            if($this->session->userdata('role_id') == FALSE || $this->session->userdata('role_id') != '4')
		{
			redirect(base_url().'index.php/amda');
                        $$this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
			
                }else{
                    
            // $this->form_validation->set_message('required', 'El %s es requerido');
           //  $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
           //  $this->form_validation->set_message('max_length', 'El %s debe tener maximo %s carácteres');
            // $this->form_validation->set_message('check_default', 'El campo %s esta vacio');
               // $cadena = ereg_replace( "([ ]+)", "", $str );
         // $mes_a_reportar = preg_replace( "([ ]+)", "", $this->input->post('mes_reportado'));
         // $tipo_aviso = $this->input->post('select_tipo_aviso');
          //aki debo crear un switch para mostrar la vista de aviso con datos o sin datos
          $usuario =  $this->session->userdata('username');
          $role_id = $this->session->userdata('role_id');
          $id_user = $this->session->userdata('id_usuario');
          $data['usuario'] = $this->session->userdata('username');
          $data['datos_usuario']= $this->avisos_model->datos_usuario($role_id,$id_user);
        //  $data['mes_a_reportar']=$mes_a_reportar;
        //  $data['tipo_aviso']= $tipo_aviso;
          /******campos input******/
         
          //$data['referencia_aviso']=array('name'=>'referencia_aviso','type'=>'text','placeholder'=>'Referencia del aviso','class'=>'form_control','value'=> set_value("referencia_aviso") );
          $data['token'] = $this->token();
          $data['alerta'] = $this->avisos_model->alerta();
          $data['mes_reportado']=array('name'=>'mes_reportado','value'=>set_value("mes_reportado"),'type'=>'hidden');//$mes_a_reportar;
          /***********/
          $data['title']='Crear aviso :: AMDA ::';
          $data['subtitle']='Crear aviso';
          $data['contentx']='create_aviso';
          $data['menu']='menu_create';
          $this->load->view('admin/template',$data);
               
        
    }
         /* if($this->session->userdata('role_id') == FALSE || $this->session->userdata('role_id') != '4')
		{
			redirect(base_url().'index.php/amda');
                        $$this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
			
                }else{
                    
            // $this->form_validation->set_message('required', 'El %s es requerido');
           //  $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
           //  $this->form_validation->set_message('max_length', 'El %s debe tener maximo %s carácteres');
            // $this->form_validation->set_message('check_default', 'El campo %s esta vacio');
               // $cadena = ereg_replace( "([ ]+)", "", $str );
          $mes_a_reportar = preg_replace( "([ ]+)", "", $this->input->post('mes_reportado'));
         
          $tipo_aviso = $this->input->post('select_tipo_aviso');
          if(isset($tipo_aviso) && $tipo_aviso != NULL){
          switch ($tipo_aviso) {
              case 1:
                    $usuario =  $this->session->userdata('username');
          $role_id = $this->session->userdata('role_id');
          $id_user = $this->session->userdata('id_usuario');
          $data['usuario'] = $this->session->userdata('username');
          $data['datos_usuario']= $this->avisos_model->datos_usuario($role_id,$id_user);
          $data['mes_a_reportar']=$mes_a_reportar;
          $data['tipo_aviso']= $tipo_aviso;
          /******campos input******/
         
          //$data['referencia_aviso']=array('name'=>'referencia_aviso','type'=>'text','placeholder'=>'Referencia del aviso','class'=>'form_control','value'=> set_value("referencia_aviso") );
      /*    $data['token'] = $this->token();
          $data['alerta'] = $this->avisos_model->alerta();
          $data['mes_reportado']=array('name'=>'mes_reportado','value'=>$mes_a_reportar,'type'=>'hidden');//$mes_a_reportar;
          /***********/
    /*/*      $data['title']='Crear aviso :: AMDA ::';
          $data['subtitle']='Crear aviso';
          $data['contentx']='create_aviso';
          $data['menu']='menu_create';
          $this->load->view('admin/template',$data);
          

                  break;
              case 2:
                  $usuario =  $this->session->userdata('username');
          $role_id = $this->session->userdata('role_id');
          $id_user = $this->session->userdata('id_usuario');
          $data['usuario'] = $this->session->userdata('username');
          $data['datos_usuario']= $this->avisos_model->datos_usuario($role_id,$id_user);
          $data['mes_a_reportar']=$mes_a_reportar;
          $data['tipo_aviso']= $tipo_aviso;
          /******campos input******/
         
          //$data['referencia_aviso']=array('name'=>'referencia_aviso','type'=>'text','placeholder'=>'Referencia del aviso','class'=>'form_control','value'=> set_value("referencia_aviso") );
   /*       $data['token'] = $this->token();
          $data['alerta'] = $this->avisos_model->alerta();
          $data['mes_reportado']=array('name'=>'mes_reportado','value'=>$mes_a_reportar,'type'=>'text');//$mes_a_reportar;
          /***********/
 /*         $data['title']='Crear aviso vacio :: AMDA ::';
          $data['subtitle']='Crear aviso sin datos (ceros)';
          $data['contentx']='create_aviso_ceros';
          $data['menu']='menu_create';
          $this->load->view('admin/template',$data);
          
              
                  break;
          }
          //aki debo crear un switch para mostrar la vista de aviso con datos o sin datos
               
        }else
        {
         redirect(base_url().'index.php/amda'); 
        }
    }*/
 }//fin nuevo aviso       
                
 public function aviso_ceros()
         {
          $usuario =  $this->session->userdata('username');
          $role_id = $this->session->userdata('role_id');
          $id_user = $this->session->userdata('id_usuario');
          $data['usuario'] = $this->session->userdata('username');
          $data['datos_usuario']= $this->avisos_model->datos_usuario($role_id,$id_user);
          
         
          /******campos input******/
         
          //$data['referencia_aviso']=array('name'=>'referencia_aviso','type'=>'text','placeholder'=>'Referencia del aviso','class'=>'form_control','value'=> set_value("referencia_aviso") );
          $data['token'] = $this->token();
          $data['alerta'] = $this->avisos_model->alerta();
          $data['mes_reportado']=array('class'=>'form-control','id'=>'mes_reportado', 'name'=>'mes_reportado','value'=>  set_value("mes_reportado"),'type'=>'text');//$mes_a_reportar;
          /***********/
          $data['title']='Crear aviso vacio :: AMDA ::';
          $data['subtitle']='Crear aviso sin datos (ceros)';
          $data['contentx']='create_aviso_ceros';
          $data['menu']='menu_create';
          $this->load->view('admin/template',$data);
          

         }               
    public function guardardatosaviso() {
   // print_r($_POST);
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
             $this->form_validation->set_message('check_referencia','La referencia ya existe, ingresa otro numero de referencia');
             
             
            if($this->form_validation->run('distribuidor/guardardatosaviso') == FALSE)
            {
              //echo "entra y es false";
                
                $this->nuevo_aviso();
            
        
           }else{
         
          //ya recibidos y formateados los valor del post
          //guardamos en la base de datos
               $mes_reportado = preg_replace( "([ ]+)", "", $this->input->post('mes_reportado'));
               $data_aviso['referencia_aviso']= $this->input->post('referencia_aviso');
               $data_aviso['prioridad_aviso']= $this->input->post('prioridad_aviso');
               $data_aviso['tipo_alerta']= $this->input->post('tipo_alerta');
               if($this->input->post('descripcion_alerta') && $this->input->post('descripcion_alerta') != NULL)
                   {
                   $data_aviso['descripcion_alerta']=  $this->input->post('descripcion_alerta');
                   }else
                       {
                       $data_aviso['descripcion_alerta']=NULL;
                       }
              // if(isset($this->input->post('descripcion_alerta')) && $this->input->post('descripcion_alerta') != NULL)
                //   {
                //  $data_aviso['descripcion_alerta']=$this->input->post('descripcion_alerta'); 
                //   }else
                  //     {
                  //     $data_aviso['descripcion_alerta']=NULL;
                  //     }
          /*comprobamos que no existe ningun informe con el mes reportado*/     
               $select_informe=$this->avisos_model->select_informe($mes_reportado,$this->session->userdata('id_usuario'));
               //si no hay ningun registro damos de alta el informe 
               if($select_informe == FALSE)
                   {
                    $this->avisos_model->create_informe($mes_reportado,$this->session->userdata('id_usuario'));
                    //recuperamos el id del informe que se ha creado
                     //$mysqli->insert_id;
                    $idinformecreado=mysql_insert_id();
                        //creamos un nuevo aviso  para el informe creado pasandole los datos del aviso y el idinforme creado
                    $id_aviso = $this->avisos_model->create_aviso($data_aviso,$idinformecreado);
                    // $role_id = $this->session->userdata('role_id');
                    //creamos  $this->session->set_userdata('token',$token);
                    $idaviso = $this->session->set_userdata('id_aviso',$id_aviso);
                   }else
                       {
                     foreach ($select_informe->result() as $informe)
                         {
                             $id_informe = $informe->idinforme;

                         }
                         $id_aviso=$this->avisos_model->create_aviso($data_aviso,$id_informe); 
                         $idaviso = $this->session->set_userdata('id_aviso',$id_aviso);
                       }
                        
                       
                        redirect(base_url().'index.php/persona_aviso/crear_persona/');    
           }//fin else run
        } ///fin if
        else{
          //http://localhost/amda//index.php/distribuidor/nuevo_aviso
          redirect(base_url().'index.php/distribuidor/nuevo_aviso');
        }
         
         }//fin guardardatosaviso
         
        //chekar si el select no esta vacio
 function check_default($post_string)
        {
          return $post_string == '0' ? FALSE : TRUE;
        }
        //chekar si la referencia del aviso ya existe .
function check_referencia($ref)
          {
              $referencia = $this->avisos_model->check_referencia($ref);
                   //falta crear la funcion check_referencia
                   
              return $referencia;
          }

/*****************************************************************************************/
public function guardardatosavisoceros() {
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
             $this->form_validation->set_message('check_referencia','La referencia ya existe, ingresa otro numero de referencia');
             
             
            if($this->form_validation->run('distribuidor/guardardatosavisoceros') == FALSE)
            {
             // print_r($_POST);
             // echo "entra y es false";
                
                $this->aviso_ceros();
            
        
           }else{
         
           $data_aviso['referencia_aviso']= $this->input->post('referencia_aviso');
               $data_aviso['prioridad_aviso']= '000';
               $data_aviso['tipo_alerta']= '000';
          /*comprobamos que no existe ningun informe con el mes reportado*/     
               $select_informe=$this->avisos_model->select_informe($this->input->post("mes_reportado"),$this->session->userdata('id_usuario'));
               //si no hay ningun registro damos de alta el informe 
               if($select_informe == FALSE)
                   {
                    $this->avisos_model->create_informe($this->input->post("mes_reportado"),$this->session->userdata('id_usuario'));
                    //recuperamos el id del informe que se ha creado
                     //$mysqli->insert_id;
                    $idinformecreado=mysql_insert_id();
                        //creamos un nuevo aviso  para el informe creado pasandole los datos del aviso y el idinforme creado
                    $id_aviso = $this->avisos_model->create_aviso($data_aviso,$idinformecreado);
                    // $role_id = $this->session->userdata('role_id');
                    //creamos  $this->session->set_userdata('token',$token);
                    $idaviso = $this->session->set_userdata('id_aviso',$id_aviso);
                   }else
                       {
                     foreach ($select_informe->result() as $informe)
                         {
                             $id_informe = $informe->idinforme;

                         }
                         $id_aviso=$this->avisos_model->create_aviso($data_aviso,$id_informe); 
                         $idaviso = $this->session->set_userdata('id_aviso',$id_aviso);
                       }

                        redirect(base_url().'index.php/distribuidor/index');    
           }//fin else run
        } ///fin if
        else{
          //http://localhost/amda//index.php/distribuidor/nuevo_aviso
          redirect(base_url().'index.php/distribuidor/nuevo_aviso');
        }
         
         }//fin guardardatosavisoceros
         
         /*****************************************************************/
         

}//fin clase
