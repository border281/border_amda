<?php
if(isset($numero_cuenta)){
?>

<tr><td>Instituci&oacute;n</td>

    <td><?=form_input($institucion_credito);?></td></tr>
<tr><td>N&uacute;mero Cuenta</td>
    <td><?=form_input($numero_cuenta);?></td></tr>
<tr><td>N&uacute;mero Cheque</td>
    <td><?=form_input($numero_cheque);?></td></tr>

<?php
}else{
?>
<tr><td>Instituci&oacute;n</td>
<td><?=form_input($institucion_credito);?></td></tr>
<tr><td>N&uacute;mero Cheque</td>
    <td><?=form_input($numero_cheque);?></td></tr>
    <?php }

