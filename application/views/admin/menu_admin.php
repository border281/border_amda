<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://amda.gsinlimites.com.mx/index.php/admin">
              <i class="fa fa-user"></i> Administraci&oacute;n de Usuarios
          </a>
        </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
              <li class=""><a href="http://amda.gsinlimites.com.mx/index.php/admin"><i class="fa fa-list-alt" style="margin:0 5px 0 3px"></i>  Gestion de Usuarios</a></li>
              <li class=""><a href="<?=  base_url("index.php/users")?>"><i class="fa fa-users " style="margin:0 5px 0 3px"></i> Usuarios </a></li>
              
          </ul>
          <ul class="nav navbar-nav navbar-right navbar-user">
              <li class="dropdown user-dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo "  ".$usuario;?><b class="caret"></b></a>
                  
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
