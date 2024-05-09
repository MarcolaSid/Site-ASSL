<?php header("Content-Type: text/html; charset=iso-8859-1",true) ?>
<?php
	ini_set('display_errors', false);
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
    <title><?=$pr['SITE_NOME'];?> - Cadastro de Destaque</title>

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
	<h3 style="cursor: s-resize; ">Cadastro de Destaque</h3>
	<div class="clear"></div>
<?php
	if ($_GET['acao'] == "insere")
	{ 
		$numeroCampos = 5;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../images/clientes/";
		$substituir = false;		
		//exit;		
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
					$erro .= "O arquivo " . $nomeArquivo . " nao deve ultrapassar " . $tamanhoMaximo. " bytes";
				} 
				elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
					$erro .= "A extensao do arquivo <b>" . $nomeArquivo . "</b> nao e valida";
				} 
				elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
					$erro .= "O arquivo <b>" . $nomeArquivo . "</b> ja existe";
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

		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

		$nome = $_POST["nome"];
		$mensagem = $_POST["mensagem"];
		
		$foto = $_FILES["imagem"]['name'];

		$tmpfoto = $_FILES['imagem']['tmp_name'];
		$destino = "../images/clientes/".$foto;
		move_uploaded_file($tmpfoto, $destino);	

	$sql = "INSERT INTO cliente (nome, mensagem, imagem, data_criacao)
					VALUES ('$nome', '$mensagem', '$foto', NOW())";
	$sql_busca = mysql_query($sql);
		
	if ($login) 
	{
?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Destaque inserido com sucesso...</div>
</div>
<?php } else { ?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel cadastrar o Destaque...</div>
</div>
<?php }	} ?>
</div> <!-- END .content-box-content -->

<div class="insereNoticia">
<p></p>

<form name="insere" action="clienteI.php?acao=insere" method="post" enctype="multipart/form-data">
  	<label>Nome:</label>
  	<input class="text-input large-input" type="text" id="nome" name="nome">
	<p></p>

	<label>Mensagem:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="mensagem" cols="79" rows="15"><?=$array['mensagem'];?></textarea>
	<p></p>
	
	<div class="align-left imagem1">
    <label>Imagem: <br /><strong>(60x60)</strong></label>
		<span class="alignverticaltop">
				<input id="fakeupload" name="fakeupload" type="text" class="inputfile fakeupload" />
		</span>
		<input type="file" id="imagem" name="imagem" onchange="this.form.fakeupload.value = this.value;" class="inputfile realupload" />
	</div>
	

	<div class="clear"></div>
	<p>&nbsp;</p>
	<input class="button" type="submit" value=" Cadastrar Destaque ">
</form>
</div>

</div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>