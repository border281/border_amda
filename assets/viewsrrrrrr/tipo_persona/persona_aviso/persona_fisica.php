<?php ?> 
<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Persona Fisica </th>
     </thead>
     <tbody>
         <tr>
             <td>Nombre </td> 
             <td><?php echo form_input($nombre);?></td>
             <td>Fecha nacimiento</td>
             <td><?php echo form_input($fecha_nac);?></td>
            
         </tr>
         <tr>
             <td>Apellido paterno</td>
             <td><?php echo form_input($ap_paterno);?></td>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?></td>
         </tr>
         <tr>
            <td>Apellido materno</td>
             <td><?php echo form_input($ap_materno);?></td>
             <td>CURP</td>
             <td><?php echo form_input($curp);?></td> 
         </tr>
         <tr>
             <td>Pais nacionalidad</td>
             <td>
                 <select id="nacionalidad" name="nacionalidad" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
                 
             </td>
             <td>Tipo identificacion</td>
             <td>
                 <select id="tipo_identificacion" name="tipo_identificacion" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($tipo_identificacion->result() as $row_identif){?>
                     <option value="<?=$row_identif->id_clave?>"><?=$row_identif->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
         </tr>
         <tr>
             <td>Pais nacimiento</td>
             <td>
                 <select id="pais_nacimiento" name="pais_nacimiento" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
             <td>Autoridad emite identificacion</td>
             <td><?php echo form_input($aut_identif);?></td>
         </tr>
         <tr>
             <td>Actividad economica</td>
             <td>
                 <select id="clave_actividad" name="clave_actividad" class="form-control" style="font-size: 11px;">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_actividad->result() as $row_clave_actividad){?>
                     <option title="<?=$row_clave_actividad->descrip?>" value="<?=$row_clave_actividad->id_clave?>"><?=$row_clave_actividad->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
             <td>Numero identificacion</td>
             <td>
                <?php echo form_input($numero_identif);?> 
             </td>
         </tr>
     </tbody>
</table>
 <label>Tipo de domicilio</label>
                <br>
                <select id='selecttipo_domicilio' class='selecttipo_domicilio form-control' name='selecttipo_domicilio'>
                    <option selected value='0'>Selecciona un tipo de domicilio</option>
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
  



$( "input#fecha_nacimientop" ).datepicker();


$('input:text,input:checkbox,input:radio,textarea,select').one('change', function()
    {
    $("#save_persona").empty().html("Actualizar Datos");
    $("button#save").attr({"onclick":"actualizar_persona"});
    });
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