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
    <title><?=$pr['SITE_NOME'];?> - Empreendimentos em Destaque</title>
	
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
<h3 style="cursor: s-resize; ">Lista de empreendimentos em destaque</h3>

<div class="clear"></div>
</div>
<div class="content-box-content">

<!-- ====================== -->
<!-- ALTERA PROJETOS CB     -->
<!-- ====================== -->
<?php
if ($_GET['acao'] == "update")
	{
		
$id = $_GET['id'];		
$produto_costabrava = $_POST['produto_costabrava'];

$query = mysql_query("UPDATE categoria SET produto_costabrava = '$produto_lab' WHERE id = '$id' ") or die(mysql_error());  

if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='empreendimentosCB.php'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Registro alterado com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="empreendimentosCB.php"', 2000) /* 2 seconds */</script>
	<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='empreendimentosCB.php'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Não foi possível alterar o registro...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="empreendimentosCB.php"', 5000) /* 5 seconds */</script>
<? } } ?>
<!-- ========================== -->
<!-- END ALTERA PROJETOS CB     -->
<!-- ========================== -->

<!-- ===================== -->
<!-- LISTA PROJETOS CB     -->
<!-- ===================== -->
<table>
<?php
	$sql = mysql_query("SELECT * FROM categoria WHERE produto_costabrava = '1' ORDER BY id ASC") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
	{
	if ($cor=="")
	{ $cor = "#cccccc";}
	else
	{ $cor = "";}			
?>
<tr bgcolor="<?="$cor"?>">
	<td class="alignverticaltop"><?=$array['nome'];?></td>
	<td class="alignverticaltop"><?=$array['descricao'];?></td>
	<td class="alignverticaltop" width="130px">
	<!-- Icones -->
	<form action="empreendimentosCB.php?acao=update&id=<?=$array['id'];?>" method="post" enctype="multipart/form-data">
		<label>Empreendimentos Costa Brava:</label>
			<?php
				if($array['produto_costabrava'] == 1) {
					$chk_s = '"checked = checked"';
				} else {
					$chk_n = '"checked = checked"';
				}
			?>
			<input type="radio" value="1" name="produto_costabrava" <?=$chk_s;?>> Sim
			<input type="radio" value="0" name="produto_costabrava" <?=$chk_n;?>> Não

		<input class="button" type="submit" value=" Alterar ">			
	</form>
</tr>                        
<?php } ?>
</table>
<!-- ========================= -->
<!-- END LISTA PROJETOS CB     -->
<!-- ========================= -->

<div class="clear"><p>&nbsp;</p></div>

</div>
</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>