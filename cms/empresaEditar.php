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
    <title><?=$pr['SITE_NOME'];?> - Editar Empresa</title>
	
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
	<h3 style="cursor: s-resize; ">Edi&ccedil;&atilde;o da P&aacute;gina Empresa</h3>
	<div class="clear">
<?php 
	$id = '1';

	if ($_GET['acao'] == "update" and is_numeric($id) and !empty($id))
	{ 
		$numeroCampos = 4;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../images/";
		$substituir = false;
		
		for ($i = 0; $i < count($_FILES['path']); $i++) {
			
			$nomeArquivo = $_FILES["imagem"]["name"][$i];
			$tamanhoArquivo = $_FILES["imagem"]["size"][$i];
			$nomeTemporario = $_FILES["imagem"]["tmp_name"][$i];
			if ($_FILES["imagem"]["error"][$i] <> 0) {
				$arr_erros_img[] = $i;
			}
			if (!empty($nomeArquivo)) {
			
				$erro = false;
			
				if ($tamanhoArquivo > $tamanhoMaximo) {
					$erro = "O arquivo " . $nomeArquivo . " n&atilde;o deve ultrapassar " . $tamanhoMaximo. " bytes";
				} 
				elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
					$erro = "A extens&atilde;o do arquivo <b>" . $nomeArquivo . "</b> n&atilde;o &eacute; v&aacute;lida";
				} 
				elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
					$erro = "O arquivo <b>" . $nomeArquivo . "</b> j&aacute; existe";
				}
			
				if (!$erro) {
					move_uploaded_file($nomeTemporario, ($caminho . $nomeArquivo));
					
					echo "
						<div class='notification success'>
							<a href='#' class='close'><img src='./img/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
						<div>O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso...</div>
						</div>
							<script type='text/javascript'>setTimeout('window.location.href='#'', 2000) /* 2 seconds */</script>
							";
				} 
				else {
					
					echo"
						<div class='notification error'>
							<a href='#' class='close' onclick='window.location.href='#''><img src='./img/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
						<div>$erro ...</div>
						</div>					
					";
//					echo $erro . "<br />";
				}
			}
		}
		
		
		$id = '1';		
		$titulo = $_POST["titulo"];				
		$conteudo = $_POST["conteudo"];
		
		$foto = $_FILES["imagem"]['name'];

		$tmpfoto = $_FILES['imagem']['tmp_name'];
		$destino = "../images/".$foto;
		move_uploaded_file($tmpfoto, $destino);	

		  if (($foto != "") && ($foto != NULL)) { $foto = $foto; } else { $foto = $imagemBD;}		
		
		$query = mysql_query("UPDATE paginas SET titulo='$titulo', conteudo='$conteudo', imagem='$foto' WHERE id = '1' ") or die(mysql_error());
	
		if ($login) 
			{
?>
<div class="notification success">
	<a href="./index.php" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa Notifica&ccedil;&atilde;o" alt="fechar"></a>
	<div>P&aacute;gina alterada com sucesso...</div>
</div>
<p></p>
<?php } else { ?>
<div class="notification error">
	<a href="./index.php" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa Notifica&ccedil;&atilde;o" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel efetuar a altera&ccedil;&atilde;o...</div>
</div>
<p></p>
<?php
} }
$sql = mysql_query("SELECT * FROM paginas WHERE id = '$id' ") or die(mysql_error());  
while($array = mysql_fetch_array($sql))  
{  
?>
</div>
</div>
			
<div class="content-box-content">
<p></p>

<div class="insereNoticia">
	<form action="empresaEditar.php?acao=update&id=1" method="post" enctype="multipart/form-data">

	<label>Título:</label>
	<input class="text-input large-input" type="text" id="titulo" name="titulo" value="<?=$array['titulo'];?>">
	<p></p>
	
	<label>Texto:</label>
		<textarea class="text-input textarea wysiwyg" id="textarea" name="conteudo" cols="79" rows="15"><?=$array['conteudo'];?></textarea>
	<p></p>
	
	<label>Imagem: <br /><strong>(960x250)</strong></label>
	<span class="alignverticaltop">
		<a href="../images/<?=$array['imagem'];?>" id="fancyimg"><img src="../images/<?=$array['imagem'];?>" width="250" class="borda"></a>
	</span>
	<p>&nbsp;</p>
	<label class="cabinet">
			<input id="imagem" name="imagem" class="file" type="file"  value="<?=$_FILES['imagem'];?>" />
	</label>
	
	
	<input class="button" type="submit" value=" Alterar ">
	<?php } ?>
	</form>
</div>
            
</div>
</div>
	<div class="clear"></div>
</div>
	<?php include ("./include/javascript.php"); ?>
</body>
</html>
<?php ob_end_flush(); ?>