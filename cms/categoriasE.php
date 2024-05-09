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
    <title><?=$pr['SITE_NOME'];?> - Edi&ccedil;&atilde;o de Categorias</title>
	
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
				<h3 style="cursor: s-resize; ">Edi&ccedil;&atilde;o de Categorias</h3>
				<a href="javascript:history.go(-1)" class="btnvoltar" title=" Voltar para Lista ">Voltar para Categorias</a>				
			<div class="clear">
<?php 
	$id = $_GET['id'];
	
	if ($_GET['acao'] == "update")
		{
		
		$numeroCampos = 5;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../uploads/extras/";
		$substituir = false;
		
		for ($i = 0; $i < $numeroCampos; $i++) {
			
			$nomeArquivo = $_FILES["arquivo"]["name"][$i];
			$tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
			$nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
			
			if (!empty($nomeArquivo)) {
			
				$erro = false;
			
				if ($tamanhoArquivo > $tamanhoMaximo) {
					$erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
				} 
				elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
					$erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
				} 
				elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
					$erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
				}
			
				if (!$erro) {
					move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
					
					echo "O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso.<br />";
				} 
				else {
					echo $erro . "<br />";
				}
			}		
		}

		$id = $_GET['id'];		
		$nome = $_POST['nome'];
		$descricao = $_POST["descricao"];

		$query = mysql_query("UPDATE categoria SET nome='$nome', descricao='$descricao' WHERE id = '$id' ") or die(mysql_error());  
	
		if ($login) 
			{
?>
		<div class="notification success">
			<a href="#" class="close" onclick="window.location.href='categorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa Mensagem" alt="fechar"></a>
			<div>P&aacute;gina alterada com sucesso...</div>
		</div>
			<script type="text/javascript">setTimeout('window.location.href="categorias.php?pagina=1"', 2000) /* 2 seconds */</script>		
		<p></p>
<?php
			} 
		else
			{
?>
		<div class="notification error">
			<a href="#" class="close" onclick="window.location.href='categorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa Mensagem" alt="fechar"></a>
			<div>N&atilde;o foi poss&iacute;vel efetuar a altera&ccedil;&atilde;o...</div>
		</div>
			<script type="text/javascript">setTimeout('window.location.href="categorias.php?pagina=1"', 5000) /* 5 seconds */</script>	
    <p></p>
<?php
}	}
	$sql = mysql_query("SELECT * FROM categoria WHERE id = '$id' ") or die(mysql_error());  
		while($array = mysql_fetch_array($sql))  
{  
?>
</div>
</div> <!-- END .content-box-header -->
			
<div class="content-box-content">
<p></p>

<div class="insereNoticia">
	<form action="categoriasE.php?acao=update&id=<?=$array['id'];?>" method="post" enctype="multipart/form-data">

	<label>Nome da Categoria:</label>
		<input class="text-input medium-input" type="text" id="nome" name="nome" value="<?=utf8_encode($array['nome']);?>">
	<p></p>

	<label>Decri&ccedil;&atilde;o da Categoria:</label>
		<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao" cols="79" rows="5"><?=utf8_encode($array['descricao']);?></textarea>
	<p></p>
 
		<input class="button" type="submit" value=" Alterar Categoria ">
	<?php } ?>
	</p>
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