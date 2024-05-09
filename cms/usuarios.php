<?php header("Content-Type: text/html; charset=utf-8",true) ?>
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
  <meta charset="<?=$pr['UTF8'];?>">
    <title><?=$pr['SITE_NOME'];?> - Empresa</title>
	
	<!-- CSS -->
	<link rel="stylesheet" href="./css/reset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/estilos.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/invalid.css" type="text/css" media="screen">	
	<link rel="stylesheet" href="<?=$pr['TEMA'];?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/screentable.css" type="text/css" media="screen" title="default" />	
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
	<h3 style="cursor: s-resize; "><?=$pr['SITE_NOME'];?> - Usu&aacute;rios</h3>
	<div class="clear"></div>		  
</div>
			
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">		
			<!--  start table-content  -->
			<div id="table-content">
			
				<!--  Mensagem de Erro -->
				<!-- <div id="message-red">
				<table border="0" width="700px" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">Ocorreu um erro. <a href="">Tente novamente.</a></td>
					<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div> -->
				<!--  END Mensagem de Erro -->
							
				<!--  Mensagem de Sucesso -->
				<!-- <div id="message-green">
				<table border="0" width="700px" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">Usuário adicionado com sucesso. <a href="">Adicionar outro.</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div> -->
				<!--  END Mensagem de Sucesso -->
		
		 
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="620px" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check" width="18px"><a id="toggle-all" ></a></th>
					<th class="table-header-repeat line-left" width="80px"><a href="">Usuário</a></th>
					<th class="table-header-repeat line-left" width="250px"><a href="">Nome</a></th>
					<th class="table-header-repeat line-left" width="150px"><a href="">Email</a></th>
					<th class="table-header-repeat line-left" width="100px"><a href="">Opções</a></th>
				</tr>
				<?php 
					$sql = mysql_query("SELECT * FROM usuarios") or die(mysql_error());  
						while($array = mysql_fetch_array($sql))  
					{
						$usuario = $array['usuario'];
						$nomeusuario = $array['nome'];
						$emailusuario = $array['email'];
						$foneusuario = $array['fone'];

						if ($cor=="")
					{ $cor = "#cccccc";}
						else
					{ $cor = "";}
				?>
				<tr bgcolor="<?="$cor"?>">
					<td><input type="checkbox" width="18px" /></td>
					<td width="80px"><?=$usuario?></td>
					<td width="250px"><?=$nomeusuario?></td>
					<td width="150px"><?=$emailusuario?></td>
					<td width="100px">
						<a href="" title="Editar" class="icon-1 info-tooltip"></a>
						<a href="" title="Excluir" class="icon-2 info-tooltip"></a>
						<a href="" title="Ativar/Desativar" class="icon-5 info-tooltip"></a>
					</td>
				</tr>
				<?php } ?>
				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
			<!--  start actions-box ............................................... -->
			<div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					<a href="" class="action-edit">Editar</a>
					<a href="" class="action-delete">Excluir</a>
				</div>
				<div class="clear"></div>
			</div>
			<!-- end actions-box........... -->
			
			<!--  start paging..................................................... -->
			<div id="paginacao-box">
			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
			<td>
				<a href="" class="page-far-left"></a>
				<a href="" class="page-left"></a>
				<div id="page-info">Página <strong>1</strong> / 15</div>
				<a href="" class="page-right"></a>
				<a href="" class="page-far-right"></a>
			</td>
			</tr>
			</table>
			</div>
			<!--  end paging................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->




















</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>