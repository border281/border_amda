<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_liquidacion extends CI_Controller {

	public function __construct() {
            parent::__construct();
           
            $this->load->model('catalogos_model');
            $this->load->library(array('session','form_validation'));
            $this->load->helper(array('url','form'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->config('amda');
            $this->load->model('avisos_model');
            $this->load->model('operaciones_model');
            //
        }
 /***********************************************/       
        function index() {

            //array('name'=>'anio','value'=>  set_value("anio"),'class'=>'form-control');
            $data['fecha_pago'] = array('name'=>'fecha_pago','id'=>'fecha_pago', 'value'=> set_value("fecha_pago"),'class'=>'form-control');
            $data['forma_pago'] = $this->catalogos_model->forma_pago();
            $data['instrumento']= $this->catalogos_model->instrumento();
            $data['iddatos_operacion']= $this->session->set_userdata('datos_operacion'); 
            $data['select_moneda']=$this->catalogos_model->moneda();
            $this->load->view('content/form_liquidacion',$data);
             //cometar   
            
        }
 }
