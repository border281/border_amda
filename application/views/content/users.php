<div id="page-wrapper">
    <div id="fuel_main_top_panel"></div>
    <div class="clear"></div>
    <div id="amda_actions">
      <div id="filters">
	<table cellspacing="0" cellpadding="0" border="0">
		<tbody>
		     <tr>
			<td>
			<div id="form_537fcd2601115" class="more_filters">
                        <div>
        <div class="actions">
            <div class="actions_inner"></div>
                
        </div>
</div>
</div>
        <script charset="utf-8" type="text/javascript" src="http://amda.gsinlimites.com.mx/assets/js/jquery-migrate-1.1.1.js"></script>
	<script charset="utf-8" type="text/javascript" src="http://amda.gsinlimites.com.mx/assets/js/jquery.formbuilder.js"></script>
	<script charset="utf-8" type="text/javascript" src="http://amda.gsinlimites.com.mx/assets/js/custom_fields.js"></script>
	<script type="text/javascript">
//&lt;![CDATA[

if (jQuery){ jQuery(function(){if (jQuery.fn.formBuilder) {if (typeof(window['formBuilderFuncs']) == "undefined") { window['formBuilderFuncs'] = {}; };window['formBuilderFuncs'] = jQuery.extend(window['formBuilderFuncs'], []);jQuery("#form_537fcd2601115").formBuilder(window['formBuilderFuncs']);jQuery("#form_537fcd2601115").formBuilder().initialize();}})}
//]]&gt;
</script>
		</td>
		<!--<td><a class="reset" href="#"></a></td>
		<td>
			<div class="search_input">
			<input type="search" placeholder="Buscar..." value="" id="search_term" name="search_term">											</div>
		</td>
		<td class="search"><input type="submit" value="Buscar" id="search" name="search"></td>
		<td class="show"><label for="limit">Ver:</label> 
                    <select id="limit" name="limit">
                        <option selected="selected" label="50" value="50">50</option>
                        <option label="100" value="100">100</option>
                        <option label="200" value="200">200</option>
                    </select>
                </td>-->
	</tr>
	</tbody>
	</table>
</div>
        <div id="action_btns" class="buttonbar">

	<ul>
           <!-- <li>
                <a class="ico ico_select_all" href="#">Selecciona Todos</a>
            </li>-->
            <li style="display: none;">
                <a id="multi_delete" class="ico ico_delete" href="#">Eliminar varios</a>
            </li>
            <li class="end">
                <a class="ico ico_create" href="<?=  base_url('index.php/users/create')?>">Crear</a>
            </li>
        </ul>
	
	
</div>
    </div>
    <div id="amda_notification"></div>
    <div id="amda_main_content">
        
   
			
			
			<!-- BODY -->
			
<!-- list view -->
<div id="list_container">
	<div id="data_table_container">
            <table cellspacing="0" cellpadding="0" class="data" id="data_table">
                <thead>
                <tr>
                        <th class="col1 asc on">
                            <a onclick="" href="">Email</a>
                        </th>
                        <th class="col2">
                            <a onclick="" href="">Nombre</a>
                        </th>
                        <th class="col3">
                            <a onclick="" href="">RFC</a>
                        </th>
                        
                        <th class="col5">
                            <a onclick="" href="">Super Admin</a>
                        </th>
                        <th class="col6">
                            <a onclick="" href="">Activo</a>
                        </th>
                        <th class="col7">
                            <a  href="">Editar</a>
                    
                        </th>
                        <!--<th class="col8">
                            <a  href="">Eliminar</a>
                    
                        </th>-->
            </tr>
</thead>
<tbody>

	<!--<td class="col1 first"></td>
	<td class="col2">administrador</td>
	<td class="col3">amda</td>
	<td class="col4">amda</td>
	<td class="col5">si</td>
	<td class="col6"><span class="publish_hover publish_col"><span data-field="active" id="row_published_1" class="publish_text published toggle_off">SI</span></span></td>
	<td class="col7 actions"><a class="action_edit" href="http://fuel.com/index.php/fuel/users/edit/1">EDITAR</a></td>
-->
<?php 
foreach ($usuarios->result() as $key ) {
 ?> 
<tr class=" rowaction" id="data_table_row1">
<td class="col1 first"><?=$key->email?></td> 
<td class="col2"><?=$key->display_name?></td> 
<td class="col3"><?=$key->rfc?></td> 
<td class="col5"><?=$key->super_admin?></td> 
<td class="col4"><?=$key->active?></td> 

<td class="col6"><a href="<?=base_url("index.php/users/edit")."/".$key->id;?>"><i class="fa fa-edit"></i> Editar</a></td> 
<!--<td class="col6"><a href="=//base_url("index.php/users/edit")."/".$key->id;?>"><i class="fa fa-times-circle"></i> Eliminar</a></td> -->
</tr>

<?php
}
?>

</tbody>
</table>
<input type="hidden" value="0" id="offset" name="offset"><input type="hidden" value="asc" id="order" name="order"><input type="hidden" value="email" id="col" name="col"></div>
	<div id="table_loader" class="loader" style="display: none;"></div>
</div>

<?php 

?>

<div class="clear"></div>			
<input type="hidden" value="0" id="fuel_inline" name="fuel_inline">
        
        </div>
        
    </div>
</div>
