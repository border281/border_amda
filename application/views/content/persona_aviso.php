<div id="page-wrapper">
   

  
        <div class="content-header">
            <h3 class="icon-head head-products">Datos Generales persona aviso</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="save" class="scalable save" onclick="submitformDatospersona(); wait();" style="">
                        <span id="save_persona">Guardar y continuar</span>
                    </button>
                   <!--<input id="submit_persona_aviso" type="submit" value ="guardar y continuar">-->
                    <button type="button" id="add_beneficiario" class="scalable add_beneficiario" onclick="addbeneficiario();">
                        <span>Agregar Due&ntilde;o Beneficiario</span>
                    </button>
                    
                </p>
            </div>
        </div>
     <?php
    // $att_form=array('name'=>'formDatospersona','id'=>'form_persona_aviso');
      //echo form_open(base_url().'index.php/persona_aviso/guardardatospersona',$att_form);
      ?>
    <form id="form_persona_aviso" name="formDatospersona" accept-charset="utf-8" method="post" action="http://amda.gsinlimites.com.mx/index.php/persona_aviso/guardardatospersona" >
    <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
        <div class="middle-container">
             <?php
            if($this->session->flashdata('valido') != ''){
            ?>
        <div class="status_box success">
            <h6>Exito</h6>
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
                <div class="highlight">
                    INSTRUCCIONES : Capture los datos del cliente o usuario con quien haya celebrado la operaci&oacute;n. 
               </div>
                <br>
                <label>Tipo de persona</label>
                <br>
                <select id='tipo_persona' class='requerido tipo_persona form-control' name='tipo_persona'>
                    <option selected value=''>Selecciona un tipo de persona</option>
                    <option value='1'>Persona F&iacute;sica</option>
                    <option value='2'>Persona Moral</option>
                    <option value='3'>Fideicomiso</option>
                    
                </select>
                <div class="div_tipo_persona">
                    
                </div>
                <?=form_hidden('id_aviso',$id_aviso)?>
            </fieldset>
        </div>
    </form>
  
    

</div><!-- /.modal -->


<div class="modal fade" id="form_beneficiario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    
</div>
             
<script>
       $(document).ready(function() {
            $("select#tipo_persona.tipo_persona").change(function() {
                $("select#tipo_persona.tipo_persona option:selected").each(function(){
                    tipo_persona = $('#tipo_persona').val();
                    $.post("<?php echo base_url();?>index.php/persona_aviso/tipo_persona", {
                        tipo_persona : tipo_persona
                        }, function(data) {
                            $(".div_tipo_persona").html(data);
                           
                });
                
                });
        });
        
        });
    </script>    
<script>
 $(document).ready(function(){
     $( ".nav li" ).removeClass('active');   
      $( ".nav li:nth-child(2)" ).addClass( "active" );
      $('form#form_persona_aviso').validate({
           rules :{
                tipo_persona : {
                    required : true //para validar campo vacio
                   
                }
            }
      });
  });
     
</script>

