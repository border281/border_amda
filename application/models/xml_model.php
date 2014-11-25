<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Xml_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function datos_informe($idaviso) {
        //recuperamos los datos del aviso
        $query = $this->db->query("SELECT  I.mes_reportado,
                                           AV.idalerta,
                                           AV.referencia,
                                           AV.prioridad,
                                           AV.descripcion_alerta
				   FROM aviso AV,informe I
                                   WHERE AV.idaviso=".$idaviso."
                                    AND I.idinforme = AV.idinforme");
        //debemos construir el array completo
        
            return $query;
        
        //return $query;
    }
    /****************************************************************************/
   
  /*******************************************************************/
  function datos_modificatorio($id_aviso)
  {
    $query_modificatorio = $this->db->query("SELECT * FROM modificatorio where idaviso = ".$id_aviso."");
    return $query_modificatorio;
  }  
 /*********************************************************************************/
 function datos_informe_ceros($idaviso)
 {
    $query = $this->db->query("SELECT I.mes_reportado,
                                      AV.idaviso,
                                     U.rfc
                                FROM informe I,aviso AV , am_users U 
                                WHERE AV.idaviso = ".$idaviso."
                                AND AV.idinforme = I.idinforme
                                AND I.id_user = U.id");
    return $query;

 }
 /******************************************************************************/   
    function datos_aviso($idaviso)
    {
        $queryav = $this->db->query("SELECT CL.idcliente,
		CL.tipo_persona,
		CL.tipo_domicilio,
		CL.id_telefono,
		TEL.clave_pais,
		TEL.numero_tel,
		TEL.correo_electronico
		
FROM cliente CL,telefono TEL
WHERE CL.idaviso = ".$idaviso."
AND CL.id_telefono = TEL.idtelefono;");
        
        return $queryav;
    }
    
    function persona_fisica($id_cliente) {
        $query_fisica = $this->db->query ('SELECT * FROM persona_fisica WHERE idcliente = '.$id_cliente.'');
        return $query_fisica;
    } 
    function persona_fisica_beneficiario($id_beneficiario)
    {
         $query_fisica = $this->db->query ('SELECT * FROM persona_fisica WHERE idbeneficiario = '.$id_beneficiario.'');
        return $query_fisica;
    }
    function persona_moral($id_cliente)
    {
       $query_moral = $this->db->query('SELECT MO.razon_social,
                                    MO.fecha_constitucion,
                                    MO.rfc as rfc_moral,
                                    MO.pais_nacionalidad,
                                    MO.giro_mercantil,
                                    MO.idrepresentante_apoderado,
                                             AP.nombre,
                                             AP.ap_paterno,
                                             AP.ap_materno,
                                             AP.fecha_nac,
                                             AP.rfc,
                                             AP.curp,
                                             AP.tipo_identificacion,
                                             AP.identificacion_otro,
                                             AP.autoridad_identificacion,
                                             AP.numero_identificacion
                             FROM persona_moral MO ,representante_apoderado AP
                             WHERE MO.idcliente = '.$id_cliente.'
                             AND MO.idrepresentante_apoderado = AP.idrepresentante_apoderado;');
       return $query_moral;
                
    }
    function persona_moral_beneficiario($id_beneficiario)
    {
       $query_moral = $this->db->query('SELECT MO.razon_social,
                                    MO.fecha_constitucion,
                                    MO.rfc,
                                    MO.pais_nacionalidad,
                                    MO.giro_mercantil
                                    
                             FROM persona_moral MO 
                             WHERE MO.idbeneficiario = '.$id_beneficiario.'
                            ');
       return $query_moral;
                
    }
    function fideicomiso($id_cliente) {
        
        $query_f = $this->db->query('SELECT F.razon_social,
                                             F.rfc,
                                             F.identificador_fideicomiso,
                                             F.idapoderado_delegado,
                                             AD.nombre,
                                             AD.ap_paterno,
                                             AD.ap_materno,
                                             AD.fecha_nac,
                                             AD.rfc as rfcad,
                                             AD.curp,
                                             AD.tipo_identificacion,
                                             AD.identificacion_otro,
                                             AD.autoridad_identificacion,
                                            AD.numero_identificacion
                             FROM fideicomiso F ,apoderado_delegado AD
                             WHERE F.idcliente = '.$id_cliente.'
                             AND F.idapoderado_delegado = AD.idapoderado_delegado');
        return $query_f;
                
        
    }
    function fideicomiso_beneficiario($id_beneficiario) {
        
        $query_f = $this->db->query('SELECT F.razon_social,
                                             F.rfc,
                                             F.identificador_fideicomiso
                                            
                             FROM fideicomiso F 
                             WHERE F.idbeneficiario= '.$id_beneficiario.'
                            ');
        return $query_f;
                
        
    }
    
    
    function nacional($id_cliente)
    {
       $query_nac = $this->db->query('SELECT D.colonia,
                                        D.calle,
                                        D.numero_interior,
                                        D.numero_exterior,
                                        D.cp,
                                        TEL.clave_pais,
                                        TEL.numero_tel,
                                        TEL.correo_electronico
                                        FROM  dom_nacional D ,telefono TEL  
                                        WHERE D.idcliente = '.$id_cliente.'
                                        AND D.idcliente = TEL.idcliente');
       return $query_nac;
    }
    function extranjero($id_cliente)
    {
        $query_ext = $this->db->query('SELECT 	D.idpais,
                                                D.provincia,
                                                D.ciudad,
                                                D.colonia,
                                                D.calle,
                                                D.numero_interior,
                                                D.numero_exterior,
                                                D.cp,
                                                TEL.clave_pais,
                                                TEL.numero_tel,
                                                TEL.correo_electronico
                                                FROM  dom_extranjero D ,telefono TEL  
                                                WHERE D.idcliente = '.$id_cliente.'
                                                AND D.idcliente = TEL.idcliente;');
       return $query_ext;
    }
     function nacional_beneficiario($id_beneficiario)
    {
       $query_nac = $this->db->query('SELECT * FROM dom_nacional d LEFT join telefono t on d.idbeneficiario = t.idbeneficiario where d.idbeneficiario = '.$id_beneficiario.'');
       return $query_nac;
    }
    function extranjero_beneficiario($id_beneficiario)
    {
        $query_ext = $this->db->query('SELECT * FROM dom_extranjero d LEFT JOIN telefono t on d.idbeneficiario = t.idbeneficiario WHERE d.idbeneficiario = '.$id_beneficiario.'');
       return $query_ext;
    }
    //**********************************************//
    function count_beneficiario($id_aviso) {
        //regresara el numero de duenos beneficiarios existentes para el aviso
        $num_beneficiarios= $this->db->query('SELECT BN.idbeneficiario,
		BN.tipo_persona,
		BN.tipo_domicilio,
		BN.id_telefono,
		TEL.clave_pais,
		TEL.numero_tel,
		TEL.correo_electronico
		
FROM beneficiario BN,telefono TEL
WHERE BN.idaviso = '.$id_aviso.'
AND BN.id_telefono = TEL.idtelefono;');
        return $num_beneficiarios;
        
    }
    function count_beneficiario_1($id_aviso,$idbeneficiario) {
        //regresara el numero de duenos beneficiarios existentes para el aviso
        $num_beneficiarios= $this->db->query('SELECT BN.idbeneficiario,
        BN.tipo_persona,
        BN.tipo_domicilio,
        BN.id_telefono,
        TEL.clave_pais,
        TEL.numero_tel,
        TEL.correo_electronico
        
FROM beneficiario BN,telefono TEL
WHERE BN.idaviso = '.$id_aviso.'
AND BN.idbeneficiario = '.$idbeneficiario.'
AND BN.id_telefono = TEL.idtelefono;');
        return $num_beneficiarios;
        
    }
    
    function operaciones($id_aviso,$datos_operacion = NULL)
    {
      
        if(isset($datos_operacion) && $datos_operacion <> NULL)
            
            {
                    $id_instrumento = $this->db->query('SELECT OP.idaviso,
                                                                LI.id_instrumento
							FROM datos_operacion OP,datos_liquidacion LI
                                                        WHERE OP.idaviso = '.$id_aviso.'
                                                        AND OP.iddatos_operacion = '.$datos_operacion.'
							AND OP.iddatos_operacion = LI.iddatos_operacion;');
                    
                    $row_instrumento=$id_instrumento->row();
                   
                    if(!empty($row_instrumento->id_instrumento)){
                    switch ($row_instrumento->id_instrumento) {
                        case 1: 
                                $oper = $this->db->query('SELECT OP.iddatos_operacion,
                                                OP.fecha_operacion, 
                                                OP.tipo_operacion, 
                                                OP.id_datos_vehiculo, 
                                                OP.nivel_blindaje, 
                                                OP.idaviso, 
                                                OP.cp_sucursal, 
                                                OP.nombre_sucursal, 
                                                VE.iddatos_vehiculo, 
                                                VE.marca, 
                                                VE.modelo, 
                                                VE.anio, 
                                                VE.vin, 
                                                VE.repuve, 
                                                VE.placas
                                        FROM datos_operacion OP, datos_vehiculo VE
                                        WHERE OP.idaviso ='.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
                                        AND OP.iddatos_operacion= '.$datos_operacion.'
                                       ');
                                return $oper;
                            break;
                        case 2: //tarjeta credito
                                  $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            TC.numero_tarjeta
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,tarjeta_credito TC
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=TC.iddatos_liquidacion;');
                            break;
                        case 3://tarjeta debito
                            $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            TD.numero_tarjeta
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,tarjeta_debito TD
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=TD.iddatos_liquidacion;');
                            break;
                        case 4://tarjeta prepago
                             $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            TP.numero_tarjeta
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,tarjeta_prepagada TP
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=TP.iddatos_liquidacion;');
                            break;
                        case 5://cheque nominativo
                                $oper= $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            CH.institucion_credito,
                                                                            CH.numero_cheque,
                                                                            CH.numero_cuenta   
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,cheque CH
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=CH.iddatos_liquidacion;');
                            break;
                        case 6://cheque caja
                             $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            CHC.institucion_credito,
                                                                            CHC.numero_cheque,
                                                                            CHC.numero_cuenta   
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,cheque_caja CHC
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=CHC.iddatos_liquidacion;');
                            break;
                        case 7://cheque viajero
                           $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            CHV.institucion_credito,
                                                                            CHV.numero_cheque
                                                                             
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,cheque_viajero CHV
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=CHV.iddatos_liquidacion;');
                            
                            break;
                        case 8://transferencia interbancaria
                            $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            TR.clave_rastreo,
                                                                            
                                                                             
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,transferencia_interbancaria TR
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion=TR.iddatos_liquidacion;');
                            break;
                        case 9://transferencia misma institucion
                            $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            TM.clave_rastreo,
                                                                            
                                                                             
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,transferencia_mismo_banco TM
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion = TM.iddatos_liquidacion;');
                            break;
                        case 10://transferencia internacional 
                             $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            TI.institucion_ordenante,
                                                                            TI.numero_cuenta,
                                                                            TI.pais_origen
                                                                            
                                                                             
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,transferencia_internacional TI
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion = TI.iddatos_liquidacion;');
                            break;
                        case 11://orden pago
                             $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            O.institucion_ordenante,
                                                                            O.numero_cuenta,
                                                                            O.numero_orden_pago
                                                                                                                                                      
                                                                             
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,orden_pago O
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion = O.iddatos_liquidacion;');
                            break;
                          case 12://giro
                             $oper = $this->db->query('SELECT   OP.iddatos_operacion,
                                                                            OP.fecha_operacion, 
                                                                            OP.tipo_operacion, 
                                                                            OP.id_datos_vehiculo, 
                                                                            OP.nivel_blindaje, 
                                                                            OP.idaviso, 
                                                                            OP.cp_sucursal, 
                                                                            OP.nombre_sucursal, 
                                                                            VE.iddatos_vehiculo, 
                                                                            VE.marca, 
                                                                            VE.modelo, 
                                                                            VE.anio, 
                                                                            VE.vin, 
                                                                            VE.repuve, 
                                                                            VE.placas,
                                                                            LI.iddatos_liquidacion,
                                                                            LI.fecha_pago,
                                                                            LI.forma_pago,
                                                                            LI.id_instrumento,
                                                                            LI.moneda,
                                                                            LI.monto_operacion,
                                                                            G.institucion_ordenante,
                                                                            G.numero_cuenta,
                                                                            G.numero_giro
                                                                                                                                                      
                                                                             
                                        FROM datos_operacion OP, datos_vehiculo VE, datos_liquidacion LI,giro G
                                        WHERE OP.idaviso = '.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
					AND OP.iddatos_operacion = '.$datos_operacion.'
					AND OP.iddatos_operacion = LI.iddatos_operacion
					AND LI.iddatos_liquidacion = G.iddatos_liquidacion;');
                            break;
                        case 13:
                         $oper = $this->db->query('SELECT OP.iddatos_operacion,
                                                OP.fecha_operacion, 
                                                OP.tipo_operacion, 
                                                OP.id_datos_vehiculo, 
                                                OP.nivel_blindaje, 
                                                OP.idaviso, 
                                                OP.cp_sucursal, 
                                                OP.nombre_sucursal, 
                                                VE.iddatos_vehiculo, 
                                                VE.marca, 
                                                VE.modelo, 
                                                VE.anio, 
                                                VE.vin, 
                                                VE.repuve, 
                                                VE.placas
                                        FROM datos_operacion OP, datos_vehiculo VE
                                        WHERE OP.idaviso ='.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
                                       AND OP.iddatos_operacion = '.$datos_operacion.'');
                         break;
                        case 14:
                         $oper = $this->db->query('SELECT OP.iddatos_operacion,
                                                OP.fecha_operacion, 
                                                OP.tipo_operacion, 
                                                OP.id_datos_vehiculo, 
                                                OP.nivel_blindaje, 
                                                OP.idaviso, 
                                                OP.cp_sucursal, 
                                                OP.nombre_sucursal, 
                                                VE.iddatos_vehiculo, 
                                                VE.marca, 
                                                VE.modelo, 
                                                VE.anio, 
                                                VE.vin, 
                                                VE.repuve, 
                                                VE.placas
                                        FROM datos_operacion OP, datos_vehiculo VE
                                        WHERE OP.idaviso ='.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
                                       AND OP.iddatos_operacion = '.$datos_operacion.'');
                         break;
                    }//fin switch

                    }else {//fin if
                   $oper = $this->db->query('SELECT OP.iddatos_operacion,
                                                OP.fecha_operacion, 
                                                OP.tipo_operacion, 
                                                OP.id_datos_vehiculo, 
                                                OP.nivel_blindaje, 
                                                OP.idaviso, 
                                                OP.cp_sucursal, 
                                                OP.nombre_sucursal, 
                                                VE.iddatos_vehiculo, 
                                                VE.marca, 
                                                VE.modelo, 
                                                VE.anio, 
                                                VE.vin, 
                                                VE.repuve, 
                                                VE.placas
                                        FROM datos_operacion OP, datos_vehiculo VE
                                        WHERE OP.idaviso ='.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
                                       AND OP.iddatos_operacion = '.$datos_operacion.'');
                    }
            
        
            }else{ 
        $oper = $this->db->query('SELECT OP.iddatos_operacion,
                                                OP.fecha_operacion, 
                                                OP.tipo_operacion, 
                                                OP.id_datos_vehiculo, 
                                                OP.nivel_blindaje, 
                                                OP.idaviso, 
                                                OP.cp_sucursal, 
                                                OP.nombre_sucursal, 
                                                VE.iddatos_vehiculo, 
                                                VE.marca, 
                                                VE.modelo, 
                                                VE.anio, 
                                                VE.vin, 
                                                VE.repuve, 
                                                VE.placas
                                        FROM datos_operacion OP, datos_vehiculo VE
                                        WHERE OP.idaviso ='.$id_aviso.'
                                        AND OP.id_datos_vehiculo = VE.iddatos_vehiculo
                                        
                                       ');
            
            } //$rop=$oper->row();
            //print_r($rop);
           // echo $this->db->last_query();
        return $oper;
                
    }
    function datos_vehiculo($id_datos_vehiculo)
    {
        $vehiculo = $this->db->query('SELECT * FROM datos_vehiculo WHERE iddatos_vehiculo = '.$id_datos_vehiculo.'');
        return $vehiculo;
    }
    function datos_liquidacion($iddatos_operacion) {
        //$this->db->free_result();
        $liquidacion= $this->db->query('SELECT * FROM datos_liquidacion WHERE iddatos_operacion = '.$iddatos_operacion.'');
       // $this->db->order_by("iddatos_liquidacion", "asc"); 
        return $liquidacion;
        
    }
     public function detalle_instrumento($tabla,$iddatosliquidacion) {
                           $query = $this->db->where("iddatos_liquidacion",$iddatosliquidacion);
                           $query = $this->db->get($tabla);
                           return $query;
                           
                       } 
    public function liquidacion_datos($datos_operacion)
    {
        $datos_liquidacion = $this->db->query('
                    SELECT case when L.id_instrumento = 0 then ""
             when L.id_instrumento = 1 then "efectivo" 
             when L.id_instrumento = 2 then "tarjeta_credito" 
             when L.id_instrumento = 3 then "tarjeta_debito"
             when L.id_instrumento = 4 then "tarjeta_prepagada"
             when L.id_instrumento = 5 then "cheque"
             when L.id_instrumento = 6 then "cheque_caja" 
             when L.id_instrumento = 7 then "cheque_viajero"
             when L.id_instrumento = 8 then "transferencia_interbancaria"
             when L.id_instrumento = 9 then "transferencia_internacional"
             when L.id_instrumento = 10 then "transferencia_mismo_banco" 
             when L.id_instrumento = 11 then "orden_pago"
             when L.id_instrumento = 12 then "giro" end as tipo_instrumento,
            L.iddatos_liquidacion,L.iddatos_liquidacion,L.fecha_pago,PA.descrip as forma_pago,
            I.descrip as instrumento,MO.descrip as moneda,L.monto_operacion
                    FROM datos_liquidacion L , clave_pago PA ,clave_moneda MO, clave_instrumento I
                    WHERE iddatos_operacion = '.$datos_operacion.' 
                    AND L.forma_pago = PA.id_clave
                    AND L.id_instrumento = I.id_clave
                    AND L.moneda = MO.id_clave
                    order by iddatos_liquidacion asc;

            ');
        return $datos_liquidacion;

    } 
    /*********************************************************************/
    public function liquidacion_editar($datos_operacion,$iddatosliquidacion)
    {
        $datos_liquidacion = $this->db->query('
                    SELECT case when L.id_instrumento = 0 then ""
             when L.id_instrumento = 1 then "efectivo" 
             when L.id_instrumento = 2 then "tarjeta_credito" 
             when L.id_instrumento = 3 then "tarjeta_debito"
             when L.id_instrumento = 4 then "tarjeta_prepagada"
             when L.id_instrumento = 5 then "cheque"
             when L.id_instrumento = 6 then "cheque_caja" 
             when L.id_instrumento = 7 then "cheque_viajero"
             when L.id_instrumento = 8 then "transferencia_interbancaria"
             when L.id_instrumento = 9 then "transferencia_internacional"
             when L.id_instrumento = 10 then "transferencia_mismo_banco" 
             when L.id_instrumento = 11 then "orden_pago"
             when L.id_instrumento = 12 then "giro" end as tipo_instrumento,
            L.iddatos_liquidacion,L.iddatos_liquidacion,L.fecha_pago,PA.descrip as forma_pago,
            I.descrip as instrumento,MO.descrip as moneda,L.monto_operacion,L.forma_pago as f_pago,L.id_instrumento,L.moneda as id_moneda
                    FROM datos_liquidacion L , clave_pago PA ,clave_moneda MO, clave_instrumento I
                    WHERE iddatos_operacion = '.$datos_operacion.' 
                    AND L.forma_pago = PA.id_clave
                    AND L.id_instrumento = I.id_clave
                    AND L.moneda = MO.id_clave
                    AND L.iddatos_liquidacion = '.$iddatosliquidacion.';

            ');
        return $datos_liquidacion;

    } 

    /**************************************************************/
    public function instrumento ($tabla,$idliquidacion)
    {
        //$query = $this->db->query("YOUR QUERY");
        //SELECT * FROM amda.tarjeta_credito;
        $query = $this->db->query('
            SELECT * FROM '.$tabla.' WHERE iddatos_liquidacion = '.$idliquidacion.'');
        return $query;


    }   //fin instrumento               

    public function detalles_instrumento($tabla,$idliquidacion)
    {
        if($tabla != "efectivo"){
        $query = $this->db->query('
            SELECT * FROM '.$tabla.' WHERE iddatos_liquidacion = '.$idliquidacion.'');
        return $query;
    }else
    {
        return false;
    }
    }
    
}

//fin clase xml model
