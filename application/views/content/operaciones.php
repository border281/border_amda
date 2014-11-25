<?php
$correcto = $this->session->flashdata('correcto');
    if ($correcto) 
    {
?>
       <span id="registroCorrecto"><?= $correcto ?></span>
<?php
  }
?>

<div id="page-wrapper">
                             
 <?php
     $att_form=array('name'=>'formDetalleOperaciones','id'=>'form_operacion');
      echo form_open(base_url().'index.php/operaciones/guardaroperacion',$att_form);
      ?>
  
        <div class="content-header">
            <h3 class="icon-head head-products">Detalles de la operaci&oacute;n</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="finalizar" class="scalable save" onclick="fin(<?=$id_aviso?>);" style="">
                        <span>Finalizar</span>
                    </button>
                    <button type="submit" id="save" class="scalable save" onclick="wait()" style="">
                        <span>Guardar y continuar</span>
                    </button>
                  
                    <button type="button" data-toggle='modal' data-target='#form_liquidacion' id="add_beneficiario" class="scalable add_beneficiario">
                        <span>Agregar Datos de liquidaci&oacute;n</span>
                    </button>
                    <!-- <button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>    -->
                    
                </p>
            </div>
        </div>
     <?php
   //  $att_form=array('name'=>'formDetalleOperaciones','id'=>'form_operacion');
     // echo form_open(base_url().'index.php/operaciones/guardaroperacion',$att_form);
      ?>
    <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
        <div class="middle-container">
            <div class="status_box"></div>
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <div class="highlight">
                    INSTRUCCIONES : Capture los datos de la operaci&oacute;n. 
                    
               </div>
                <table class="table table-striped table_amda">
                    <thead>
                    <th colspan="4">Detalles de la operaci&oacute;n</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fecha de operaci&oacute;n</td>
                            <td><?=form_input($fecha_operacion)?></td>
                            <td>C&oacute;digo Postal </td>
                            <td><?=form_input($cp_sucursal_operacion)?></td>
                            
                        </tr>
                        <tr>
                            
                            <td>Nombre de la Sucursal</td>
                            <td><?=form_input($nom_sucursal_operacion)?></td>
                            <td>Tipo de operaci&oacute;n</td>
                            <td>
                                <select id="tipo_operacion" name="tipo_operacion" class="requerido form-control">
                                    <option value=""<?php echo set_select('tipo_operacion', '0', TRUE); ?> selected>Selecciona un tipo de operaci&oacute;n</option>
                                    <?php foreach ($select_tipo_operacion->result() as $row_tipo_operacion){?>
                                    <option value="<?=$row_tipo_operacion->id_clave?>"<?php echo set_select('tipo_operacion',''.$row_tipo_operacion->id_clave.''); ?>><?=$row_tipo_operacion->descrip?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                      
                    </tbody>
                    <thead>
                    <th colspan="4">Datos del veh&iacute;culo</th>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>Marca veh&iacute;culo</td>
                            <td><?=form_input($marca_fabricante)?></td>
                            <td>Modelo</td>
                            <td><?=form_input($modelo)?></td>
                        </tr>
                        <tr>
                            <td>A&ntilde;o</td>
                            <td><?=form_input($anio)?></td>
                            <td>VIN</td>
                            <td><?=form_input($vin)?></td>
                            
                        </tr>
                        <tr>
                            <td>Repuve</td>
                            <td><?=form_input($repuve)?></td>
                            <td>Placas</td>
                            <td><?=form_input($placas)?></td>
                        </tr>
                        <tr>
                            
                            <td>Es veh&iacute;culo blindado</td>
                            



                            <td>
                                <input id="vehiculo_blindado_si" class="" type="radio" onclick="blindado_si()" name="vehiculo_blindado" value="si"<?php echo set_radio('vehiculo_blindado', 'si'); ?>>
                                <label>SI</label>
                            </td>
                            <td>
                                <input id="vehiculo_blindado_no" class="" type="radio" onclick="blindado_no()" name="vehiculo_blindado" value="no"<?php echo set_radio('vehiculo_blindado', 'no'); ?>>
                                <label>NO</label>
                            </td>
                            <td>
                                <div id="blindado">
                                    
                                </div>
                            </td>
                            
                        </tr>
                      
                    </tbody>
                </table>
                
                <?=form_hidden('id_aviso',$id_aviso)?>
                <?php if(isset($idoperacion) && $idoperacion != NULL){ echo form_hidden('id_operacion',$idoperacion);}?>
                
                <?=form_hidden('token',$token)?> 
                 
                    
            </fieldset>
        </div>
    <?php
    //echo $this->db->last_query();
   // print_r($liquidacion->result()); 
    if (isset($liquidacion)&& $liquidacion ->num_rows() > 0){
        $indice =1;
        ?>
  
        <div class="entry-edit">
            <div class="entry-edit-head">
                <h4 class="icon-head head-customer-view">Datos de Liquidaciones </h4>
            </div>
    </div>  
    <?php
        
        foreach ($liquidacion->result() as $row_liquidacion){
           
            ?>
    
 

    <div class="panel-heading" id="accordion">
        
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h4 class="panel-title" style="background-color:rgba(53, 127, 106,0.3)/*rgba(111, 137, 146,0.3)*/;padding: 5px;">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <i style="margin-right:10px" class="fa fa-angle-double-down" name="liquidacion<?=$row_liquidacion->iddatos_liquidacion;?> "></i> <b><i>Datos de liquidaci&oacute;n <?=$indice?> </i></b>
                        
                    </a>
                    <a class="editar" style=" font-size: 12px;margin-left:60%;margin-right:10px;color: #428BCA; text-decoration: underline;" href="http://amda.gsinlimites.com.mx/index.php/operaciones/editar_liquidacion/<?=$idoperacion?>/<?=$row_liquidacion->iddatos_liquidacion?>/<?=$indice?>">
                        <i class="fa fa-edit" style="color:#ED7D33"></i>
                            Modificar
                    </a>
                   <!-- <a class="editar" style="font-size: 12px; color: #428BCA; text-decoration: underline;" href="<?=base_url()?>index.php/operaciones/delete_liquidacion/<?=$idoperacion?>/<?=$row_liquidacion->iddatos_liquidacion?>/<?=$row_liquidacion->tipo_instrumento?>">
                        <i class="fa fa-times-circle" style="color:#ED7D33"></i>
                            Eliminar
                    </a>-->
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
        <table class="table table-striped table_amda">
            <thead>
                <tr>
                    <th colspan="4"> Detalles de liquidaci&oacute;n </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> Fecha de pago</td>
                    <td><input  disabled="true" class="form-control" type="text" value="<?=$row_liquidacion->fecha_pago?>"></td>
                </tr>
                <tr>
                    <td>Forma de pago</td>
                    <td><input disabled="true" class="form-control" type="text" value="<?=$row_liquidacion->forma_pago?>"></td>
                </tr>
                <tr>
                    <td>Moneda</td>
                    <td><input disabled="true" class="form-control" type="text" value="<?=$row_liquidacion->moneda?>"></td>
                </tr>
                <tr>
                    <td>Monto de la operaci&oacute;n</td>
                    <td><input disabled="true" class="form-control" type="text" value="<?=number_format($row_liquidacion->monto_operacion,2)?>"></td>
                </tr>
                <?php if ($row_liquidacion->instrumento != "" && $row_liquidacion->instrumento != NULL) {?>
                <tr>
                    <td colspan="4"><p class="instrumento"> Detalles instrumento de pago</p></td>
                </tr>
                <tr>
                    
                
            
             
                    <td>INSTRUMENTO DE PAGO </td>
                    <td><input disabled="true" class="form-control" type="text" value="<?=$row_liquidacion->instrumento?>"></td>
                </tr>
                <tr class="div_mostrar_instrumento<?=$row_liquidacion->iddatos_liquidacion;?>">
                     
                        
                   
                       
                </tr>    
                <?php } ?>
                <tr><td></td></tr>
                
            </tbody>
        </table>
                </div> 
                </div>
    </div>
</div>
    <?php
    $indice = $indice +1;
        }
    }
    
    
    
?>
           
    <?=  form_close()?>
    

</div><!-- /.modal -->

<div class="modal fade" id="form_liquidacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 </div>
<?php if(isset($actualizar_datos) && $actualizar_datos != NULL){?>
<script>
   
$(function(){
        $('#form_operacion').validate({
            rules:{
                  fecha_operacion:{required:true,minlength:8,maxlength:8},
                  cp_sucursal_operacion:{required:true,number:true,minlength:5,maxlength:5},
                  nom_sucursal_operacion:{required:true},
                  tipo_operacion:{required:true},
                  marca_fabricante:{required:true},
                  modelo:{required:true},
                  anio:{required:true,number:true,minlength:4,maxlength:4},
                  vin :{required:true,minlength:17,maxlength:17},
                  repuve:{minlength:8,maxlength:8},
                  placas:{maxlength:12}
                  
                  },
         messages :{
             fecha_operacion :{required:"Se requiere fecha de la operacion",minlength:"Minimo 8 caracteres",maxlength:"Maximo 8 caracteres"},
              cp_sucursal_operacion:{required:"Se requiere codigo postal",number:"Solo se aceptan numeros",minlength:"Minimo 5 caracteres",maxlength:"Maximo 5 caracteres"},
             nom_sucursal_operacion:{required:"Se requiere el nombre de la sucursal donde se efectuo la operacion"},
                     tipo_operacion:{required:"Se requiere un tipo de operacion"},
                   marca_fabricante:{required:"Se requiere marca de fabricante"},
                             modelo:{required:"Se requiere modelo"},
                               anio:{required:"Se requiere año en formato AAAA",number:"Ingresa un anio valido",minlength:"Formato AAA",maxlength:"Formato AAA"},
                               vin :{required:"Ingrese 17 dígitos",minlength:"Minimo 17 caracteres",maxlength:"Maximo 17 caracteres"},
                             repuve:{minlength:"Minimo 8 caracteres",maxlength:"Maximo 8 caracteres"},
                             placas:{maxlength:"Maximo 12 caracteres"}
         },
          submitHandler: function (form) {
            $.ajax({
      url: "http://amda.gsinlimites.com.mx/index.php/operaciones/actualizar_datos/",//action del formulario, ej:
      type: "POST",//el método post o get del formulario
      data: $("#form_operacion").serialize(),//obtenemos todos los datos del formulario
      complete: function(objeto, exito){
           // alert("Me acabo de completar");
            if(exito=="success"){
             // alert( "Se guardaron los datos: " + exito);  
             $(".status_box").empty().addClass('success').html("Los datos de han actualizado correctamente")
            }else{alert("El sistema encontro un error, verifica tus datos e intentalo de nuevo");}
        },
      success: function(data){
        alert("Datos actualizados correctamente");
      },
      error : function(data)
      {
          alert("Error : verifica los datos y vuelve a intentarlo mas tarde.");
      }
       
      
   }); 
   return false;
         }
        });
    });
</script>
<?php } else {?>
<script>
   
$(function(){
        $('#form_operacion').validate({
            rules:{
                  fecha_operacion:{required:true,minlength:8,maxlength:8},
                  cp_sucursal_operacion:{required:true,number:true,minlength:5,maxlength:5},
                  nom_sucursal_operacion:{required:true},
                  tipo_operacion:{required:true},
                  marca_fabricante:{required:true},
                  modelo:{required:true},
                  anio:{required:true,number:true,minlength:4,maxlength:4},
                  vin :{required:true,minlength:17,maxlength:17},
                  repuve:{minlength:8,maxlength:8},
                  placas:{maxlength:12}
                  
                  },
         messages :{
             fecha_operacion :{required:"Se requiere fecha de la operacion",minlength:"Minimo 8 caracteres",maxlength:"Maximo 8 caracteres"},
              cp_sucursal_operacion:{required:"Se requiere codigo postal",number:"Solo se aceptan numeros",minlength:"Minimo 5 caracteres",maxlength:"Maximo 5 caracteres"},
             nom_sucursal_operacion:{required:"Se requiere el nombre de la sucursal donde se efectuo la operacion"},
                     tipo_operacion:{required:"Se requiere un tipo de operacion"},
                   marca_fabricante:{required:"Se requiere marca de fabricante"},
                             modelo:{required:"Se requiere modelo"},
                               anio:{required:"Se requiere año en formato AAAA",number:"Ingresa un anio valido",minlength:"Formato AAA",maxlength:"Formato AAA"},
                               vin :{required:"Ingrese 17 dígitos",minlength:"Minimo 17 caracteres",maxlength:"Maximo 17 caracteres"},
                             repuve:{minlength:"Minimo 8 caracteres",maxlength:"Maximo 8 caracteres"},
                             placas:{maxlength:"Maximo 12 caracteres"}
         }
        });
    });
</script>
<?php }?>
<script>
$(document).ready(function(){
   <?=$cargar_modal;?> 
           
});
</script>
<?php if (isset($idoperacion) && $idoperacion != NULL){?>

<script>
    $(document).ready(function () {
       
    $('#operacion<?=$idoperacion?>').addClass('activo');
    //alert (sei);
         //$('ul.nav li:nth-child()').addClass('active');
    $('.add_beneficiario').attr('onclick','addliquidacion()'); 
    
      <?php 

if(isset($actualizar_datos) && $actualizar_datos != NULL){
    echo $actualizar_datos;
    
}
?>
});
</script>
<?php }?>
<script>


 
 $(function(){
  $('.block').hide();
   $('.accordion h4.panel-title').on('click',function(){
    if($(this).next().is(':visible')){
       $(this).next().slideUp();
    }
     if($(this).next().is(':hidden')){
       $('.accordion h4.panel-title').next().slideUp();
       $(this).next().slideDown();
    }
   });
 }) 
 $(function(){
    $('#fecha_operacion').datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                });
  $('#fecha_operacion').datepicker('option', {dateFormat: 'yymmdd',changeMonth: true,changeYear: true}); 
 $( "#fecha_operacion" ).datepicker( "setDate", "<?php if(isset($fecha_datepicker) && $fecha_datepicker != NULL){ echo $fecha_datepicker;}?>");
 });
</script>
<?php if (isset($blindaje) && $blindaje > 0 ){?>

<script>
    $(document).ready(function(){
          
    $("#vehiculo_blindado_si").prop("checked","checked")
    $("#vehiculo_blindado_si").prop("disabled","disabled")
    $("#vehiculo_blindado_no").prop("disabled","disabled")
    
    
     blindado_si();
     $('select#nivel_blindaje option[value= "<?=$blindaje;?>" ]').attr({'selected':'true'});
     $('select#nivel_blindaje').prop('disabled','disabled');
          
});
</script>
<?php }?>
<?php if(isset($blindaje) && $blindaje == 0) {?>
   
<script>
     $(document).ready(function(){
          
    $("#vehiculo_blindado_no").prop("checked","checked")
   $("#vehiculo_blindado_no").prop("disabled","disabled")
   
    });
    </script>
<?php } ?>
    <?php if (!isset($blindaje)){?>
    <script>
    $(document).ready(function(){
          
    $("#vehiculo_blindado_si").prop("checked","")
    $("#vehiculo_blindado_no").prop("checked","")
         
});
</script>
    <?php }?>
    
 <?php if (isset($tipo_operacion) && $tipo_operacion != NULL ){?>
    <script>
        $(document).ready(function(){
            $('#tipo_operacion option[value= "<?php echo $tipo_operacion;?>" ]').attr({'selected':'true'});
           // $('#tipo_operacion').prop('disabled','disabled');
           
        });
        
    </script>
    <?php } ?>

