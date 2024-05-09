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
    <title><?=$pr['SITE_NOME'];?> - An&uacute;ncios</title>
	
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
	<h3 style="cursor: s-resize; ">Visualizar An&uacute;ncios</h3>
	<div class="clear"></div>
	
<!-- =============== -->
<!-- EXCLUI PRODUTO  -->
<!-- =============== -->
<?php
if ($_GET['acao'] == "exclui")
{ 	
	$id = $_GET["id"];
	mysql_select_db(BD_NAME); 
	$res = mysql_query("DELETE FROM anuncios WHERE id = '$id' ")or die(mysql_error()); 
	if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='clienteV.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Registro exclu&iacute;do com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="clienteV.php?pagina=1"', 2000) /* 2 seconds */</script>
	<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='clienteV.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="clienteV.php?pagina=1"', 5000) /* 5 seconds */</script>
<? } } ?>
<!-- =================== -->
<!-- END EXCLUI ANUNCIO  -->
<!-- =================== -->	

</div>
			
<div class="content-box-content">
<?php
	// Inicio paginacao
	$quantidade 				= 10;
	$pagina     				= (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
	$inicio     				= ($quantidade * $pagina) - $quantidade;
	$query_rsFotos 				= "SELECT * FROM anuncios ORDER BY id DESC LIMIT $inicio, $quantidade";
	$rsFotos 					= mysql_query($query_rsFotos) or die(mysql_error());
	$row_rsFotos 				= mysql_fetch_assoc($rsFotos);
	$totalRows_rsFotos 			= mysql_num_rows($rsFotos);
	$sqlTotal    				= "SELECT * FROM anuncios";
	$qrTotal     				= mysql_query($sqlTotal) or die(mysql_error());
	$numTotal    				= mysql_num_rows($qrTotal);
	$totalPagina 				= ceil($numTotal/$quantidade);
		// Final paginacao
?>
<div class="pagination">
<?php  include('anunciopg.php'); ?>
<hr style="border:0px;color:#ddd;background-color:#ddd;height:1px;margin:20px 0 10px 18px;">
</div>

<table>
	<tbody>
		<tr>
				<div class="listaclientes">
<ul>
<?php
$sql = mysql_query("SELECT * FROM anuncios ORDER BY id ASC Limit $inicio, $quantidade ") or die(mysql_error());
	
	while($array = mysql_fetch_array($sql))  	
{
	$imagemp = $array['imagem'];
	$idp = $array['id'];
	$nomep = $array['nome'];
	$mensagemp = $array['mensagem'];	
	$link = $array['link'];		
	
?>
<li style="margin: 20px;width: 150px!important;height: 150px;clear: right;float: left;">
	<span class="iconesclientes">
		<a href="./anuncioE.php?id=<?=$idp;?>" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a>
		<a href="./anuncioV.php?acao=exclui&id=<?=$idp;?>" title="Excluir">&nbsp;&nbsp;<img src="./img/icones/cross.png" alt="Excluir"></a><br />
	</span>
		<a href="../images/anuncios/<?=$imagemp;?>" id="fancyimg"><img src="../images/anuncios/<?=$imagemp;?>" width="95" height="90" class="borda" style="padding:8px;background:#fefefe;"></a><br />
		<?=utf8_decode($nomep);?>
</li>
<?php } ?>
</ul>
			</div>
	</tr>                        
</tbody>

</table>

	<div class="clear"><p>&nbsp;</p></div>              

</div>
</div>
	<div class="clear"></div>	
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>