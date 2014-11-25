<div id="page-wrapper">
   

  
        <div class="content-header">
            <h3 class="icon-head head-products">Editar Liquidaci&oacute;n <?=$indice?></h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="save" class="scalable save" onclick="actualizar_liquidacion();" style="">
                        <span>Actualizar datos</span>
                    </button>
                    
                    
                </p>
            </div>
        </div>
     <?php
     $att_form=array('name'=>'formupdateliquidacion','id'=>'formupdateliquidacion');
      echo form_open(base_url().'index.php/operaciones/update_liquidacion',$att_form);
      ?>
    <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
        <div class="middle-container">
             <?php
            if($this->session->flashdata('valido') != ''){
            ?>
        <div class="status_box success">
            <h6>Exito</h6>
            <ul><li><?=$this->session->flashdata('valido')?></li></ul>
        </div>
    <?php } ?>
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <div class="highlight">
                    INSTRUCCIONES : Capture los datos de la liquidaci&oacute;n. 
               </div>
                <table class="table table-striped">
                    <thead>
                        <tr><th>Datos de Liquidaci&oacute;n</th></tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                    <div class="form-group">
                        <td>Fecha de pago :</td>
                        <td><?=  form_input($fecha_pago)?></td>
                    </div>   
                    </tr>
                        <tr>
                            <td>
                               Forma de Pago
                            </td>
                            <td>
                               <select id="select_forma_pago" name="select_forma_pago" class="form-control">
                                  <option value="" selected>Selecciona una Forma de pago</option>
                                  <?php foreach ($forma_pago->result() as $row_pago){?>
                                  <option value="<?=$row_pago->id_clave?>"><?=$row_pago->descrip?></option>
                                  <?php }?>
                              </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Moneda</td>
                            <td>
                                <select id="select_moneda" name="select_moneda" class="form-control">
            <option selected value="">Selecciona un tipo de moneda</option>
        <?php foreach ($select_moneda->result() as $row_moneda){?>
            <option value="<?=$row_moneda->id_clave?>"><?=$row_moneda->descrip?></option>
        <?php } ?>
        </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Monto de la operaci&oacute;n</td>
                            <td><?=form_input($monto)?></td>
                        </tr>
                        <tr>
                            <td>Instrumento de pago</td>
                            <td>
                                <select id="select_instrumento" disabled="" name="select_instrumento" class="select_instrumento form-control">
                                    <option selected value="">Selecciona una opci&oacute;n</option>
    <?php foreach ($instrumento->result() as $row_instrumento) {?>
    <option value="<?=$row_instrumento->id_clave?>"><?=$row_instrumento->descrip?></option>
<?php } ?>
</select>
                            </td>
                        </tr>
                        <tr class="div_mostrar_instrumento">
                            
                        </tr>
                    </tbody>
                </table>
                
                <?=form_hidden('id_aviso',$id_aviso)?>
                <?=form_hidden('id_op',$id_op)?>
                <?=form_hidden('id_li',$id_li)?>
            </fieldset>
        </div>
    
    <?=  form_close()?>
    

</div><!-- /.modal -->
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
        });
   $(function(){
    $('#form_form_liquidacion').validate({
       rules : {
           fecha_pago : {required :  true, minlength :8,maxlength :8},
    select_forma_pago : {required:true},
   select_instrumento : {required:true}, 
        select_moneda : {required :true},
                monto : {required:true,number :true },  
       numero_tarjeta : {required :true,number :true,minlength: 4},
  institucion_credito : {required:true},
        numero_cuenta : {required:true,number:true},
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
                       required : "" 
                    },
            select_instrumento :
                    {
                        required :""
                    }        
       }
    });
}); 
$(function(){
    $('#fecha_pago').datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
                
  $('#fecha_pago').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true}); 
  $( "#fecha_pago" ).datepicker( "setDate", "<?php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){ echo $fecha_datepicker;}?>");

});
    </script>

           
   

<?php if (isset($forma_pago_js) && $forma_pago_js != NULL ){?>
    <script>
        $(document).ready(function(){
            //$('select#tipo_persona option[value= "" ]').attr({'selected':'true'});
            $('select#select_forma_pago option[value= "<?=$forma_pago_js?>" ]').attr({'selected':'true'});
            $('select#select_moneda option[value="<?=$id_moneda?>"]').attr({'selected':'true'});
            $('select#select_instrumento option[value="<?=$id_instrumento?>"]').attr({'selected':'true'});
           
        });
        
    </script>
    <?php } ?>


