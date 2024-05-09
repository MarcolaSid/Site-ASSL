<?php header("Content-Type: text/html; charset=UTF-8",true) ?>
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
<html lang="pt-br" class="no-js">
<head>
  <meta charset="utf-8">
    <title><?=$pr['SITE_NOME'];?> - CMS</title>

	<!-- CSS -->
	<link rel="stylesheet" href="./css/reset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/estilos.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/invalid.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?=$pr['TEMA'];?>" type="text/css" media="screen" />

	<!-- Internet Explorer Fixes -->
	<!--[if lte IE 7]>
		<link rel="stylesheet" href="./css/ie.css" type="text/css" media="screen" />
	<![endif]-->
  <link rel="stylesheet" href="./css/jquery.tabs.css" type="text/css" media="print, projection, screen">
  <!-- Additional IE/Win specific style sheet (Conditional Comments) -->
  <!--[if lte IE 7]>
  <link rel="stylesheet" href="./css/jquery.tabs-ie.css" type="text/css" media="projection, screen">
  <![endif]-->

	<!-- contato -->
	<script type="text/javascript" src="./js/functionAddEvent.js"></script>
	<script type="text/javascript" src="./js/contact.js"></script>
	<script type="text/javascript" src="./js/xmlHttp.js"></script>

</head>
<?php flush(); ?>
<body>

<div id="sidebar">
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>

<div id="main-content">
<div class="content-box">

<div class="content-box-header">
	<h3 style="cursor: s-resize; "><?=$pr['SITE_NOME'];?> - CMS</h3>
</div>

	<div class="content-box-content">

			<div class="tab-content default-tab" style="display: block; ">
			<div class="insereNoticia">

					<h4>In&iacute;cio</h4>
					<p>Esta &eacute; a &aacute;rea de administra&ccedil;&atilde;o do conte&uacute;do do website da <?=$pr['SITE_NOME'];?>.</p>
					<p>Utilize o menu ao lado para incluir, editar ou excluir algum produto.</p>

					<?php include 'relatorio.php'; ?>

			</div>
			</div>

			</div>
		</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>