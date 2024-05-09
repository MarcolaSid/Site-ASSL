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
  <meta charset="<?=$pr['LANG'];?>">
    <title><?=$pr['SITE_NOME'];?> - Categorias</title>
	
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
<h3 style="cursor: s-resize; ">Visualizar Categorias</h3>

<div class="clear"></div>
</div>
<div class="content-box-content">

<!-- ================ -->
<!-- EXCLUI CATEGORIA -->
<!-- ================ -->
<?php
if ($_GET['acao'] == "exclui")
{ 	
	$id = $_GET["id"];
	mysql_select_db(BD_NAME); 
	$res = mysql_query("DELETE FROM categoria WHERE id = '$id' ")or die(mysql_error()); 
	if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='categorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Registro exclu&iacute;do com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="categorias.php?pagina=1"', 2000) /* 2 seconds */</script>
	<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='categorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="categorias.php?pagina=1"', 5000) /* 5 seconds */</script>
<? } } ?>
<!-- ==================== -->
<!-- END EXCLUI CATEGORIA -->
<!-- ==================== -->

<!-- ================ -->
<!-- INSERE CATEGORIA -->
<!-- ================ -->
<?php
if ($_GET['acao'] == "insere")
{ 
		$nome = $_POST["nome"];
		$descricao = $_POST["descricao"];
		$produto_potlab = $_POST['produto_potlab'];

				$sql = "INSERT INTO categoria (nome, descricao, produto_potlab ) VALUES ('$nome', '$descricao', $produto_potlab)"; 
				$sql_busca = mysql_query($sql);

					if ($login) 
						{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='categorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Inser&ccedil;&atilde;o efetuada com sucesso...</div>
</div>
<script type="text/javascript">setTimeout('window.location.href="categorias.php?pagina=1"', 2000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='categorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel realizar a Inser&ccedil;&atilde;o...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="categorias.php?pagina=1"', 5000) /* 5 seconds */</script>
<?php }	} ?>
<!-- ==================== -->
<!-- END INSERE CATEGORIA -->
<!-- ==================== -->

<!-- =============== -->
<!-- LISTA CATEGORIA -->
<!-- =============== -->
<table>
<?php
// Inicio paginacao
	$quantidade = 5;
	$pagina     = (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
	$inicio     = ($quantidade * $pagina) - $quantidade;
	$query_rsFotos = "SELECT * FROM categoria ORDER BY nome DESC LIMIT $inicio, $quantidade";
	$rsFotos = mysql_query($query_rsFotos) or die(mysql_error());
	$row_rsFotos = mysql_fetch_assoc($rsFotos);
	$totalRows_rsFotos = mysql_num_rows($rsFotos);
	$sqlTotal    = "SELECT * FROM categoria";
	$qrTotal     = mysql_query($sqlTotal) or die(mysql_error());
	$numTotal    = mysql_num_rows($qrTotal);
	$totalPagina = ceil($numTotal/$quantidade);
// Final paginacao

	$sql = mysql_query("SELECT * FROM categoria ORDER BY id ASC Limit $inicio, $quantidade") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
	{
	if ($cor=="")
	{ $cor = "#cccccc";}
	else
	{ $cor = "";}			
?>
<tr bgcolor="<?="$cor"?>">
	<td class="alignverticaltop"><?=utf8_encode($array['nome']);?></td>
	<td class="alignverticaltop"><?=utf8_encode($array['descricao']);?></td>
	<td class="alignverticaltop" width="10%"><!-- Icones -->
	<a href="./categoriasE.php?id=<?=$array['id'];?>" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a>
	<a href="./categorias.php?acao=exclui&id=<?=$array['id'];?>" title="Excluir">&nbsp;&nbsp;<img src="./img/icones/cross.png" alt="Excluir"></a></td>
</tr>                        
<?php } ?>
</table>
<div class="pagination"><?php include('paginacaoc.php'); ?></div>
<!-- =================== -->
<!-- END LISTA CATEGORIA -->
<!-- =================== -->

<div class="clear"><p>&nbsp;</p></div>

<!-- ====================== -->
<!-- INSERE CATEGORIA FORM  -->
<!-- ====================== -->
<div class="insereNoticia">
<form action="categorias.php?acao=insere" method="post" enctype="multipart/form-data">            
  <label>
	Nome da Categoria:</label>
  <input class="text-input medium-input" type="text" id="nome" name="nome">
	<p></p>

  <label>Descri&ccedil;&atilde;o da Categoria:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao"></textarea>
	<p></p>
   <input class="button" type="submit" value=" Cadastrar Categoria ">
</form>
</div>
<!-- ========================== -->
<!-- END INSERE CATEGORIA FORM  -->
<!-- ========================== -->
	              
</div>
</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>