<?php $tipo_persona = $tipo_p?>
<script>
       $(document).ready(function() {
                      
                    tipo_persona = <?php echo $tipo_persona;?>;
                   $.post("<?php echo base_url();?>index.php/beneficiario/datos/<?=$id_aviso.'/'.$id_beneficiario?>", {
                        tipo_persona : tipo_persona
                        }, function(data) {
                            $(".div_tipo_persona_beneficiario").html(data);
                });
                
                 
        });
 </script> 
