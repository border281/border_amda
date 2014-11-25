/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function agregarmodificatorio()
{
     $.post("http://amda.gsinlimites.com.mx/index.php/datos_aviso/addmodificatorio", {
                        //tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $("#modificatorio").html(data);
                });
}
function form_beneficiario()
{
    $.post("http://amda.gsinlimites.com.mx/index.php/persona_aviso/add_beneficiario", {
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
    
    $.post("http://amda.gsinlimites.com.mx/index.php/operaciones/add_liquidacion", {
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
    
   
     $.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
 
        setTimeout($.unblockUI, 2000); 
    
 
} 
function finalizar(id_aviso)
{
    var aviso = id_aviso
  window.location ="http://amda.gsinlimites.com.mx/index.php/createxml/index/" + aviso;
         //document.execCommand('Save As','true','tu_archivo.xml')
   window.setTimeout('alert ("El archivo se ha generado correctamente")',2000);
         // window.setTimeout(window.location = "http://amda.gsinlimites.com.mx/index.php/datos_aviso",5000);
        
        
    
}
function fin(id_aviso){
    var aviso = id_aviso
  window.location ="http://amda.gsinlimites.com.mx/index.php/createxml/index/" + aviso;
         //document.execCommand('Save As','true','tu_archivo.xml')
   window.setTimeout('alert ("El archivo se ha generado correctamente")',2000);
         // window.setTimeout(window.location = "http://amda.gsinlimites.com.mx/index.php/datos_aviso",5000);
        
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
  if(validar_persona_aviso()){
    //      debug: true

  //  })){
  $.post("http://amda.gsinlimites.com.mx/index.php/persona_aviso/guardardatospersona/",$("#form_persona_aviso").serialize(),function(res){
                  // Hacemos desaparecer el div "formulario" con un efecto fadeOut lento.
                if(res == 1){
                    //$(".status_box").addClass("success").html('Los datos se han guardado correctamente <br />')      // Si hemos tenido éxito, hacemos aparecer el div "exito" con un efecto fadeIn lento tras un delay de 0,5 segundos.
                    location.reload(true);
                } else {
                   // $(".status_box").html("<p>Error</p>");    // Si no, lo mismo, pero haremos aparecer el div "fracaso"
                   alert("Error al guardar los datos, verifica tus datos e intentalo de nuevo");
                }
            });
        }
    //preventDefault(); 
 //document.formDatospersona.submit();   
 //$('#save').submit(function(evnt){
//Evitamos que el evento submit siga en ejecución, evitando que se recargue toda la página
//$.post(url+"clip/edit_clip", //La variable url ha de contener la base_url() de nuestra aplicacion
  //  $("form#edit_form").serialize(), //Codificamos todo el formulario en formato de URL
  ///  function (data) {
   //     $('div#sending_form').prepend(data); //Añadimos la respuesta AJAX a nuestro div de notificación de respuesta
   // });
   //alert("hola");

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
    if($ullista < 50)
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
    var $ullista=$('.active').children(".block").next().find("li").length;
if($ullista < 3)
    {
       $(".active").children(".block").next().append("<ul><li><a class = 'nyroModal' data-toggle='modal' data-target='#form_liquidacion' >Datos de Liquidacion</a></li></ul>"); 
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

 /* alert("hola"); 
  e.preventDefault();
//if(validar_operacion()){
$('#form_operacion').validate({
            rules:{
                  fecha_operacion:{required:true,minlength:8,maxlength:8},
                  cp_sucursal_operacion:{required:true,number:true,minlength:5,maxlength:5},
                  nom_sucursal_operacion:{required:true},
                  tipo_operacion:{required:true},
                  marca_fabricante:{required:true},
                  modelo:{required:true},
                  anio:{required:true,number:true,minlength:4,maxlength:4},
                  vin :{required:true,minlength:17,maxlength:17},
                  repuve:{minlength:8,maxlength:8},
                  placas:{maxlength:12}
                  
                  },
         messages :{
             fecha_operacion :{required:"Se requiere fecha de la operacion",minlength:"Minimo 8 caracteres",maxlength:"Maximo 8 caracteres"},
              cp_sucursal_operacion:{required:"Se requiere codigo postal",number:"Solo se aceptan numeros",minlength:"Minimo 5 caracteres",maxlength:"Maximo 5 caracteres"},
             nom_sucursal_operacion:{required:"Se requiere el nombre de la sucursal donde se efectuo la operacion"},
                     tipo_operacion:{required:"Se requiere un tipo de operacion"},
                   marca_fabricante:{required:"Se requiere marca de fabricante"},
                             modelo:{required:"Se requiere modelo"},
                               anio:{required:"Se requiere año en formato AAAA",number:"Ingresa un anio valido",minlength:"Formato AAA",maxlength:"Formato AAA"},
                               vin :{required:"Ingrese 17 dígitos",minlength:"Minimo 17 caracteres",maxlength:"Maximo 17 caracteres"},
                             repuve:{minlength:"Minimo 8 caracteres",maxlength:"Maximo 8 caracteres"},
                             placas:{maxlength:"Maximo 12 caracteres"}
         },
         submitHandler: function (form) {
            $.ajax({
      url: "http://amda.gsinlimites.com.mx/index.php/operaciones/actualizar_datos/",//action del formulario, ej:
      type: "POST",//el método post o get del formulario
      data: $("#form_operacion").serialize(),//obtenemos todos los datos del formulario
      complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
      success: function(data){
        alert("Datos actualizados correctamente");
      },
      error : function(data)
      {
          alert("Error : verifica los datos y vuelve a intentarlo mas tarde.");
      }
       
      
   }); 
   return false;
         }
        });
  /*$.ajax({
      url: "http://amda.gsinlimites.com.mx/index.php/operaciones/actualizar_datos/",//action del formulario, ej:
      type: "POST",//el método post o get del formulario
      data: $("#form_operacion").serialize(),//obtenemos todos los datos del formulario
      complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
      success: function(data){
        alert("Datos actualizados correctamente");
      },
      error : function(data)
      {
          alert("Error : verifica los datos y vuelve a intentarlo mas tarde.");
      }
       
      
   });*//*.done(function(respuesta){
           // $("#mensaje").html(respuesta.mensaje);
           //alert(respuesta.mensaje);
          alert(respuesta);
        });*/
 
 //}
    //  alert("reacciona");
}
/*validar operacion*/

function validar_operacion(event)
{
    var repuve = /\d{8}/;
    var placas = /\d{12}/;
    var form =document.formDetalleOperaciones;
    if(form.fecha_operacion.value.length==0)
    {
        alert("se necesita fecha");
        return false;
    }
    
}
function actualizar_persona()
{
      $.ajax({
      url: "http://amda.gsinlimites.com.mx/index.php/persona_aviso/actualizar_datos/",//action del formulario, ej:
      //http://localhost/mi_proyecto/mi_controlador/mi_funcion
      type: "POST",//el método post o get del formulario
      data: $("#form_persona_aviso").serialize(),//obtenemos todos los datos del formulario
      complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
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
 function updateDatosInforme()
 {
   if(validar_persona_aviso()){
      
    $.ajax({
        url:"http://amda.gsinlimites.com.mx/index.php/datos_aviso/UpdateAviso/",
        async:true,
        type:"POST",
        data:$("#form_datos_aviso").serialize(),
        complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
        error:function(objeto, error, otroobj){
            alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");
        }
        
    });
   }
 }
function actualizar_beneficiario()
{
    
    $.ajax({
        url:"http://amda.gsinlimites.com.mx/index.php/beneficiario/actualizar_datos/",
        type:"POST",
        data : $("#formDatospersona").serialize(),
       complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
        error:function()
        {
            alert("El sistema encontro un error , verifica tus datos e intentalo de nuevo");
        },
        success:function(data){
            alert("Datos actualizados correctamente");
        }
    });
} 
 function agrega_operacion_nueva()
 {
    setTimeout(function(){document.location.href = "http://amda.gsinlimites.com.mx/index.php/operaciones/"},500);
 //alert("ok");
 }   
 
 function validar_persona_aviso(event)
 {
     
 
  var error = 0;
    $('.requerido').each(function(i, elem){
        if($(elem).val() == ''){
            $(elem).css({'border':'1px solid red'});
            error++;
            }else
            {
             $(elem).css({'border':'1px solid #CCCCCC'});   
            }
        });
    if(error > 0){
      // event.preventDefault();
        $('.status_box').addClass("warning").html('Debe rellenar los campos requeridos <br />');
        //alert("error");
        return false;
        }else{
             $('.status_box').removeClass("warning").empty();
      
    return true;
        }
 }
 
 function actualizar_liquidacion()
{
  // document.formDetalleOperaciones.submit();  
 // $(document).ready(function(){
//cuando hagamos submit al formulario con id id_del_formulario
//se procesara este script javascript
// $("#form_operacion").submit(function(e){
  // e.preventDefault();
    $.ajax({
      url: "http://amda.gsinlimites.com.mx/index.php/operaciones/update_liquidacion/",//action del formulario, ej:
      //http://localhost/mi_proyecto/mi_controlador/mi_funcion
      type: "POST",//el método post o get del formulario
      data: $("#formupdateliquidacion").serialize(),//obtenemos todos los datos del formulario
      complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
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
function ValidaRfc(rfcStr) {
	var strCorrecta;
	strCorrecta = rfcStr;	
	if (rfcStr.length == 12){
	var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
	}else{
	var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
	}
	var validRfc=new RegExp(valid);
	var matchArray=strCorrecta.match(validRfc);
	if (matchArray==null) {
		//alert('Cadena incorrectas');
                $('#rfc').addClass('error');
                $('#trfc').html( "<label for='rfc' class='error'>Debe ingresar un RFC valido </label>" );
		return false;
	}
	else
	{
		$('#trfc').html( "<label for='rfc' class='ico ico_yes'>RFC valido </label>" );
		return true;
	}
	
}
function ValidaRfcb(rfcStr) {
	var strCorrecta;
	strCorrecta = rfcStr;	
	if (rfcStr.length == 12){
	var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
	}else{
	var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
	}
	var validRfc=new RegExp(valid);
	var matchArray=strCorrecta.match(validRfc);
	if (matchArray==null) {
		//alert('Cadena incorrectas');
                $('#rfcb').addClass('error');
                $('#trfcb').html( "<label for='rfc' class='error'>Debe ingresar un RFC valido </label>" );
		return false;
	}
	else
	{
		$('#trfcb').html( "<label for='rfc' class='ico ico_yes'>RFC valido </label>" );
		return true;
	}
	
}