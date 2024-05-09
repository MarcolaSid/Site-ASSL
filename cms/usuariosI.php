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
    <title><?=$pr['SITE_NOME'];?> - Cadastro de Usu&aacute;rios</title>

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
	<h3 style="cursor: s-resize; ">Cadastro de Usu&aacute;rios</h3>
	<div class="clear"></div>
<?php
	if ($_GET['acao'] == "insere")
	{ 
		$numeroCampos = 5;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../img/produtos/";
		$substituir = false;
		
		for ($i = 0; $i < $numeroCampos; $i++) {
			$nomeArquivo = $_FILES["arquivo"]["name"][$i];
			$tamanhoArquivo = $_FILES["arquivo"]["size"][$i];
			$nomeTemporario = $_FILES["arquivo"]["tmp_name"][$i];
			
			if (!empty($nomeArquivo)) {
			
				$erro = false;
			
				if ($tamanhoArquivo > $tamanhoMaximo) {
					$erro = "O arquivo " . $nomeArquivo . " nao deve ultrapassar " . $tamanhoMaximo. " bytes";
				} 
				elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
					$erro = "A extensao do arquivo <b>" . $nomeArquivo . "</b> nao e valida";
				} 
				elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
					$erro = "O arquivo <b>" . $nomeArquivo . "</b> ja existe";
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

		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

	$usuario = $_POST["usuario"];
	$nome = $_POST["nome"];
	$senha = md5($_POST["senha"]);
	$email = $_POST["email"];
	$fone = $_POST["telefone"];
	$obs = $_POST["obs"];

	$imagem = $_FILES["imagem"]['name'];

	$tmpimagem = $_FILES['imagem']['tmp_name'];
	$destino = "../img/usuarios/".$imagem;
	move_uploaded_file($tmpimagem, $destino);

	$sql = "INSERT INTO usuarios (usuario, nome, senha, email, telefone, obs, imagem)
					VALUES ('$usuario', '$nome', '$senha', '$email', '$telefone', '$obs', '$imagem')";
	$sql_busca = mysql_query($sql);
	if ($login) 
	{
?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Usu&aacute;rio cadastrado com sucesso...</div>
</div>
<?php } else { ?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel cadastrar o usu&aacute;rio...</div>
</div>
<?php }	} ?>
</div> <!-- END .content-box-content -->

<div class="insereNoticia">
<p></p>

<form action="usuariosI.php?acao=insere" method="post" enctype="multipart/form-data">
<label>
  <label>Usu&aacute;rio:</label>
  <input class="text-input large-input" type="text" id="usuario" name="usuario">
	<p></p>

  <label>Nome Completo:</label>
  <input class="text-input large-input" type="text" id="nome" name="nome">
	<p></p>

  <label>Senha:</label>
  <input class="text-input large-input" type="password" id="senha" name="senha">
	<p></p>

  <label>Confirme a Senha:</label>
  <input class="text-input large-input" type="password" id="senhaconfere" name="senhaconfere">
	<p></p>

  <label>E-mail:</label>
  <input class="text-input large-input" type="text" id="email" name="email">
	<p></p>

  <label>Telefone:</label>
  <input class="text-input large-input" type="text" id="telefone" name="telefone">
	<p></p>

	<label>Observa&ccedil;&otilde;es:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="obs" cols="79" rows="5"></textarea>
  <p></p>

	<div class="align-left imagem1">
    <label>Imagem: <br /><strong>&nbsp;&nbsp;&nbsp;(75x85px)</strong></label>
		<span class="alignverticaltop">
				<input id="fakeupload" name="fakeupload" type="text" class="inputfile fakeupload" />
				<input id="imagem" name="imagem" type="file" value="imagem" onchange="this.form.fakeupload.value = this.value;" class="inputfile realupload" />
	</div>

	<div class="clear"></div>
	<p>&nbsp;</p>
	<input class="button" type="submit" value=" Cadastrar Usu&aacute;rio ">
</form>
</div>

</div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>