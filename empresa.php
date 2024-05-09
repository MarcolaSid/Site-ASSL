<!DOCTYPE HTML>
<html lang="pt-BR" class="no_js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASSL - ArtSegur</title>

<link rel="shortcut icon" href="favicon.ico" />

<link href='//fonts.googleapis.com/css?family=Inder' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>

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
                <li><a href="empresa.html" class="selected"><span style="color:#333;">Empresa</span></a></li>
                <li><a href="servicos.html">Serviços</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="contato.html">Contato</a></li>
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
                <h1>Empresa</h1>
            </div>         -->
        </div>

    <div id="body-wrapper" class="container_16">
    <div class="clear"></div>

		<div class="section">

            <div class="title grid_16">
            	<img src="images/icon1.png" width="20" height="20" alt=""/>
                <h4>A Empresa</h4>
            </div>

            <div class="grid_16">
                <img src="images/assl-empresa.jpg" width="960" height="250" alt="ASSL Artsegur Ltda."/>
            </div>

            <div class="grid_15">
                <p><span class="dropcap">A</span> Serralheria ArtSegur com 6 anos de tradição usa acessórios e componentes de primeira qualidade em seus serviços, o que garante o conforto e segurança aos clientes.</p>
                <p>Sua matéria prima é adquirida junto a fornecedores selecionados e criteriosos. Com o volume de material trabalhado garante-se vantagens de preços e pagamentos que são repassados aos clientes.</p>
				<p>Nossa empresa realiza serviço de grande qualidade, tudo que você necessita, desde portões sociais até Estruturas Metálicas Industriais. Produzimos conforme suas necessidades, com um ótimo padrão e diversos modelos a sua escolha.</p>
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
                <div id="googlemap" class="googlemapfooter"></div>
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
				    <img src="https://www.agenciaorganize.com.br/img/design-by-agencia-organize-h.png" alt="Agência Organize" width="180" />
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
<script type="text/javascript" src="js/contact-form-validate.js"></script>
<script type="text/javascript" src="js/jquery.coda-slider-2.0.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/twitter.js"></script>

<?php include ("google-analytics.php");?>

</body>
</html>