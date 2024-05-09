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
    <title><?=$pr['SITE_NOME'];?> - Slides</title>
	
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
	<h3 style="cursor: s-resize; ">Edi&ccedil;&atilde;o dos Slides</h3>
	<div class="clear">

<?php 
	$sql = mysql_query("SELECT * FROM slides WHERE id='$id'") or die(mysql_error());
	$res = mysql_fetch_assoc($sql);
	$imagemBD = $res['imagem'];

	$id = $_GET['id'];
	
	if ($_GET['acao'] == "update" and is_numeric($id) and !empty($id))
	{ 
//		$numeroCampos = 5;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../images/slides/";
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

		/////////////////////////////////////////////////////
		//Script para atualizar os dados no bando de dados://
		/////////////////////////////////////////////////////

		$id = $_GET["id"];		

		$titulo = $_POST["titulo"];		
		$linkurl = $_POST["linkurl"];										

		$data_slide = $_POST["data_slide"];
		$data_slide = ($data_slide == "sim") ? "NOW()" : "null";

		$switch = $_POST["switch"];

		$imagem = $_FILES["imagem"]['name'];					
			$tmpiamgem = $_FILES['iamgem']['tmp_name'];
			$destino = "../images/slides/".$imagem;
			move_uploaded_file($tmpimagem, $destino);	

			if (($imagem != "") && ($imagem != NULL))
				{

			// if (($imagem != "") && ($imagem != NULL)) { $imagem = $imagem; } else { $imagem = $imagemBD;} 
						
		$sql_query_update = "UPDATE slides SET titulo='$titulo', linkurl='$linkurl', data_slide='$data_slide', imagem='$imagem', switch='$switch' WHERE id='$id'";
		$query = mysql_query($sql_query_update) or die(mysql_error());
}
	if ($login) 
							{	
							?>	
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='slides.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>Registro alterado com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="slides.php?pagina=1"', 2000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='#'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>

<?php }	
}	

	$sql = mysql_query("SELECT * FROM slides WHERE id = '$id' ") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
{ 
	$foto = $array['imagem']; 
	$titulo_slide = $array['titulo']; 
	$linkurl_slide = $array['linkurl'];
	$data_slide = $array['data_slide'];	
	$switch = $array['switch'];		
}		
?>
</div>
</div>
			
<div class="content-box-content">
<p></p>

<div class="insereNoticia">
	<form action="slidesEditar.php?acao=update&id=<?=$id;?>" method="post" enctype="multipart/form-data">
		<label>Imagem <strong>&nbsp;&nbsp;&nbsp;(960x350px)</strong>:</label>
		<span class="alignverticaltop">
			<a href="../images/slides/<?=$foto;?>" id="fancyimg"><img src="../images/slides/<?=$foto;?>" height="150" class="borda"></a>
		</span>
		<p>&nbsp;</p>
		
		<label class="cabinet">
			<input class="file" type="file" id="imagem" name="imagem" value="<?=$_FILES['imagem'];?>" />
		</label>
		<p>&nbsp;</p>	

        <label>Slide na Home:</label>
			<input type="checkbox" name="switch" value="2" <?php if ($switch == 2) { echo "checked"; } else { echo ""; } ?>>Sim
			<input type="checkbox" name="switch" value="1" <?php if ($switch == 1) { echo "checked"; } else { echo ""; } ?>>N&atilde;o
		<p></p>
		
		<label>Título:</label>
			<input class="text-input large-input" type="text" id="titulo" name="titulo" value="<?=$titulo_slide;?>">
		<p></p>

		<label>Link (URL):</label>
			<input class="text-input large-input" type="text" id="linkurl" name="linkurl" value="<?=$linkurl_slide;?>">
		<p></p>

	<div class="clear"></div>
		<input class="button" type="submit" value=" Alterar Slide ">
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