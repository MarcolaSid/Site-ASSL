<?php
	include_once "include/parametros.php";
	include "include/_config.php";
	$dadosUsuario	=	$_SESSION['exp_user'];
	$LoginUsuario = $_POST["usuario"];
	$SenhaUsuario = md5($_POST["senha"]);
	require_once("login.class.php");
	$login = new Login();
	$logar = $login->logar($LoginUsuario, $SenhaUsuario, "index.php");
	if ($logar)
		echo $logar;
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
</head>
<?php flush(); ?>
<body id="login">

    <div id="login-wrapper" class="png_bg">
        <div id="login-top">
            <h1><?=$pr['SITE_NOME'];?> - CMS</h1>
            <img id="logo" src="./img/logo.png" alt="<?=$pr['SITE_NOME'];?>"><br>
            <p></p>
        </div>
        <!-- End #login-top -->

        <div id="login-content">
            	<div class="notification information png_bg">
                    <div>
                    Seu usu&aacute;rio ou sua senha n&atilde;o s&atilde;o v&aacute;lidos!<br>
                    Por favor, volte e digite novamente.
                    </div>
              	</div>
                <div class="clear"></div>
        </div> <!-- End #login-content -->
    </div> <!-- End #login-wrapper -->

    <!-- Javascripts -->
    <!-- jQuery -->
    <script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
    <!-- jQuery Configuration -->
    <script type="text/javascript" src="./js/jquery.configuration.js"></script>

    <!-- Internet Explorer .png-fix -->
    <!--[if IE 6]>
        <script type="text/javascript" src="./js/DD_belatedpNG_0.0.7a.js"></script>
        <script type="text/javascript">
            DD_belatedpNG.fix('.png_bg, img, li');
        </script>
    <![endif]-->

</body>
</html>
<?php ob_end_flush(); ?>