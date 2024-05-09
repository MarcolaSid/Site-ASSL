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
    <title><?=$pr['SITE_NOME'];?> - Serviços</title>
	
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
<?php
if ($a == "buscar") { 
	$palavra = trim($_POST['palavra']); 
	$sqlbusca = mysql_query("SELECT * FROM servicos WHERE titulo LIKE '%".$palavra."%' ORDER BY titulo"); 
	$numRegistros = mysql_num_rows($sqlbusca); 
	if ($numRegistros != 0) { 
		while ($produto = mysql_fetch_object($sqlbusca)) { echo $produto->titulo . " (R$ ".$produto->valor.") <br />"; } 
	 } else { echo "Nenhum projeto foi encontrado com a palavra ".$palavra.""; } } 
?>			
<div class="content-box-header">
	<h3 style="cursor: s-resize; ">Visualizar Serviços</h3>
		<form class="busca" name="frmBusca" method="post" action="busca.php?a=buscar"> 
			<input class="text-input small-input" type="text" name="palavra" /> <input class="button" type="submit" value="Buscar" /> 
		</form>	
	<div class="clear"></div>
	
<!-- =============== -->
<!-- EXCLUI SERVIÇO  -->
<!-- =============== -->
<?php
if ($_GET['acao'] == "exclui")
{ 	
	$id = $_GET["id"];
	mysql_select_db(BD_NAME); 
	$res = mysql_query("DELETE FROM servicos WHERE id = '$id' ")or die(mysql_error()); 
	if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='servicosVisualizar.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Registro exclu&iacute;do com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="servicosVisualizar.php?pagina=1"', 2000) /* 2 seconds */</script>
	<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='servicosVisualizar.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="servicosVisualizar.php?pagina=1"', 5000) /* 5 seconds */</script>
<? } } ?>
<!-- =================== -->
<!-- END EXCLUI SERVIÇO  -->
<!-- =================== -->	

</div>
			
<div class="content-box-content">
<?php
	// Inicio paginacao
	$quantidade 				= 4;
	$pagina     				= (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
	$inicio     				= ($quantidade * $pagina) - $quantidade;
	$query_rsFotos 				= "SELECT * FROM servicos ORDER BY id DESC LIMIT $inicio, $quantidade";
	$rsFotos 					= mysql_query($query_rsFotos) or die(mysql_error());
	$row_rsFotos 				= mysql_fetch_assoc($rsFotos);
	$totalRows_rsFotos 			= mysql_num_rows($rsFotos);
	$sqlTotal    				= "SELECT * FROM servicos";
	$qrTotal     				= mysql_query($sqlTotal) or die(mysql_error());
	$numTotal    				= mysql_num_rows($qrTotal);
	$totalPagina 				= ceil($numTotal/$quantidade);
		// Final paginacao
?>
<div class="pagination">
<?php  include('paginacaoServicos.php'); ?>
<hr style="border:0px;color:#ddd;background-color:#ddd;height:1px;margin:20px 0 10px 18px;">
</div>

<table>
<?php
$sql = mysql_query("SELECT id, titulo, conteudo
	FROM servicos ORDER BY id
	DESC Limit $inicio, $quantidade ") or die(mysql_error());
	
	while($array = mysql_fetch_array($sql))  	
{
	$id = $array['id'];
	$titulo = $array['titulo'];
	$conteudo = $array['conteudo'];
	$data_entrada = $array['data_entrada'];		
	
	if ($cor=="")
{ $cor = "#cccccc";}
	else
{ $cor = "";}		
?>	
	<thead>
		<tr style="background: rgb(252, 236, 236);">
			<th width="480px"><?=$titulo;?>
				<span class="icones">
				<a href="./servicosEditar.php?id=<?=$id;?>" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a>
				<a href="./servicosVisualizar.php?acao=exclui&id=<?=$idp;?>" title="Excluir">&nbsp;&nbsp;<img src="./img/icones/cross.png" alt="Excluir"></a>
				</span>
			</th>
		</tr>
	</thead>
	
<!-- <tfoot>
	<tr><td></td></tr>
</tfoot> -->
<tbody>
	<tr bgcolor="<?="$cor"?>">
		<td class="alignverticaltop" width="480px">Projetos cadastrado em:
			<?php 
				print date("d \d\e m \d\e Y",strtotime($data_entrada));
			?><br><br><?=$conteudo;?></td>
	</tr>                       
</tbody>
<?php } ?>
</table>
<div class="pagination">
<?php  //include('paginacaop.php'); ?>
</div>

	<div class="clear"><p>&nbsp;</p></div>              
</div>
</div>
	<div class="clear"></div>	
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>