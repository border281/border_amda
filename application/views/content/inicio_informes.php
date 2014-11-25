
<style>
.datepicker{z-index:1151;}
</style>

<div id="page-wrapper">

        <div class="content-header">
            <h3 class="icon-head head-products"> Lista de informes</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" data-toggle="modal" data-target="#tipo_aviso">
                        <span> Crear nuevo informe</span>
                    </button>
                    
                    
                </p>
            </div>
        </div>
    <?php
            if($this->session->flashdata('valido') != ''){
            ?>
        <div class="status_box success">
            <h6></h6>
            <ul><li><?=$this->session->flashdata('valido')?></li></ul>
        </div>
    <?php } ?>
  
    <div class="middle-container">
        <div class="entry-edit">
            <div class="entry-edit-head">
                <h4 class="icon-head head-customer-view">Informes</h4>
            </div>
            <fieldset>
                <div class="highlight">
                    Para ver los avisos de un informe anterior selecciona uno en la siguiente lista :
                </div>
                
                <select class="dropdown_mes_aviso" style="margin: 20px 0"> 
                    <option value="" selected>Selecciona un informe</option>
                    <?php 
                   // print_r($mes_reportado);
                    foreach ($mes_reportado->result() as $row_mes){
                     ?> 
                    <option value="<?php echo $row_mes->mes_reportado;?>"><?php echo $row_mes->mes_reportado;?></option>
                    <?php }?>        
                </select>
                <table class="table table-striped tabla ">
                    <thead>
                        <tr>
                           <th class="column-check"><input class="check-all" type="checkbox" /></th>
                            
                            <th>Mes reportado</th>
                            <th>Modificar</th>
                            <th>Referencia aviso</th>
                            <th>Prioridad</th>
                            <th>Archivo XML</th>
                            <th>Fecha de modificaci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            if ($lista_avisos->num_rows() > 0)
                                {
                                foreach ($lista_avisos->result() as $rowavisos){
                                ?>
                                <tr>
                                    <td class="column-check"><input  name ='id_aviso' value="<?php echo $rowavisos->idaviso;?> " class="check-all" type="checkbox" /></td>  
                   
                    <td><?php echo $rowavisos->mes_reportado;?> </td>
                     <td>
                         <a class="editar" href="<?=base_url('index.php/datos_aviso/index/'.$rowavisos->idaviso)?>">
                             <i class="fa fa-edit" style="color:#ED7D33"></i> Modificar
                        </a>
                         
                     </td>
                  
                    <td><?php echo $rowavisos->referencia;?> </td>
                    <td><?php echo $rowavisos->prioridad;?> </td>
                    <td>
                        <a href="<?=  base_url('index.php/createxml/index/'.$rowavisos->idaviso)?>">
                            <i class="fa fa-file-text" style="color:#2C752C"></i> Crear Xml
                        </a>
                    </td>
                    
                    <td>
                        <?php 
                          //  echo "daos del ".$is_modific[$rowavisos->idaviso]->num_rows();
                                   foreach ($is_modific[$rowavisos->idaviso]->result() as $key){
                                     //   foreach($key->result() as $value){
                                         echo $key->fecha_modificacion;   
                                       }
                           // }?>
                    </td>
                    </tr>
                             <?php
                                
                                }
                                }else
                                    {
                             
                                    ?>
                      <tr>  
                    <td colspan="6">
                        <div class="avisos_vacio">
                            Aun no se han registrado avisos para este mes haga click en en bot&oacute;n crear nuevo informe.
                        </div>    
                        
                        </td>
                         </tr>
                                <?php
                                    
                                    }
                                ?>
                        
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
    
    <!-- Modal -->
<div class="modal fade" id="tipo_aviso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
     <!-- <form  name= "form_tipo_aviso" class="form-horizontal"  id="form_tipo_aviso" method="post" action="<?php //echo base_url().'index.php/distribuidor/nuevo_aviso'; ?>">-->
        
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
            <div class="panel-heading">
                <h5 class="text-info">INSTRUCCIONES :</h5>
                <p class="pmodal text-info"> A continuaci&oacute;n indica si deseas generar un informe sin operaciones (informe en ceros) o si deseas capturar los avisos correspondientes a las operaciones del periodo.</p>
            </div>
        </h4>
      </div>
          
      <div class="modal-body">
          <div class="form-group">
            <!--  <label class="text-muted" style="margin:0 50px;">Mes del aviso *</label>
                    <br>
                    <input class="mes_reportado" id="mes_reportado" type="text" placeholder="AAAAMM"  name="mes_reportado" style="margin:0 50px; z-index: 1050;">
                  -->  
          </div>
          <div style="margin:30px;"></div>
          <div class="form-group">
                    
              <div class="btn-group" style="margin : 0 0 10px 50px">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      Selecciona el tipo de reporte a realizar <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a style="width:280px" href="<?=base_url()."index.php/distribuidor/nuevo_aviso"?>">Aviso con Datos</a></li>
                      <li><a style="width:280px" href="<?=base_url()."index.php/distribuidor/aviso_ceros"?>">Informe en Ceros</a></li>
                    </ul>
                </div>
          </div>
           <?=form_hidden('token',$token)?>
      </div>
          </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <!--  <button type="submit" class="btn btn-primary">Continuar</button>-->
      </div>
       </form> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
 
$("#mes_reportado").focus();  


$(function(){
   // $('#form_tipo_aviso').validate({
      /* rules : {
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
                  }
           
       },
       messages :{
           mes_reportado :
                   {
                       required :  "Debe ingresar un mes a reportar",
                       minlength : "Debe tener el formato AAAAMM",
                       maxlength : "Debe tener el formato AAAAMM",
                       number : "El campo debe contener solo numeros"
                   },
            select_tipo_aviso :
                    {
                       required : "Selecciona el tipo de aviso a reportar" 
                    }
       }
    });*/
});
</script>   
<script type="text/javascript">
 
    
     $(function(){
         $('#mes_reportado').datepicker({
                showOn: 'button',
                buttonImage: '<?=base_url()?>assets/images/cal.gif',
                buttonImageOnly: true
                
         });
     $('input#mes_reportado').datepicker('option', {dateFormat: 'yymmdd'});     
      }); 
</script>
</div>