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
    <title><?=$pr['SITE_NOME'];?> - Editar P&aacute;gina Inicial</title>
	
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
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>
	
	<div id="main-content">
		<div class="content-box">
			<div class="content-box-header">
				<h3 style="cursor: s-resize; ">Edi&ccedil;&atilde;o da P&aacute;gina Inicial</h3>

				<div class="clear">
<?php 
	$id = '1';	
	if ($_GET['acao'] == "update")
		{
		$id = '1';		
		$conteudo = $_POST["conteudo"];
		$query = mysql_query("UPDATE paginas SET conteudo='$conteudo' WHERE id = '1' ") or die(mysql_error());  
	if ($login) 
			{
?>
		<div class="notification success">
			<a href="#" class="close" onclick="window.location.href='home.php'"><img src="./img/cross_grey_small.png" title="Fechar essa Notifica&ccedil;&atilde;o" alt="fechar"></a>
			<div>P&aacute;gina alterada com sucesso...</div>
		</div>
			<script type="text/javascript">setTimeout('window.location.href="home.php"', 2000) /* 2 seconds */</script>
		<p></p>
<?php
			} else {
?>
		<div class="notification error">
			<a href="#" class="close" onclick="window.location.href='home.php'"><img src="./img/cross_grey_small.png" title="Fechar essa Notifica&ccedil;&atilde;o" alt="fechar"></a>
			<div>N&atilde;o foi poss&iacute;vel efetuar a altera&ccedil;&atilde;o...</div>
		</div>
			<script type="text/javascript">setTimeout('window.location.href="home.php"', 5000) /* 5 seconds */</script>
    <p></p>
<?php
			}
	
			}
			$sql = mysql_query("SELECT * FROM paginas WHERE id = '1' ") or die(mysql_error());  
			while($array = mysql_fetch_array($sql))  
			{  
?>
</div>
</div>
			
<div class="content-box-content">
<p></p>
           
<div class="insereNoticia">
	<form action="homeEditar.php?acao=update&id=1" method="post" enctype="multipart/form-data">
		<label>Conte&uacute;do:</label>
		<textarea class="text-input textarea wysiwyg" id="textarea" name="conteudo" cols="79" rows="15"><?=$array['conteudo'];?></textarea>
		<p></p>
		<input class="button" type="submit" value=" Alterar ">
		<?php } ?>
	</form>
</div>
            
</div>
</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>