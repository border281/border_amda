<div id="page-wrapper">
   

  
        <div class="content-header">
            <h3 class="icon-head head-products">Datos Generales Dueño Beneficiario</h3>
            <div class="content-buttons-placeholder"style="width: 0px; height: 15px;">
                <p class="content-buttons form-buttons">
                    <button type="button" id="save" class="scalable save" onclick="submitformDatospersona();" style="">
                        <span>actualizar datos</span>
                    </button>
                    <button type="button" id="add_beneficiario" class="scalable add_beneficiario" onclick="addbeneficiario();">
                        <span>Agregar Dueno Beneficiario</span>
                    </button>
                    
                </p>
            </div>
        </div>
     <?php
     $att_form=array('name'=>'formDatospersona');
      echo form_open(base_url().'index.php/beneficiario/guardarbeneficiario',$att_form);
      ?>
    <?=validation_errors('<div class="status_box warning"><h6>Advertencia</h6><ul><li>','</li></ul></div>'); ?>
        <div class="middle-container">
             <?php
            if($this->session->flashdata('valido') != ''){
            ?>
        <div class="status_box success">
            <h6>Exito</h6>
            <ul><li><?=$this->session->flashdata('valido')?></li></ul>
        </div>
    <?php } ?>
            <div class="entry-edit">
                <div class="entry-edit-head">
                    <h4 class="icon-head head-customer-view"><?php echo $subtitle;?></h4>
                </div>

            </div>
            <fieldset>
                <div class="highlight">
               INSTRUCCIONES : Capture los datos del dueño beneficiario. 
               </div>
                <br>
                <label>Tipo de persona</label>
                <br>
                <select id='tipo_persona' class='tipo_persona form-control' name='tipo_persona'>
                    <option selected value='0'>Selecciona un tipo de persona</option>
                    <option value='1'>Persona Fisica</option>
                    <option value='2'>Persona Moral</option>
                    <option value='3'>Fideicomiso</option>
                    
                </select>
                <div class="div_tipo_persona_beneficiario">
                    
                </div>
                <?=form_hidden('id_aviso',$id_aviso)?>
            </fieldset>
        </div>
    
    <?=  form_close()?>
    

</div><!-- /.modal -->


           
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
  });
     
</script>


