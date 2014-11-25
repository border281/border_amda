 <table class="table table-striped table_amda">
     <thead>
     <th colspan="4">Domicilio Extranjero</th>
     </thead>
     <tbody>
         <tr>
              <td>Pais</td>
             <td>
                 <select id="pais_nacimiento" name="pais_nacimiento" class="form-control">
                     <option selected value="0">Selecciona una opcion</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select>
             </td>
             <td>Estado o provincia</td>
             <td><?php echo form_input($estado);?></td>
            
         </tr>
         <tr>
             <td>Ciudad</td>
             <td><?php echo form_input($ciudad);?></td>
             <td>Colonia</td>
             <td><?php echo form_input($colonia);?></td>
         </tr>
         <tr>
             <td>Calle</td>
             <td><?php echo form_input($calle);?></td>
            <td>Codigo postal</td>
             <td><?php echo form_input($cp);?></td>
            
         </tr>
         <tr>
                <td>Numero exterior</td>
                <td><?php echo form_input($num_ext);?></td>
                <td>Numero interior</td>
                <td><?php echo form_input($num_int);?></td>
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
 