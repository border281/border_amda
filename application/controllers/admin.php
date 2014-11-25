<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Admin extends CI_Controller {
	
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
	
	public function index()
	{
          if($this->session->userdata('role_id')== FALSE && ($this->session->userdata('role_id') != '1' || $this->session->userdata('role_id') != '2'))
              {
                redirect(base_url().'index.php/amda','refresh');
                $this->session->set_flashdata('error_permiso','No tiene permiso para acceder a esta area');
            }
            $id_user = $this->session->userdata('id_usuario');
            $data['token'] = $this->token();
            $data['id_usuario'] = $this->session->userdata('id_usuario');
            $data['menu']= 'menu_admin';
            $data['contentx'] = 'control_admin';
            $data['userdata']= $this->session->all_userdata();
            $data['usuario']  = $this->session->userdata('username');
            $data['title']    = 'Administraci&oacute;n de Usuarios Amda';
            $this->load->view('admin/template',$data);       
        }//fin de index
        
        public function token()
                {
                $token = md5(uniqid(rand(),true));
                $this->session->set_userdata('token',$token);
                return $token;
                }
}
