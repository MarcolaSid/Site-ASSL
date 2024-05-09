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
    <title><?=$pr['SITE_NOME'];?> - Busca Produtos</title>
	
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
	<h3 style="cursor: s-resize; ">Visualizar Produtos</h3>
	<div class="clear"></div>
	
<!-- =============== -->
<!-- EXCLUI PRODUTO  -->
<!-- =============== -->
<?php
if ($_GET['acao'] == "exclui")
{ 	
	$id = $_GET["id"];
	mysql_select_db(BD_NAME); 
	$res = mysql_query("DELETE FROM produto WHERE id = '$id' ")or die(mysql_error()); 
	if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='produtosV.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Registro exclu&iacute;do com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="produtosV.php?pagina=1"', 2000) /* 2 seconds */</script>
	<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='produtosV.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="produtosV.php?pagina=1"', 5000) /* 5 seconds */</script>
<? } } ?>
<!-- =================== -->
<!-- END EXCLUI PRODUTO  -->
<!-- =================== -->	

</div>
			
<div class="content-box-content">

<?php
// Inicio paginacao
$quantidade = 4;
$pagina     = (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
$inicio     = ($quantidade * $pagina) - $quantidade;
$query_rsFotos = "SELECT * FROM produto ORDER BY nome DESC LIMIT $inicio, $quantidade";
$rsFotos = mysql_query($query_rsFotos) or die(mysql_error());
$row_rsFotos = mysql_fetch_assoc($rsFotos);
$totalRows_rsFotos = mysql_num_rows($rsFotos);
$sqlTotal    = "SELECT * FROM produto WHERE nome LIKE '%".$palavra."%'";
$qrTotal     = mysql_query($sqlTotal) or die(mysql_error());
$numTotal    = mysql_num_rows($qrTotal);
$totalPagina = ceil($numTotal/$quantidade);
	// Final paginacao			

if ($a == "buscar") { 
	$palavra = trim($_POST['palavra']); 
	$sqlbusca = mysql_query("SELECT * FROM produto WHERE nome LIKE '%".$palavra."%' ORDER BY nome DESC Limit $inicio, $quantidade"); 
	$numRegistros = mysql_num_rows($sqlbusca); 
	if ($numRegistros != 0) { 
		while ($produto = mysql_fetch_object($sqlbusca)) { 
			$foto = mysql_query("SELECT path FROM foto WHERE id_produto = " . $produto->id);
			$foto = mysql_fetch_row($foto);
				if ($cor=="")
			{ $cor = "#cccccc";}
				else
			{ $cor = "";}
?>			

<table>
	<thead>
		<tr>
			<th width="120px">Produto:</th>
			<th width="480px"><?=ucwords(strtolower($produto->nome));?></th>
			<th colspan="2">Editar</th>
		</tr>
	</thead>
<tfoot>
	<tr><td></td></tr>
</tfoot>
<tbody>
	<tr bgcolor="<?="$cor"?>">
		<td class="alignverticaltop" width="120px"><a href="../img/produtos/<?=$foto[0];?>" id="fancyimg"><img src="../img/produtos/<?=$foto[0];?>" width="110" height="125" class="borda" style="padding:8px;background:#fefefe;"></a></td>	
		<td class="alignverticaltop" width="480px"><?=ucwords(strtolower($produto->descricao));?></td>
		<td class="alignverticaltop" width="50px"><!-- Icones -->
			<a href="./produtosE.php?id=<?=$produto->id;?>" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a>
			<a href="./produtosV.php?acao=exclui&id=<?=$produto->id;?>" title="Excluir">&nbsp;&nbsp;<img src="./img/icones/cross.png" alt="Excluir"></a>
		</td>
	</tr>                        
</tbody>
<?php }}} else { ?>
	<div class="notification success">
		<a href="#" class="close" onclick="window.location.href='busca.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
		<div>Nenhum produto encontrado com a palavra: "<?=$palavra;?>".</div>
	</div>
<?php } ?>
</table>
<div class="pagination">
<?php  include('paginacaob.php'); ?>
</div>

<hr style="border:0px;color:#ddd;background-color:#ddd;height:1px;margin:20px 0 10px 18px;">

<form class="busca" name="frmBusca" method="post" action="busca.php?a=buscar"> 
	<input class="text-input small-input" type="text" name="palavra" /> <input class="button" type="submit" value="Buscar" /> 
</form>	

	<div class="clear"><p>&nbsp;</p></div>              
</div>
</div>
	<div class="clear"></div>	
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>