<table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Domicilio Extranjero</th>
     <?=  form_hidden('id_aviso',$id_aviso)?>
     </thead>
     <tbody>
         <tr>
             <td>Pais</td>
             <td><?=form_input($pais)?></td>
             <td>Estado Provincia</td>
             <td><?=form_input($estado)?></td>
         </tr>
         <tr>
             <td>Ciudad Poblacion</td>
             <td><?=form_input($ciudad)?></td>
             <td>Codigo Postal </td> 
             <td><?php echo form_input($codigo_postal);?></td>
             
            
         </tr>
         <tr>
             <td>Colonia</td>
             <td><?php echo form_input($colonia);?></td>
             <td>Calle</td>
             <td><?php echo form_input($calle);?></td>
             
         </tr>
         <tr>
             <td>Numero Exterior</td>
             <td><?php echo form_input($num_ext);?></td>
            <td>Numero interior</td>
             <td><?php echo form_input($num_int);?></td>
             
         </tr>
    <tr>
     </tbody>
       </table>
<table class="table table-striped table_amda">
    <thead> <th colspan="4">Telefono</th></thead>
<tbody>
<tr>
        <td>Clave Pais</td>
        <td><?php echo form_input($clave_pais)?></td>
    
        <td>Numero telefono</td>
        
        <td><?php echo form_input($numero_telefono)?></td>
</tr>
<tr>
        <td>Correo electronico</td>
        <td><?php echo form_input($mail)?></td>
</tr>              
     </tbody>
</table>
 
