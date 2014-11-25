<?php
if(isset($instrumento)){
?>
<tbody>
<tr>
    <td>Instrumento de Pago :</td>
    <td>
        <select id="select_instrumento" name="select_instrumento" class="select_instrumento form-control">
            <option selected value="">Selecciona una opci&oacute;n</option>
    <?php foreach ($instrumento->result() as $row_instrumento) {?>
    <option value="<?=$row_instrumento->id_clave?>"><?=$row_instrumento->descrip?></option>
<?php } ?>
</select>
        </td>
</tr>
<?php } ?>
<th>
<tr id="instrumentopago" class="instrumentopago">
    
<th>
        
<tr class="s_moneda">
    <td>Moneda :</td>
    <td>
        <select id="select_moneda" name="select_moneda" class="form-control">
            <option selected value="">Selecciona un tipo de moneda</option>
        <?php foreach ($select_moneda->result() as $row_moneda){?>
            <option value="<?=$row_moneda->id_clave?>"><?=$row_moneda->descrip?></option>
        <?php } ?>
        </select>
    </td>
</tr>
<tr>
    <td>Monto :</td>  
    <td><?=form_input($monto)?></td>
</tr>
</tbody>
<script>
     //html body div#wrapper div#page-wrapper form div.middle-container fieldset div#form_liquidacion.modal div.modal-dialog form#form_form_liquidacion.form-horizontal div.modal-content div.modal-body div.form-group table.table tbody tr td select#select_forma_pago.form-control 
      //*[@id="tipo_persona"]html body.modal-open div#wrapper div#form_beneficiario.modal div.modal-dialog form#form_form_beneficiario.form-horizontal div.modal-content div.modal-body div.form-group select#tipo_persona.tipo_persona
      //html body.modal-open div#wrapper div#page-wrapper form div.middle-container fieldset div#form_liquidacion.modal div.modal-dialog form#form_form_liquidacion.form-horizontal div.modal-content div.modal-body div.form-group div.div_tipo_instrumento tr td select#select_instrumento.select_instrumento
       $(document).ready(function() {
            $("select#select_instrumento.select_instrumento ").change(function() {
                $("select#select_instrumento.select_instrumento  option:selected").each(function(){
                    instrumento = $('#select_instrumento').val();
                    $.post("<?php echo base_url();?>index.php/operaciones/instrumento", {
                        instrumento : instrumento
                        }, function(data) {
                            $(".instrumentopago").html(data);
                });
                
                });
        });
        });
   
    </script> 