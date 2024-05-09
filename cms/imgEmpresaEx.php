<?php header("Content-Type: text/html; charset=iso-8859-1",true) ?>
<?php
	include "include/parametros.php";	
	include "include/_config.php";
	$dadosUsuario	=	$_SESSION['exp_user'];
	require_once("login.class.php");
	$login = new Login();
	$login->verificar("login.php");
?>
<!DOCTYPE html>
<?php ob_start();?>
<html lang="en" class="no-js">
<head>
  <meta charset="<?=$pr['ISO88591'];?>">
    <title><?=$pr['SITE_NOME'];?></title>
	
	<!-- CSS -->
	<link rel="stylesheet" href="./css/reset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/estilos.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/invalid.css" type="text/css" media="screen">	
	<link rel="stylesheet" href="<?=$pr['TEMA'];?>" type="text/css" media="screen" />

	<!-- Internet Explorer Fixes -->
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="./css/ie.css" type="text/css" media="screen" />
	<![endif]-->

</head>
<?php flush(); ?>
<body>
	
<div id="sidebar">
<div id="sidebar-wrapper"> <!-- Barra lateral com logo e menu -->
	<?php include 'include/inc_menu.php';?>
</div> <!-- End Barra lateral com logo e menu -->
</div> <!-- End #sidebar -->
	
	<div id="main-content"> <!-- BEGIN Box Geral -->
		<div class="content-box"><!-- BEGIN Content Box -->
			
			<div class="content-box-header">
				<h3 style="cursor: s-resize; ">Excluir Imagem</h3>
				
				<div class="clear"></div>

		  </div> <!-- END .content-box-header -->
			
		  <div class="content-box-content"> <!-- BEGIN .content-box-content -->
              		  
			<?php 	
				$id = $_GET["id"];

					mysql_select_db(BD_NAME); 
					$res = mysql_query("DELETE FROM conteudo WHERE id = '$id' ")or die(mysql_error()); 
	
					if ($login) 
						{
			?>
				<div class="notification success">
					<a href="#" class="close" onclick="window.location.href='imgEmpresa.php'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
					<div>Registro exclu&iacute;do com sucesso...</div>
				</div>
					<script type="text/javascript">setTimeout('window.location.href="imgEmpresa.php"', 2000) /* 2 seconds */</script>
			<?php	} else { ?>
				<div class="notification error">
					<a href="#" class="close" onclick="window.location.href='imgEmpresa.php'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
					<div>Não foi poss&iacute;vel excluir o registro...</div>
				</div>
					<script type="text/javascript">setTimeout('window.location.href="imgEmpresa.php"', 5000) /* 5 seconds */</script>
			<? } ?> 

		  </div> <!-- END .content-box-content -->
	</div> <!-- END .content-box -->

	  <div class="clear"></div>
		
</div> <!-- END Box Geral -->

<?php include ('./include/javascript.php'); ?>

</body>
</html>
<?php ob_end_flush(); ?>