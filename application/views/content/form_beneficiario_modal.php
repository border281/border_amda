 <?php //if(isset($beneficiario) && $beneficiario->num_rows() > 0){
            // foreach ($beneficiario->result() as $row_beneficiario){?>
 <!-- Modal -->
 <div class="modal-dialog" style="width: 800px">
      <form class="form-horizontal"  id="form_form_beneficiario" method="post" action="<?php echo base_url().'/index.php/beneficiario/save_beneficiario'; ?>">
        
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
            <div class="panel-heading">
                <h5 class="text-info">AGREGAR DATOS DE DUE&Nacute;O BENEFICIARIO :</h5>
            
            </div>
        </h4>
      </div>
          
      <div class="modal-body">
          
          <div style="margin:30px;"></div>
          <div class="form-group">
                   <select id='tipo_persona_beneficiario' class='tipo_persona_beneficiario form-control' name='tipo_persona_beneficiario'>
                    <option selected value=''>Selecciona un tipo de persona</option>
                    <option value='1'>Persona F&iacute;sica</option>
                    <option value='2'>Persona Moral</option>
                    <option value='3'>Fideicomiso</option>
                    
                </select>
                <div class="div_tipo_persona_beneficiario">
                    
                </div>
                      
              </select>
          </div>
          
      </div>
          </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
       </form> 
    </div><!-- /.modal-content -->
    <?php 
             // }
            //  }else{
              ?>
    <!-- 
 <div class="modal-dialog" style="width: 800px">
      <form class="form-horizontal"  id="form_form_beneficiario" method="post" action="<?php echo base_url().'/index.php/beneficiario/save_beneficiario'; ?>">
        
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
            <div class="panel-heading">
                <h5 class="text-info">AGREGAR DATOS DE DUE&Nacute;O BENEFICIARIO :</h5>
            
            </div>
        </h4>
      </div>
          
      <div class="modal-body">
          
          <div style="margin:30px;"></div>
          <div class="form-group">
                   <select id='tipo_persona_beneficiario' class='tipo_persona_beneficiario form-control' name='tipo_persona_beneficiario'>
                    <option selected value=''>Selecciona un tipo de persona</option>
                    <option value='1'>Persona Fisica</option>
                    <option value='2'>Persona Moral</option>
                    <option value='3'>Fideicomiso</option>
                    
                </select>
                <div class="div_tipo_persona_beneficiario">
                    
                </div>
                      
              </select>
          </div>
          
      </div>
          </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
       </form> 
    </div><!-- /.modal-content -->
              <?php //}?>
  <script>
      //*[@id="tipo_persona"]html body.modal-open div#wrapper div#form_beneficiario.modal div.modal-dialog form#form_form_beneficiario.form-horizontal div.modal-content div.modal-body div.form-group select#tipo_persona.tipo_persona
       $(document).ready(function() {
            $("select#tipo_persona_beneficiario.tipo_persona_beneficiario").change(function() {
                $("select#tipo_persona_beneficiario.tipo_persona_beneficiario option:selected").each(function(){
                    tipo_persona = $('#tipo_persona_beneficiario').val();
                    $.post("<?php echo base_url();?>index.php/beneficiario/tipo_persona", {
                        tipo_persona : tipo_persona
                        }, function(data) {
                            $(".div_tipo_persona_beneficiario").html(data);
                });
                
                });
        });
        });
   $(function(){
    $('#form_form_beneficiario').validate({
       rules : {
           mes_reportado :
                   {
                      
                  required :  true,
                  minlength : 6,
                  maxlength : 7,
                  number : true
                   },
          tipo_persona_beneficiario :
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
            tipo_persona_beneficiario :
                    {
                       required : "Selecciona el tipo de aviso a reportar" 
                    }
       }
    });
});     
 $(function(){
   // $('#fecha_nacimiento').datepicker();
});
    </script> 