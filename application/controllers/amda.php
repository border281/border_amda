<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amda extends CI_Controller {

	public function __construct() {
            parent::__construct();
           
            $this->load->model('login_model');
            $this->load->library(array('session','form_validation'));
            $this->load->helper(array('url','form'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->config('amda');
            //
        }

        public function index()
                
	{
            //crearemos un switch para saber de que clase de usuario esta logueado
            switch ($this->session->userdata('role_id'))
            {
                
                case '':
                    //echo sha1(md5('password'));
                 //  echo '<br> sesion ='.$this->session->userdata('role_id');
                    $data['username'] = array('name' => 'user_am', 'placeholder' => 'Introduce tu nombre de usuario','class' => 'form-control');
                    $data['password'] = array('name' => 'pass_am','type'=>'password',	'placeholder' => 'Introduce tu password','class' => 'form-control');
                    $data['submit'] = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión','class' => 'btn btn-large btn-primary');
                    
                    $data['token'] = $this->token();
                    $data['title'] = "Login : Sistema Amda";
                    $this->load->view('inicio',$data);
                    break;
                case '4'://usuario capturista
                    redirect(base_url().'index.php/distribuidor');
                    break;
                case '1': // super administrador
                    redirect(base_url().'index.php/admin');
                    break;
                case '2': // super administrador
                    redirect(base_url().'index.php/admin');
                    break;
                default :
                    $data['title'] = "Login";
                    $this->load->view('inicio',$data);
                    
            }
	}//fin index
        public function token()
                {
                $token = md5(uniqid(rand(),true));
                $this->session->set_userdata('token',$token);
                return $token;
                }
        
    public function login() {
       
        if($this->input->post("token") && $this->input->post('token')== $this->session->userdata('token'))
        {
          
             $this->form_validation->set_rules('user_am','Nombre de usuario','required|trim|min_length[5]|max_length[150]|xss_clean');
             $this->form_validation->set_rules('pass_am','Password','required|trim|min_length[6]|max_length[150]|xss_clean');
           
             //lanzamos mensajes de error si hay
             
             $this->form_validation->set_message('required', 'El %s es requerido');
             $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
             $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
	
            if($this->form_validation->run() == FALSE)
            {
             //  echo "entra y es false";
            $this->index();
            
        
           }else{
              // echo 'else';
       
                $user_am = $this->input->post('user_am');
                $pass_am = sha1($this->input->post('pass_am'));
               // echo $user_am;
               // echo $pass_am;
           
              $check_user = $this->login_model->login_user($user_am,$pass_am);
             // print_r($check_user);
               if($check_user == TRUE)
                {
                    $data = array(
                        'is_logued_in' => TRUE,
                        'id_usuario'   => $check_user -> id,
                        'role_id'      => $check_user -> role_id, 
                        'username'     => $check_user -> display_name,
                        'rfc'          => $check_user-> rfc
                    );
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('valido','Acceso exitoso!');
                    $this->index();
                }//fin if check
            }//fin else
            
        }//fin primer if
        else{
            redirect(base_url().'index.php/amda');
            
        }
        
    }//fin login
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(),'refresh');//$this->index();
    }
    
}//fin clase

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */