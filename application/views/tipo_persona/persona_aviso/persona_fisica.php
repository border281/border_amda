<?php ?> 
<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Persona F&iacute;sica </th>
     </thead>
     <tbody>
         <tr>
             <td>Nombre(s) </td> 
             <td><?php echo form_input($nombre);?></td>
             <td>Fecha nacimiento</td>
             <td><?php echo form_input($fecha_nac);?></td>
            
         </tr>
         <tr>
             <td>Apellido paterno</td>
             <td><?php echo form_input($ap_paterno);?></td>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?><label id="trfc"></label></td>
            
         </tr>
         <tr>
            <td>Apellido materno</td>
             <td><?php echo form_input($ap_materno);?></td>
             <td>CURP</td>
             <td><?php echo form_input($curp);?></td> 
         </tr>
         <tr>
             <td>Pa&iacute;s nacionalidad</td>
             <td>
                 <select id="nacionalidad" name="nacionalidad" class="requerido form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
                 
             </td>
             <td>Tipo identificaci&oacute;n</td>
             <td>
                 <select id="tipo_identificacion" name="tipo_identificacion" class="requerido form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($tipo_identificacion->result() as $row_identif){?>
                     <option value="<?=$row_identif->id_clave?>"><?=$row_identif->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
         </tr>
         <?php if(isset($identif_otro) && $identif_otro != NULL && $identif_otro != 0){?>
         <tr id="identificacion_otro">
             <td>Descripci&oacute;n de Identificaci&oacute;n</td>
             <td><?=form_textarea($identif_otro)?></td>
         </tr>
         <?php }else{?>
         <tr id="identificacion_otro"></tr>
          <?php }?>
         <tr>
             <td>Pa&iacute;s nacimiento</td>
             <td>
                 <select id="pais_nacimiento" name="pais_nacimiento" class="requerido form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
             <td>Autoridad emite identificaci&oacute;n</td>
             <td><?php echo form_input($aut_identif);?></td>
         </tr>
         <tr>
             <td>Actividad econ&oacute;mica</td>
             <td>
                 <select id="clave_actividad" name="clave_actividad" class="requerido form-control" style="font-size: 11px;">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_actividad->result() as $row_clave_actividad){?>
                     <option title="<?=$row_clave_actividad->descrip?>" value="<?=$row_clave_actividad->id_clave?>"><?=$row_clave_actividad->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
             <td>N&uacute;mero identificaci&oacute;n</td>
             <td>
                <?php echo form_input($numero_identif);?> 
             </td>
         </tr>
     </tbody>
     <?php if(isset($cl)&& $cl != NULL){ echo form_hidden('cl',$cl);}?>
     <?php if(isset($t)&& $t != NULL){ echo form_hidden('t',$t);}?>
</table>
 <label>Tipo de domicilio</label>
                <br>
                <select id='selecttipo_domicilio' class='requerido selecttipo_domicilio form-control' name='selecttipo_domicilio'>
                    <option selected value=''>Selecciona un tipo de domicilio</option>
                    <option value='1'>Nacional</option>
                    <option value='2'>Extranjero</option>
                    
                    
                </select>
                <div class="div_tipo_domicilio">
                    
                </div>
                
<script>
       $(document).ready(function() {
            $("select#selecttipo_domicilio.selecttipo_domicilio").change(function() {
                $("select#selecttipo_domicilio.selecttipo_domicilio option:selected").each(function(){
                    tipo_domicilio = $('#selecttipo_domicilio').val();
                    $.post("<?php echo base_url();?>index.php/persona_aviso/tipo_domicilio", {
                        tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $(".div_tipo_domicilio").html(data);
                });
                
                });
        });
  
$( "select#tipo_identificacion" ).change(function() {
var valor_identificacion=$("select#tipo_identificacion option:selected").val();
    if(valor_identificacion == "11" || valor_identificacion == "12" || valor_identificacion == "13")
    {
         $("#identificacion_otro").empty(); 
        $("#identificacion_otro").append("<td>Descripci&oacute;n de Identificaci&oacute;n</td><td><textarea name='descripcion_identificacion' value='<?php echo   set_value('descripcion_identificacion'); ?>' class='requerido form-control' placeholder='Introduce una descripci&oacute;n de la identificaci&oacute;n' id='descripcion_identificacion'></textarea></td>"); 
    
    }else
    {
        $("#identificacion_otro").empty(); 
    }
});


$( "input#fecha_nacimientop" ).datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_nacimientop').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true,yearRange: '-100:+0'});
  $( "#fecha_nacimientop" ).datepicker( "setDate", "<?php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){echo $fecha_datepicker;}?>");
$( "input#fecha_nacimiento" ).datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_nacimiento').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true,yearRange: '-100:+0'});
  $( "#fecha_nacimiento" ).datepicker( "setDate", "<?php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){echo $fecha_datepicker;}?>");

    $('#form_persona_aviso').validate({
       rules : {
           nombre_persona : {required :  true, maxlength : 200},
               ap_paterno : {required:true},
               ap_materno : {required:true},
                       rfc: {required:true},
                           
       },
       messages :{
           nombre_persona :{required :  "Se requiere un nombre", maxlength : "El nombre es muy largo"},
            select_tipo_aviso :
                    {
                       required : "Selecciona el tipo de aviso a reportar" 
                    }
       }
    });


<?php 

if(isset($actualizar_datos) && $actualizar_datos != NULL){
    echo $actualizar_datos;
} 
?>


});
    </script>  
    <?php if (isset($pais_nacionalidad) && $pais_nacionalidad != NULL ){?>
    <script>
        $(document).ready(function(){
            $('#nacionalidad option[value= "<?php echo $pais_nacionalidad;?>" ]').attr({'selected':'true'});
            $('#nacionalidad').prop('disabled','disabled');
            $('#pais_nacimiento option[value= "<?php echo $pais_nacimiento;?>" ]').attr({'selected':'true'});
            $('#pais_nacimiento').prop('disabled','disabled');
            $('#tipo_identificacion option[value= "<?php echo $identificacion;?>" ]').attr({'selected':'true'});
            $('#tipo_identificacion').prop('disabled','disabled');
            $('#clave_actividad option[value= "<?php echo $actividad_economica;?>" ]').attr({'selected':'true'});
            $('#clave_actividad').prop('disabled','disabled');
        });
        
    </script>
    <?php } ?>

<?php if (isset($tipo_domicilio1) && $tipo_domicilio1 != NULL ){?>
    <script>
        $(document).ready(function(){
            $('select#selecttipo_domicilio.selecttipo_domicilio option[value= "<?php echo $tipo_domicilio1;?>" ]').attr({'selected':'true'});
               // $("select#selecttipo_domicilio.selecttipo_domicilio option:selected").each(function(){
                    tipo_domicilio = $('#selecttipo_domicilio').val();
                    $.post("<?php echo base_url();?>index.php/persona_aviso/tipo_domicilio", {
                        tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $(".div_tipo_domicilio").html(data);
                });
                
                //});
            // $('select#selecttipo_domicilio.selecttipo_domicilio').prop('disabled','disabled');
           
        });
        
    </script>
    <?php } ?>
