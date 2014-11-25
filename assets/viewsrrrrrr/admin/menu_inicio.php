 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
              <i class="fa fa-dashboard"></i> Administracion avisos
          </a>
        </div>
      <!-- nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
              <li class="active"><a href=""><i class="fa fa-list-alt" style="margin:0 5px 0 3px"></i>  Lista informes</a></li>
              <li class=""><a href=""><i class="fa fa-exclamation-circle " style="margin:0 5px 0 3px"></i>  Acerca de..</a></li>
              
          </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
              <li class="dropdown user-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo "  ".$usuario;?><b class="caret"></b></a>
                  
                  <ul class="dropdown-menu">
                      <li><a href="#"><i class="fa fa-user"></i> Datos</a></li>
                      <li class="divider"></li>
                      <li><a href=""><i class="fa fa-power-off"></i> Salir</a></li>
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

