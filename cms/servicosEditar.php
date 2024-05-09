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
    <title><?=$pr['SITE_NOME'];?> - Editar Projeto</title>
	
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

	<script language="javascript" type="text/javascript">
	function getXMLHTTP() { //fuction to return the xml http object
			var xmlhttp=false;	
			try{
				xmlhttp=new XMLHttpRequest();
			}
			catch(e)	{		
				try{			
					xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e){
					try{
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch(e1){
						xmlhttp=false;
					}
				}
			}

			return xmlhttp;
	    }

		function getSubCategoria(categId) {		

			var strURL="achaCategoria.php?categ="+categId;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('subcategoriadiv').innerHTML=req.responseText;						
						} else {
							alert("Ocorreu um problema ao utilizar XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}		
		}
	</script>	
</head>
<?php flush(); ?>
<body>

<div id="sidebar">
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>
	
<div id="main-content">
<div class="content-box">
			
<div class="content-box-header">
	<h3 style="cursor: s-resize; ">Editar Projeto</h3>

	<!-- BEGIN MENU ABAS -->
	<ul id="insereprodutos" class="shadetabs">
		<li class="button"><a href="#" rel="tabproduto" class="selected">Projeto</a></li>
		<li class="button button-right"><a href="projetosVisualizar.php?pagina=1" title=" Voltar para Lista ">Voltar para Lista</a></li>
	</ul>

	<div class="clear"></div>

<?php 
$sql = mysql_query("SELECT * FROM foto WHERE id = '$id' ") or die(mysql_error());
$res = mysql_fetch_assoc($sql);
$imagemBD = $res['path'];
?>

<?php
	$id = $_GET['id'];
	if ($_GET['acao'] == "update" and is_numeric($id) and !empty($id)) 
	{ 
		$numeroCampos = 1;
		$tamanhoMaximo = 2097152;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../images/projetos/";
		$substituir = false;
		
		for ($i = 0; $i < count($_FILES['path']); $i++) {
			
			$nomeArquivo = $_FILES["path"]["name"][$i];
			$tamanhoArquivo = $_FILES["path"]["size"][$i];
			$nomeTemporario = $_FILES["path"]["tmp_name"][$i];
			if ($_FILES["path"]["error"][$i] <> 0) {
				$arr_erros_img[] = $i;
			}
			$url = "projetosEditar.php?id=".$_GET['id'];
			if (!empty($nomeArquivo)) {
			
				$erro = false;
			
				if ($tamanhoArquivo > $tamanhoMaximo) {
					//$erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
				} 
				elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
					//$erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
				} 
				elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
					//$erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
				}
			
				if (!$erro) {
					$ext = end(explode(".",$nomeArquivo));
					$furl = md5(uniqid($nomeArquivo)).".$ext";
					
					move_uploaded_file($nomeTemporario, ($caminho . $furl));
								
					$sql = "INSERT INTO foto (id_projeto, path, descricao) VALUES ($id, '$furl', '')";
					$q = mysql_query($sql);		
					if(!$q){echo mysql_error();exit;}
					
					echo "
						<div class='notification success'>
							<a href='#' class='close'><img src='./img/icones/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
						<div>O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso...</div>
						</div>
							<script type='text/javascript'>setTimeout(function(){window.location.href='".$url."'}, 1000)</script>
							";
				} 
				else {
					
					echo"
						<div class='notification error'>
							<a href='#' class='close' onclick='window.location.href='".$url."''><img src='./img/icones/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
						<div>$erro ...</div>
						</div>					
					";
					echo $erro . "<br />";
				}
			}
		}

		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

			$id = $_GET["id"];
			$titulo = $_POST["titulo"];
			$descricao = $_POST["conteudo"];

$sql_query_update = "UPDATE servicos SET titulo='$titulo', conteudo='$descricao' WHERE id='$id'";

$query = mysql_query($sql_query_update) or die(mysql_error()); 
	if ($login) 
							{	
							?>	
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='servicosVisualizar.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>Registro alterado com sucesso...</div>
<?php
    $url = "servicosEditar.php?id=".$_GET['id'];
    echo "<script> var int = setTimeout( function(){window.location = '$url'},1000);</script>";	
?>
</div>
	<script type="text/javascript">setTimeout('window.location.href="servicosVisualizar.php?pagina=1"', 52000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='#'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>Não foi possível excluir o registro...</div>
</div>

<?php }	
}	

$sql = mysql_query("SELECT * FROM servicos WHERE id = '$id' ") or die(mysql_error());  

	while($array = mysql_fetch_array($sql))  	
{
	$idp = $id;
	$titulo = $array['titulo'];
	$descricao = $array['conteudo'];
}
	
?>
</div>

<div class="insereNoticia">
<p></p>
	<form action="servicosEditar.php?acao=update&id=<?=$idp;?>" method="post" enctype="multipart/form-data">

		<div class="tabcontent" id="tabproduto">          

   			<label>Título:</label>
   			<input class="text-input large-input" type="text" id="titulo" name="titulo" value="<?=$titulo;?>">
			<p></p>

			<label>Descrição:</label>
			<textarea class="text-input textarea wysiwyg" id="textarea" name="conteudo" cols="79" rows="5"><?=$descricao;?></textarea>
      		<p></p>
    
		</div> <!-- Final tabprodutos -->


			<div class="clear"></div>
			<p>&nbsp;</p>          
    			
			<input class="button" type="submit" value=" Alterar Serviço ">
		</form>

<script type="text/javascript">
		var prods=new ddtabcontent("insereprodutos")
		prods.setpersist(true)
		prods.setselectedClassTarget("link")
		prods.init()
</script>
<!-- END ABAS -->
</div>

<div class="clear"></div>
</div>

</div>
	<div class="clear"></div>
</div>

	<?php include ('./include/javascript.php'); ?>
    	
</body>
</html>
<?php ob_end_flush(); ?>