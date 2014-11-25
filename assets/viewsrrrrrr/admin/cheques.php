<?php
if(isset($numero_cuenta)){
?>

<tr><td>Institucion</td>

    <td><?=form_input($institucion_credito);?></td></tr>
<tr><td>Numero Cuenta</td>
    <td><?=form_input($numero_cuenta);?></td></tr>
<tr><td>Numero Cheque</td>
    <td><?=form_input($numero_cheque);?></td></tr>

<?php
}else{
?>
<tr><td>Institucion</td>
<td><?=form_input($institucion_credito);?></td></tr>
<tr><td>Numero Cheque</td>
    <td><?=form_input($numero_cheque);?></td></tr>
    <?php }

