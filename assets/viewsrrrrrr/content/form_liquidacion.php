
 <!-- Modal -->
 <div class="modal-dialog" style="width: 800px">
      <form class="form-horizontal"  id="form_form_liquidacion" method="post" action="<?php echo base_url().'/index.php/operaciones/save_liquidacion/'.$this->session->userdata('datos_operacion'); ?>">
        
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">
            <div class="panel-heading">
                <h5 class="text-info">AGREGAR DATOS DE LIQUIDACION :</h5>
            
            </div>
        </h4>
      </div>
          
      <div class="modal-body">
          <?=  form_hidden('datos_operacion',$this->session->userdata('datos_operacion'))?>
         <?php //print_r($this->session->all_userdata()) ?>
          <div style="margin:30px;"></div>
          <div class="form-group">
              <table class="table table-striped">
                  <tbody>
                      <tr>
                          <td>Fecha de pago :</td>
                          <td><?=  form_input($fecha_pago)?></td>
                      </tr>
                      <tr>
                          <td>Forma de pago :</td>
                          <td>
                              <select id="select_forma_pago" name="select_forma_pago" class="form-control">
                                  <option value="" selected>Selecciona una Forma de pago</option>
                                  <?php foreach ($forma_pago->result() as $row_pago){?>
                                  <option value="<?=$row_pago->id_clave?>"><?=$row_pago->descrip?></option>
                                  <?php }?>
                              </select>
                          </td>
                      </tr>
                      
                  </tbody>
              </table>
                   
                <div class="div_tipo_instrumento">
                    
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
  <script>
     //html body div#wrapper div#page-wrapper form div.middle-container fieldset div#form_liquidacion.modal div.modal-dialog form#form_form_liquidacion.form-horizontal div.modal-content div.modal-body div.form-group table.table tbody tr td select#select_forma_pago.form-control 
      //*[@id="tipo_persona"]html body.modal-open div#wrapper div#form_beneficiario.modal div.modal-dialog form#form_form_beneficiario.form-horizontal div.modal-content div.modal-body div.form-group select#tipo_persona.tipo_persona
       $(document).ready(function() {
            $("select#select_forma_pago.form-control ").change(function() {
                $("select#select_forma_pago.form-control  option:selected").each(function(){
                    forma_pago = $('#select_forma_pago').val();
                    $.post("<?php echo base_url();?>index.php/operaciones/forma_pago", {
                        forma_pago : forma_pago
                        }, function(data) {
                            $(".div_tipo_instrumento").html(data);
                });
                
                });
        });
        });
   $(function(){
    $('#form_form_liquidacion').validate({
       rules : {
           fecha_pago :
                   {
                      
                  required :  true,
                  minlength :8,
                  maxlength :8,
                 
                   },
          select_forma_pago :
                  {
                      required:true
                  },
          select_instrumento :
                  {
                      required:true
                  }        
           
       },
       messages :{
           fecha_pago :
                   {
                       required :  "Debe ingresar una fecha de pago",
                       minlength : "Debe tener el formato AAAAMMDD",
                       maxlength : "Debe tener el formato AAAAMMDD",
                       number : "El campo debe contener solo numeros"
                   },
            select_forma_pago :
                    {
                       required : "" 
                    },
            select_instrumento :
                    {
                        required :""
                    }        
       }
    });
}); 
$(function(){
    $('#fecha_pago').datepicker();
});
    </script> 