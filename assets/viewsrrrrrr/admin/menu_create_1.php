<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=""> Nuevo aviso</a>
        </div>
      <!-- nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
              <li class=""><a href="<?php echo base_url().'index.php/datos_aviso/'?>"><i class="fa fa-list"></i> Datos del aviso</a></li>
              <li class=""><a href="<?php echo base_url().'index.php/persona_aviso/'?>"><i class="fa fa-users"></i> Personas aviso</a></li>
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
              <?php
              if(isset($operaciones)&& $operaciones ->num_rows()>0)
                  
                  {
                foreach($operaciones->result() as $row_operacion){  
              
                  ?>
              
              <li id="<?=$row_operacion->iddatos_operacion?>" class="" ><a href="<?php echo base_url().'index.php/operaciones/index/'.$row_operacion->iddatos_operacion?> " ><i class="fa fa-gears"></i> Detalles operacion</a></li>
               <li class=" liquidacion"></li>
                  <?php 
                  
                }}else
                    {
                    ?>
                     <li class=""><a href="<?php echo base_url().'index.php/operaciones/index/'?>"><i class="fa fa-gears"></i> Detalles operacion</a></li>
                       <li class=" liquidacion"></li>
             
                    <?php
                    }
                ?>
              
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
                        date_default_timezone_set('UTC');
                        echo ''.date('Y-m-d')."";
                        
                    ?>
                  
              </li>
          </ul>
      </div>    
      </nav>

