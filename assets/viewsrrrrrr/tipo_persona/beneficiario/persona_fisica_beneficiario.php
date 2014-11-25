<?php ?> 
<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Persona Fisica</th>
     <?=  form_hidden('id_aviso',$id_aviso)?>
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
             <td>Pais nacimiento</td>
             <td>
                 <select id="pais_nacimiento" name="pais_nacimiento" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
         </tr>
         <tr>
             <td>Actividad economica</td>
             <td colspan="3">
                 <select id="actividad_economica" name="actividad_economica" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_actividad->result() as $row_clave_actividad){?>
                     <option value="<?=$row_clave_actividad->id_clave?>"><?=$row_clave_actividad->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
         </tr> 
         
     </tbody>
</table>
 <label>Tipo de domicilio</label>
                <br>
                <select id='selecttipo_domicilio_beneficiario' class='selecttipo_domicilio_beneficiario form-control' name='selecttipo_domicilio_beneficiario'>
                    <option selected value='0'>Selecciona un tipo de domicilio</option>
                    <option value='1'>Nacional</option>
                    <option value='2'>Extranjero</option>
                    
                    
                </select>
                <div class="div_tipo_domicilio_beneficiario">
                    
                </div>
<script>
       $(document).ready(function() {
            $("select#selecttipo_domicilio_beneficiario.selecttipo_domicilio_beneficiario").change(function() {
                $("select#selecttipo_domicilio_beneficiario.selecttipo_domicilio_beneficiario option:selected").each(function(){
                    tipo_domicilio = $('#selecttipo_domicilio_beneficiario').val();
                    $.post("<?php echo base_url();?>index.php/beneficiario/tipo_domicilio", {
                        tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $(".div_tipo_domicilio_beneficiario").html(data);
                });
                
                });
        });
        
        $( "input#fecha_nacimiento" ).datepicker();
        });
 
        

    </script> 
    
    <?php if (isset($nacionalidad) && $nacionalidad != NULL ){?>
    <script>
        $(document).ready(function(){
            $('#nacionalidad option[value= "<?php echo $nacionalidad;?>" ]').attr({'selected':'true'});
            $('#nacionalidad').prop('disabled','disabled');
            $('#pais_nacimiento option[value= "<?php echo $nacimiento;?>" ]').attr({'selected':'true'});
            $('#pais_nacimiento').prop('disabled','disabled');
            $('#actividad_economica option[value= "<?php echo $actividad_economica;?>" ]').attr({'selected':'true'});
            $('#actividad_economica').prop('disabled','disabled');
            
        });
        
    </script>
    <?php } ?>