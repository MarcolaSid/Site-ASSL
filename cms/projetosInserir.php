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
  <meta charset="utf-8">
    <title><?=$pr['SITE_NOME'];?> - Cadastro de Empreendimento</title>

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

	<!-- Mapa -->
    <link href="./cep/css/main.css" rel="stylesheet" />
    <!-- END Mapa -->

	<script type="text/javascript" src="./js/tabcontent.js"></script>
	
	<script language="javascript" type="text/javascript">
	function getXMLHTTP() { //fuction to return the xml http object
			var xmlhttp=false;	
			try{
				xmlhttp=new XMLHttpRequest();
			}
			catch(e)	{		
				try{			
					xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e){
					try{
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					}
					catch(e1){
						xmlhttp=false;
					}
				}
			}

			return xmlhttp;
	    }

		function getSubCategoria(categId) {		

			var strURL="achaCategoria.php?categ="+categId;
			var req = getXMLHTTP();

			if (req) {

				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {						
							document.getElementById('subcategoriadiv').innerHTML=req.responseText;						
						} else {
							alert("Ocorreu um problema ao utilizar XMLHTTP:\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}		
		}
	</script>
</head>
<?php flush(); ?>
<body>
	
<div id="sidebar">
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>
	
<div id="main-content">
<div class="content-box">
			
<div class="content-box-header">
	<h3 style="cursor: s-resize; ">Cadastro de Projeto</h3>
	<div class="clear"></div>
<?php
	if ($_GET['acao'] == "insere")

	if(isset($_FILES['imagem'])){
	    $errors= array();
		foreach($_FILES['imagem']['tmp_name'] as $key => $tmp_name ){
			$imagem = $_FILES['imagem']['name'][$key];
			$file_size =$_FILES['imagem']['size'][$key];
			$file_tmp =$_FILES['imagem']['tmp_name'][$key];
			$file_type=$_FILES['imagem']['type'][$key];	
	        if($file_size > 2097152){
				$errors[]='File size must be less than 2 MB';
	        }	
	        $destino="../images/projetos/";
	        if(empty($errors)==true){
	            if(is_dir("$destino/".$imagem)==false){
	                move_uploaded_file($file_tmp,"../images/projetos/".$imagem);
	            }
	    }
		if(empty($error)){
			echo "
				<div class='notification success'>
					<a href='#' class='close'><img src='./img/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
					<div>O arquivo <b>".$imagem."</b> foi enviado com sucesso...</div>
				</div>
				<script type='text/javascript'>setTimeout('window.location.href='#'', 2000) /* 2 seconds */</script>";
		}
	}
		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

		$titulo = $_POST["titulo"];	
		$descricao = $_POST["descricao"];
		$mapa = $_POST["mapa"];
		
		$projetoCep = $_POST["projetoCep"];
		$projetoRua = $_POST["projetoRua"];
		$num = $_POST["num"];
		$projetoBairro = $_POST["projetoBairro"];
		$projetoCidade = $_POST["projetoCidade"];
		$projetoEstado = $_POST["projetoEstado"];
		$lat = $_POST["lat"];
		$lng = $_POST["lng"];		

		$id_subcategoria = $_POST["id_subcategoria"];

		$data_entrada = $_POST["data_entrada"];
		$data_destaque = $_POST["data_destaque"];

	$sql = "INSERT INTO projeto (titulo, projetoCep, projetoRua, num, projetoBairro, projetoCidade, projetoEstado, lat, lng, descricao, id_subcategoria, data_destaque)
					VALUES ('$titulo', '$projetoCep', '$projetoRua', '$num', '$projetoBairro', '$projetoCidade', '$projetoEstado', '$lat', '$lng', '$descricao', '$id_subcategoria', '$data_destaque')";
	$sql_busca = mysql_query($sql);
	
	$sql = "";
	//Insere as fotos.
	$id_projeto_foto = mysql_insert_id();
	if (isset($_FILES['imagem']))
	{
		$num_files = count($_FILES['imagem']['tmp_name']);
		for ($x = 0; $x < $num_files; $x++) {
			$imagem = $_FILES['imagem']['name'][$x];
			if(!is_uploaded_file($_FILES['file']['tmp_name'][$x]))
	            {
					$messages[] = 'Nenhum arquivo enviado';
	            }
			// $imagem = $_FILES['imagem']['name'][$x];
			// $erro = $_FILES['imagem']['error'][$x];			
			
			if (!empty($imagem)) {
				$sql = "INSERT INTO foto (id_projeto, path, descricao) VALUES ($id_projeto_foto, '$imagem', '')";
				mysql_query($sql);
			}
		}
}
	if ($login) 
	{
?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>Item inserido com sucesso...</div>
</div>
<?php } else { ?>
<div class="notification success">
	<a href="./index.html#" class="close"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
	<div>N&atilde;o foi poss&iacute;vel cadastrar o item...</div>
</div>
<?php }	} ?>
</div> <!-- END .content-box-content -->

<div class="insereNoticia">
<p></p>

<form name="insere" action="projetosInserir.php?acao=insere" method="post" enctype="multipart/form-data">
	<select name="categoria" id="categoria" class="marromeno-input" onChange="getSubCategoria(this.value)">
	<option value="<?=$categoriap;?>">Selecione uma Categoria</option>
	<?php
		$sql = mysql_query("SELECT * FROM categoria ORDER BY nome ASC") or die(mysql_error());  
			while($array = mysql_fetch_array($sql))  
		{ echo "<option value=".$array['id'].">".$array['nome']."</option>"; }
	?>
	</select>

	<select name="id_subcategoria" id="subcategoriadiv">
	<option>Antes, Selecione uma Categoria</option>
	<? $sql2 = mysql_query("SELECT * FROM subcategoria") or die(mysql_error());
	while($array2=mysql_fetch_array($sql2)) { ?>
	<option value=<?=$array2['id']?>><?=$array2['nome']?></option>
	<? } ?>
	</select>
	<p></p>	
	
	<p>&nbsp;</p>

    <label>Aparece no site?</label>
    <input type="radio" name="data_destaque" value="0"> Sim
    <input type="radio" name="data_destaque" value="1"> Não
    <p></p>
	
  <label>Título:</label>
  <input class="text-input large-input" type="text" id="titulo" name="titulo">
	<p></p>

<!--
  <label>Mapa:</label>
  <input class="text-input large-input" type="text" id="mapa" name="mapa">
	<p></p>
-->
	
	<label>Descrição:</label>
	<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao" cols="79" rows="5"></textarea>
	<p></p>

	<div class="align-left imagem1">
    <label>Imagens:<strong>&nbsp;&nbsp;&nbsp;(600x450px)</strong></label>
		<span class="alignverticaltop">
			<input class="inputfile" type="file" name="imagem[]" id="imagem" multiple />
		</span>
	</div>

	<div class="clear"></div>
	<p>&nbsp;</p>

    <!-- Mapa -->
    <label>Digite o CEP para gerar o mapa:</label>
    <div class="mapa_12">
    
    <div class="mapa_4">
        <div class="input-prepend cep-label">
            <span class="add-on">CEP</span>
            <input id="projetoCep" name="projetoCep" onsubmit="return false" type="text" prefix="projeto" class="cep-ws" placeholder="Informe o CEP" />
        </div>
    
        <div class="input-prepend">
            <span class="add-on">Rua</span>
            <input id="projetoRua" name="projetoRua" type="text" placeholder="Nome da Rua / Logradouro" />
        </div>
    
        <div class="input-prepend">
            <span class="add-on">Nº</span>
            <input id="num" name="num" type="text" placeholder="Número" />
        </div>
    </div>
    
    <div class="mapa_4">
        <div class="input-prepend">
            <span class="add-on">Bairro</span>
            <input id="projetoBairro" name="projetoBairro" type="text" placeholder="Informe o Bairro" />
        </div>
    
        <div class="input-prepend">
            <span class="add-on">Cidade</span>
            <input id="projetoCidade" name="projetoCidade" type="text" placeholder="Informe a Cidade" />
        </div>
    
        <div class="input-prepend">
            <span class="add-on">UF</span>
            <input id="projetoEstado" name="projetoEstado" type="text" placeholder="Informe a UF"/>
        </div>
        
        <input id="lat" name="lat" type="hidden" />
        <input id="lng" name="lng" type="hidden" />
    </div>                        
    
    <div class="mapa_8 map" id="map1"></div>
    </div>

    <!-- END Mapa -->
    <p>&nbsp;</p>   

	<div class="clear"></div>
	<p>&nbsp;</p>
	<input class="button" type="submit" value=" Cadastrar Projeto ">
</form>

</div>
</div>
</div>
	<?php include ('./include/javascript.php'); ?>
	<!-- Mapa -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="./cep/js/gmaps.js" type="text/javascript"></script>
    <script src="./cep/js/cep.js" type="text/javascript"></script>
    <link href="./cep/css/main.css" rel="stylesheet" />

    <script>
        $(function(){
            wscep({map: 'map1',auto:true});				
        })
    </script>
    <!-- END Mapa -->

</body>
</html>
<?php ob_end_flush(); ?>