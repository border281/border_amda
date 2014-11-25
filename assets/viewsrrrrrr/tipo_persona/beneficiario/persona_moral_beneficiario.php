<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Persona Moral</th>
     </thead>
     <tbody>
         <tr>
             <td>Denominacion Social </td> 
             <td><?php echo form_input($razon_social);?></td>
             <td>Fecha Constitucion</td>
             <td><?php echo form_input($fecha_constitucion);?></td>
            
         </tr>
         <tr>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?></td>
             <td>Pais nacionalidad</td>
             <td>
                 <select id="nacionalidad" name="nacionalidad" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
                 
             </td>
         </tr>
         <tr>
            <td>Giro Mercantil</td>
               <td>
                 <select id="clave_actividad" name="clave_actividad" class="form-control" style="font-size: 11px;">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_actividad->result() as $row_clave_actividad){?>
                     <option title="<?=$row_clave_actividad->descrip?>" value="<?=$row_clave_actividad->id_clave?>"><?=$row_clave_actividad->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
            
         </tr>
       
         <tr>
                 
     </tbody>
     
                   
        
</table>
 <label>Tipo de domicilio</label>
                <br>
                <select id='selecttipo_domicilio_beneficiario' class='selecttipo_domicilio_beneficiario form-control' name='selecttipo_domicilio'>
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
        });
        $(document).ready(function() {
$( "input#fecha_nacimiento" ).datepicker();
$("input#fecha_constitucion").datepicker();
});
    </script>                    