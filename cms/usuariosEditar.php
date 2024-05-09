<?php
	//ini_set('display_errors', true);
	include "include/parametros.php";	
	include "include/_config.php";
	$dadosUsuario	=	$_SESSION['exp_user'];
	require_once("login.class.php");
	$login = new Login();
	$login->verificar("login.php");
	$user = $_SESSION['LoginUsuario'];
	$sql = "SELECT id, nivel FROM usuarios WHERE usuario = '$user'";
	$sql_query = mysql_query($sql);
	$arr_dados_usuario_logado = mysql_fetch_array($sql_query, MYSQL_ASSOC);
	$id_usuario_logado = $arr_dados_usuario_logado['id'];
	$nivel_usuario_logado = $arr_dados_usuario_logado['nivel'];
?>
<!DOCTYPE html>
<?php ob_start();?>
<html lang="pt-BR" class="no-js">
<head>
  <meta charset="utf-8">
    <title><?=$pr['SITE_NOME'];?> - Editar Cadastro de Usu&aacute;rio</title>
	
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
	<h3 style="cursor: s-resize; ">Editar Cadastro de Usu&aacute;rio</h3>
	<a href="javascript:history.go(-1)" class="btnvoltar" title=" Voltar para Lista ">Voltar para Lista</a>
	<div class="clear"></div>

<?php 
$sql = mysql_query("SELECT * FROM usuarios WHERE id = '$id' ") or die(mysql_error());
$res = mysql_fetch_assoc($sql);
$imagemBD = $res['path'];
?>

<?php
	$id = $_GET['id'];

	if ($_GET['acao'] == "update")
	{ 
		$numeroCampos = 5;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "./img/usuarios/";
		$substituir = false;

		$nomeArquivo = $_FILES["path"]["name"];
		$tamanhoArquivo = $_FILES["path"]["size"];
		$nomeTemporario = $_FILES["path"]["tmp_name"];
		
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

		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

		$imagem = $_FILES["imagem"]['name'];

		$tmpimagem = $_FILES['imagem']['tmp_name'];
		$destino = "./img/usuarios/".$imagem;
		move_uploaded_file($tmpimagem, $destino);
		
		//Insere a foto
		if (!$erro) {
			$foto_upload = $_FILES['path']['name'];
			if (!empty($foto_upload)) {
				$sql = "UPDATE usuarios SET path = '$foto_upload' WHERE id = $id";
				mysql_query($sql);
			}
		}

if (($imagem != "") && ($imagem != NULL)) { $imagem = $imagem; } else { $imagem = $imagemBD;} 

	if ($login) 
							{	
							?>	
<div class="notification success">
	<a href="#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Altera&ccedil;&atilde;o efetuada com sucesso...</div>
</div>
<?php	} else { ?>	
<div class="notification error">
	<a href="#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Ocorreu um problema ao cadastrar o item...</div>
</div>
<?php }	}	

$sql = mysql_query("SELECT * FROM usuarios WHERE id = '$id' ") or die(mysql_error());  
	if ($sql) {
		while($array = mysql_fetch_array($sql))  	
		{
			$idp = $id;
			$usuario = $array['usuario'];
			$nome = $array['nome'];
			$senha = $array['senha'];
			$email = $array['email'];
			$obs = $array['obs'];
			$fone = $array['telefone'];
			$foto = $array['path'];
			$nivel = $array['nivel'];
			
			if ($_GET['acao'] == "update") {
				if ($nivel == 1 and $id_usuario_logado <> $idp) {
					$sql = "UPDATE usuarios SET senha = '" . md5($_POST['senha']) . "'" . 
							" WHERE id = $idp";
					mysql_query($sql);
				} else {
					$email = $_POST['email'];
					$senha = $_POST['senha'];
					$telefone = $_POST['telefone'];
					$nome_completo = $_POST['nome'];
					$descricao = $_POST['descricao'];
					$nivel = $_POST['nivel'];
					$senha = $_POST['senha'];
					$nova_senha = $_POST['nova_senha'];
					$usuario_updt = $_POST['usuario'];
					
					$sql = "UPDATE usuarios SET email = '$email', telefone = '$telefone', 
							 nome = '$nome_completo', obs = '$descricao', nivel = $nivel";
					if (!empty($nova_senha)) {
						$sql .= ", senha = '" . md5($nova_senha) . "'";
					}
					
					$sql .= " WHERE usuario = '$usuario' AND senha = '" . md5($senha) . "'";
					//echo $sql;
					mysql_query($sql);
				}
			}
		} 
}

?>
</div>

<div class="insereNoticia">
<div>
<p></p>
<form action="usuariosEditar.php?acao=update&id=<?=$idp;?>" method="post" enctype="multipart/form-data">		                					

<div class="align-left user1">
  <label>Usu&aacute;rio:</label>
  <input class="text-input" type="text" id="usuario" name="usuario" value="<?=$usuario;?>">
	<p></p>
	
  <label>Senha:</label>
  <input class="text-input" type="password" id="senha" name="senha" value="" />
	<p></p>

  <label>Nova Senha:</label>
  <input class="text-input" type="password" id="senha" name="nova_senha" value="" />
	<p></p>
</div>

<div class="align-left user2">
  <label>Email:</label>
  <input class="text-input" type="text" id="email" name="email" value="<?=$email;?>">
	<p></p>
	
  <label>Telefone:</label>
  <input class="text-input" type="text" id="telefone" name="telefone" value="<?=$fone;?>">
	<p></p>
</div>

<div class="align-left user3">
	<label>Foto Usu&aacute;rio: <strong>&nbsp;&nbsp;&nbsp;(75x85px)</strong></label>
	<?php
	if ($foto) {
	?>
	<span class="alignverticaltop">
		<a href="./img/usuarios/<?=$foto;?>" id="fancyimg"><img src="./img/usuarios/<?=$foto;?>" width="85" height="85" class="borda"></a>
	</span>
	<?php
	}
	?>
	<br /><br />
	<input id="fakeupload" name="fakeupload" class="inputfile fakeupload" type="text" />
	<input id="path" name="path" class="inputfile realupload" type="file"  value="" onchange="this.form.fakeupload.value = this.value;" />
</div>

<div class="clear"></div>

<?php
//Se for administrador.
if ($nivel_usuario_logado == 1) {
?>
<label>N&iacute;vel de permiss&atilde;o:</label>
<select name="nivel">
  <?php
	if ($nivel == 1) {
		$sel_adm = "selected = selected";
	} else {
		$sel_usr = "selected = selected";
	}
  ?>
  <option <?=$sel_adm;?> value="1">Administrador</option>
  <option <?=$sel_usr;?> value="2">Usu&aacute;rio</option>
</select>
<p></p>
<?php
}
?>
  <label>Nome Completo:</label>
  <input class="text-input large-input" type="text" id="nome" name="nome" value="<?=$nome;?>">
	<p></p>

	<label>Observa&ccedil;&otilde;es:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao" cols="79" rows="5"><?=$obs;?></textarea>
  <p></p>

	<div class="clear"></div>
	<p>&nbsp;</p>
	<input class="button" type="submit" value=" Alterar Cadastro ">
</form>
				

<div class="clear"></div>
</div>

</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>