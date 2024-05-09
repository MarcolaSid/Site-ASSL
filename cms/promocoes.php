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
    <title><?=$pr['SITE_NOME'];?> - Promo&ccedil;&otilde;es</title>
	
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
	<h3 style="cursor: s-resize; ">Projetos HMD Car em Promo&ccedil;&atilde;o</h3>			
<?php 
	$id = $_GET['id'];
	if ($_GET['acao'] == "update")
	{ 	
	$destaque = $_POST['data_promocao'];

	$query = mysql_query("UPDATE produto SET data_promocao = null WHERE id='$id'") or die(mysql_error());
	if ($login) 
	{
?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='promocoes.php'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Altera&ccedil;&atilde;o efetuada com sucesso...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="promocoes.php"', 2000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='promocoes.php'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel realizar a altera&ccedil;&atilde;o...</div>
</div>
	<script type="text/javascript">setTimeout('window.location.href="promocoes.php"', 5000) /* 5 seconds */</script>
<?php	} } ?>

<div class="clear"></div>	  
</div>
<?php 
	$newp = $_GET['p'];
	$plimit = "3";
	$strSQL = mysql_query("SELECT produto.id, produto.nome, produto.descricao, produto.data_promocao, foto.path, foto.id_produto, count(produto.id)
		FROM produto JOIN foto ON foto.id_produto = produto.id WHERE produto.data_promocao IS NOT NULL GROUP BY produto.nome, foto.id_produto ORDER BY id ASC") or die(mysql_error());

	$totalrows = mysql_num_rows($strSQL);
	$pnums = ceil ($totalrows/$plimit);
	if ($newp==''){ $newp='1'; }
	$start = ($newp-1) * $plimit;
	$starting_no = $start + 1;
	if ($totalrows - $start < $plimit) { $end_count = $totalrows;
	} elseif ($totalrows - $start >= $plimit) { $end_count = $start + $plimit; }

	$sql = mysql_query("SELECT produto.id, produto.nome, produto.descricao, produto.data_promocao, foto.path, foto.id_produto, count(produto.id)
		FROM produto JOIN foto ON foto.id_produto = produto.id WHERE produto.data_promocao IS NOT NULL GROUP BY produto.nome, foto.id_produto ORDER BY id ASC LIMIT $start,$plimit") or die(mysql_error());  
		while($array = mysql_fetch_array($sql))  
	{
		$destaque = $array['data_promocao'];
				
		if ($cor=="")
	{ $cor = "#cccccc";}
		else
	{ $cor = "";}
?>			
<div class="content-box-content">
<table>
	<thead>
		<tr>
			<th width="5%">Projeto:</th>
			<th width="60%"><?=$array['nome'];?></th>
			<th width="10%" style="text-align:right;">
				<a href="./produtosE.php?id=<?=$array['id'];?>" title="Editar"><img src="./img/icones/pencil.png" alt="Editar"></a>
				<a href="./produtosV.php?acao=exclui&id=<?=$array['id'];?>" title="Excluir">&nbsp;&nbsp;<img src="./img/icones/cross.png" alt="Excluir"></a>
			</th>
		</tr>
	</thead>
<tbody>
	<tr bgcolor="<?=$cor;?>">
		<td class="alignverticaltop">&nbsp;&nbsp;&nbsp;(647x247px)<br /><a href="../images/projetos/<?=$array['path'];?>" id="fancyimg"><img src="../images/projetos/<?=$array['path'];?>" width="115" height="85" class="borda"></a>
		<br />
		</td>	
		<td class="alignverticaltop"><?=$array['descricao'];?></td>
		<td class="alignverticaltop">
			<form action="promocoes.php?acao=update&id=<?=$array['id'];?>" method="post" enctype="multipart/form-data">
			&Eacute; um Destaque?<br /><br />
				<input type="radio" name="promocao" value="" <?php if ($destaque == null) { echo ""; } else { echo "CHECKED"; } ?>>Sim &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="promocao" value="" <?php if ($destaque == null) { echo "CHECKED"; } else { echo ""; } ?>>N&atilde;o
						
				<input class="buttonpromo" type="submit" value=" Alterar Promo&ccedil;&atilde;o ">
			</form>
		</td>
	</tr>
<?php } ?>
</tbody>
</table>       
<?php
//Exibe a paginacao

if ($totalrows - $end_count > $plimit) { $var2 = $plimit;
} elseif ($totalrows - $end_count <= $plimit) { $var2 = $totalrows - $end_count; }
?>

	<div class='pagination'>
		<?php if ($newp>1) { ?>
			<a href="<?="promocoes.php?p=".($newp-1);?>">&laquo; Anterior</a>
		<?php } for ($i=1; $i<=$pnums; $i++) { if ($i!=$newp){ ?>
			<a href="<?="promocoes.php?p=$i";?>" class="number"><?php print_r("$i");?></a>
		<?php } else { ?>
			<span class="number current"><?php print_r("$i");?></span>
		<?php }} if ($newp<$pnums) { ?>
			<a href="<?="promocoes.php?p=".($newp+1);?>">Pr&oacute;ximo &raquo;</a>
		<?php } ?>
	</div>

	<div class="clear"><p></p></div>
</div>
</div>
	<div class="clear"></div>		
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>