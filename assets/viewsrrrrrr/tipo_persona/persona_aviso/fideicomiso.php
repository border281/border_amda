<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Fideicomiso</th>
     </thead>
     <tbody>
         <tr>
             <td>Denominacion Razon Social </td> 
             <td><?php echo form_input($razon_social);?></td>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?></td>
            
         </tr>
         <tr>
             <td>Identificador Fideicomiso</td>
             <td><?php echo form_input($identificador_fideicomiso);?></td>
         </tr>
                                
     </tbody>
     
                                   
         <thead>
            <th colspan="4">Apoderado Delegado</th>
         </thead>
         <tbody>
         <tr>
             <td>Nombre</td>
              <td><?php echo form_input($nombre);?></td>
             <td>Apellido Paterno</td>
             <td><?php echo form_input($ap_paterno);?></td>
         </tr>
          <tr>
             <td>Apellido Materno</td>
             <td><?php echo form_input($ap_materno);?></td>
             <td>Fecha Nacimiento</td>
             <td><?php echo form_input($fecha_nac);?></td>
         </tr>
          <tr>
             <td>RFC</td>
            <td><?php echo form_input($rfc);?></td>
             <td>CURP</td>
             <td><?php echo form_input($curp);?></td> 
         </tr>
          <tr>
             <td>Tipo Identificacion</td>
             <td> <select id="tipo_identificacion" name="tipo_identificacion" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($tipo_identificacion->result() as $row_identif){?>
                     <option value="<?=$row_identif->id_clave?>"><?=$row_identif->descrip?></option>
                     <?php  }?>
                 </select></td>
             <td>Identificacion otro</td>
             <td><?php echo form_input('nombre_apoderado');?></td>
         </tr>
          <tr>
             <td>Autoridad identificacion</td>
            <td><?php echo form_input($aut_identif);?></td>
             <td>Numero identficacion</td>
             <td><?php echo form_input($numero_identif);?> </td> 
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
        
        });
$(document).ready(function() {
$( "input#fecha_nacimiento" ).datepicker();
});
    </script>  
    <?php if (isset($identificacion) && $identificacion != NULL ){?>
    
    <script>
        $(document).ready(function(){
            
            $('#tipo_identificacion option[value= "<?php echo $identificacion;?>" ]').attr({'selected':'true'});
            $('#tipo_identificacion').prop('disabled','disabled');
          
        });
        
        
    </script>
    
    <?php } ?>