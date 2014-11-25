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
             <td>N&uacute;mero exterior</td>
             <td><?php echo form_input($num_ext);?></td>
             <td>N&uacute;mero interior</td>
             <td><?php echo form_input($num_int);?></td>
         </tr>
         <tr>
             <td>C&oacute;digo postal</td>
             <td><?php echo form_input($cp);?></td>
            
         </tr>
         
     </tbody>
</table>
<table class="table table-striped table_amda">
    <thead>
    <th colspan="4">Tel&eacute;fono</th>
    </thead>
    <tbody>
        <tr>
            <td>Clave del pa&iacute;s</td>
            <td> <select id="lada" name="lada" class="form-control">
                    <option selected value="">Selecciona una opci&oacute;n</option>
                     <?php foreach ($clave_pais->result() as $row_clave_pais){?>
                     <option value="<?=$row_clave_pais->id_clave?>"><?=$row_clave_pais->descrip?></option>
                     <?php  }?>
                 </select></td>
                 <td>N&uacute;mero telef&oacute;nico</td>
            <td><?php echo form_input($num_tel);?></td>
        </tr>
        <tr>
            <td> Correo electr&oacute;nico</td>
            <td><?php echo form_input($correo);?></td>
        </tr>
    </tbody>
</table>
<?php if (isset($pais) && $pais != NULL ){?>
    <script>
        $(document).ready(function(){
            $('select#lada option[value= "<?php echo $pais;?>" ]').attr({'selected':'true'});
             //$('select#selecttipo_domicilio_beneficiario option[value= "" ]').attr({'selected':'true'});
          
           
        });
        
    </script>
    <?php } ?> 