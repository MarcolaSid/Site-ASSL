<!DOCTYPE html>
<?php ob_start();?>
<html lang="pt-BR" class="no-js">
<head>
	<meta charset="utf-8">
	<?php if($paginaAtual == '' || $paginaAtual == 'https://www.assl.com.br/' || $paginaAtual == './' || $paginaAtual == 'index.php?conteudo=home' || $paginaAtual == 'index.php' || $paginaAtual == 'home') {echo '<title>ASSL ArtSegur Ltda.</title>';} ?>
	<?php if($paginaAtual == 'servicos.html') {echo '<title>Serviços</title>';} ?>
	<?php if($paginaAtual == 'empresa.html') {echo '<title>A Costa Brava</title>';} ?>
	<?php if($paginaAtual == 'portfolio.html') {echo '<title>Portfolio</title>';} ?>
	<?php if($paginaAtual == 'contato.html') {echo '<title>Contato ASSL</title>';} ?>

<?php
$id = $_GET['id'];
$titulo = $_GET['titulo'];

$sql = mysql_query("SELECT titulo FROM projeto WHERE projeto.id = '" . mysql_real_escape_string($_GET['id']) . "' ") or die(mysql_error());

	while($array = mysql_fetch_array($sql))
{
	$nomepagina = $array['titulo'];
}

	if($paginaAtual == $paginaAtual) {echo '<title>'.$nomepagina.'</title>';} else {} ?>

	<meta name="author" content="Organize Comunicação">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="expires" content="never" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<base href="https://www.assl.com.br/">

	<link href="img/favicon.png" rel="icon" type="image/png">
	<?php
	if($paginaAtual == '' || $paginaAtual == 'https://www.assl.com.br/' || $paginaAtual == './' || $paginaAtual == 'index.php?conteudo=home' || $paginaAtual == 'index.php' || $paginaAtual == 'home.html' || $paginaAtual == 'index.html') {
		echo '
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<link id="theme" rel="stylesheet" type="text/css" href="css/dark.css" media="screen"/>

	<!--[if IE 8]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/><![endif]-->
';
	} else {

		echo '
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<link id="theme" rel="stylesheet" type="text/css" href="css/dark.css" media="screen"/>

	<!--[if IE 8]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/><![endif]-->
';}
?>
	<meta property="og:locale" content="pt_BR" />
	<meta property="og:site_name" content="ASSL ArtSegur Ltda." />
	<meta property="og:url" content="https://www.assl.com.br/" />
	<meta property="og:title" content="ASSL ArtSegur Ltda." />
	<meta property="og:image" content="https://www.assl.com.br/img/logo-assl-200x200.png" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="200" />
	<meta property="og:image:height" content="200" />
	<meta property="og:description" content="ASSL ArtSegur Ltda. - Projetos de Alto Padrão, projetos modernos, inteligentes e com alta qualidade. Visite nosso website!." />

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link href='//fonts.googleapis.com/css?family=Inder' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>

  	<!-- Internet Explorer condition - HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- code removed for brevity. -->
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<!-- code removed for brevity. -->

	<!-- Google +1 Button -->
	<script type="text/javascript">
	  window.___gcfg = {lang: 'pt-BR'};

	  (function() {
	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	    po.src = 'https://apis.google.com/js/plusone.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>

</head>
<?php flush(); ?>
<body>
<div id="wrapper">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <div class="fixposition">
	<div id="header-wrapper">
	<div id="header-content">

        <div id="logo">
		  <a href="index.html" alt="ASSL ArtSegur Ltda."><img src="images/logo.jpg" alt="logo" width="350" height="80" /></a>
        </div>

        <div id="menu" class="menu">
            <ul>
				<li><a href="index.html" title="Página Principal" <?php if($paginaAtual == '' || $paginaAtual == 'index.html' || $paginaAtual == 'http://assl.dev/' || $paginaAtual == 'http://assl.com.br/' || $paginaAtual == './' || $paginaAtual == 'index.php?conteudo=home' || $paginaAtual == 'index.php' || $paginaAtual == 'home') {echo 'class="text_menu_selected selected"';} ?>>Home</a></li>
				<li><a href="empresa.html" <?php if($paginaAtual == 'empresa.html') {echo 'class="text_menu_selected selected"';} ?>>Empresa</a></li>
                <li <?php if($paginaAtual == 'servicos.html') {echo 'class="selected"';} ?>><a href="servicos.html">Serviços</a></li>
                <li <?php if($paginaAtual == 'portfolio.html') {echo 'class="selected"';} ?>><a href="portfolio.html">Portfolio</a></li>
                <li <?php if($paginaAtual == 'contato.html') {echo 'class="selected"';} ?>><a href="contato.html">Contato</a></li>
            </ul>
		<br style="clear: left" />
		</div>

	</div>
	</div>
    </div>

  	<div id="body-background">
    <div id="header-buffer"></div>
