<div id="page-wrapper">
<?php
//echo "id = ".$id_usuario;
//echo "name =".$usuario;

?>
  
        <div class="content-header">
            <h3 class="icon-head head-products">Datos Generales aviso</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="save" class="scalable save" onclick="submitDatosAvisoceros(),wait();" style="">
                        <span>Guardar y Finalizar</span>
                    </button>
                   
                    
                </p>
            </div>
        </div>
        <div class="middle-container">
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <table class="table table-striped">
                    <thead>
                        <tr><th>Datos de identificaci&oacute;n de quien realiza la actividad vulnerable</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos_usuario->result() as $rowdatosuser){?>
                        <tr>
                    <div class="form-group">
                        <td>Nombre, denominaci&oacute;n o raz&oacute;n social :</td>
                        <td><input disabled class="form-control" type="text" placeholder="<?=$rowdatosuser->display_name;?>"></td>
                    </div>   
                    </tr>
                        <tr>
                            <td>
                               Clave de quien realiza la actividad vulnerable :
                            </td>
                            <td>
                               <input disabled class="form-control" type="text" placeholder="<?=$rowdatosuser->rfc;?>"> 
                            </td>
                        </tr>
                        <tr>
                            <td>Clave de la actividad vulnerable :</td>
                            <td><input disabled class="form-control" type="text" placeholder="VEH"> </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <?php
                    $att_form=array('name'=>'formDatosAvisoceros');
                    echo form_open(base_url().'index.php/distribuidor/guardardatosavisoceros',$att_form);
                 ?>
               
                <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
                <div class="modificatorio">
                                    
                </div>  
                <table id="datosgeneralesaviso" class="table table-striped">
                     <thead>
                        <div class="highlight">
                            INSTRUCCIONES : Capture todos los datos que se soliciten. En caso de que el aviso sea modificatorio deber&aacute; capturar el numero de folio as&iacute; como el motivo de modificaci&oacute;n 
                        </div>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>Referencia del aviso :</td>
                            <td>
                              
                                <input class="form-control" name="referencia_aviso"  value="<?php echo set_value("referencia_aviso"); ?>" type="text" placeholder="Referencia del aviso">
                            </td>
                        </tr>
                        <tr>
                            <td>Mes a Reportar</td>
                            <td> <?=form_input($mes_reportado)?></td>
                        </tr>
                        <tr>
                            <td style="visibility: hidden">Prioridad del aviso</td>
                            <td>
                                <select style="visibility: hidden" class="form-control" name="prioridad_aviso">
                                    <option selected="selected" value="1">Selecciona una opcion</option>
                                    <option value="1">Normal</option>
                                    <option value="1">24 hrs</option>
                                </select>
                            </td>
                        </tr>   
                        <tr>
                            <td style="visibility: hidden">
                               Selecciona el tipo de alerta 
                            </td>
                            <td>
                                <select style="visibility: hidden" onchange="alerta(this.value)" style="font-size:10px" name="tipo_alerta" class="form-control">
                                    <option  selected="selected" value="1">Seleccione un tipo alerta</option>
                                            <?php foreach ($alerta->result() as $row) {?>
                                            <option value="<?php echo $row->idalerta;?>"><?php echo $row->descripcion_alerta;?></option>
                                            <?php }?>
                                </select> 
                            </td>
                        </tr>
                        
                    </tbody>
                      <?=form_hidden('token',$token)?>
                    
                </table>
                 <?=form_close()?>   
            </fieldset>
        </div>
    
    <!-- Modal -->

</div><!-- /.modal -->
   <script type="text/javascript">
 
$("#mes_reportado").focus();  
$("#mes_reportado").focusin(function (e) {
   $(this).val($(this).val().replace(' ',''));
});

$(function(){
    $('#form_tipo_aviso').validate({
       rules : {
           mes_reportado :
                   {
                      
                  required :  true,
                  minlength : 6,
                  maxlength : 7,
                  number : true
                   },
                   
          select_tipo_aviso :
                  {
                      required:true
                  },
           referencia_aviso :{required:true,minlength:1,maxlength:14}
           
       },
       messages :{
           mes_reportado :
                   {
                       required :  "Debe ingresar un mes a reportar",
                       minlength : "Debe tener el formato AAAAMM",
                       maxlength : "Debe tener el formato AAAAMM",
                       number : "El campo debe contener solo numeros"
                   },
                    referencia_aviso :
                    {
                       required : "Ingresa una referencia para el aviso" ,
                       minlength : "Minimo 1 caracter",
                       maxlength: "Maximo 14 caracteres",
                    },
            select_tipo_aviso :
                    {
                       required : "Selecciona el tipo de aviso a reportar" 
                    }
       }
    });
});
</script>   
<script type="text/javascript">
 
    
     $(function(){
         $('#mes_reportado').datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                              
         });
          $('input#mes_reportado').datepicker('option', {dateFormat: 'yymm',changeMonth: true,changeYear: true});     
          }); 
</script>

 
  

