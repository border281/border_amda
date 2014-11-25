<tr>
    <td>Moneda</td>
    <td>
        <select id="select_moneda_oro" name="select_moneda" class="form-control">
            <option selected value="">Selecciona un tipo de moneda</option>
        <?php foreach ($select_moneda->result() as $row_moneda){?>
            <option value="<?=$row_moneda->id_clave?>"><?=$row_moneda->descrip?></option>
        <?php } ?>
        </select>
    </td>
</tr>

<script>
$(document).ready(function()
{
  $(".s_moneda").remove();  
});
</script>
