
 <!-- Modal -->
 <div class="modal-dialog" style="width: 800px">
      <form class="form-horizontal"  id="form_form_liquidacion" method="post" action="<?php echo base_url().'index.php/operaciones/save_liquidacion/'.$this->session->userdata('datos_operacion'); ?>">
        
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
            <div class="panel-heading">
                <h5 class="text-info">AGREGAR DATOS DE LIQUIDACI&Oacute;N :</h5>
            
            </div>
        </h4>
      </div>
          
      <div class="modal-body">
          <?=  form_hidden('datos_operacion',$this->session->userdata('datos_operacion'))?>
         <?php //print_r($this->session->all_userdata()) ?>
          <div style="margin:30px;"></div>
          <div class="form-group">
              <table class="table table-striped">
                  <tbody>
                      <tr>
                          <td>Fecha de pago :</td>
                          <td>
                             <select name="dia_pago" id="dia_pago">
                 <?php 
                 for ($d=1;$d<=31;$d++) {
                     if($d<=9){$d= '0'.$d;}
                     ?>
                     <option value="<?=$d?>"><?=$d?></option>
                 <?php } ?>
                </select>
                 <select name="mes_pago" id="mes_pago">
                     <option value="01">Enero</option>
                     <option value="02">Febrero</option>
                     <option value="03">Marzo</option>
                     <option value="04">Abril</option>
                     <option value="05">Mayo</option>
                     <option value="06">Junio</option>
                     <option value="07">Julio</option>
                     <option value="08">Agosto</option>
                     <option value="09">Septiembre</option>
                     <option value="10">Octubre</option>
                     <option value="11">Noviembre</option>
                     <option value="12">Diciembre</option>
                 </select>
                 <select name="anio_pago" id="anio_pago">
                     <?php for ($y=1900;$y<=2050;$y++) {?>
                     <option value="<?=$y?>"><?=$y?></option>
                 <?php } ?>
                 </select>   
         <?=  form_input($fecha_pago)?>
                          </td>
                      </tr>
                      <tr>
                          <td>Forma de pago :</td>
                          <td>
                              <select id="select_forma_pago" name="select_forma_pago" class="form-control">
                                  <option value=""<?php echo set_select('select_forma_pago','',TRUE); ?> selected>Selecciona una Forma de pago</option>
                                  <?php foreach ($forma_pago->result() as $row_pago){?>
                                  <option value="<?=$row_pago->id_clave?>"<?php echo set_select('select_forma_pago',''.$row_pago->id_clave.''); ?>><?=$row_pago->descrip?></option>
                                  <?php }?>
                              </select>
                          </td>
                      </tr>
                      
                  </tbody>
              </table>
                   
                <div class="div_tipo_instrumento">
                    
                </div>
                      
              </select>
          </div>
          
      </div>
          </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
       </form> 
    </div><!-- /.modal-content -->
  <script>
     //html body div#wrapper div#page-wrapper form div.middle-container fieldset div#form_liquidacion.modal div.modal-dialog form#form_form_liquidacion.form-horizontal div.modal-content div.modal-body div.form-group table.table tbody tr td select#select_forma_pago.form-control 
      //*[@id="tipo_persona"]html body.modal-open div#wrapper div#form_beneficiario.modal div.modal-dialog form#form_form_beneficiario.form-horizontal div.modal-content div.modal-body div.form-group select#tipo_persona.tipo_persona
       $(document).ready(function() {
            $("select#select_forma_pago.form-control ").change(function() {
                $("select#select_forma_pago.form-control  option:selected").each(function(){
                    forma_pago = $('#select_forma_pago').val();
                    $.post("<?php echo base_url();?>index.php/operaciones/forma_pago", {
                        forma_pago : forma_pago
                        }, function(data) {
                            $(".div_tipo_instrumento").html(data);
                });
                
                });
        });
        
         $("select[name=anio_pago]").change(function(){
            $("#fecha_pago").val($("select#anio_pago").val()+$("select#mes_pago").val()+$("select#dia_pago").val()); 
    });
        });
   $(function(){
    $('#form_form_liquidacion').validate({
       rules : {
           fecha_pago : {required :  true, minlength :8,maxlength :8},
    select_forma_pago : {required:true},
   select_instrumento : {required:true}, 
        select_moneda : {required :true},
                monto : {required:true,number :true },  
       numero_tarjeta : {required :true,number :true,minlength: 4,maxlength:4},
  institucion_credito : {required:true},
        numero_cuenta : {required:true,number:true,minlength:1,maxlength:18},
        numero_cheque : {required:true,number:true},
        clave_rastreo : {required:true},
        folio_interno : {required:true},
 institucion_ordenante : {required:true},
           pais_origen: {required:true}
       },
       
       messages :{
           fecha_pago :
                   {
                       required :  "Debe ingresar una fecha de pago",
                       minlength : "Debe tener el formato AAAAMMDD",
                       maxlength : "Debe tener el formato AAAAMMDD",
                       number : "El campo debe contener solo numeros"
                   },
            select_forma_pago :
                    {
                       required : "Selecciona una forma de pago" 
                    },
            select_instrumento :
                    {
                        required :"Selecciona un instrumento de pago"
                    },
        select_moneda : {required :"Selecciona un tipo de moneda"},
                monto : {required:"Ingresa el monto",number :"Se aceptan solo numeros" },  
       numero_tarjeta : {required :"Ingrese 4 caracteres",number :"Se aceptan solo numeros",minlength:"Minimo 4 caracteres",maxlength:"Maximo 4 caracteres"},
  institucion_credito : {required:"Se requiere nombre de la institucion de credito"},
        numero_cuenta : {required:"Se requiere numero de cuenta",number:"Se aceptan solo numeros",minlength:"Minimo 1 caracter",maxlength:"Maximo 18 caracteres"},
        numero_cheque : {required:"Se requiere numero de cheque",number:"Se aceptan solo numeros"},
        clave_rastreo : {required:"Se requiere clave de rastreo"},
        folio_interno : {required:"Se requiere folio interno"},
 institucion_ordenante : {required:"Se requiere nombre de la instituci&oacute;n ordenante"},
           pais_origen: {required:"Se requiere pa&iacute;s de origen"}
       }
    });
}); 
/*$(function(){
    $('#fecha_pago').datepicker({
                showOn: 'button',
                buttonImage: '<?//=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
                
  $('#fecha_pago').datepicker('option', {dateFormat: 'yymmdd'}); 
});*/
    </script> 
    