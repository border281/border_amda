<?php if (isset($datos_instrumento) && $datos_instrumento->num_rows() > 0)
    {
     foreach ($datos_instrumento->result() as $row_instrumento)
         {
         ?>
<table>
<tr class="instrumeto-tarjeta">
    
    <td>Numero de tarjeta</td>
    <td ><input disabled="true" type="text" class="form-control" value="<?=$row_instrumento->numero_tarjeta?>"></td>
</tr>
</table>      
         <?php
         }
    }
    ?>
    