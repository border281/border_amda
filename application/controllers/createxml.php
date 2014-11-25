<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Createxml extends CI_Controller {

	public function __construct() {
            parent::__construct();
           
            $this->load->model('xml_model');
            $this->load->library(array('session','form_validation'));
            $this->load->helper(array('url','form'));
            $this->load->database();
            $this->lang->load('user');
            $this->load->config('amda');
            $this->load->helper('xml_helper');
            //
        }

        public function index($id_aviso)
                
	{
            $checkaviso= $this->xml_model->datos_informe($id_aviso);
            
           
         //recuperamos los datos para el aviso y el mes correspondiente
    //$id = idaviso
    //$res_xml=$this->informe_model->query_xml($id,$mes_reportado);
   // $telefono_xml = $this->informe_model->telefono_xml($id,$id_user);
   // $datos_opreacion_xml = $this->informe_model->datos_opreacion_xml($id,$id_user);
    
/**
 * @author [israel millan]
 * @copyright [2013]
 */
//foreach ($res_xml->result() as $row){
 if(isset($checkaviso) && $checkaviso->num_rows() > 0){               
$xml = new DomDocument('1.0', 'windows-1252');

//$root = $xml->createElement('tienda');

$root = $xml->createElementNS('http://www.uif.shcp.gob.mx/recepcion/veh', 'archivo');
$root = $xml->appendChild($root);
$root->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
$root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.uif.shcp.gob.mx/recepcion/veh veh.xsd');

$informe =$xml->createElement('informe');
$informe=$root->appendChild($informe);
/**********************************/
 $datos_informe=$this->xml_model->datos_informe($id_aviso);
 /*********************************/
 foreach($datos_informe->result() as $dinforme){
$mes_reportado = $xml->createElement('mes_reportado',strtoupper($dinforme->mes_reportado));
$mes_reportado = $informe->appendChild($mes_reportado);
/*sujeto obligado*/
//pendiente la etiqueta clave de entidad colegiada
$sujeto_obligado = $xml->createElement('sujeto_obligado');
$sujeto_obligado = $informe->appendChild($sujeto_obligado);
  //$clave_entidad   = $xml->createElement('clave_entidad_colegiada',' ');
  //$clave_entidad   = $sujeto_obligado->appendChild($clave_entidad);

  $clave_sujeto = $xml->createElement('clave_sujeto_obligado',  strtoupper($this->session->userdata('rfc')));
  $clave_sujeto = $sujeto_obligado->appendChild($clave_sujeto);

  $clave_actividad = $xml->createElement('clave_actividad','VEH');
  $clave_actividad = $sujeto_obligado->appendChild($clave_actividad);
  
  /** DATOS GENERAES DEL *AVISO *****************************************************/
  $aviso =$xml->createElement('aviso');
  $aviso=$informe->appendChild($aviso);
  
  /*referencia aviso*/
  //$refaviso= $this->
    $referencia=$xml->createElement('referencia_aviso',''.strtoupper($dinforme->referencia).'');
    $referencia = $aviso->appendChild($referencia); 
      
 // $modificatorio=$xml->createElement('modificatorio');
 // $modificatorio =$aviso->appendChild($modificatorio);
	/**/
//	$folio_modificacion = $xml->createElement('folio_modificacion',' ');
//	$folio_modificacion =$modificatorio->appendChild($folio_modificacion);
//	
//	$descripcion_modificacion = $xml->createElement('descripcion_modificacion',' ');
//	$descripcion_modificacion = $modificatorio->appendChild($descripcion_modificacion);
      /**/
     $prioridad = $xml->createElement('prioridad',''.strtoupper($dinforme->prioridad).'');
     $prioridad = $aviso->appendChild($prioridad);
        
  
    $alerta = $xml->createElement('alerta');
    $alerta =$aviso->appendChild($alerta);
  
        $tipo_alerta =$xml->createElement('tipo_alerta',''.strtoupper($dinforme->idalerta).'');
        $tipo_alerta = $alerta->appendChild($tipo_alerta);
        if($dinforme->descripcion_alerta != NULL){
        $descripcion_alerta = $xml->createElement('descripcion_alerta',''.strtoupper($dinforme->descripcion_alerta).'');
        $descripcion_alerta = $alerta->appendChild($descripcion_alerta);
        }
    $persona_aviso=$xml->createElement('persona_aviso');
    $persona_aviso =$aviso->appendChild($persona_aviso);
            $tipo_persona= $xml->createElement("tipo_persona");
            $tipo_persona = $persona_aviso->appendChild($tipo_persona);
            // $tipo_persona = $persona_aviso->appendChild($tipo_persona);  
 /*****************************************************************************************/           
      $datos_aviso=  $this->xml_model->datos_aviso($id_aviso);
      foreach($datos_aviso->result() as $row_aviso){
          switch ($row_aviso->tipo_persona) {
              case 1:
                  $persona_fisica= $this->xml_model->persona_fisica($row_aviso->idcliente);
                  foreach($persona_fisica->result() as $fisica){
                        
                       $persona_fisica = $xml->createElement('persona_fisica');
                       $persona_fisica = $tipo_persona->appendChild($persona_fisica);      
                       
                                $nombre = $xml->createElement('nombre',''.strtoupper($fisica->nombre).'');
                                $nombre = $persona_fisica->appendChild($nombre);
                                 $apellido_paterno = $xml->createElement('apellido_paterno',''.strtoupper($fisica->ap_paterno).'');
                                 $apellido_paterno = $persona_fisica->appendChild($apellido_paterno);
                                 $apellido_materno = $xml->createElement('apellido_materno',''.strtoupper($fisica->ap_materno).'');
                                 $apellido_materno= $persona_fisica->appendChild($apellido_materno);
                                 $fecha_nacimiento = $xml->createElement('fecha_nacimiento',''.strtoupper($fisica->fecha_nacimiento).'');
                                 $fecha_nacimiento= $persona_fisica->appendChild($fecha_nacimiento);
                                 
                                 if($fisica->rfc != NULL && $fisica->rfc != ''){
                                 $rfc = $xml->createElement('rfc',''.strtoupper($fisica->rfc).'');
                                 
                                 $rfc= $persona_fisica->appendChild($rfc);
                                 }
                                 
                                 if($fisica->curp != NULL && $fisica->curp != ''){
                                 $curp = $xml->createElement('curp',''.strtoupper($fisica->curp).'');
                                 $curp= $persona_fisica->appendChild($curp);
                                 }
                                 $pais_nacionalidad = $xml->createElement('pais_nacionalidad',''.strtoupper($fisica->pais_nacionalidad).'');
                                 $pais_nacionalidad = $persona_fisica->appendChild($pais_nacionalidad);
                                 $pais_nacimiento = $xml->createElement('pais_nacimiento',''.strtoupper($fisica->pais_nacimiento).'');
                                 $pais_nacimiento = $persona_fisica->appendChild($pais_nacimiento );
                                 $actividad_economica = $xml->createElement('actividad_economica',''.strtoupper($fisica->actividad_economica).'');
                                 $actividad_economica = $persona_fisica->appendChild($actividad_economica);
                                 $tipo_identificacion = $xml->createElement('tipo_identificacion',''.strtoupper($fisica->tipo_identificacion).'');
                                 $tipo_identificacion = $persona_fisica->appendChild($tipo_identificacion);
                                 
                                 if($fisica->identificacion_otro != NULL && $fisica->identificacion_otro != '' ){
                                 $identificacion_otro = $xml->createElement('identificacion_otro',''.strtoupper($fisica->identificacion_otro).'');
                                 $identificacion_otro = $persona_fisica->appendChild($identificacion_otro);
                                 }
                                 $autoridad_identificacion= $xml->createElement('autoridad_identificacion',''.strtoupper($fisica->autoridad_identificacion).'');
                                 $autoridad_identificacion = $persona_fisica->appendChild($autoridad_identificacion);
                                 $numero_identificacion = $xml->createElement('numero_identificacion',''.strtoupper($fisica->numero_identificacion).'');
                                 $numero_identificacion = $persona_fisica->appendChild($numero_identificacion);
              
                  }
                  
                  break;
              case 2:
                   $persona_moral= $this->xml_model->persona_moral($row_aviso->idcliente);
                   foreach ($persona_moral->result() as $row_moral)
                       {
                             $persona_moral= $xml->createElement('persona_moral');
                                 $persona_moral = $tipo_persona->appendChild($persona_moral); 
                                    $denominacion_razon = $xml->createElement('denominacion_razon',''.strtoupper($row_moral->razon_social).'');
                                    $denominacion_razon = $persona_moral->appendChild($denominacion_razon); 
                                    $fecha_constitucion = $xml->createElement('fecha_constitucion',''.str_replace("-","",$row_moral->fecha_constitucion).'');
                                    $fecha_constitucion = $persona_moral->appendChild($fecha_constitucion); 
                                    $rfc_moral  = $xml->createElement('rfc',''.strtoupper($row_moral->rfc_moral).'');
                                    $rfc_moral = $persona_moral->appendChild($rfc_moral); 
                                    $pais_nacionalidad = $xml->createElement('pais_nacionalidad',''.strtoupper($row_moral->pais_nacionalidad).'');
                                    $pais_nacionalidad = $persona_moral->appendChild($pais_nacionalidad); 
                                    $giro_mercantil = $xml->createElement('giro_mercantil',''.strtoupper($row_moral->giro_mercantil).'');
                                    $giro_mercantil = $persona_moral->appendChild($giro_mercantil); 
                                    $representante_apoderado = $xml->createElement('representante_apoderado');
                                    $representante_apoderado = $persona_moral->appendChild($representante_apoderado); 
                                        $nombre = $xml->createElement('nombre',''.strtoupper($row_moral->nombre).'');
                                        $nombre = $representante_apoderado->appendChild($nombre); 
                                        $apellido_paterno = $xml->createElement('apellido_paterno',''.strtoupper($row_moral->ap_paterno).'');
                                        $apellido_paterno = $representante_apoderado->appendChild($apellido_paterno); 
                                        $apellido_materno = $xml->createElement('apellido_materno',''.strtoupper($row_moral->ap_materno).'');
                                        $apellido_materno = $representante_apoderado->appendChild($apellido_materno); 
                                        $fecha_nacimiento = $xml->createElement('fecha_nacimiento',''.str_replace("-","",$row_moral->fecha_nac).'');
                                        $fecha_nacimiento = $representante_apoderado->appendChild($fecha_nacimiento); 
                                        
                                        if($row_moral->rfc != NULL && $row_moral->rfc != ''){
                                        $rfc = $xml->createElement('rfc',''.strtoupper($row_moral->rfc).'');
                                        $rfc = $representante_apoderado->appendChild($rfc); 
                                        }
                                        
                                        if($row_moral->curp != NULL && $row_moral->curp != ''){
                                        $curp = $xml->createElement('curp',''.strtoupper($row_moral->curp).'');
                                        $curp = $representante_apoderado->appendChild($curp); 
                                        
                                        }
                                        $tipo_identificacion = $xml->createElement('tipo_identificacion',''.strtoupper($row_moral->tipo_identificacion).'');
                                        $tipo_identificacion = $representante_apoderado->appendChild($tipo_identificacion);
                                        
                                        if($row_moral->identificacion_otro != NULL && $row_moral->identificacion_otro != ''){
                                        $identificacion_otro = $xml->createElement('identificacion_otro',''.strtoupper($row_moral->identificacion_otro).'');
                                        $identificacion_otro = $representante_apoderado->appendChild($identificacion_otro); 
                                        }
                                        $autoridad_identificacion = $xml->createElement('autoridad_identificacion',''.strtoupper($row_moral->autoridad_identificacion).'');
                                        $autoridad_identificacion = $representante_apoderado->appendChild($autoridad_identificacion); 
                                        $numero_identificacion = $xml->createElement('numero_identificacion',''.strtoupper($row_moral->numero_identificacion).'');
                                        $numero_identificacion = $representante_apoderado->appendChild($numero_identificacion); 
    
                       }
                  
                  break;
              case 3:
                     $fideicomiso= $this->xml_model->fideicomiso($row_aviso->idcliente);
                   foreach ($fideicomiso->result() as $row_fideicomiso)
                       {
                                 $fideicomiso= $xml->createElement('fideicomiso');
                                   $fideicomiso = $tipo_persona->appendChild($fideicomiso); 
                                    $denominacion_razon = $xml->createElement('denominacion_razon',''.strtoupper($row_fideicomiso->razon_social).'');
                                    $denominacion_razon = $fideicomiso->appendChild($denominacion_razon); 
                                     
                                    $rfc  = $xml->createElement('rfc',''.strtoupper($row_fideicomiso->rfc).'');
                                    $rfc = $fideicomiso->appendChild($rfc); 
                                    $identificador_fideicomiso  = $xml->createElement('identificador_fideicomiso',''.strtoupper($row_fideicomiso->identificador_fideicomiso).'');
                                    $identificador_fideicomiso = $fideicomiso->appendChild($identificador_fideicomiso); 
                                    
                                   $apoderado_delegado = $xml->createElement('apoderado_delegado');
                                    $apoderado_delegado = $fideicomiso->appendChild($apoderado_delegado); 
                                        $nombre = $xml->createElement('nombre',''.strtoupper($row_fideicomiso->nombre).'');
                                        $nombre = $apoderado_delegado->appendChild($nombre); 
                                        $apellido_paterno = $xml->createElement('apellido_paterno',''.strtoupper($row_fideicomiso->ap_paterno).'');
                                        $apellido_paterno = $apoderado_delegado->appendChild($apellido_paterno); 
                                        $apellido_materno = $xml->createElement('apellido_materno',''.strtoupper($row_fideicomiso->ap_materno).'');
                                        $apellido_materno = $apoderado_delegado->appendChild($apellido_materno); 
                                        $fecha_nacimiento = $xml->createElement('fecha_nacimiento',''.str_replace("-","",$row_fideicomiso->fecha_nac).'');
                                        $fecha_nacimiento = $apoderado_delegado->appendChild($fecha_nacimiento); 
                                        
                                        if($row_fideicomiso->rfc != NULL && $row_fideicomiso->rfc != ''){
                                        $rfc = $xml->createElement('rfc',''.strtoupper($row_fideicomiso->rfc).'');
                                        $rfc = $apoderado_delegado->appendChild($rfc);
                                        }
                                        
                                        if($row_fideicomiso->curp != NULL && $row_fideicomiso->curp != ''){
                                        $curp = $xml->createElement('curp',''.strtoupper($row_fideicomiso->curp).'');
                                        $curp = $apoderado_delegado->appendChild($curp);
                                        }
                                        $tipo_identificacion = $xml->createElement('tipo_identificacion',''.strtoupper($row_fideicomiso->tipo_identificacion).'');
                                        $tipo_identificacion = $apoderado_delegado->appendChild($tipo_identificacion); 
                                       
                                        if($row_fideicomiso->identificacion_otro != NULL && $row_fideicomiso->identificacion_otro != ""){
                                        $identificacion_otro = $xml->createElement('identificacion_otro',''.strtoupper($row_fideicomiso->identificacion_otro).'');
                                        $identificacion_otro = $apoderado_delegado->appendChild($identificacion_otro); 
                                          }
                                        $autoridad_identificacion = $xml->createElement('autoridad_identificacion',''.strtoupper($row_fideicomiso->autoridad_identificacion).'');
                                        $autoridad_identificacion = $apoderado_delegado->appendChild($autoridad_identificacion); 
                                        $numero_identificacion = $xml->createElement('numero_identificacion',''.strtoupper($row_fideicomiso->numero_identificacion).'');
                                        $numero_identificacion = $apoderado_delegado->appendChild($numero_identificacion); 
             
                       }
                       
       //            }
                  break;
              
      //}
          } //fin switch tipo persona 
          switch ($row_aviso->tipo_domicilio) {
          case 1:
                    $nacional= $this->xml_model->nacional($row_aviso->idcliente);
                   foreach ($nacional->result() as $row_nacional)
                       {
                             $tipo_domicilio= $xml->createElement("tipo_domicilio");
                            $tipo_domicilio = $persona_aviso->appendChild($tipo_domicilio); 
          
                                $nacional = $xml->createElement('nacional');
                                $nacional = $tipo_domicilio->appendChild($nacional); 
                                
                                 $colonia = $xml->createElement('colonia',''.strtoupper($row_nacional->colonia).'');
                                $colonia = $nacional->appendChild($colonia);
                                 $calle = $xml->createElement('calle',''.strtoupper($row_nacional->calle).'');
                                 $calle = $nacional->appendChild($calle);
                                 $numero_exterior = $xml->createElement('numero_exterior',''.strtoupper($row_nacional->numero_exterior).'');
                                 $numero_exterior= $nacional->appendChild($numero_exterior);
                                 if($row_nacional->numero_interior != NULL && $row_nacional->numero_interior != ''){
                                 $numero_interior = $xml->createElement('numero_interior',''.$row_nacional->numero_interior.'');
                                 $numero_interior= $nacional->appendChild($numero_interior);
                                 }
                                 $codigo_postal = $xml->createElement('codigo_postal',''.$row_nacional->cp.'');
                                 $codigo_postal= $nacional->appendChild($codigo_postal);
           
                        }

              break;

          case 2:
                $extranjero= $this->xml_model->extranjero($row_aviso->idcliente);
                   foreach ($extranjero->result() as $row_extranjero)
                       {
                         $tipo_domicilio= $xml->createElement("tipo_domicilio");
                            $tipo_domicilio = $persona_aviso->appendChild($tipo_domicilio); 
          
                                 $extranjero = $xml->createElement('extranjero');
                        $extranjero = $tipo_domicilio->appendChild($extranjero);      
                                $pais = $xml->createElement('pais',''.$row_extranjero->idpais.'');
                                $pais = $extranjero->appendChild($pais);
                                 $estado_provincia = $xml->createElement('estado_provincia',''.strtoupper($row_extranjero->provincia).'');
                                 $estado_provincia = $extranjero->appendChild($estado_provincia);
                                 $ciudad_poblacion = $xml->createElement('ciudad_poblacion',''.strtoupper($row_extranjero->ciudad).'');
                                 $ciudad_poblacion = $extranjero->appendChild($ciudad_poblacion);
                                 $colonia = $xml->createElement('colonia',''.strtoupper($row_extranjero->colonia).'');
                                 $colonia = $extranjero->appendChild($colonia);
                                 $calle = $xml->createElement('calle',''.strtoupper($row_extranjero->calle).'');
                                 $calle = $extranjero->appendChild($calle);
                                 $numero_exterior = $xml->createElement('numero_exterior',''.$row_extranjero->numero_exterior.'');
                                 $numero_exterior= $extranjero->appendChild($numero_exterior);
                                 if($row_extranjero->numero_interior != NULL && $row_extranjero->numero_interior != ''){
                                 $numero_interior = $xml->createElement('numero_interior',''.$row_extranjero->numero_interior.'');
                                 $numero_interior= $extranjero->appendChild($numero_interior);
                                 }
                                 $codigo_postal = $xml->createElement('codigo_postal',''.$row_extranjero->cp.'');
                                 $codigo_postal= $extranjero->appendChild($codigo_postal);
         
                       
                        }

              break;
      }//fin switch tipo domicilio
      
                     $telefono= $xml->createElement("telefono");
                     $telefono = $persona_aviso->appendChild($telefono); 
                                 $clave_pais = $xml->createElement('clave_pais',''.strtoupper($row_aviso->clave_pais).'');
                                 $clave_pais = $telefono->appendChild($clave_pais);
                                 $numero_telefono = $xml->createElement('numero_telefono',''.$row_aviso->numero_tel.'');
                                 $numero_telefono = $telefono->appendChild($numero_telefono);
                                 if($row_aviso->correo_electronico != NULL && $row_aviso->correo_electronico != ''){
                                 $correo_electronico = $xml->createElement('correo_electronico',''.strtoupper($row_aviso->correo_electronico).'');
                                 $correo_electronico = $telefono->appendChild($correo_electronico);
                                 }
      
   }//fin foreach datos aviso
      //************DUENO BENEFICIARIO********************************************//
   
   $count_beneficiario = $this->xml_model->count_beneficiario($id_aviso);
     if($count_beneficiario->num_rows() > 0){ 
               
 
        foreach($count_beneficiario->result() as $row_beneficiario){
                $dueno_beneficiario=$xml->createElement('dueno_beneficiario');
                $dueno_beneficiario =$aviso->appendChild($dueno_beneficiario);
                    $tipo_persona= $xml->createElement("tipo_persona");
                    $tipo_persona = $dueno_beneficiario->appendChild($tipo_persona); 
          switch ($row_beneficiario->tipo_persona) {
              case 1:
                  $persona_fisicab= $this->xml_model->persona_fisica_beneficiario($row_beneficiario->idbeneficiario);
                  foreach($persona_fisicab->result() as $fisicab){
                        // $tipo_persona= $xml->createElement("tipo_persona");
                        // $tipo_persona = $persona_aviso->appendChild($tipo_persona);
                            $persona_fisica = $xml->createElement('persona_fisica');
                            $persona_fisica = $tipo_persona->appendChild($persona_fisica);      
                       
                                $nombre = $xml->createElement('nombre',''.strtoupper($fisicab->nombre).'');
                                $nombre = $persona_fisica->appendChild($nombre);
                                 $apellido_paterno = $xml->createElement('apellido_paterno',''.strtoupper($fisicab->ap_paterno).'');
                                 $apellido_paterno = $persona_fisica->appendChild($apellido_paterno);
                                 $apellido_materno = $xml->createElement('apellido_materno',''.strtoupper($fisicab->ap_materno).'');
                                 $apellido_materno= $persona_fisica->appendChild($apellido_materno);
                                 $fecha_nacimiento = $xml->createElement('fecha_nacimiento',''.str_replace("-","",$fisicab->fecha_nacimiento).'');
                                 $fecha_nacimiento= $persona_fisica->appendChild($fecha_nacimiento);
                                 
                                 if($fisicab->rfc != NULL && $fisicab != ''){
                                 $rfc = $xml->createElement('rfc',''.strtoupper($fisicab->rfc).'');
                                 $rfc= $persona_fisica->appendChild($rfc);
                                 }
                                 if($fisicab->curp != NULL && $fisicab->curp != ''){
                                 $curp = $xml->createElement('curp',''.strtoupper($fisicab->curp).'');
                                 $curp= $persona_fisica->appendChild($curp);
                                 }
                                 $pais_nacionalidad = $xml->createElement('pais_nacionalidad',''.strtoupper($fisicab->pais_nacionalidad).'');
                                 $pais_nacionalidad = $persona_fisica->appendChild($pais_nacionalidad);
                                 $pais_nacimiento = $xml->createElement('pais_nacimiento',''.strtoupper($fisicab->pais_nacimiento).'');
                                 $pais_nacimiento = $persona_fisica->appendChild($pais_nacimiento );
                                 $actividad_economica = $xml->createElement('actividad_economica',''.strtoupper($fisicab->actividad_economica).'');
                                 $actividad_economica = $persona_fisica->appendChild($actividad_economica);
                                 
                  }
                  
                  break;
              case 2:
                   $persona_moralb= $this->xml_model->persona_moral_beneficiario($row_beneficiario->idbeneficiario);
                   foreach ($persona_moralb->result() as $row_moralb)
                       {
                             $persona_moral= $xml->createElement('persona_moral');
                                 $persona_moral = $tipo_persona->appendChild($persona_moral); 
                                    $denominacion_razon = $xml->createElement('denominacion_razon',''.$row_moralb->razon_social.'');
                                    $denominacion_razon = $persona_moral->appendChild($denominacion_razon); 
                                    $fecha_constitucion = $xml->createElement('fecha_constitucion',''.str_replace("-","",$row_moralb->fecha_constitucion).'');
                                    $fecha_constitucion = $persona_moral->appendChild($fecha_constitucion); 
                                    $rfc  = $xml->createElement('rfc',''.$row_moralb->rfc.'');
                                    $rfc = $persona_moral->appendChild($rfc); 
                                    $pais_nacionalidad = $xml->createElement('pais_nacionalidad',''.$row_moralb->pais_nacionalidad.'');
                                    $pais_nacionalidad = $persona_moral->appendChild($pais_nacionalidad); 
                                    $giro_mercantil = $xml->createElement('giro_mercantil',''.$row_moralb->giro_mercantil.'');
                                    $giro_mercantil = $persona_moral->appendChild($giro_mercantil); 
                                   
                       }
                  
                  break;
              case 3:
                     $fideicomisob= $this->xml_model->fideicomiso_beneficiario($row_beneficiario->idbeneficiario);
                   foreach ($fideicomisob->result() as $row_fideicomisob)
                       {
                                 $fideicomiso= $xml->createElement('fideicomiso');
                                   $fideicomiso = $tipo_persona->appendChild($fideicomiso); 
                                    $denominacion_razon = $xml->createElement('denominacion_razon',''.strtoupper($row_fideicomisob->razon_social).'');
                                    $denominacion_razon = $fideicomiso->appendChild($denominacion_razon); 
                                     
                                    $rfc  = $xml->createElement('rfc',''.strtoupper($row_fideicomisob->rfc).'');
                                    $rfc = $fideicomiso->appendChild($rfc); 
                                    $identificador_fideicomiso  = $xml->createElement('identificador_fideicomiso',''.strtoupper($row_fideicomisob->identficador_fieicomiso).'');
                                    $identificador_fideicomiso = $fideicomiso->appendChild($identificador_fideicomiso); 
                                    
                                 
                       }
                       
       
                  break;
              
      
          } //fin switch tipo persona 
          switch ($row_beneficiario->tipo_domicilio) {
          case 1:
                    $nacionalb= $this->xml_model->nacional_beneficiario($row_beneficiario->idbeneficiario);
                   foreach ($nacionalb->result() as $row_nacionalb)
                       {
                             $tipo_domicilio= $xml->createElement("tipo_domicilio");
                            $tipo_domicilio = $dueno_beneficiario->appendChild($tipo_domicilio); 
          
                                $nacional = $xml->createElement('nacional');
                                $nacional = $tipo_domicilio->appendChild($nacional); 
                                
                                 $colonia = $xml->createElement('colonia',''.strtoupper($row_nacionalb->colonia).'');
                                $colonia = $nacional->appendChild($colonia);
                                 $calle = $xml->createElement('calle',''.strtoupper($row_nacionalb->calle).'');
                                 $calle = $nacional->appendChild($calle);
                                 $numero_exterior = $xml->createElement('numero_exterior',''.$row_nacionalb->numero_exterior.'');
                                 $numero_exterior= $nacional->appendChild($numero_exterior);
                                 if($row_nacionalb->numero_interior != NULL && $row_nacionalb->numero_interior != ""){
                                 $numero_interior = $xml->createElement('numero_interior',''.$row_nacionalb->numero_interior.'');
                                 $numero_interior= $nacional->appendChild($numero_interior);
                                 }
                                 $codigo_postal = $xml->createElement('codigo_postal',''.$row_nacionalb->cp.'');
                                 $codigo_postal= $nacional->appendChild($codigo_postal);
           
                        }

              break;

          case 2:
                $extranjerob= $this->xml_model->extranjero_beneficiario($row_beneficiario->idbeneficiario);
                   foreach ($extranjerob->result() as $row_extranjerob)
                       {
                         $tipo_domicilio= $xml->createElement("tipo_domicilio");
                            $tipo_domicilio = $dueno_beneficiario->appendChild($tipo_domicilio); 
          
                                 $extranjero = $xml->createElement('extranjero');
                                $extranjero = $tipo_domicilio->appendChild($extranjero);      
                                $pais = $xml->createElement('pais',' ');
                                $pais = $extranjero->appendChild($pais);
                                 $estado_provincia = $xml->createElement('estado_provincia',''.strtoupper($row_extranjerob->provincia).'');
                                 $estado_provincia = $extranjero->appendChild($estado_provincia);
                                 $ciudad_poblacion = $xml->createElement('ciudad_poblacion',''.strtoupper($row_extranjerob->ciudad).'');
                                 $ciudad_poblacion = $extranjero->appendChild($ciudad_poblacion);
                                 $colonia = $xml->createElement('colonia',''.strtoupper($row_extranjerob->colonia).'');
                                 $colonia = $extranjero->appendChild($colonia);
                                 $calle = $xml->createElement('calle',''.strtoupper($row_extranjerob->calle).'');
                                 $calle = $extranjero->appendChild($calle);
                                 $numero_exterior = $xml->createElement('numero_exterior',''.$row_extranjerob->numero_exterior.'');
                                 $numero_exterior= $extranjero->appendChild($numero_exterior);
                                 if($row_extranjerob->numero_interior != NULL && $row_extranjerob->numero_interior != "" ){
                                 $numero_interior = $xml->createElement('numero_interior',''.$row_extranjerob->numero_interior.'');
                                 $numero_interior= $extranjero->appendChild($numero_interior);
                                 }
                                 $codigo_postal = $xml->createElement('codigo_postal',''.$row_extranjerob->cp.'');
                                 $codigo_postal= $extranjero->appendChild($codigo_postal);
         
                       
                        }

              break;
      }//fin switch tipo domicilio
      
                     $telefono= $xml->createElement("telefono");
                     $telefono = $dueno_beneficiario->appendChild($telefono); 
                                 $clave_pais = $xml->createElement('clave_pais',''.$row_beneficiario->clave_pais.'');
                                 $clave_pais = $telefono->appendChild($clave_pais);
                                 $numero_telefono = $xml->createElement('numero_telefono',''.$row_beneficiario->numero_tel.'');
                                 $numero_telefono = $telefono->appendChild($numero_telefono);
                                  if($row_aviso->correo_electronico != NULL && $row_aviso->correo_electronico != ''){
                                 $correo_electronico = $xml->createElement('correo_electronico',''.strtoupper($row_beneficiario->correo_electronico).'');
                                 $correo_electronico = $telefono->appendChild($correo_electronico);
                                  }
   }
 }//fin if 
  /****************FIN DUENO BENEFICIARIO*****************************************************************/
   /******DETALLE DE OPERACIONES****************************************************************************************/
 //recuperamos las operaciones realizadas para el aviso
         $operaciones = $this->xml_model->operaciones($id_aviso);
            $detalle_operaciones =$xml->createElement('detalle_operaciones');
            $detalle_operaciones =$aviso->appendChild($detalle_operaciones);
            $operaciones_realizadas = $xml->createElement('operaciones_realizadas');
              $operaciones_realizadas = $detalle_operaciones->appendChild($operaciones_realizadas);
               
                foreach ($operaciones->result() as $row_operacion) {
                     $datos_operacion = $xml->createElement('datos_operacion');
                     $datos_operacion = $operaciones_realizadas->appendChild($datos_operacion);
                         $fecha_operacion = $xml->createElement('fecha_operacion',''.str_replace("-","",$row_operacion->fecha_operacion).'');
                            $fecha_operacion = $datos_operacion->appendChild($fecha_operacion);
                            $codigo_postal = $xml->createElement('codigo_postal',''.$row_operacion->cp_sucursal.'');
                            $codigo_postal = $datos_operacion->appendChild($codigo_postal);
                            $nombre_sucursal = $xml->createElement('nombre_sucursal',''.strtoupper($row_operacion->nombre_sucursal).'');
                            $nombre_sucursal = $datos_operacion->appendChild($nombre_sucursal);
                            $tipo_operacion = $xml->createElement('tipo_operacion',''.strtoupper($row_operacion->tipo_operacion).'');
                            $tipo_operacion = $datos_operacion->appendChild($tipo_operacion);
                            $tipo_vehiculo = $xml->createElement('tipo_vehiculo');
                            $tipo_vehiculo = $datos_operacion->appendChild($tipo_vehiculo);
                              $datos_vehiculo_terrestre = $xml->createElement('datos_vehiculo_terrestre');
                               $datos_vehiculo_terrestre = $tipo_vehiculo->appendChild($datos_vehiculo_terrestre);
                               /**DATOS DEL VEHICULO*********/
                               $datos_vehiculo= $this->xml_model->datos_vehiculo($row_operacion->id_datos_vehiculo);
                               foreach($datos_vehiculo->result() as $row_vehiculo)
                                   {
                                        $marca_fabricante= $xml->createElement('marca_fabricante',''.strtoupper($row_vehiculo->marca).'');
                                        $marca_fabricante = $datos_vehiculo_terrestre->appendChild($marca_fabricante);
                                        $modelo= $xml->createElement('modelo',''.strtoupper($row_vehiculo->modelo).'');
                                        $modelo = $datos_vehiculo_terrestre->appendChild($modelo);
                                        $anio= $xml->createElement('anio',''.strtoupper($row_vehiculo->anio).'');
                                        $anio = $datos_vehiculo_terrestre->appendChild($anio);
                                        if($row_vehiculo->vin != ''){
                                        $vin= $xml->createElement('vin',''.strtoupper($row_vehiculo->vin).'');
                                        $vin = $datos_vehiculo_terrestre->appendChild($vin);
                                        }
                                        if($row_vehiculo->repuve != ''){
                                        $repuve= $xml->createElement('repuve',''.strtoupper($row_vehiculo->repuve).'');
                                        $repuve = $datos_vehiculo_terrestre->appendChild($repuve);
                                        }
                                        if($row_vehiculo->placas != ''){
                                        $placas= $xml->createElement('placas',''.strtoupper($row_vehiculo->placas).'');
                                        $placas = $datos_vehiculo_terrestre->appendChild($placas);
                                        }
                                   }
             /***************************************/
                                   if($row_operacion->nivel_blindaje != 0)
                                       {
                                        $vehiculo_blindado = $xml->createElement('vehiculo_blindado');
                                        $vehiculo_blindado = $datos_operacion->appendChild($vehiculo_blindado);
                                        $nivel_blindaje = $xml->createElement('nivel_blindaje',''.$row_operacion->nivel_blindaje .'');
                                        $nivel_blindaje = $vehiculo_blindado->appendChild($nivel_blindaje);
                                       }
                       // $datos_liquidacion = $xml->createElement('datos_liquidacion');
                        //$datos_liquidacion = $datos_operacion->appendChild($datos_liquidacion);
                         $liquidacion = $this->xml_model->datos_liquidacion($row_operacion->iddatos_operacion);
                         foreach ($liquidacion->result() as $row_liquidacion) {
                             $datos_liquidacion = $xml->createElement('datos_liquidacion');
                             $datos_liquidacion = $datos_operacion->appendChild($datos_liquidacion);
                
                             $fecha_pago= $xml->createElement('fecha_pago',''.str_replace("-","",$row_liquidacion->fecha_pago).'');
                             $fecha_pago = $datos_liquidacion->appendChild($fecha_pago);
                             $forma_pago= $xml->createElement('forma_pago',''.strtoupper($row_liquidacion->forma_pago).'');
                             $forma_pago = $datos_liquidacion->appendChild($forma_pago);
                              switch ($row_liquidacion->id_instrumento) {
                                  case 0:
                                       $moneda= $xml->createElement('moneda',''.strtoupper($row_liquidacion->moneda).'');
                                       $moneda = $datos_liquidacion->appendChild($moneda);
                                       $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                       $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);
                                       break;   
                                 case 1:
                                 case 13:
                                 case 14:
                                 $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                 $moneda= $xml->createElement('moneda',''.strtoupper($row_liquidacion->moneda).'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;

                                 case 2:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                      $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                     $tabla='tarjeta_credito';
                                     $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                     $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);
                                                                      
                                         
                                      
                                         $tarjeta_credito = $xml->createElement('tarjeta_credito');
                                         $tarjeta_credito = $detalle_instrumento->appendChild($tarjeta_credito);
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                           foreach ($instrumento->result() as $row_i) {
                                                     $numero_tarjeta = $xml->createElement('numero_tarjeta',''.$row_i->numero_tarjeta.'');
                                                     $numero_tarjeta = $tarjeta_credito->appendChild($numero_tarjeta);
                                       }
                                        $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                  case 3: 
                                       $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                       $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                         $tabla='tarjeta_debito';
                                            $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                            $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);
                                                     $tarjeta_debito = $xml->createElement('tarjeta_debito');
                                                      $tarjeta_debito = $detalle_instrumento->appendChild($tarjeta_debito);
                                    
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                      
                                       foreach ($instrumento->result() as $row_i) {
                                                $numero_tarjeta = $xml->createElement('numero_tarjeta',''.$row_i->numero_tarjeta.'');
                                                $numero_tarjeta = $tarjeta_debito->appendChild($numero_tarjeta);
                                       }
                                     break;
                                 case 4:
                                        $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                        $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                                    
                                      $tabla='tarjeta_prepagada';
                                            $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                            $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);
                                                $tarjeta_prepagada = $xml->createElement('tarjeta_prepagada');
                                                $tarjeta_prepagada = $detalle_instrumento->appendChild($tarjeta_prepagada);
                                     $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                      
                                        
                                       foreach ($instrumento->result() as $row_i) {
                                                $numero_tarjeta = $xml->createElement('numero_tarjeta',''.$row_i->numero_tarjeta.'');
                                                $numero_tarjeta = $tarjeta_prepagada->appendChild($numero_tarjeta);
                                       }
                                        $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 case 5:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                            $tabla='cheque';
                                                     $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                                     $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                        $cheque = $xml->createElement('cheque');
                                                        $cheque = $detalle_instrumento->appendChild($cheque);
                                       
                                        $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                        
                                      foreach ($instrumento->result() as $row_i) {
                                          
                                     
                                            $institucion_credito = $xml->createElement('institucion_credito',''.strtoupper($row_i->institucion_credito).'');
                                            $institucion_credito = $cheque->appendChild($institucion_credito);
                                            $numero_cuenta = $xml->createElement('numero_cuenta',''.$row_i->numero_cuenta.'');
                                            $numero_cuenta = $cheque->appendChild($numero_cuenta);
                                            $numero_cheque = $xml->createElement('numero_cheque',''.$row_i->numero_cheque.'');
                                            $numero_cheque = $cheque->appendChild($numero_cheque);
                                      }
                                       $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 case 6:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                     
                                         $tabla='cheque_caja';
                                             $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                             $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                 $cheque_caja = $xml->createElement('cheque_caja');
                                                 $cheque_caja = $detalle_instrumento->appendChild($cheque_caja);
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                        
                                         foreach ($instrumento->result() as $row_i) {
                                             $institucion_credito = $xml->createElement('institucion_credito',''.strtoupper($row_i->institucion_credito).'');
                                            $institucion_credito = $cheque_caja->appendChild($institucion_credito);
                                            $numero_cuenta = $xml->createElement('numero_cuenta',''.$row_i->numero_cuenta.'');
                                            $numero_cuenta = $cheque_caja->appendChild($numero_cuenta);
                                            $numero_cheque = $xml->createElement('numero_cheque',''.$row_i->numero_cheque.'');
                                            $numero_cheque = $cheque_caja->appendChild($numero_cheque);
                                         }
                                          $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 case 7:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                         $tabla='cheque_viajero';
                                             $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                             $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                 $cheque_viajero = $xml->createElement('cheque_viajero');
                                                 $cheque_viajero = $detalle_instrumento->appendChild($cheque_viajero);
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                       
                                       foreach ($instrumento->result() as $row_i) {
                                             $institucion_credito = $xml->createElement('institucion_credito',''.strtoupper($row_i->institucion_credito).'');
                                             $institucion_credito = $cheque_viajero->appendChild($institucion_credito);
                                             $numero_cheque = $xml->createElement('numero_cheque',''.$row_i->numero_cheque.'');
                                             $numero_cheque = $cheque_viajero->appendChild($numero_cheque);
                                       }
                                        $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 case 8:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                            $tabla='transferencia_interbancaria';
                                             $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                             $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                  $transferencia_interbancaria = $xml->createElement('transferencia_interbancaria');
                                                  $transferencia_interbancaria = $detalle_instrumento->appendChild($transferencia_interbancaria);
                                             
                                          $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                      
                                       foreach ($instrumento->result() as $row_i) {
                                                $clave_rastreo = $xml->createElement('clave_rastreo',''.$row_i->clave_rastreo.'');
                                                $clave_rastreo = $transferencia_interbancaria->appendChild($clave_rastreo);
                                       }
                                        $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 case 9:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                             $tabla='transferencia_mismo_banco';
                                             $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                             $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                 $transferencia_mismo_banco = $xml->createElement('transferencia_mismo_banco');
                                                 $transferencia_mismo_banco = $detalle_instrumento->appendChild($transferencia_mismo_banco);
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                           foreach ($instrumento->result() as $row_i) {
                                                $folio_interno = $xml->createElement('folio_interno',''.$row_i->folio_interno.'');
                                                $folio_interno = $transferencia_mismo_banco->appendChild($folio_interno);
                                             }
                                     break;
                                      $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                 case 10:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                             $tabla='transferencia_internacional';
                                                $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                                $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                     $transferencia_internacional = $xml->createElement('transferencia_internacional');
                                                     $transferencia_internacional = $detalle_instrumento->appendChild($transferencia_internacional);
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                      
                                         
                                       foreach ($instrumento->result() as $row_i) {
                                                $institucion_ordenante = $xml->createElement('institucion_ordenante',''.strtoupper($row_i->institucion_ordenante).'');
                                                $institucion_ordenante = $transferencia_internacional->appendChild($institucion_ordenante);
                                                 $numero_cuenta = $xml->createElement('numero_cuenta',''.$row_i->numero_cuenta.'');
                                                $numero_cuenta = $transferencia_internacional->appendChild($numero_cuenta);
                                                 $pais_origen = $xml->createElement('pais_origen',''.$row_i->pais_origen.'');
                                                $pais_origen = $transferencia_internacional->appendChild($pais_origen);
                                       }
                                        $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                     
                                 case 11:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                             $tabla='orden_pago';
                                             $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                             $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                $orden_pago = $xml->createElement('orden_pago');
                                                $orden_pago = $detalle_instrumento->appendChild($orden_pago);
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                      
                                        
                                       foreach ($instrumento->result() as $row_i) {
                                                $institucion_ordenante = $xml->createElement('institucion_ordenante',''.strtoupper($row_i->institucion_ordenante).'');
                                                $institucion_ordenante = $orden_pago->appendChild($institucion_ordenante);
                                                 $numero_cuenta = $xml->createElement('numero_cuenta',''.$row_i->numero_cuenta.'');
                                                $numero_cuenta = $orden_pago->appendChild($numero_cuenta);
                                                 $numero_orden_pago = $xml->createElement('numero_orden_pago',''.$row_i->numero_orden_pago.'');
                                                $numero_orden_pago = $orden_pago->appendChild($numero_orden_pago);
                                       }
                                        $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                 $moneda = $datos_liquidacion->appendChild($moneda);
                                 $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                 $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 case 12:
                                      $instrumento_monetario= $xml->createElement('instrumento_monetario',''.strtoupper($row_liquidacion->id_instrumento).'');
                                 $instrumento_monetario = $datos_liquidacion->appendChild($instrumento_monetario);
                               
                                        $tabla='giro';
                                              $detalle_instrumento= $xml->createElement('detalle_instrumento');
                                              $detalle_instrumento = $datos_liquidacion->appendChild($detalle_instrumento);  
                                                $giro = $xml->createElement('giro');
                                                $giro = $detalle_instrumento->appendChild($giro);
                                        
                                         $instrumento = $this->xml_model->detalle_instrumento($tabla,$row_liquidacion->iddatos_liquidacion);
                                      
                                       foreach ($instrumento->result() as $row_i) {
                                                 $institucion_ordenante = $xml->createElement('institucion_ordenante',''.strtoupper($row_i->institucion_ordenante).'');
                                                 $institucion_ordenante = $giro->appendChild($institucion_ordenante);
                                                 $numero_cuenta = $xml->createElement('numero_cuenta',''.$row_i->numero_cuenta.'');
                                                 $numero_cuenta = $giro->appendChild($numero_cuenta);
                                                 $numero_giro = $xml->createElement('numero_giro',''.$row_i->numero_giro.'');
                                                 $numero_giro = $giro->appendChild($numero_giro);
                                       }
                                       $moneda= $xml->createElement('moneda',''.$row_liquidacion->moneda.'');
                                       $moneda = $datos_liquidacion->appendChild($moneda);
                                       $monto_operacion= $xml->createElement('monto_operacion',''.$row_liquidacion->monto_operacion.'');
                                       $monto_operacion = $datos_liquidacion->appendChild($monto_operacion);

                                     break;
                                 
                             }
                             
                
                             
                         }
                               
                    
                }
   /*******FIN DETALLE DE OPERACIONES*******************************************************************************/
 }//fin foreach
 //************************************************************************************/
 
$xml->formatOutput = true;

            //Guardar el xml como un archivo de String, es decir, poner los string en la variable $strings_xml:
	
            $strings_xml = $xml->saveXML();

            //Finalmente, guardarlo en un directorio:

           
            $xml->save('./public/xml/miarchivoxml3.xml');
            
$query_referencia= $this->xml_model->datos_informe($id_aviso);
foreach ($query_referencia->result() as $referencia)
    {
    $nom_referencia = $referencia->referencia;
    }
//}//fin foreach
//echo 'Se creo el XML';
$urlxml="./public/xml/miarchivoxml3.xml";
        $this->descargar_xml($urlxml,$nom_referencia);
 }
 else
     {
     $this->CrearInformeCeros($id_aviso);
     }

  //  echo "creacion de archivos xml con id = ".$id.' y mes = '.$mes_reportado;
        }//fin create xml
    public function descargar_xml($param,$nom_referencia) {
        $basefichero = basename($param);

header( "Content-Type: application/octet-stream");

header( "Content-Length:".filesize($param));

//header( "Content-Disposition:attachment;filename=".$basefichero."");
header( "Content-Disposition:attachment;filename=".$nom_referencia.".xml");
readfile($param);
//redirect(base_url('distribuidor'));
        
    } 
     
    public function CrearInformeCeros($id_aviso) {

        $xml = new DomDocument('1.0', 'UTF-8');

//$root = $xml->createElement('tienda');

$root = $xml->createElementNS('http://www.uif.shcp.gob.mx/recepcion/veh', 'archivo');
$root = $xml->appendChild($root);
$root->setAttributeNS('http://www.w3.org/2000/xmlns/' ,'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
$root->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', 'http://www.uif.shcp.gob.mx/recepcion/veh veh.xsd');

$informe =$xml->createElement('informe');
$informe=$root->appendChild($informe);
 $datos_informe_ceros=$this->xml_model->datos_informe_ceros($id_aviso);
 /*********************************/
 foreach($datos_informe_ceros->result() as $dinformeceros){
$mes_reportado = $xml->createElement('mes_reportado',$dinformeceros->mes_reportado);
$mes_reportado = $informe->appendChild($mes_reportado);
/*sujeto obligado*/
//pendiente la etiqueta clave de entidad colegiada
$sujeto_obligado = $xml->createElement('sujeto_obligado');
$sujeto_obligado = $informe->appendChild($sujeto_obligado);
  //$clave_entidad   = $xml->createElement('clave_entidad_colegiada',' ');
  //$clave_entidad   = $sujeto_obligado->appendChild($clave_entidad);

  $clave_sujeto = $xml->createElement('clave_sujeto_obligado',  $dinformeceros->rfc);
  $clave_sujeto = $sujeto_obligado->appendChild($clave_sujeto);

  $clave_actividad = $xml->createElement('clave_actividad','VEH');
  $clave_actividad = $sujeto_obligado->appendChild($clave_actividad);
 }
  $xml->formatOutput = true;

            //Guardar el xml como un archivo de String, es decir, poner los string en la variable $strings_xml:
	
            $strings_xml = $xml->saveXML();

            //Finalmente, guardarlo en un directorio:

           
            $xml->save('./public/xml/miarchivoxml3.xml');
            

//}//fin foreach
//echo 'Se creo el XML';
$urlxml="./public/xml/miarchivoxml3.xml";
        $this->descargar_xml($urlxml);
 
        
    }
    
 }

