/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function agregarmodificatorio()
{
     $.post("http://localhost/amda/index.php/distribuidor/addmodificatorio", {
                        //tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $("#modificatorio").html(data);
                });
}
function form_beneficiario()
{
    $.post("http://localhost/amda/index.php/persona_aviso/add_beneficiario", {
                        //tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $("#form_beneficiario").html(data);
                });
   //$("#enlaceajax").click(function(evento){
  //    evento.preventDefault();
    //  $("#destino").load("conriotenido-ajax.html");
  // });

}
function form_liquidacion()
{
    
    $.post("http://localhost/amda/index.php/operaciones/add_liquidacion", {
                        //tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $("#form_liquidacion").html(data);
                });
   //$("#enlaceajax").click(function(evento){
  //    evento.preventDefault();
    //  $("#destino").load("conriotenido-ajax.html");
  // });

}
function wait(){
    $(document).ready(function() {
    $('#save').click(function() {
    $.blockUI({message: 'Espere...'
    });
    setTimeout(function() {
    $.unblockUI();
    }, 8000);
    });
}); 
} 
function finalizar(id_aviso)
{
    var aviso = id_aviso
  window.location ="http://localhost/amda/index.php/createxml/index/" + aviso;
         //document.execCommand('SaveAs','true','tu_archivo.xml')
         window.setTimeout('alert ("El archivo se ha generado correctamente")',2000);
    
}

function submitDatosAviso()
{
document.formDatosAviso.submit();
}
function submitDatosAvisoceros()
{
document.formDatosAvisoceros.submit();
}
function submitformDatospersona()
{
 document.formDatospersona.submit();   
}
function submitformDetalleOperaciones()
{
    document.formDetalleOperaciones.submit();
}
function addbeneficiario()
{
    //agregams la lista si no existe
    form_beneficiario();
    $ullista = $(".beneficiario").find("ul").length;
    if($ullista < 3)
    {
       $(".beneficiario").append("<ul><li><a class = 'nyroModal' data-toggle='modal' data-target='#form_beneficiario' >Dueño Beneficiario</a></li></ul>"); 
    }else {
    alert("Solo se permiten 3 dueños beneficiarios");
    }
   // if(!$('.beneficiario').find('ul').length) $('.beneficiario').append('<ul/>');
    // var ilimite = 3;
    //obtnms una instancia de la lista
     
  //  $ulLista=$('.beneficiario').find('ul>li');
    //verificamos el limite de la lista
    //if($ulLista.find('li').length<iLimite || iLimite==0){
  //  if($ulLista.find('ul>li').length<ilimite || ilimite==0){
        // $.post("<?php echo base_url();?>index.php/persona_aviso/tipo_persona",
       
   //     var $liNuevobeneficiario = $('<li/>').html('<a  id= "clsEliminarElemento" class = "clsEliminarElemento">&nbsp;</a><a class = "nyroModal" data-toggle="modal" data-target="#form_beneficiario" ><i class="fa fa-dashboard"></i>Dueno Beneficiario</a>');
   //     $ulLista.append($liNuevobeneficiario);
  //  }else{
   //     alert('No es posible agregar al dueno beneficiario solo se permiten 3');
        
 }
   //evento al boton eliminar
    //$('#parentElement').on('click', '.myButton', function) 
// $( document ).on( "click", "a.clsEliminarElemento", function() {
 //buscamos la lista
 //      var $ulLista = $('.beneficiario').find('ul');
       //buscamos el padre el tag li en el que se encuentra
 //      var $lipadre=$($(this).parents().get(0));
       //eliminamos 
      
  //     $lipadre.remove();
       //si la lista esta vacia la eliminamos del dom
  //     if($ulLista.find('li').length==0) $ulLista.remove();
//});
   
    //alert('addbeneficiario');
//}
function addliquidacion()
{
    //agregams la lista si no existe
    form_liquidacion();
    var $ullista=$('.active').next().find("li").length;
if($ullista < 3)
    {
       $(".active").next().append("<ul><li><a class = 'nyroModal' data-toggle='modal' data-target='#form_liquidacion' >Datos de Liquidacion</a></li></ul>"); 
    }else {
    alert("Solo se permiten 3 dueños beneficiarios");
    }
   //evento al boton eliminar
    //$('#parentElement').on('click', '.myButton', function) 
 $( document ).on( "click", "a.clsEliminarElemento", function() {
 //buscamos la lista
       var $ulLista = $('.liquidacion').find('ul');
       //buscamos el padre el tag li en el que se encuentra
       var $lipadre=$($(this).parents().get(0));
       //eliminamos 
      
       $lipadre.remove();
       //si la lista esta vacia la eliminamos del dom
       if($ulLista.find('li').length == 0) $ulLista.remove();
});
   
    //alert('addbeneficiario');
}


 function blindado_si()
          {
               var blindado="<label for='blindaje'> Nivel de Blindaje <span class='required'>*</span> </label>"+
                              "<select class='form-control' id='nivel_blindaje' name='nivel_blindaje'>"+
                                                    "<option selected='selected'>Selecione una opcion</option>"+
                                                    " <option value='1'>NIVEL A</option>"+
                                                    " <option value='2'>NIVEL B</option>"+
                                                    " <option value='3'>NIVEL B PLUS</option>"+
                                                    " <option value='4'>NIVEL C</option>"+
                                                    " <option value='5'>NIVEL C PLUS</option>"+
                                                    " <option value='6'>NIVEL D</option>"+
                                                    " <option value='7'>NIVEL E</option>"+
                                                    
                                                "</select>";
               
                                 $("#blindado").html(blindado);
          }
 function blindado_no()
          {
               var blindado="<label for='blindaje'><span class='required'></span> </label>";
                                 
                                 $("#blindado").html(blindado);
          }
          
          
 function addliquidacionAffter()
{
    //agregams la lista si no existe
    form_liquidacion();
   $ullista = $(".liquidacion").find("ul").length;
    if($ullista < 3)
    {
       $(".liquidacion").append("<ul><li><a class = 'nyroModal' data-toggle='modal' data-target='#form_liquidacion' >Datos de Liquidacion</a></li></ul>"); 
    }else {
    alert("Solo se permiten 3 Datos de Liquidacion");
    }
   //evento al boton eliminar
    //$('#parentElement').on('click', '.myButton', function) 
 $( document ).on( "click", "a.clsEliminarElemento", function() {
 //buscamos la lista
       var $ulLista = $('.liquidacion').find('ul');
       //buscamos el padre el tag li en el que se encuentra
       var $lipadre=$($(this).parents().get(0));
       //eliminamos 
      
       $lipadre.remove();
       //si la lista esta vacia la eliminamos del dom
       if($ulLista.find('li').length == 0) $ulLista.remove();
});
   
    //alert('addbeneficiario');
    }
    
function actualizar_operaciones()
{
  // document.formDetalleOperaciones.submit();  
 // $(document).ready(function(){
//cuando hagamos submit al formulario con id id_del_formulario
//se procesara este script javascript
// $("#form_operacion").submit(function(e){
  // e.preventDefault();
    $.ajax({
      url: "http://localhost/amda/index.php/operaciones/actualizar_datos/",//action del formulario, ej:
      //http://localhost/mi_proyecto/mi_controlador/mi_funcion
      type: "POST",//el método post o get del formulario
      data: $("#form_operacion").serialize(),//obtenemos todos los datos del formulario
      error: function(){
      //si hay un error mostramos un mensaje
      alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");
      },
      success:function(data){
          alert("Datos actualizados correctamente");
      //hacemos algo cuando finalice todo correctamente
      }
   });
 

    //  alert("reacciona");
} 

function actualizar_persona()
{
      $.ajax({
      url: "http://localhost/amda/index.php/persona_aviso/actualizar_datos/",//action del formulario, ej:
      //http://localhost/mi_proyecto/mi_controlador/mi_funcion
      type: "POST",//el método post o get del formulario
      data: $("#form_persona_aviso").serialize(),//obtenemos todos los datos del formulario
      error: function(){
      //si hay un error mostramos un mensaje
      alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");
      },
      success:function(data){
          alert("Datos actualizados correctamente");
      //hacemos algo cuando finalice todo correctamente
      }
   });
 
}
 
function actualizar_beneficiario()
{
    $.ajax({
        url:"http://localhost/amda/index.php/beneficiario/actualizar_datos/",
        type:"POST",
        data : $("#formDatospersona").serialize(),
        error:function()
        {
            alert("El sistema encontro un error , verifica tus datos e intentalo de nuevo");
        },
        success:function(data){
            alert("Datos actualizados correctamente");
        }
    });
} 
 function agregar_operacion()
 {
    window.location="http://localhost/amda/index.php/operaciones/";
 }   