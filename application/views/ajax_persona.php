<?php 
$tipo_persona = $tipo_p;
$domicilio_tipo = $tipo_dom;
?>
<script>
       $(document).ready(function() {
                      
                    tipo_persona = <?php echo $tipo_persona;?>;
                    $.post("<?php echo base_url();?>index.php/persona_aviso/tipo_persona", {
                        tipo_persona : tipo_persona
                        }, function(data) {
                            $(".div_tipo_persona").html(data);
                            
                });
                
                 
        });
 </script> 
<?php if (isset($tipo_persona) && $tipo_persona != NULL ){?>
    <script>
        $(document).ready(function(){
            $('#tipo_persona option[value= "<?php echo $tipo_persona;?>" ]').attr({'selected':'true'});
           // $('#tipo_operacion').prop('disabled','disabled');
           
        });
        
    </script>
    <?php } ?>
    