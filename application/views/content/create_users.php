<div id="page-wrapper">
    <div id="fuel_main_top_panel"></div>
    <div class="clear"></div>
    <?= form_open('users/save_user',$attrib_form)?>
    <div id="amda_actions">
     
        <div id="action_btns" class="buttonbar">

	
                <h4 class="ico ico_users">Crear  > Usuario</p>
                <!--<a class="ico ico_save" href="<?//=  base_url('index.php/users/create')?>">Guardar</a>-->
        
	
	
</div>
    </div>
    <div id="amda_notification"></div>
    <div id="amda_main_content">
        <div id="amda_main_content_inner">
            <p class="instructions">Aqu&iacute; puede gestionar los datos para los usuarios.</p>
            <div id="form_users" class="form">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>
                                <?=  form_label('Nombre de Usuario','username')?>
                                <span class="required">*</span>
                            </td>
                            <td>
                                <?=  form_input($inp_username)?>
                                <label class="error"><?php echo form_error('username'); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td><?=  form_label('E-mail','email')?>
                                <span class="required">*</span>
                            </td>
                        <td>
                            <?=  form_input($inp_email)?>
                            <label class="error"><?php echo form_error('email'); ?></label>
                        </td>
                        </tr>
                        <tr>
                            <td><?=  form_label('RFC','rfc')?>
                                <span class="required">*</span>
                            </td>
                            <td>
                                <?=  form_input($inp_rfc)?>
                                <label id="trfc"></label>
                                <label class="error"><?php echo form_error('rfc'); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?=  form_label('Permisos','permisos')?>
                            <span class="required">*</span>
                            </td>
                            <td>
                                <select  id="role" name="permisos">
                                    <option value="" selected="selected">Selecciona una opci&oacute;n</option>
                                    <option value="2">Administrador</option>
                                    <option value="4">Usuario</option>
                                </select>
                                <label class="error"><?php echo form_error('permisos'); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td><?=  form_label('Activo','activo')?>
                                <span class="required">*</span>
                           </td>
                           <td>
                              <span class="multi_field">
                                  <input type="radio" checked="checked" value="1" id="active_yes" name="active"> 
                                  <label id="label_active_yes" for="active_yes">yes</label>&nbsp;&nbsp;&nbsp;</span>
                                  <span class="multi_field">
                                      <input type="radio" value="0" id="active_no" name="active"> 
                                      <label id="label_active_no" for="active_no">no</label>&nbsp;&nbsp;&nbsp;</span>
                                      <label class="error"><?php echo form_error('active'); ?></label>
                           </td>
                        </tr>
                        <tr>
                            <td id="tdpassword"><?=  form_label('Password','password')?>
                                <span class="required">*</span>
                            </td>
                            <td>
                                <?=  form_input($inp_password)?>
                                <label class="error"><?php echo form_error('password'); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <td><?=  form_hidden('id',$id_user)?>
                            <?php
                            if(isset($update_user) && $update_user == TRUE)
                                {
                                echo form_input($user_edit);
                                } 
                            ?>
                            </td>
                            <td>
                                <div class="actions_inner">
                                    <input id="save" class="submit" type="submit" value="Guardar" name="Guardar">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="required" colspan="2"><span class="required">*</span> Campos requeridos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
			
			
			<!-- BODY -->
			


<?php 

?>

<div class="clear"></div>			

        
        </div>-
        
    </div>
</div>
<script>
  
$(function(){
    
    
    $('#form_newuser').validate({
       rules : {
           username : {required :  true},
              email : {required:true,checkmail:true},
                rfc : {required:true}, 
           permisos : {required :true},
           password : {required:true,minlength:6}
       },
       
       messages :{
           username :
                   {
                       required :  "Debe ingresar un nombre de usuario",
                       
                   },
              email :
                    {
                       required : "Debe ingresar un correo valido" 
                    },
                rfc :
                    {
                        required :"Debe ingresar un RFC"
                    },
           permisos : {required :"Selecciona el tipo de usuario"},
           password : {required:"Debe ingresar un password",minlength :"El password debe contener al menos 6 caracteres" }
       
       }
    });
    
}); 
</script>

<?php if(isset($update_user) && $update_user == TRUE){?>
<script>
    $(document).ready(function() {
        $(".ico_users").empty().html("Actualizar datos de usuario");
        $("#save").attr('value','Actualizar');
        $(".actions_inner").append('<input type="button" class="cancel" value="Cancelar" id="Cancel" name="Cancel" onclick ="history.back(-1);">');
        $("#form_newuser").attr('action','http://amda.gsinlimites.com.mx/index.php/users/update'); 
        $('#role option[value= "<?=$permisos;?>" ]').attr({'selected':'true'});
        $("#tdpassword").empty().html("<label for='password'>Nuevo Password</label><span class='required'>*</span>");

        <?php if($activo == '1'){?>
             $("#active_yes").attr('checked','checked');
        <?php }else{?>
        $("#active_no").attr('checked','checked');
        <?php }?>
    });
</script>
    <?php }?>