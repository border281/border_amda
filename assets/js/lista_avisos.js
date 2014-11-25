/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   $('.dropdown_mes_aviso').change(function(){
      window.location = "http://amda.gsinlimites.com.mx/index.php/distribuidor/index/" + this.value + "/";
  });
  
  $(function(){
   $('.block').hide();
   $('.accordion li').on('click',function(){
       $('.accordion li').removeClass("activo");
       $(this).addClass("activo");
     if($(this).next().is(':visible')){
       $(this).next().slideUp();
       
     }
     if($(this).next().is(':hidden')){
     $('.accordion a').next().slideUp();
       $(this).next().slideDown();
       
    }
   });
 });
 
 $( "#select_tipoalerta" ).change(function() {
var valor=$("#select_tipoalerta option:selected").val();
    if(valor == "9999")
    {
        $("#alerta_otro").append("<td>Descripci&oacute;n de la alerta</td><td><textarea name='descripcion_alerta' class='requerido form-control' placeholder='Introduce una descripci&oacute;n de la alerta' id='descripcion_alerta'></textarea></td>"); 
    
    }else
    {
        $("#alerta_otro").empty(); 
    }
});

});

