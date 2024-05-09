<?php	include_once "include/parametros.php"; ?>
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
            <H1><?=$pr['SITE_NOME'];?> - CMS</H1>
            <img id="logo" src="./img/logo.png" alt="<?=$pr['SITE_NOME'];?>">
        </div> <!-- END #login-top -->
        <div id="login-content">
            <form action="logar.php" name="autenticacao" method="post">
                <div class="notification information png_bg">
                    <div>
                        Digite seu nome de usu&aacute;rio e senha para acessar a &aacute;rea administrativa.
                    </div>
                </div>
                <p>
                    <label>Usu&aacute;rio</label>
                    <input class="text-input" type="text" name="usuario" id="usuario">
                </p>
                <div class="clear"></div>
                <p>
                    <label>Senha</label>
                    <input class="text-input" type="password" name="senha" id="senha">
                </p>
                <div class="clear"></div>
                <p id="remember-password">
                    <input type="checkbox">Lembrar
                </p>
                <div class="clear"></div>
                <p>
                    <input class="button" type="submit" value="Entrar">
                </p>
            </form> <!-- END Formulario de login -->
        </div> <!-- END #login-content -->

    </div> <!-- End #login-wrapper -->

    <!-- Javascripts -->
    <script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
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