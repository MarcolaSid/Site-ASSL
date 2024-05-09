<?php header("Content-Type: text/html; charset=UTF-8",true) ?>
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
  <meta charset="utf-8">
    <title><?=$pr['SITE_NOME'];?> - P&aacute;gina Inicial</title>
	
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
	<h3 style="cursor: s-resize; "><?=$pr['SITE_NOME'];?> - P&aacute;gina Inicial</h3>
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
	<thead>
		<tr>
		 <th width="85%">Conte&uacute;do</th>
		 <th colspan="2">Editar</th>
		</tr>
	</thead>
<tfoot>
		<tr><td></td></tr>
</tfoot>
<tbody>

	<tr bgcolor="<?="$cor"?>">
	<td class="alignverticaltop"><?=$array['conteudo'];?></td>
	<td class="alignverticaltop" width="5%"><!-- Icones -->
	<a href="./homeEditar.php?id=1" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a></td>
	</tr>                        
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