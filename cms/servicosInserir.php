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
    <title><?=$pr['SITE_NOME'];?> - Cadastro de Serviço</title>

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

	<!-- Mapa -->
    <link href="./cep/css/main.css" rel="stylesheet" />
    <!-- END Mapa -->

	<script type="text/javascript" src="./js/tabcontent.js"></script>
	
</head>
<?php flush(); ?>
<body>
	
<div id="sidebar">
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>
	
<div id="main-content">
<div class="content-box">
			
<div class="content-box-header">
	<h3 style="cursor: s-resize; ">Cadastro de Serviço</h3>
	<div class="clear"></div>
<?php
	if ($_GET['acao'] == "insere")

	{
		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

		$titulo = $_POST["titulo"];	
		$conteudo = $_POST["conteudo"];
		$data_entrada = $_POST["data_entrada"];

	$sql = "INSERT INTO servicos (titulo, conteudo)
					VALUES ('$titulo', '$conteudo')";
	$sql_busca = mysql_query($sql);
	
	$sql = "";

	if ($login) 
	{
?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Item inserido com sucesso...</div>
</div>
<?php } else { ?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel cadastrar o item...</div>
</div>
<?php }	} ?>
</div> <!-- END .content-box-content -->

<div class="insereNoticia">
<p></p>

<form name="insere" action="servicosInserir.php?acao=insere" method="post" enctype="multipart/form-data">
	
	<label>Título:</label>
	<input class="text-input large-input" type="text" id="titulo" name="titulo">
	<p></p>

	<label>Descrição:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="conteudo" cols="79" rows="5"></textarea>
	<p></p>

	<div class="clear"></div>
	<p>&nbsp;</p>
	<input class="button" type="submit" value=" Cadastrar Serviço ">
</form>

</div>
</div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>