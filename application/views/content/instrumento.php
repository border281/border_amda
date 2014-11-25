<?php 
$id_instrumento = $idinstrumento;
$id_datos_liquidacion = $iddatos_liquidacion;
?>
<script>
       $(document).ready(function() {
            
                    id_instrumento = "<?php echo $id_instrumento;?>";
                    id_liquidacion = <?php echo $id_datos_liquidacion;?>;
                   $.post("<?php echo base_url();?>index.php/operaciones/mostrar_instrumento", {
                        id_instrumento : id_instrumento,
                        id_liquidacion : id_liquidacion,
                        }, function(data) {
                            $(".div_mostrar_instrumento<?=$iddatos_liquidacion?>").html(data);
                });
                
               
        });
 </script>  
