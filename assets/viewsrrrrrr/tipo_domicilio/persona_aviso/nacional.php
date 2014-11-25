 <table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Domicilio Nacional</th>
     </thead>
     <tbody>
         <tr>
             <td>Colonia </td> 
             <td><?php echo form_input($colonia);?></td>
             <td>Calle, Avenida o via</td>
             <td><?php echo form_input($calle);?></td>
            
         </tr>
         <tr>
             <td>Numero exterior</td>
             <td><?php echo form_input($num_ext);?></td>
             <td>Numero interior</td>
             <td><?php echo form_input($num_int);?></td>
         </tr>
         <tr>
            <td>Codigo postal</td>
             <td><?php echo form_input($cp);?></td>
            
         </tr>
         
     </tbody>
</table>
<table class="table table-striped table_amda">
    <thead>
    <th colspan="4">Telefono</th>
    </thead>
    <tbody>
        <tr>
            <td>Clave lada del pais</td>
            <td> <?php echo form_input($lada);?></td>
            <td>Numero telefonico</td>
            <td><?php echo form_input($num_tel);?></td>
        </tr>
        <tr>
            <td> Correo electronico</td>
            <td><?php echo form_input($correo);?></td>
        </tr>
    </tbody>
</table>
 