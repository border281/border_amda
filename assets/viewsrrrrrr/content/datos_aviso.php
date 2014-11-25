<div id="page-wrapper">
<?php
//echo "id = ".$id_usuario;
//echo "name =".$usuario;

?>
  
        <div class="content-header">
            <h3 class="icon-head head-products">Datos Generales aviso</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
               
            </div>
        </div>
        <div class="middle-container">
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Datos de identificacion de quien realiza la actividad vulnerable</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos_usuario->result() as $rowdatosuser){?>
                        <tr>
                    <div class="form-group">
                        <td>Nombre, denominacion o razon social :</td>
                        <td><?=$rowdatosuser->display_name;?></td>
                    </div>   
                    </tr>
                        <tr>
                            <td>
                               Clave de quien realiza la actividad vulnerable :
                            </td>
                            <td>
                               <?=$rowdatosuser->rfc;?> 
                            </td>
                        </tr>
                        <tr>
                            <td>Clave de la actividad vulnerable :</td>
                            <td>VEH</td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <div class="middle-container">
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"></h4>
                </div>

            </div>
                <table id="datosgeneralesaviso" class="table table-bordered">
                     <thead>
                       
                            <tr><th colspan="7">Datos del aviso a reportar</th></tr> 
                        </div>
                    </thead>
                    <thead>
                        <tr>
                            <th>No. Aviso</th>
                            <th>Mes reportado</th>
                            <th>Referencia aviso</th>
                            <th>Prioridad</th>
                            <th>Descripcion alerta</th>
                            <th>Persona aviso</th>
                            <th>Dettalles operaci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                             <td> null</td>
                             <td> null</td>
                             <td> null</td>
                             <td> null</td>
                              <td> null</td>
                             <td>Completo<span> Ver detalles</span> </td>
                             <td>Incompleto<span> Ver detalles</span> </td>
                        </tr>
                        
                    </tbody>
                      <?//=form_hidden('token',$token)?>
                     <?//=form_input($mes_reportado)?>
                </table>
                  
            </fieldset>
        </div>
    
    <!-- Modal -->

</div><!-- /.modal -->
    
  


<script>
 $(document).ready(function(){
     $( ".nav li" ).removeClass('active');   
      $( ".nav li:nth-child(1)" ).addClass( "active" );
  });
     
</script>
