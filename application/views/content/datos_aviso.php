<div id="page-wrapper">
<?php
//echo "id = ".$id_usuario;
//echo "name =".$usuario;

?>
   <form id="form_datos_aviso" name="formDatosaviso" accept-charset="utf-8" method="post" action="<?=  base_url()?>/index.php/datos_aviso/UpdateAviso/" >
         
        <div class="content-header">
            <h3 class="icon-head head-products">Datos Generales aviso</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
               <p class="content-buttons form-buttons">
                    <button type="button" id="save" class="scalable save" onclick="updateDatosInforme(); wait();" style="">
                        <span>Actualizar Datos</span>
                    </button>
                    <?php if(isset($agregar_modificatorio)){echo $agregar_modificatorio;}?>
                    
                </p>
            </div>
        </div>
        <div class="middle-container">
             <?php
            if($this->session->flashdata('valido') != ''){
            ?>
        <div class="status_box success">
            <h6>&Eacute;xito</h6>
            <ul><li><?=$this->session->flashdata('valido')?></li></ul>
        </div>
    <?php }else{ ?>
            <div class="status_box"></div>
    <?php }?>
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Datos de identificaci&oacute;n de quien realiza la actividad vulnerable</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos_usuario->result() as $rowdatosuser){?>
                        <tr>
                    <div class="form-group">
                        <td>Nombre, denominaci&oacute;n o raz&oacute;n social :</td>
                        <td><input disabled="disabled" class="form-control" value="<?=$rowdatosuser->display_name;?>"></td>
                    </div>   
                    </tr>
                        <tr>
                            <td>
                               Clave de quien realiza la actividad vulnerable :
                            </td>
                            <td>
                                <input disabled="disabled" class="form-control" value="<?=$rowdatosuser->rfc;?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Clave de la actividad vulnerable :</td>
                            <td><input  disabled="disabled" class="form-control" value="VEH"></td>
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
                       
                            <tr><th colspan="7">Detalle de informe</th></tr> 
                        </div>
                    </thead>
                     <tbody>
                        <?php 
                        if(isset($folio_modificatorio) && $folio_modificatorio != NULL){
                         ?>   
                         <tr>
                             <td>Folio modificatorio</td>
                             <td><?=  form_input($folio_modificatorio)?></td>
                         </tr>
                         <tr>
                             <td>Descripci&oacute;n Modificatorio</td>
                             <td><?= form_input($desc_modificatorio)?></td>
                         </tr>
                         
                        <?php
                        
                        }
                        ?>
                         <tr>
                             <td>Mes reportado</td>
                             <td><?=form_input($mes_reportado)?></td>
                         </tr>
                         <tr>
                             <td>Referencia del aviso</td>
                             <td><?=  form_input($referencia)?></td>
                         </tr>
                         <tr>
                             <td>Prioridad</td>
                             <td>
                                 <select id="select_prioridad" class="requerido form-control" name="prioridad_aviso">
                                    <option value="">Selecciona una opcion</option>
                                    <option value="1">Normal</option>
                                    <option value="2">24 hrs</option>
                                </select>
                             </td>
                         </tr>
                         <tr>
                             <td>Tipo de alerta</td>
                             <td>
                                 <select   id="select_tipoalerta" style="font-size:10px" name="tipo_alerta" class="requerido form-control">
                                    <option  selected="selected" value="">Seleccione un tipo alerta</option>
                                            <?php foreach ($alerta->result() as $row) {?>
                                            <option value="<?php echo $row->idalerta;?>"><?php echo $row->descripcion_alerta;?></option>
                                            <?php }?>
                                </select> 
                             </td>
                         </tr>
                          <?php 
                             if(isset($descripcion_alerta) && $descripcion_alerta != NULL && $descripcion_alerta != "")
                                 {?>
                         <tr id="modificatorio">
                            <?php
                                 echo '<td>Descripcion de la alerta</td><td>'.form_textarea($descripcion_alerta).'</td>';
                                 
                                 ?>
                         </tr>
                         <?php
                             }else{
                          ?>
                         <tr id="modificatorio"></tr>
                                 <?php
                                 
                             }
                           ?>
                         
                    </tbody>
                      <?=  form_hidden('id_aviso',$id_aviso)?>
                </table>
              </form>    
            </fieldset>
        </div>
    
    <!-- Modal -->

</div><!-- /.modal -->

  
<script type="text/javascript">
 
 

/*
$(function(){
    $('#formDatosAviso').validate({
       rules : {
           mes_reportado :{required :true,minlength : 6,maxlength : 7,number : true},
        referencia_aviso :{required:true,maxlength:14},
         prioridad_aviso :{required:true},
             tipo_alerta :{required:true},
            descripcion_alerta:{required:true}
           },
       messages :{
           mes_reportado :{
                       required :  "Debe ingresar un mes a reportar",
                       minlength : "Debe tener el formato AAAAMM",
                       maxlength : "Debe tener el formato AAAAMM",
                       number : "El campo debe contener solo numeros"
                   },
        referencia_aviso :
                    {
                       required : "Ingresa una referencia para el aviso" ,
                       maxlength: "Maximo 14 caracteres",
                    },
         prioridad_aviso :{required:"La prioridad del aviso es requerida"},    
             tipo_alerta :{required:"El tipo de alerta es requierido"},
       descripcion_alerta:{required:"Ingrese una descripcion de alerta"}
            },   
       debug:true
    });
});*/
</script>  

<script>
 $(document).ready(function(){
     $( ".nav li" ).removeClass('active');   
    // $( ".nav li:nth-child(1)" ).addClass( "active" );
     $('select#select_prioridad option[value= "<?php echo $prioridad_value;?>" ]').attr({'selected':'true'});
     $('select#select_tipoalerta option[value= "<?php echo $tipo_alerta_value;?>" ]').attr({'selected':'true'});  
     $( "#select_tipoalerta" ).change(function() {
     
var valor=$("#select_tipoalerta option:selected").val();

    if(valor == "9999")
    {
        $("#modificatorio").append("<td>Descripcion de la alerta</td><td><textarea name='descripcion_alerta' class='requerido form-control' placeholder='Introduce una descripcion de la alerta' id='descripcion_alerta'></textarea></td>"); 
    
    }else
    {
        $("#modificatorio").empty(); 
    }
});
  });
     
</script>
<?php 
if(isset($folio_modificatorio) && $folio_modificatorio != NULL)
    {
    echo '<script>'.$input_disable.'</script>';
    echo '<script>'.$select_disable.'</script>';
    echo '<script>'.$button_disable.'</script>';                               
    }
?>