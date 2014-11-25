
<?php 
if (isset($detalle_instrumento) && $detalle_instrumento != NULL && $detalle_instrumento != FALSE)
    {
    $row=$detalle_instrumento->row();
        
                    foreach ($row as $key => $value) {
                            $idexist = strrpos($key,'id');
                                if($idexist === FALSE){  
                                   echo "<hr><i>".strtoupper($key)."</i><hr><input class = 'form-control' type='text' value = '".$value."' disabled='true'>";      
        
                    }
                        
            }
     //   echo "<tr><td>". $value->iddatos_liquidacion ."</td></tr>";
    //}
    
    }
?>