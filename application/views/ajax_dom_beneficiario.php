<?php 
$tipo_domicilio = $t_domicilio;
?>

<script>
       $(document).ready(function() {
            
                    tipo_domicilio = <?php echo $tipo_domicilio;?>;
                   $.post("<?php echo base_url();?>index.php/beneficiario/tipo_domicilio", {
                        tipo_domicilio : tipo_domicilio
                        }, function(data) {
                            $(".div_tipo_domicilio_beneficiario").html(data);
                });
                
               
        });
    </script> 
     