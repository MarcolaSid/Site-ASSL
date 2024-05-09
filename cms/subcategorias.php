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
    <title><?=$pr['SITE_NOME'];?> - Subcategorias</title>
	
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
<h3 style="cursor: s-resize; ">Visualizar Subcategorias</h3>

<div class="clear"></div>
</div>
<div class="content-box-content">

<!-- =================== -->
<!-- EXCLUI SUBCATEGORIA -->
<!-- =================== -->
<?php
if ($_GET['acao'] == "exclui")
{ 	
	$id = $_GET["id"];
	mysql_select_db(BD_NAME); 
	$res = mysql_query("DELETE FROM subcategoria WHERE id = '$id' ")or die(mysql_error()); 
	if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='subcategorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Registro exclu&iacute;do com sucesso...</div>
</div>
<script type="text/javascript">setTimeout('window.location.href="subcategorias.php?pagina=1"', 2000) /* 2 seconds */</script>
	<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='subcategorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel excluir o registro...</div>
</div>
<script type="text/javascript">setTimeout('window.location.href="subcategorias.php?pagina=1"', 5000) /* 5 seconds */</script>
<? } } ?>
<!-- ======================= -->
<!-- END EXCLUI SUBCATEGORIA -->
<!-- ======================= -->

<!-- =================== -->
<!-- INSERE SUBCATEGORIA -->
<!-- =================== -->
<?php
if ($_GET['acao'] == "insere")
{ 
		$nome = $_POST["nome"];
		$descricao = $_POST["descricao"];
		$categoria = $_POST['categoria'];

				$sql = "INSERT INTO subcategoria (nome, descricao, id_categoria ) VALUES ('$nome', '$descricao', $categoria)"; 
				$sql_busca = mysql_query($sql);

					if ($login) 
						{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='subcategorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Inser&ccedil;&atilde;o efetuada com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="subcategorias.php?pagina=1"', 2000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='subcategorias.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel realizar a Inser&ccedil;&atilde;o...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="subcategorias.php?pagina=1"', 5000) /* 5 seconds */</script>
<?php }	} ?>
<!-- ======================= -->
<!-- END INSERE SUBCATEGORIA -->
<!-- ======================= -->

<!-- ================== -->
<!-- LISTA SUBCATEGORIA -->
<!-- ================== -->
<table>
<?php
// Inicio paginacao
	$quantidade = 5;
	$pagina     = (isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1);
	$inicio     = ($quantidade * $pagina) - $quantidade;
	$query_rsFotos = "SELECT * FROM subcategoria ORDER BY nome DESC LIMIT $inicio, $quantidade";
	$rsFotos = mysql_query($query_rsFotos) or die(mysql_error());
	$row_rsFotos = mysql_fetch_assoc($rsFotos);
	$totalRows_rsFotos = mysql_num_rows($rsFotos);
	$sqlTotal    = "SELECT * FROM subcategoria";
	$qrTotal     = mysql_query($sqlTotal) or die(mysql_error());
	$numTotal    = mysql_num_rows($qrTotal);
	$totalPagina = ceil($numTotal/$quantidade);
// Final paginacao

	$sql = mysql_query("SELECT * FROM subcategoria ORDER BY nome ASC Limit $inicio, $quantidade") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
	{
	if ($cor=="")
	{ $cor = "#cccccc";}
	else
	{ $cor = "";}			
?>
<tr bgcolor="<?="$cor"?>">
	<td class="alignverticaltop"><?=$array['nome'];?></td>
	<td class="alignverticaltop"><?=$array['descricao'];?></td>
	<td class="alignverticaltop" width="10%"><!-- Icones -->
	<a href="./subcategoriasE.php?id=<?=$array['id'];?>" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a>
	<a href="./subcategorias.php?acao=exclui&id=<?=$array['id'];?>" title="Excluir">&nbsp;&nbsp;<img src="./img/icones/cross.png" alt="Excluir"></a></td>
</tr>                        
<?php } ?>
</table>
<div class="pagination"><?php include('paginacaos.php'); ?></div>
<!-- ====================== -->
<!-- END LISTA SUBCATEGORIA -->
<!-- ====================== -->

<div class="clear"><p>&nbsp;</p></div>

<!-- ========================= -->
<!-- INSERE SUBCATEGORIA FORM  -->
<!-- ========================= -->
<div class="insereNoticia">
<form action="subcategorias.php?acao=insere" method="post" enctype="multipart/form-data">  
	
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
			echo "<option value=\"" . $categoria[0] . "\">" . utf8_encode($categoria[1]) . "</option>";
		}
	?>
  </select>
  <br /><br />
  <p></p>
  <label>Nome da Subcategoria:</label>
  <input class="text-input large-input" type="text" id="nome" name="nome">
	<p></p>
  <label>Descri&ccedil;&atilde;o da Subcategoria:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao"></textarea>
	<p></p>
   <input class="button" type="submit" value=" Cadastrar Subcategoria ">
</form>
</div>
<!-- ============================= -->
<!-- END INSERE SUBCATEGORIA FORM  -->
<!-- ============================= -->
	              
</div>
</div>
	<div class="clear"></div>
</div>
<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>