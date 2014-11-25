<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Domicilio Extranjero</th>
     <?=  form_hidden('id_aviso',$id_aviso)?>
     </thead>
     <tbody>
         <tr>
             <td>Pa&iacute;s nacimiento</td>
             <td>
                 <select id="pais_nacimiento" name="pais_nacimiento" class="form-control">
                     <option selected value="0">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
             <td>Estado Provincia</td>
             <td><?=form_input($estado)?></td>
         </tr>
         <tr>
             <td>Ciudad Poblaci&oacute;n</td>
             <td><?=form_input($ciudad)?></td>
             <td>Codigo Postal </td> 
             <td><?php echo form_input($codigo_postal);?></td>
             
            
         </tr>
         <tr>
             <td>Colonia</td>
             <td><?php echo form_input($colonia);?></td>
             <td>Calle</td>
             <td><?php echo form_input($calle);?></td>
             
         </tr>
         <tr>
             <td>Numero Exterior</td>
             <td><?php echo form_input($num_ext);?></td>
            <td>Numero interior</td>
             <td><?php echo form_input($num_int);?></td>
             
         </tr>
    <tr>
     </tbody>
       </table>
<table class="table table-striped table_amda">
    <thead> <th colspan="4">Tel&eacute;fono</th></thead>
<tbody>
<tr>
        <td>Clave Pais</td>
        <td> <select id="lada" name="lada" class="form-control">
                     <option selected value="0">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select></td>
    
        <td>Numero tel&eacute;fono</td>
        
        <td><?php echo form_input($numero_telefono)?></td>
</tr>
<tr>
    <td>Correo electr&oacute;nico</td>
        <td><?php echo form_input($mail)?></td>
</tr>              
     </tbody>
</table>
 
<?php if (isset($tipo_domicilio) && $tipo_domicilio != NULL ){?>
    <script>
        $(document).ready(function(){
            //$('select#tipo_persona option[value= "" ]').attr({'selected':'true'});
            $('select#selecttipo_domicilio_beneficiario.selecttipo_domicilio_beneficiario option[value= "2" ]').attr({'selected':'true'});
            $('select#selecttipo_domicilio_beneficiario.selecttipo_domicilio_beneficiario').prop('disabled','disabled');
            $('#lada option[value="<?=$clave_pais_java1?>"]').attr({'selected':true});
            //$('#nacionalidad option[value= "" ]').attr({'selected':'true'});
            $('#lada').prop('disabled','disabled');
        });
        
    </script>
    <?php } ?>