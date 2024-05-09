<?php
	error_reporting(E_ALL^E_NOTICE);
	ini_set('display_errors', true);
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
    <title><?=$pr['SITE_NOME'];?> - Editar An&uacute;ncio</title>
	
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
	<h3 style="cursor: s-resize; ">Editar An&uacute;ncio</h3>
	<a href="javascript:history.go(-1)" class="btnvoltar" title=" Voltar para Lista ">Voltar para Lista</a>
	<div class="clear"></div>

<?php 
$sql = mysql_query("SELECT * FROM anuncios WHERE id='$id'") or die(mysql_error());
$res = mysql_fetch_assoc($sql);
$imagemBD = $res['imagem'];
?>

<?php
	$id = $_GET['id'];
	//print_r($_FILES);
	//print_r($_POST['fakeupload']);
	if ($_GET['acao'] == "update" and is_numeric($id) and !empty($id))
	{ 
		$numeroCampos = 4;
		$tamanhoMaximo = 1000000;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "./images/anuncios/";
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

		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

			$nome = $_POST["nome"];
			$mensagem = $_POST["mensagem"];	
			$link = $_POST["link"];									
			
			$foto = $_FILES["imagem"]['name'];

				$tmpfoto = $_FILES['imagem']['tmp_name'];
				$destino = "../images/anuncios/".$foto;
				move_uploaded_file($tmpfoto, $destino);	

				// if (($foto != "") && ($foto != NULL))
				// 	{

						if (($foto != "") && ($foto != NULL)) { $foto = $foto; } else { $foto = $imagemBD;} 

			$sql_query_update = "UPDATE anuncios SET nome='$nome', mensagem='$mensagem', link='$link', imagem='$foto', data_criacao=NOW() WHERE id='$id'";
			$query = mysql_query($sql_query_update) or die(mysql_error()); 			

// }	

if ($login) {	

?>	
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='anuncioV.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>Registro alterado com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="anuncioV.php?pagina=1"', 2000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='#'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>

<?php }	
}	

$sql = mysql_query("SELECT * FROM anuncios WHERE id='$id'") or die(mysql_error());  

	while($array = mysql_fetch_array($sql))  	
{
	$nome = $array['nome'];
	$mensagem = $array['mensagem'];	
	$link = $array['link'];		
	$foto = $array['imagem'];
}

?>
</div>

<div class="insereNoticia">
<div>
<p></p>
<form action="anuncioE.php?acao=update&id=<?=$id;?>" method="post" enctype="multipart/form-data">
		                
		<label>Nome:</label>
			<input class="text-input large-input" type="text" id="nome" name="nome" value="<?=$nome;?>">
		<p></p>

		<label>Link:</label>
			<input class="text-input large-input" type="text" id="link" name="link" value="<?=$link;?>">
		<p></p>

		<label>Texto:</label>
			<input class="text-input large-input" type="text" id="mensagem" name="mensagem" value="<?=$mensagem;?>">
		<p></p>
					
		<div class="align-left">
			<label>Imagem: <br /><strong>(204x194px)</strong></label>
			<span class="alignverticaltop">
				<a href="../images/clientes/<?=$foto;?>" id="fancyimg"><img src="../images/anuncios/<?=$foto;?>" width="90" class="borda"></a>
			</span>
			<p>&nbsp;</p>
				<label class="cabinet">
						<input id="imagem" name="imagem" class="file" type="file"  value="<?=$_FILES['imagem'];?>" />
				</label>
		</div>

					<div class="clear"></div>
					<p>&nbsp;</p>
					<input class="button" type="submit" value=" Alterar An&uacute;ncio ">
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