<div id="page-wrapper">
<?php
//echo "id = ".$id_usuario;
//echo "name =".$usuario;

?>
  
        <div class="content-header">
            <h3 class="icon-head head-products">Datos Generales aviso</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="save" class="scalable save" onclick="submitDatosAviso(),wait();" style="">
                        <span>Guardar y continuar</span>
                    </button>
                    <button type="button" id="addmodificatorio" class="scalable save" onclick="agergarmodificatorio();" style="">
                        <span>Agregar modificatorio</span>
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
                        <tr><th>Datos de identificacion de quien realiza la actividad vulnerable</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos_usuario->result() as $rowdatosuser){?>
                        <tr>
                    <div class="form-group">
                        <td>Nombre, denominacion o razon social :</td>
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
                    $att_form=array('name'=>'formDatosAviso');
                    echo form_open(base_url().'index.php/distribuidor/guardardatosaviso',$att_form);
                 ?>
               
                <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
                <div class="modificatorio">
                                    
                </div>  
                <table id="datosgeneralesaviso" class="table table-striped">
                     <thead>
                        <div class="highlight">
                            INSTRUCCIONES : Capture todos los datos que se soliciten. En caso de que el aviso sea modificatorio debera capturar el numero de folio asi como el motivo de modificacion 
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
                            <td>Prioridad del aviso</td>
                            <td>
                                <select class="form-control" name="prioridad_aviso">
                                    <option selected="selected" value="0">Selecciona una opcion</option>
                                    <option value="1">Normal</option>
                                    <option value="1">24 hrs</option>
                                </select>
                            </td>
                        </tr>   
                        <tr>
                            <td>
                               Selecciona el tipo de alerta 
                            </td>
                            <td>
                                <select onchange="alerta(this.value)" style="font-size:10px" name="tipo_alerta" class="form-control">
                                    <option  selected="selected" value="0">Seleccione un tipo alerta</option>
                                            <?php foreach ($alerta->result() as $row) {?>
                                            <option value="<?php echo $row->idalerta;?>"><?php echo $row->descripcion_alerta;?></option>
                                            <?php }?>
                                </select> 
                            </td>
                        </tr>
                        
                    </tbody>
                      <?=form_hidden('token',$token)?>
                     <?=form_input($mes_reportado)?>
                </table>
                 <?=form_close()?>   
            </fieldset>
        </div>
    
    <!-- Modal -->

</div><!-- /.modal -->
    
  

