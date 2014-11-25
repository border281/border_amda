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
                             

  
        <div class="content-header">
            <h3 class="icon-head head-products">Detalles de la operaci&oacute;n</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="finalizar" class="scalable save" onclick="finalizar();" style="">
                        <span>Finalizar</span>
                    </button>
                    <button type="button" id="save" class="scalable save" onclick="submitformDetalleOperaciones();" style="">
                        <span>Guardar y continuar</span>
                    </button>
                  
                    <button type="button" id="add_beneficiario" class="scalable add_beneficiario" onclick="addliquidacionAffter();">
                        <span>Agregar Datos de liquidacion</span>
                    </button>
                         
                    
                </p>
            </div>
        </div>
     <?php
     $att_form=array('name'=>'formDetalleOperaciones');
      echo form_open(base_url().'index.php/operaciones/guardaroperacion',$att_form);
      ?>
    <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
        <div class="middle-container">
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <div class="highlight">
               INSTRUCCIONES : Capture los datos de la operacion. 
               </div>
                <table class="table table-striped table_amda">
                    <thead>
                    <th colspan="4">Detalles de la operaci&oacute;n</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fecha de operaci&oacute;n</td>
                            <td><?=form_input($fecha_operacion)?></td>
                            <td>Codigo Postal </td>
                            <td><?=form_input($cp_sucursal_operacion)?></td>
                            
                        </tr>
                        <tr>
                            
                            <td>Nombre de la Sucursal</td>
                            <td><?=form_input($nom_sucursal_operacion)?></td>
                            <td>Tipo de operaci&oacute;n</td>
                            <td>
                                <select id="tipo_operacion" name="tipo_operacion" class="form-control">
                                    <option value="0" selected>Selecciona un tipo de operaci&oacute;n</option>
                                    <?php foreach ($select_tipo_operacion->result() as $row_tipo_operacion){?>
                                    <option value="<?=$row_tipo_operacion->id_clave?>"><?=$row_tipo_operacion->descrip?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                      
                    </tbody>
                    <thead>
                    <th colspan="4">Datos del vehiculo</th>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>Marca Vehiculo</td>
                            <td><?=form_input($marca_fabricante)?></td>
                            <td>Modelo</td>
                            <td><?=form_input($modelo)?></td>
                        </tr>
                        <tr>
                            <td>A&ntilde;o</td>
                            <td><?=form_input($anio)?></td>
                            <td>Vin</td>
                            <td><?=form_input($vin)?></td>
                            
                        </tr>
                        <tr>
                            <td>Repuve</td>
                            <td><?=form_input($repuve)?></td>
                            <td>Placas</td>
                            <td><?=form_input($placas)?></td>
                        </tr>
                        <tr>
                            
                            <td>Es vehiculo blindado</td>
                            



                            <td>
                                <input id="vehiculo_blindado_si" class="" type="radio" onclick="blindado_si()" name="vehiculo_blindado" value="si">
                                <label>SI</label>
                            </td>
                            <td>
                                <input id="vehiculo_blindado_no" class="" type="radio" onclick="blindado_no()" name="vehiculo_blindado" value="si">
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
                <?=form_hidden('token',$token)?> 
                 
                    
            </fieldset>
        </div>
    <?php
    if (isset($liquidaciones)&& $liquidaciones ->num_rows() > 0){
        ?>
  
        <div class="entry-edit">
            <div class="entry-edit-head">
                <h4 class="icon-head head-customer-view">Liquidaciones <?=$idoperacion?></h4>
            </div>
    </div>  
    <?php
        foreach ($liquidaciones->result() as $row_liquidacion){
            ?>
    
 

    <div class="panel-heading" id="accordion">
        
        <div class="panel panel-default"> 
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Datos liquidacion <?=$row_liquidacion->iddatos_liquidacion;?> 
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
        <table class="table table-striped table_amda">
            <thead>
                <tr>
                    <th colspan="4"> Detalles de liquidaci&oacute;n</th>
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
                    <td>Instrumento</td>
                    <td><?=$row_liquidacion->instrumento?></td>
                </tr>
               <tr>
                 
                <?php
                               if(isset($instrumento) && $instrumento != NULL )
                        {
                                   foreach ($instrumento as $key => $value) 
                                       {
                                       
                                            $existid=  strrpos($key,'id');
                                          //  echo $key."<br>".$existid."<br>";
                                            if($existid === FALSE){
                                                echo "<td>".strtoupper($key)."</td><td colspan = '3'> "."<input class='form-control' type='text' value='".  strtoupper($value)."'></td>";
                                            }  
                                        }
                                   //$instrumento = "";     
                        } 
                        $instrumento = "";
                ?>
                       
                </tr>    
                <tr>
                    <td>Monto de la operacion</td>
                    <td><input disabled="true" class="form-control" type="text" value="<?=$row_liquidacion->monto_operacion?>"></td>
                </tr>
                
            </tbody>
        </table>
                </div> 
                </div>
    </div>
</div>
    <?php
        }
    }
?>
           
    <?=  form_close()?>
    

</div><!-- /.modal -->

<div class="modal fade" id="form_liquidacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 </div>
<?php if (isset($idoperacion) && $idoperacion != NULL){?>

<script>
    $(document).ready(function () {
    $('#<?=$idoperacion?>').addClass('active');
    //alert (sei);
         //$('ul.nav li:nth-child()').addClass('active');
    $('.add_beneficiario').attr('onclick','addliquidacion()');     
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
    $('#fecha_operacion').datepicker(); 
 });
</script>
<?php if (isset($blindaje) && $blindaje != 0 && $blindaje != NULL){?>

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
<?php } ?>
