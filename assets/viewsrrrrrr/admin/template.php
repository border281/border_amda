<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->load->view('admin/header');
//if(isset($menu)){
$this->load->view('admin/'.$menu.'');
//}
if (isset($contentx))
    {
    $this->load->view('content/'.$contentx.'');
    }else{
        $this->load->view('inicio');
    }                
                
$this->load->view('admin/footer') ;   
                
                