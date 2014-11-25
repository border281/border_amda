<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Users extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
                
            $this->load->library(array('session','form_validation'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->helper(array('url','form'));
       
            $this->load->config('amda');
            
            $this->load->model('avisos_model');
            $this->load->model('xml_model');
            $this->load->model('users_model');
            
	}
	
	public function index()
	{
            if($this->session->userdata('role_id')== FALSE && ($this->session->userdata('role_id') != '1' || $this->session->userdata('role_id') != '2'))
                {
                 redirect(base_url().'index.php/amda');
                 $this->session->set_flashdata("valido","No tiene permiso para acceder a esta area");
                }else{
            $data['token'] = $this->token();
            $data['id_usuario'] = $this->session->userdata('id_usuario');
            $data['usuario']  = $this->session->userdata('username');
            $data['title'] = "Crear usuarios";
            $data['menu']= 'menu_admin';
           
            $data['userdata']= $this->session->all_userdata();
           
               
                 //if($this->session->userdata('role_id') == '1'){
            $data['usuarios']= $this->users_model->all_users($this->session->userdata('id_usuario'));
            // }
             // if($this->session->userdata('role_id') == '2')
             //   {
              //  $data['userdata']=  $this->user_model->list_users($this->session->userdata('id_usuario'));
              //  }
            $data['contentx']="users";
            
            //$data['contentx'] = 'control_admin';
        $this->load->view('admin/template',$data);
                } // fin else
        }
        function create()
        {
         if($this->session->userdata('role_id')== FALSE && ($this->session->userdata('role_id') != '1' || $this->session->userdata('role_id') != '2'))
                {
              redirect(base_url().'index.php/amda');
              $this->session->set_flashdata("error_permiso","No tiene permiso para acceder a esta area");
              } else {
                  $data['token']= $this->token();
                  $data['userdata']= $this->session->all_userdata();
                  $data['id_usuario']=  $this->session->userdata('id_usuario');
                  $data['usuario']= $this->session->userdata('username');
                  $data['title'] = "Crear usuarios";
                  $data['menu'] = "menu_admin";
                  $data['contentx'] = "create_users";
                  $data['inp_username']= array('class'=>'form-control','id'=>'username','name'=>'username','value'=>  set_value('username'),'type'=>'text');
                  $data['inp_email']= array('class'=>'form-control','id'=>'email','name'=>'email','value'=>  set_value('email'),'type'=>'email');
                  $data['inp_rfc']= array('class'=>'form-control','id'=>'rfc','name'=>'rfc','value'=>  set_value('rfc'),'type'=>'text','onblur'=>'ValidaRfc(this.value)');
                  $data['inp_password']= array('class'=>'form-control','id'=>'password','name'=>'password','value'=>  set_value('password'),'type'=>'password');    
                  $data['submit']=array('class'=>'form-control','id'=>'save','name'=>'save','value'=>'Guardar','type'=>'submit');
                  $data['attrib_form']=array('method'=>'post','enctype'=>'multipart/form-data','name'=>'form_newuser','id'=>'form_newuser');
                  $data['id_user']=  $this->session->userdata('id_usuario');
                  $this->load->view('admin/template',$data);
              }
           
        }
        function save_user()
        {
          //  print_r($_POST);
            $this->form_validation->set_rules('username','Nombre de usuario','required|xss_clean');
            $this->form_validation->set_rules('email','Correo Electronico','required|xss_clean|valid_email|callback_check_email');
            $this->form_validation->set_rules('rfc','RFC','required|xss_clean');
            $this->form_validation->set_rules('permisos','Permisos de usuario','required');
            $this->form_validation->set_rules('password','Password','required|min_length[6]');
            $this->form_validation->set_message('min_length', 'El campo  %s debe tener minimo 6 caracteres');
            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $this->form_validation->set_message('valid_email', 'El email %s no es valido');
            $this->form_validation->set_message('check_email','El E-mail ingresado ya existe, ingresa otro e-mail valido');
           
            
             if ($this->form_validation->run() == FALSE)
        {
           //       echo validation_errors(); 
           $this->create();
        }
        else
        {
            
            $data_user=array(
                            'id'=> NULL,
                            'role_id'=> $this->input->post('permisos'),
                            'email'=> $this->input->post('email'),
                            'password'=> sha1($this->input->post('password')),
                            'display_name'=> $this->input->post('username'),
                            'active'=> $this->input->post('active'),
                            'rfc'=> $this->input->post('rfc'),
                            'super_admin'=> 'no',
                            'create_for' => $this->input->post('id')
                            
            );
           $create_usernew = $this->users_model->CreateNewuser('am_users',$data_user);
           if($create_usernew == true)
               {
                    $this->session->set_flashdata('correcto','Usuario Creado correctamente');
                    redirect(base_url('/index.php/admin'));
               }else
                   {
                    $this->session->set_flashdata('error','Error el usuario no fue creado intente mas tarde');
                    redirect(base_url('/index.php/admin'));
                   }
           
        }
            
        }
          public function token()
                {
                $token = md5(uniqid(rand(),true));
                $this->session->set_userdata('token',$token);
                return $token;
                }
          function check_email($ref)
          {
              $email = $this->users_model->CheckMail($ref);
                   //falta crear la funcion check_referencia
                   
              return $email;
          }// fin check mail
          function edit($id)
          {
              /*infr user*/
              $data_user=$this->users_model->SelectUser($id);
              if($data_user->num_rows()>0)
                  {
                  foreach ($data_user->result() as $value) {
                      
                  $data['inp_username']= array('class'=>'form-control','id'=>'username','name'=>'username','value'=>  $value->display_name,'type'=>'text');
                  $data['user_edit']= array('class'=>'form-control','id'=>'user_edit','name'=>'user_edit','value'=>  $id,'type'=>'hidden');
                  
                  $data['inp_email']= array('class'=>'form-control','id'=>'email','name'=>'email','value'=>  $value->email,'type'=>'email');
                  $data['inp_rfc']= array('class'=>'form-control','id'=>'rfc','name'=>'rfc','value'=>  $value->rfc,'type'=>'text','onblur'=>'ValidaRfc(this.value)');
                  $data['inp_password']= array('class'=>'form-control','id'=>'password','name'=>'password','value'=>'','type'=>'password');    
                  $data['submit']=array('class'=>'form-control','id'=>'save','name'=>'save','value'=>'Guardar','type'=>'submit');
                  $data['attrib_form']=array('method'=>'post','enctype'=>'multipart/form-data','name'=>'form_newuser','id'=>'form_newuser');
                  $data['update_user']=TRUE; 
                  $data['permisos']=$value->role_id;
                  $data['activo']=$value->active;
                      
                  }
                  }
            /*vists*/
                  $data['userdata']= $this->session->all_userdata();
              $data['id_usuario']=  $this->session->userdata('id_usuario');
                  $data['usuario']= $this->session->userdata('username');
                  $data['title'] = "Editar usuario";
                  $data['menu'] = "menu_admin";
                  $data['contentx'] = "create_users";
                   $data['id_user']=  $this->session->userdata('id_usuario');
                  $this->load->view('admin/template',$data);
          }
          
          function update()
          {
               $this->form_validation->set_rules('username','Nombre de usuario','required|xss_clean');
            $this->form_validation->set_rules('email','Correo Electronico','required|xss_clean|valid_email');
            $this->form_validation->set_rules('rfc','RFC','required|xss_clean');
            $this->form_validation->set_rules('permisos','Permisos de usuario','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            $this->form_validation->set_message('valid_email', 'El email %s no es valido');
            $this->form_validation->set_message('check_email','El E-mail ingresado ya existe, ingresa otro e-mail valido');
            //$id_user = $this->input->post('user_edit'); 
            if ($this->form_validation->run() == FALSE)
        {
           //       echo validation_errors(); 
           $this->edit($this->input->post('user_edit'));
        }else{
            /* $data_user=array(
                            'id'=> $this->input->post('user_edit'),
                            'role_id'=> $this->input->post('permisos'),
                            'email'=> $this->input->post('email'),
                            'password'=> sha1($this->input->post('password')),
                            'display_name'=> $this->input->post('username'),
                            'active'=> $this->input->post('active'),
                            'rfc'=> $this->input->post('rfc'),
                            'super_admin'=> 'no',
                            'create_for' => $this->input->post('id')
                            
            );*/
           $update_user = $this->users_model->UpdateUser();
           
           if($update_user == true)
               {
                    $this->session->set_flashdata('correcto','Usuario Actualizado correctamente');
                    redirect(base_url('/index.php/admin'));
               }else
                   {
                    $this->session->set_flashdata('error','Error los datos no fueron actualizados, intente mas tarde');
                    redirect(base_url('/index.php/admin'));
                   }
          }
         }// fin update
          
      }// fin class 