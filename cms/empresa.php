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
<html lang="pt-BR" class="no-js">
<head>
  <meta charset="utf-8">
    <title><?=$pr['SITE_NOME'];?> - Empresa</title>
	
	<!-- CSS -->
	<link rel="stylesheet" href="./css/reset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/estilos.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/invalid.css" type="text/css" media="screen">	
	<link rel="stylesheet" href="<?=$pr['TEMA'];?>" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="./js/jquery.fancybox-1.3.1.css" media="screen" />		

	<!-- Internet Explorer Fixes -->
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="./css/ie.css" type="text/css" media="screen" />
	<![endif]-->

</head>
<?php flush(); ?>
<body>
	
<div id="sidebar">
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>
	
<div id="main-content">
<div class="content-box">			
<div class="content-box-header">
	<h3 style="cursor: s-resize; "><?=$pr['SITE_NOME'];?> - Sobre a Empresa</h3>
	<div class="clear"></div>
<?php 
	$sql = mysql_query("SELECT * FROM paginas WHERE id='1'") or die(mysql_error());  
		while($array = mysql_fetch_array($sql))  
	{
		if ($cor=="")
	{ $cor = "#cccccc";}
		else
	{ $cor = "";}
?>		  
</div>
			
<div class="content-box-content">              		  
<table>
	<tfoot>
		<tr><td></td></tr>
	</tfoot>
	<tbody>
		<tr><td class="alignverticaltop" width="100%"><a href="./empresaEditar.php?id=1" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"> Editar</a></td></tr>
		<tr><td><img src="../images/<?=$array['imagem'];?>" width="100%"></td></tr>
		<tr bgcolor="<?="$cor"?>"><td class="alignverticaltop"><?=$array['conteudo'];?></td></tr>                        
	</tbody>
</table>       
	<?php } ?>
</div>
</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>