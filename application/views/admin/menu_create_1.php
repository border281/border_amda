<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Men&uacute;</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url().'index.php/'?>"><i class="fa fa-home"></i> Inicio </a>
        </div>
      <!-- nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
              <li class=""><a href="<?php echo base_url().'index.php/datos_aviso/index/'?><?=$this->session->userdata('id_aviso').''?>"><i class="fa fa-list"></i> Datos del aviso</a></li>
              <li class=""><a href="<?php echo base_url().'index.php/persona_aviso/index/'?><?=$this->session->userdata('id_aviso').''?>"><i class="fa fa-users"></i> Personas aviso</a></li>
             
              <li class="beneficiario">
                  
                  <?php 
                  
              if(isset($beneficiario) && $beneficiario->num_rows() > 0){
              foreach ($beneficiario->result() as $row_beneficiario){?>
                     
                      <ul>
                      <li>
                          <!--<a  id= "clsEliminarElemento" class = "clsEliminarElemento">&nbsp;</a>
                          <a class = "nyroModal" data-toggle="modal" data-target="#form_beneficiario1">
                              <i class="fa fa-dashboard"></i>
                              Dueno Beneficiario
                          </a>-->
                          <!--<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#form_beneficiario<?//=$row_beneficiario->idbeneficiario?>">
                            Dueño beneficiario
                          </button>-->
                          <a  href="<?php echo base_url().'index.php/beneficiario/mostrar_datos/'?><?=$this->session->userdata('id_aviso').'/'?><?=$row_beneficiario->idbeneficiario?>"> Dueño Beneficiario</a>
                        
                    </li>
                    </ul>
              <?php 
              }
              }
              ?>
               
              </li>
              <div class="accordion">
                 <?php if(isset($operaciones) && $operaciones->num_rows() > 0){
                     
                     $num_op =1;
                     foreach($operaciones->result() as $row_operacion)
                         {
                          if(isset($liquidaciones) && is_array($liquidaciones) && $liquidaciones[$row_operacion->iddatos_operacion]->num_rows() > 0){
                          $count_liq=0;
                           foreach ($liquidaciones[$row_operacion->iddatos_operacion]->result() as $key){
                               $count_liq=$count_liq+1;
                           }
                          
                            }else{$count_liq=0;} 
                       ?>
                  <li style="padding-left: 15px; padding-top: 10px;" id="operacion<?=$row_operacion->iddatos_operacion?>"><i class="fa fa-gears"></i> Datos de la operaci&oacute;n  <?=$num_op;?></li> 
                   
                     <div class="block">
                         
                     <?php
                      if(isset($liquidaciones) && is_array($liquidaciones) && $liquidaciones[$row_operacion->iddatos_operacion]->num_rows() > 0){
                          $num_liq=1;
                           foreach ($liquidaciones[$row_operacion->iddatos_operacion]->result() as $key){
                          ?>
                          
                         <li> ° Liquidaci&oacute;n <?=$num_liq?></li> 
                             
                          <?php
                          $num_liq=$num_liq+1;
                           }
                          
                      } 
                      ?>
                             <li class=" liquidacion"></li>
                             <a style="color: #FFF; text-decoration: underline" href="<?php echo base_url().'index.php/operaciones/index/'.$row_operacion->iddatos_operacion?>"><i class="fa fa-file-text"></i> Ver detalles operaci&oacute;n</a>
                     </div>  
                         <?php
                         $num_op=$num_op+1; 
                        }
                        
                       }else
                            {
                    ?>
                  <li class="operaciones" style="padding-left: 15px; padding-top: 10px;"><a href="<?php echo base_url().'index.php/operaciones/index/'?>"><i class="fa fa-gears"></i> Detalles operaci&oacute;n </a></li>
                     <li class=" liquidacion"></li>
             
                    <?php
                    }
                    ?>
                 
               
                      
             </div>
          </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
              <li class="dropdown user-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " ".$usuario;?><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="#"><i class="fa fa-user"></i> Datos</a></li>
                      <li class="divider"></li>
                      <li><a href="<?=  base_url()."index.php/amda/logout/"?>"><i class="fa fa-power-off"></i> Salir</a></li>
                  </ul>
                  
              </li>
              <li class="date">
                  
                    <?php 
                        date_default_timezone_set('America/Mexico_City');
                        echo ''.date('Y-m-d')."";
                        
                    ?>
                  
              </li>
          </ul>
      </div>    
      </nav>

