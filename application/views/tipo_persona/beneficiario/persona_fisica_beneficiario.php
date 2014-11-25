<?php ?> 
<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Persona F&iacute;sica</th>
     <?=  form_hidden('id_aviso',$id_aviso)?>
     </thead>
     <tbody>
         <tr>
             <td>Nombre </td> 
             <td><?php echo form_input($nombre);?></td>
             <td>Fecha nacimiento</td>
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
                 <?php echo form_input($fecha_nacimiento_beneficiario);?>
             </td>
                 
             
         </tr>
         <tr>
             <td>Apellido paterno</td>
             <td><?php echo form_input($ap_paterno);?></td>
             <td>RFC</td>
             <td><?php echo form_input($rfc);?><label id="trfcb"></label></td>
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
                 <select id="nacionalidad" name="nacionalidad" class="form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
                 
             </td>
             <td>Pa&iacute;s nacimiento</td>
             <td>
                 <select id="pais_nacimiento" name="pais_nacimiento" class="form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
         </tr>
         <tr>
             <td>Actividad econ&oacute;mica</td>
             <td colspan="3">
                 <select id="actividad_economica" name="actividad_economica" class="form-control">
                     <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_actividad->result() as $row_clave_actividad){?>
                     <option value="<?=$row_clave_actividad->id_clave?>"><?=$row_clave_actividad->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
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
       <?php if(isset($oculta_select)){
            echo $oculta_select;
            ?>
             $("input#fecha_nacimiento_beneficiario").datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('input#fecha_nacimiento_beneficiario').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true,yearRange: '-100:+0'}); 
   $( "input#fecha_nacimiento_beneficiario" ).datepicker( "setDate", "<?php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){ echo $fecha_datepicker;}?>");
       
       <?php } ?>
            
    
    //$("select[name=dia_nacimiento_beneficiario]").change(function(){
            //alert($('select[name=color1]').val());
           // var dia_nacimiento_ben; 
           // dia_nacimiento_ben=$('input[name=dia_nacimiento_beneficiario]').val($(this).val());
       //$("#fecha_nacimiento_beneficiario").val($("select#dia_nacimiento_beneficiario").val()); 
    //});
    //$("select[name=mes_nacimiento_beneficiario]").change(function(){
         //   $("#fecha_nacimiento_beneficiario").val($(this).val() + "/"+ $("select#mes_nacimiento_beneficiario").val()); 
    //});
    $("select[name=anio_nacimiento_beneficiario]").change(function(){
            $("#fecha_nacimiento_beneficiario").val($("select#anio_nacimiento_beneficiario").val()+$("select#mes_nacimiento_beneficiario").val()+$("select#dia_nacimiento_beneficiario").val()); 
    });

/*ng.ready( function() {
    var my_cal = new ng.Calendar({
        input: 'fecha_nacimiento_beneficiario',            // the input field id
        start_date: 'last year',   // the start date (default is today)
        end_date: 'year + 5',      // the end date (related to start_date, 4 years from today)
        display_date: new Date()   // the display date (default is start_date)
    });
    
});*/
       /*$( "input#fecha_nacimiento_beneficiario" ).datepicker({
            showOn: 'button',
              buttonImage: '<?//=base_url()?>assets/images/cal.gif',
           buttonImageOnly: true
              });
  $('input#fecha_nacimiento_beneficiario').datepicker('option', {dateFormat: 'yymmdd',ChangeMonth:true,yearRange: '-100:+0'}); 
 $( "input#fecha_nacimiento_beneficiario" ).datepicker( "setDate", "<?//php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){echo $fecha_datepicker;}?>");
//$("input#fecha_nacimiento_beneficiario").datepicker({
  // changeMonth:true
//});
$("#ui-datepicker-div").css("z-index", "9999");  
//$("#ui-datepicker-div.ui-datepicker-month").css("z-index", "9999"); */ 
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
<?php if (isset($tipo_persona) && $tipo_persona != NULL ){?>
    <script>
        $(document).ready(function(){
            $('select#tipo_persona option[value= "<?php echo $tipo_persona;?>" ]').attr({'selected':'true'});
             //$('select#selecttipo_domicilio_beneficiario option[value= "" ]').attr({'selected':'true'});
          
           
        });
        
    </script>
    <?php } ?>