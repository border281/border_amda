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
        });
$(document).ready(function() {
$( "input#fecha_nacimiento" ).datepicker();
});
    </script>     