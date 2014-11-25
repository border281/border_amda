<!doctype html>
<head>
    <meta charset="utf-8">

    <title><?=$title?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_css');?>bootstrap.min.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_css');?>bootstrap.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_css');?>login.css" media="screen" />


    <link rel="shortcut icon" href="<?php echo base_url().'assets/css/'?>favicon.ico">
</head>

<body>
    <style>body { background: #f5f5f5; }</style>

    <div class="container"> <!-- Start of Main Container -->

    
        
            
        
<div id="login">
   <!-- <div class="titulo"><?//=$this->lang->line('title_login');?></div>-->
    <div class="logo"><img src="<?=base_url()."/assets/images/logo.png"?>"></div>
    
	<?=form_open(base_url().'index.php/amda/login')?>
		<div class="control-group ">
			<div class="controls">
				<?=form_input($username)?><p class="alert-warning"><?=form_error('user_am')?></p>
			</div>
		</div>

		<div class="control-group ">
			<div class="controls">
				<?=form_input($password)?><p class="alert-warning"><?=form_error('pass_am')?></p>
			</div>
		</div>
                    <?=form_hidden('token',$token)?>
					
		
		<div class="control-group">
			<div class="controls">
                            <br>
                            <center><?=form_submit($submit)?></center>
				
				<?=form_close()?>
			</div>
		</div>
	</div>
        <?php 
        if($this->session->flashdata('usuario_incorrecto'))
	  {
	 ?>
	<p><?=$this->session->flashdata('usuario_incorrecto')?></p>
	<?php
	  }
	?>
    </div>
</body>
</html>