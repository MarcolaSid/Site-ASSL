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
    <title><?=$pr['SITE_NOME'];?> - Editar Usu&aacute;rios</title>
	
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
			
		<!--  Inicio da tabela ...................................................................... START -->
		<div id="content-table-inner">		
			<!--  inicio do conteudo  -->
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
		
		 
				<!--  Tabela de usuarios ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="620px" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-repeat line-left" width="80px"><a href="">Usu&aacute;rios</a></th>
					<th class="table-header-repeat line-left" width="250px"><a href="">Nome</a></th>
					<th class="table-header-repeat line-left" width="200px"><a href="">Email</a></th>
					<th class="table-header-repeat line-left" width="100px"><a href="">Op&ccedil;&otilde;es</a></th>
				</tr>
				<?php 
					$sql_query = "SELECT * FROM usuarios";
					if ($_SESSION['Nivel'] <> 1) {
						$sql_query .= " WHERE usuario = '" . $_SESSION['LoginUsuario'] . "'";
					}
					$sql = mysql_query($sql_query);
						while($array = mysql_fetch_array($sql))  
					{
						$id = $array['id'];
						$usuario = $array['usuario'];
						$nomeusuario = $array['nome'];
						$emailusuario = $array['email'];
						$foneusuario = $array['fone'];
						$ativo = $array['ativo'];
						if ($ativo == 1) {
							$ativar_desativar = 1;
							$titulo_botao = "Desativar";
							$classe_css = "icon-5 info-tooltip";
						} else {
							$ativar_desativar = 0;
							$titulo_botao = "Ativar";
							$classe_css = "icon-6 info-tooltip";
						}

						if ($cor=="")
					{ $cor = "#cccccc";}
						else
					{ $cor = "";}
				?>
				<tr bgcolor="<?="$cor"?>">
					<td width="80px"><?=$usuario?></td>
					<td width="250px"><?=$nomeusuario?></td>
					<td width="150px"><?=$emailusuario?></td>
					<td width="100px">
						<a href="./usuariosEditar.php?id=<?=$id;?>" title="Editar" class="icon-1 info-tooltip"></a>
						<?php if ($_SESSION['Nivel'] == 1) { ?>
						<a href="./usuariosEx.php?acao=exclui&id=<?=$id;?>" title="Excluir" class="icon-2 info-tooltip"></a>
						<a href="./ativar.php?acao=ativar&id=<?=$id;?>&ativo=<?=$ativar_desativar;?>" title="<?=$titulo_botao;?>" class="<?=$classe_css;?>"></a>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
				</table>
				<!--  END tabela de usuarios................................... --> 
				</form>
			</div>
			<!--  END final da tabela do conteudo  -->
		
			<!--  acoes ............................................... -->
			<!-- <div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					<a href="" class="action-edit">Editar</a>
					<a href="" class="action-delete">Excluir</a>
				</div>
				<div class="clear"></div>
			</div> -->
			<!-- END acoes........... -->
			
			<!--  paginacao..................................................... -->
			<!-- <div id="paginacao-box">
			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
			<td>
				<a href="" class="page-far-left"></a>
				<a href="" class="page-left"></a>
				<div id="page-info">P&aacute;gina <strong>1</strong> / 15</div>
				<a href="" class="page-right"></a>
				<a href="" class="page-far-right"></a>
			</td>
			</tr>
			</table>
			</div> -->
			<!--  END paginacao................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  END final da tabela ............................................END  -->

</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>