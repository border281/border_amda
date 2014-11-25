<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Fideicomiso</th>
      <?=  form_hidden('id_aviso',$id_aviso)?>
     </thead>
     <tbody>
         <tr>
             <td>Denominaci&oacute;n Razon Social </td> 
             <td><?php echo form_input($razon_social);?></td>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?><label id="trfcb"></label></td>
            
         </tr>
         <tr>
             <td>Identificador Fideicomiso</td>
             <td><?php echo form_input($identificador_fideicomiso);?></td>
         </tr>
           <?php if(isset($idb)&& $idb !=NULL ){ echo form_hidden('idb',$idb);}?>                     
     </tbody>
     
                                   
      
    
</table>
 <label>Tipo de domicilio</label>
                <br>
                <select id='selecttipo_domicilio_beneficiario' class='selecttipo_domicilio_beneficiario form-control' name='selecttipo_domicilio_beneficiario'>
                    <option selected value=''>Selecciona un tipo de domicilio</option>
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
$( "input#fecha_nacimiento" ).datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_nacimiento').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true,yearRange: '-100:+0'}); 
});
    </script>   
    <?php if (isset($tipo_persona) && $tipo_persona != NULL ){?>
    <script>
        $(document).ready(function(){
            $('select#tipo_persona option[value= "<?php echo $tipo_persona;?>" ]').attr({'selected':'true'});
           
          
           
        });
        
    </script>
    <?php } ?>