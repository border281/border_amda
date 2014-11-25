/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   $('.dropdown_mes_aviso').change(function(){
      window.location = "http://amda.gsinlimites.com.mx/index.php/distribuidor/index/" + this.value + "/";
  });
});

