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
    <title><?=$pr['SITE_NOME'];?> - Imagens da P&aacute;gina Empresa</title>
	
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
	<h3 style="cursor: s-resize; ">Edi&ccedil;&atilde;o da Imagem da P&aacute;gina Empresa</h3>
	<div class="clear">
<?php 
	$id = $_GET['id'];
	
	if ($_GET['acao'] == "update")
		{
		$numeroCampos = 5;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../img/empresa/";
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
		$foto = $_FILES["conteudo"]['name'];
					
			$tmpfoto = $_FILES['conteudo']['tmp_name'];
			$destino = "../img/empresa/".$foto;
			move_uploaded_file($tmpfoto, $destino);	

			if (($foto != "") && ($foto != NULL))
				{
		$query = mysql_query("UPDATE paginas SET imagem='$foto' WHERE id = '$id' ") or die(mysql_error());  
}
	
		if ($login) 
			{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='imgEmpresa.php'"><img src="./img/cross_grey_small.png" title="Fechar essa Notifica&ccedil;&atilde;o" alt="fechar"></a>
	<div>P&aacute;gina alterada com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="imgEmpresa.php"', 2000) /* 2 seconds */</script>
<p></p>
<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='imgEmpresa.php'"><img src="./img/cross_grey_small.png" title="Fechar essa Notifica&ccedil;&atilde;o" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel efetuar a altera&ccedil;&atilde;o...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="imgEmpresa.php"', 5000) /* 5 seconds */</script>
<p></p>
<?php
} }
	$sql = mysql_query("SELECT * FROM paginas WHERE id = '$id' ") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
{  
	$foto = $array['imagem'];
?>
</div>
</div>
			
<div class="content-box-content">
<p></p>

<div class="insereNoticia">
	<form action="imgEmpresaEditar.php?acao=update&id=<?=$array['id']; ?>" method="post" enctype="multipart/form-data">
		<label>Foto da página "Empresa" <strong>&nbsp;&nbsp;&nbsp;(596x300px)</strong>:</label>
		<span class="alignverticaltop">
			<a href="../img/empresa/<?=$foto;?>" id="fancyimg"><img src="../img/empresa/<?=$foto;?>" width="450" class="borda"></a>
		</span>
		<p>&nbsp;</p>
			<label class="cabinet">
					<input id="conteudo" name="conteudo" class="file" type="file"  value="<?=$_FILES['imagem'];?>" />
			</label>
			<p>&nbsp;</p>	
		<div class="clear"></div>		
		<input class="button" type="submit" value=" Alterar Imagem ">
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