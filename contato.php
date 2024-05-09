<?php
if(isset($_POST['submit'])) {

	if(trim($_POST['name']) == '') {
		$hasError = true;
	} else {
		$nome = trim($_POST['name']);
	}

	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['fone']) == '') {
		$hasError = true;
	} else {
		$fone = trim($_POST['fone']);
	}

	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$mensagem = stripslashes(trim($_POST['message']));
		} else {
			$mensagem = trim($_POST['message']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = "contato@assl.com.br";
		$subject = "Contato Website - ASSL";

		$body = '<html><body>';
		$body .= "<tr style='background: #eee;'><table rules='all' style='border-color: #666;' cellpadding='10' width='650px'></tr>";
		$body .= "<tr style='background: #eee;'><td width='150px'><strong>Nome:</strong> </td><td>" . $nome . "</td></tr>";
		$body .= "<tr><td width='150px'><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
		$body .= "<tr><td width='150px'><strong>Fone:</strong> </td><td>" . $fone . "</td></tr>";
		$body .= "</table>";
		$body .= "<tr style='background: #eee;'><table rules='all' style='border-color: #666;' cellpadding='10' width='650px'>";
		$body .= "<tr style='background: #eee;'><td width='150px'><strong>Mensagem:</strong> </td></tr><tr><td>" . $message . "</td></tr>";
		$body .= "</table>";
		$body .= "</body></html>";

		$headers = "From: ASSL <contato@assl.com.br>\n";
		$headers .= "Reply-To: ". $email . "\r\n";
		$headers .= "Return-Path: ASSL <contato@assl.com.br>\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?><!DOCTYPE HTML>
<html lang="pt-BR" class="no_js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASSL - ArtSegur</title>

<link rel="shortcut icon" href="favicon.ico" />

<link href='fonts.googleapis.com/css?family=Inder' rel='stylesheet' type='text/css'>
<link href='fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link id="theme" rel="stylesheet" type="text/css" href="css/dark.css" media="screen"/>

<!--[if IE 8]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/><![endif]-->
<!--[if IE 7]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen"/><![endif]-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>!window.jQuery && document.write('<script src="js/jquery-1.7.1.min.js"><\/script>')</script>
<script type="text/javascript" src="js/modernizr.js"></script>

<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/gmap3.min.js"></script>
<script type="text/javascript">

    (function($){
        $(document).ready(function(){

        $('#googlemap').gmap3(

          {
            action: 'addMarker',
            address: "Av. Marechal Rondon, 3582 Gravatai Brasil",
            map:{
              center: true,
              zoom: 16
            },
          },

          {action: 'setOptions', args:[{scrollwheel:true}]}
        );
        });
    })(jQuery);

</script>
<script type="text/javascript">

    (function($){
        $(document).ready(function(){

        $('#googlemapfooter').gmap3(

          {
            action: 'addMarker',
            address: "Av. Marechal Rondon, 3582 Gravatai Brasil",
            map:{
              center: true,
              zoom: 16
            },
          },

          {action: 'setOptions', args:[{scrollwheel:true}]}
        );
        });
    })(jQuery);

</script>

</head>

<body>
<div id="wrapper">

    <div class="fixposition">
	<div id="header-wrapper">
	<div id="header-content">

        <div id="logo">
		  <a href="/" alt="ASSL ArtSegur Ltda."><img src="images/logo.jpg" alt="logo" width="350" height="80" /></a>
        </div>

        <div id="menu" class="menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="empresa.html">Empresa</a></li>
                <li><a href="servicos.html">Serviços</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="contato.html" class="selected"><span style="color:#333;">Contato</span></a></li>
            </ul>
		<br style="clear: left" />
		</div>

	</div>
	</div>
    </div>

    <div id="body-background">
    <div id="header-buffer"></div>

        <div id="pageheader-background">
            <!-- <div class="pageheader-title">
                <h1>Entre em Contato</h1>
            </div>         -->
        </div>

    <div id="body-wrapper" class="container_16">
    <div class="clear"></div>

		<div class="section">
       		<div class="grid_12">

                <div class="title">
                	<img src="images/icon1.png" width="20" height="20" alt=""/>
                    <h4>Fale Conosco</h4>
                </div>

					<?php if(isset($hasError)) { //Se encontrar erros ?>
						<span style="color:#fff;">Verifique se todos os campos foram preenchidos corretamente.</span>
					<?php } ?>

					<?php if(isset($emailSent) && $emailSent == true) { //Se o email foi enviado ?>
						<span style="color:#fff">
						<strong><?=$nome;?></strong>, agradecemos pelo contato. Em breve retornaremos sua mensagem.</span>
					<?php } ?>

                <form id="contact-form" class="formLayout" name="contact" autocomplete="on" enctype="multipart/form-data" method="post" action="contato.html">
                    <fieldset>
                        <label for="name">Nome*</label>
                        <input type="text" id="name" name="name" class="requiredField"/>
                    </fieldset>
                    <fieldset>
                        <label for="email">Email*</label>
                        <input type="text" id="email" name="email" class="requiredField email"/>
                    </fieldset>
                    <fieldset>
                        <label for="url">Fone</label>
                        <input type="text" id="fone" name="fone"/>
                    </fieldset>
                    <fieldset>
                        <label for="message">Mensagem*</label>
                        <textarea name="message" id="message" rows="20" cols="30" class="requiredField"></textarea>
                    </fieldset>
                    <div class="clear"></div>
    				<input name="submit" id="submitted" value=" Enviar " class="submit button" type="submit" />
                </form>
            </div>
        </div>

		<div class="section">
            <div class="grid_4">

                <div class="title">
                	<img src="images/icon1.png" width="20" height="20" alt=""/>
                    <h4>Informações de Contato</h4>
                </div>
                <p>
                Fone: (51) 4118-0625<br />
                Fone: (51) 8196-2124<br />
                Fone: (51) 8111-4369<br />
                Email: <script language="javascript" type="text/javascript">
                                <!--
                                var username = "contato";
                                var hostname = "assl.com.br";
                                var linktext = "Contato ASSL";
                                document.write("<a href=" + "mail" + "to:" + username +
                                "@" + hostname + "?subject=" + linktext + ">" + linktext + "</a>")
                                //-->
                            </script><br />
                <br>
                Av. Marechal Rondon, 3582<br />
				CEP: 94080-500 - Gravataí - RS<br />
                </p>
                <div id="googlemap" class="googlemap"></div>
            </div>
        </div>

    <div class="clear"></div>

    </div>
    </div>

    <div id="footer-wrapper">
        <div id="footer-container">

            <div class="section container_16">

                <div class="grid_4">
	                   <h4 class="footer-header">Palavra do Cliente</h4>
	                <div class="testimonial-wrapper">
	                    <div class="speech-bubble-container">
					        <div class="slides_container">
	                            <div>
	                            	<span class="speech-text"><span></span>Quero parabenizar toda a equipe da ASSL  pelo trabalho profissional que que me foi prestado. Estou muito satisfeito com os serviços.</span>
	            					<span class="speech-name">João Siqueira</span>
	            		  		</div>
	                            <div>
	                           	  	<span class="speech-text"><span></span>Estou muito satisfeito com minhas grades e portões. Empresa séria, atenciosa e pontual na entrega dos produtos. Parabéns e sucesso!</span>
	            					<span class="speech-name">Sérgio Maia</span>
	                            </div>
	                            <div>
	                           	  	<span class="speech-text"><span></span>Realmente indico a ArtSegur a todos. Parabéns pelo trabalho.</span>
	            					<span class="speech-name">Márcio Barros</span>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                </div>

                <div class="grid_4">
                    <h4 class="footer-header">Informações de Contato</h4>
                    <p>
                    Av. Marechal Rondon, 3582<br />
					CEP: 94080-500<br />
                    Cachoeirinha, RS<br /><br />
	                Fone: (51) 3074-0811<br />
	                Fone: (51) 8196-2124<br />
	                Fone: (51) 8111-4369<br /><br />
                    Email: <script language="javascript" type="text/javascript">
                                <!--
                                var username = "contato";
                                var hostname = "assl.com.br";
                                var linktext = "Contato ASSL";
                                document.write("<a href=" + "mail" + "to:" + username +
                                "@" + hostname + "?subject=" + linktext + ">" + linktext + "</a>")
                                //-->
                            </script><br />
                    Web: <a href="#">http://assl.com.br</a><br />
                    </p>
                </div>

                <div class="grid_4">
                    <h4 class="footer-header">Últimos Tweets</h4>
                    <div id="jstwitter"></div>
                    <img class="float-left marginright10" src="images/twitter-logo.png" width="27" height="18" alt=""/>
                    <p>siga <a href="https://twitter.com/ASSL_ArtSegur" target="_blank">@artsegur</a> no twitter</p>
                </div>

                <div class="grid_4">
                    <h4 class="footer-header">Social ArtSegur</h4>
                        <p>Encontre-nos nas redes sociais.</p>
                    <div id="social-icon-container">
                        <ul>
                            <li><a href="https://twitter.com/ASSL_ArtSegur" target="_blank"><img src="images/social-twitter.png" width="24" height="24" alt=""/><div><span class="arrow"></span>Twitter</div></a></li>
                            <li><a href="https://facebook.com/ASSL.ArtSegur" target="_blank"><img src="images/social-facebook.png" width="24" height="24" alt=""/><div><span class="arrow"></span>Facebook</div></a></li>
                            <li><a href="https://plus.google.com/107847509871161393447" target="_blank"><img src="images/social-google.png" width="24" height="24" alt=""/><div><span class="arrow"></span>Google</div></a></li>
                            <li><a href="https://br.linkedin.com/pub/assl-artsegur/56/37/17" target="_blank"><img src="images/social-linkedin.png" width="24" height="24" alt=""/><div><span class="arrow"></span>LinkedIN</div></a></li>
                        </ul>
                    </div>
                    <div id="googlemapfooter" class="googlemapfooter"></div>
                </div>

            </div>
        </div>
    </div>

<div class="clear"></div>

    <div id="copyright-wrapper">
        <div id="copyright-content">
            <p class="float-left">Copyright &copy;<? echo date("Y"); ?> ASSL ArtSegur Ltda.</p>
            <p class="float-right">
                <a href="https://www.agenciaorganize.com.br" target="_blank">
				    <img src="https://agenciaorganize.com.br/img/design-by-agencia-organize-h.png" alt="Agência Organize" width="180" />
				</a>
            </p>
        </div>
    </div>

</div>

<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="js/slides.jquery.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>

<script type="text/javascript" src="js/jquery.coda-slider-2.0.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/twitter.js"></script>

<?php include ("google-analytics.php");?>

</body>
</html>