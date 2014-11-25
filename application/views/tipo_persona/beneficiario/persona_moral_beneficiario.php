<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Persona Moral</th>
      <?=  form_hidden('id_aviso',$id_aviso)?>
     </thead>
     <tbody>
         <tr>
             <td>Denominaci&oacute;n Social </td> 
             <td><?php echo form_input($razon_social);?></td>
             <td>Fecha Constituci&oacute;n</td>
             <td>
                 <select name="dia_nacimiento_beneficiario" id="dia_nacimiento_beneficiario">
                 <?php 
                 for ($d=1;$d<=31;$d++) {
                     if($d<=9){$d= '0'.$d;}
                     ?>
                     <option value="<?=$d?>"><?=$d?></option>
                 <?php } ?>
                </select>
                 <select name="mes_nacimiento_beneficiario" id="mes_nacimiento_beneficiario">
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
                 <select name="anio_nacimiento_beneficiario" id="anio_nacimiento_beneficiario">
                     <?php for ($y=1900;$y<=2050;$y++) {?>
                     <option value="<?=$y?>"><?=$y?></option>
                 <?php } ?>
                 </select>
                 
                 <?php echo form_input($fecha_constitucion);?>
             </td>
            
         </tr>
         <tr>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?><label id="trfcb"></label></td>
             <td>Pa&iacute;s nacionalidad</td>
             <td>
                 <select id="nacionalidad" name="nacionalidad" class="requerido form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
                 
             </td>
         </tr>
         <tr>
            <td>Giro Mercantil</td>
               <td>
                 <select id="clave_actividad" name="clave_actividad" class="requerido form-control" style="font-size: 11px;">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_actividad->result() as $row_clave_actividad){?>
                     <option title="<?=$row_clave_actividad->descrip?>" value="<?=$row_clave_actividad->id_clave?>"><?=$row_clave_actividad->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
            
         </tr>
       <?php if(isset($idb)&& $idb !=NULL ){ echo form_hidden('idb',$idb);}?>
         <tr>
                 
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
        <?php if(isset($oculta_select)){
            echo $oculta_select;
            ?>
             $("input#fecha_constitucion").datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_constitucion').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true,yearRange: '-100:+0'}); 
   $( "input#fecha_constitucion" ).datepicker( "setDate", "<?php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){ echo $fecha_datepicker;}?>");
       
       <?php } ?>
        });
        $(document).ready(function() {
         $("select[name=anio_nacimiento_beneficiario]").change(function(){
            $("#fecha_constitucion").val($("select#anio_nacimiento_beneficiario").val()+$("select#mes_nacimiento_beneficiario").val()+$("select#dia_nacimiento_beneficiario").val()); 
     
    });
/*$( "input#fecha_nacimiento" ).datepicker({
                showOn: 'button',
                buttonImage: '<?//=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_nacimiento').datepicker('option', {dateFormat: 'yymmdd',yearRange: '-100:+0'}); 
$("input#fecha_constitucion").datepicker({
                showOn: 'button',
                buttonImage: '<?//=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_constitucion').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true,yearRange: '-100:+0'}); 
   $( "input#fecha_constitucion" ).datepicker( "setDate", "<?//php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){ echo $fecha_datepicker;}?>");
*/
});
 </script>  
<?php if (isset($nacionalidad) && $nacionalidad != NULL ){?>
    <script>
        $(document).ready(function(){
            $('#nacionalidad option[value= "<?php echo $nacionalidad;?>" ]').attr({'selected':'true'});
            $('#nacionalidad').prop('disabled','disabled');
            $('#clave_actividad option[value= "<?php echo $giro;?>" ]').attr({'selected':'true'});
            $('#clave_actividad').prop('disabled','disabled');
            
        });
        
    </script>
    <?php } ?>
    
    <?php if (isset($tipo_persona) && $tipo_persona != NULL ){?>
    <script>
        $(document).ready(function(){
            $('select#tipo_persona option[value= "<?php echo $tipo_persona;?>" ]').attr({'selected':'true'});
          
          
           
        });
        
    </script>
    <?php } ?>