<?php $tipo_persona = $tipo_p?>
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
