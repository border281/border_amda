
<tbody>
   
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
