<?php
switch ($tipo) {
    case 'transferencia_interbancaria':
        echo '<tr><td>Clave rastreo</td>';
        echo '<td>'.form_input($clave_rastreo).'</td></tr>';
        
        

        break;
    case 'transferencia_misma_institucion':
        echo '<tr><td>Folio interno</td>';
        echo '<td>'.form_input($folio_interno).'</td></tr>';

        break;
    case 'transferencia_internacional':
       
          echo '<tr><td>Institucion ordenante</td>';
          echo '<td>'.form_input($institucion_ordenante).'</td></tr>';
          echo '<tr><td>Pais de origen</td>';
          echo '<td>'.form_input($pais_origen).'</td></tr>';
          echo '<tr><td>Numero de cuenta</td>';
          echo '<td>'.form_input($numero_cuenta).'</td></tr>';

        break;
    case 'orden_pago':
          echo '<tr><td>Institucion ordenante</td>';
          echo '<td>'.form_input($institucion_ordenante).'</td></tr>';
          echo '<tr><td>Orden de pago</td>';
          echo '<td>'.form_input($orden_pago).'</td></tr>';
          echo '<tr><td>Numero de cuenta</td>';
          echo '<td>'.form_input($numero_cuenta).'</td></tr>';

        break;
    case 'giro':
          echo '<tr><td>Institucion ordenante</td>';
          echo '<td>'.form_input($institucion_ordenante).'</td></tr>';
          echo '<tr><td>Numero de giro</td>';
          echo '<td>'.form_input($numero_giro).'</td></tr>';
          echo '<tr><td>Numero de cuenta</td>';
          echo '<td>'.form_input($numero_cuenta).'</td></tr>';
        break;
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

