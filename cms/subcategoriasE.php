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
  <meta charset="iso-8859-1">
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
	
	<div id="main-content"> <!-- Conteudo central contendo tudo -->
		<div class="content-box"><!-- BEGIN Content Box -->
			
			<div class="content-box-header">
				<h3 style="cursor: s-resize; ">Edi&ccedil;&atilde;o de Catgorias</h3>
				<div class="clear">
<?php 
	$id = $_GET['id'];
	
	if ($_GET['acao'] == "update")
		{

		$id = $_GET['id'];		
		$nome = $_POST['nome'];
		$descricao = $_POST["descricao"];
		$id_categoria = $_POST['categoria'];

		$query = mysql_query("UPDATE subcategoria SET nome='$nome', descricao='$descricao', id_categoria = $id_categoria WHERE id = '$id' ") or die(mysql_error());  
	
		if ($login) 
			{
?>
		<div class="notification success">
			<a href="#" class="close" onclick="window.location.href='subcategorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
			<div>P&aacute;gina alterada com sucesso...</div>
		</div>
			<script type="text/javascript">setTimeout('window.location.href="subcategorias.php?pagina=1"', 2000) /* 2 seconds */</script>		
		<p></p>
<?php
			} 
		else
			{
?>
		<div class="notification error">
			<a href="#" class="close" onclick="window.location.href='subcategorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
			<div>N&atilde;o foi poss&iacute;vel efetuar a altera&ccedil;&atilde;o...</div>
		</div>
			<script type="text/javascript">setTimeout('window.location.href="subcategorias.php?pagina=1"', 5000) /* 5 seconds */</script>		
    <p></p>
<?php
}	}
	$sql = mysql_query("SELECT * FROM subcategoria WHERE id = '$id' ") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
{  
?>
			  </div>
		  </div> <!-- END .content-box-header -->
			
		  <div class="content-box-content">
           <p></p>
           
<div class="insereNoticia">
	<form action="subcategoriasE.php?acao=update&id=<?=$array['id'];?>" method="post" enctype="multipart/form-data">
	<?php
	//Retorna as categorias para inserir a relação subcategoria x categoria.
	$sql = "SELECT id, nome FROM categoria";
	$resultado = mysql_query($sql);
	while ($row = (mysql_fetch_array($resultado, MYSQL_ASSOC))) {
		$arr_categorias[] = array($row['id'], $row['nome']);
	}
	?>
   <label>Selecione a Categoria: </label>
   <select name="categoria">
	<?php
		foreach ($arr_categorias as $categoria) {
			if ($array['id_categoria'] == $categoria[0]) {
				echo "<option selected=\"selected\" value=\"" . $categoria[0] . "\">" . $categoria[1] . "</option>";
			} else {
				echo "<option value=\"" . $categoria[0] . "\">" . $categoria[1] . "</option>";
			}
		}
	?>
   </select>
  <br /><br />
  <p></p>
	<label>Nome:</label>
		<input class="text-input medium-input" type="text" id="nome" name="nome" value="<?=$array['nome'];?>">
	<p></p>
 
	<label>Decri&ccedil;&atilde;o:</label>
		<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao"><?=$array['descricao'];?></textarea>
	<p></p>
  
		<input class="button" type="submit" value=" Alterar Subcategoria ">
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