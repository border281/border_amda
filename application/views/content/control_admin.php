<div id="page-wrapper">
    <div id="amda_admin_top"></div>
    <div id="amda_notification"></div>
    <div id="amda_main_content">
         <?php
            if($this->session->flashdata('correcto') != ''){
            ?>
        <div class="status_box success">
            <h6>ok</h6>
            <ul><li><?=$this->session->flashdata('correcto')?></li></ul>
        </div>
    <?php } ?>
        <?php
            if($this->session->flashdata('error') != ''){
            ?>
        <div class="status_box error">
            <h6>error</h6>
            <ul><li><?=$this->session->flashdata('error')?></li></ul>
        </div>
    <?php } ?>
        <h2>"Bienvenido al sistema de Administraci&oacute;n de Usuarios AMDA".</h2>
        <hr>
        <br>
        <br>
        <h3>Este m&oacute;dulo es s&oacute;lo para Administradores del sistema.</h3>
        <br>
        <br>
        <ul>
            
            <li> Para ver una lista de todos los usuarios creados ir al men&uacute; Usuarios.</li>
            <li> Desp&uacute;es haz click en el menu superior Crear para dar de alta un usuario nuevo.</li>
        </ul>
                   


    </div>
</div>

