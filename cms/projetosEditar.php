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
    <title><?=$pr['SITE_NOME'];?> - Editar Projeto</title>
	
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
	<h3 style="cursor: s-resize; ">Editar Projeto</h3>

	<!-- BEGIN MENU ABAS -->
	<ul id="insereprodutos" class="shadetabs">
		<li class="button"><a href="#" rel="tabproduto" class="selected">Projeto</a></li>
		<li class="button button-right"><a href="projetosVisualizar.php?pagina=1" title=" Voltar para Lista ">Voltar para Lista</a></li>
	</ul>

	<div class="clear"></div>

<?php 
$sql = mysql_query("SELECT * FROM foto WHERE id = '$id' ") or die(mysql_error());
$res = mysql_fetch_assoc($sql);
$imagemBD = $res['path'];
?>

<?php
	$id = $_GET['id'];
	if ($_GET['acao'] == "update" and is_numeric($id) and !empty($id)) 
	{ 
		$numeroCampos = 1;
		$tamanhoMaximo = 2097152;
		$extensoes = array(".jpg", ".jpeg", ".gif", ".png");
		$caminho = "../images/projetos/";
		$substituir = false;
		
		for ($i = 0; $i < count($_FILES['path']); $i++) {
			
			$nomeArquivo = $_FILES["path"]["name"][$i];
			$tamanhoArquivo = $_FILES["path"]["size"][$i];
			$nomeTemporario = $_FILES["path"]["tmp_name"][$i];
			if ($_FILES["path"]["error"][$i] <> 0) {
				$arr_erros_img[] = $i;
			}
			$url = "projetosEditar.php?id=".$_GET['id'];
			if (!empty($nomeArquivo)) {
			
				$erro = false;
			
				if ($tamanhoArquivo > $tamanhoMaximo) {
					//$erro = "O arquivo " . $nomeArquivo . " não deve ultrapassar " . $tamanhoMaximo. " bytes";
				} 
				elseif (!in_array(strrchr($nomeArquivo, "."), $extensoes)) {
					//$erro = "A extensão do arquivo <b>" . $nomeArquivo . "</b> não é válida";
				} 
				elseif (file_exists($caminho . $nomeArquivo) and !$substituir) {
					//$erro = "O arquivo <b>" . $nomeArquivo . "</b> já existe";
				}
			
				if (!$erro) {
					$ext = end(explode(".",$nomeArquivo));
					$furl = md5(uniqid($nomeArquivo)).".$ext";
					
					move_uploaded_file($nomeTemporario, ($caminho . $furl));
								
					$sql = "INSERT INTO foto (id_projeto, path, descricao) VALUES ($id, '$furl', '')";
					$q = mysql_query($sql);		
					if(!$q){echo mysql_error();exit;}
					
					echo "
						<div class='notification success'>
							<a href='#' class='close'><img src='./img/icones/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
						<div>O arquivo <b>".$nomeArquivo."</b> foi enviado com sucesso...</div>
						</div>
							<script type='text/javascript'>setTimeout(function(){window.location.href='".$url."'}, 1000)</script>
							";
				} 
				else {
					
					echo"
						<div class='notification error'>
							<a href='#' class='close' onclick='window.location.href='".$url."''><img src='./img/icones/cross_grey_small.png' title='Fechar essa mensagem' alt='fechar'></a>
						<div>$erro ...</div>
						</div>					
					";
					echo $erro . "<br />";
				}
			}
		}

		///////////////////////////////////////////////////
		//Script para inserir os dados no bando de dados://
		///////////////////////////////////////////////////

			$id = $_GET["id"];
			$titulo = $_POST["titulo"];
			$descricao = $_POST["descricao"];

			$projetoCep = $_POST["cep"];
			$projetoRua = $_POST["rua"];
			$num = $_POST["num"];
			$projetoBairro = $_POST["bairro"];
			$projetoCidade = $_POST["cidade"];
			$projetoEstado = $_POST["uf"];
			$lat = $_POST["lat"];
			$lng = $_POST["lng"];																					
						
			$id_subcategoria = $_POST["subcategoria"];
			$data_entrada = $_POST["data_entrada"];
			
			$data_destaque = $_POST["data_destaque"];

			$imagem = $_FILES["imagem"]['name'];

			$tmpimagem = $_FILES['imagem']['tmp_name'];
			$destino = "../images/projetos/".$imagem;
			move_uploaded_file($tmpimagem, $destino);

if (($imagem != "") && ($imagem != NULL)) { $imagem = $imagem; } else { $imagem = $imagemBD;} 

$sql_query_update = "UPDATE projeto SET id_subcategoria = $id_subcategoria, titulo='$titulo', descricao='$descricao', cep='$projetoCep', rua='$projetoRua', num='$num', bairro='$projetoBairro', cidade='$projetoCidade', uf='$projetoEstado', lat='$lat', lng='$lng', data_destaque=$data_destaque WHERE id='$id'";

$query = mysql_query($sql_query_update) or die(mysql_error()); 
	if ($login) 
							{	
							?>	
<div class="notification success">
	<a href="#" class="close" onclick="window.location.href='projetosVisualizar.php?pagina=1'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>Registro alterado com sucesso...</div>
<?php
    $url = "projetosEditar.php?id=".$_GET['id'];
    echo "<script> var int = setTimeout( function(){window.location = '$url'},1000);</script>";	
?>
</div>
	<script type="text/javascript">setTimeout('window.location.href="projetosVisualizar.php?pagina=1"', 52000) /* 2 seconds */</script>
<?php	} else { ?>
<div class="notification error">
	<a href="#" class="close" onclick="window.location.href='#'"><img src="./img/cross_grey_small.png" title="Fechar essa mensagem" alt="fechar"></a>
<div>Não foi possível excluir o registro...</div>
</div>

<?php }	
}	

$sql = mysql_query("SELECT titulo, descricao, projetoCep, projetoRua, num, projetoBairro, projetoCidade, projetoEstado, lat, lng, id_subcategoria,
	
	(SELECT sub.nome FROM subcategoria as sub, projeto WHERE sub.id = projeto.id_subcategoria
	AND projeto.id = '$id') AS sub_categoria, 
	
	( SELECT categoria.nome FROM categoria, subcategoria WHERE subcategoria.id_categoria = categoria.id AND subcategoria.id = projeto.id_subcategoria ) 
	AS nome_categoria FROM projeto WHERE projeto.id = '$id' ") or die(mysql_error());  

	while($array = mysql_fetch_array($sql))  	
{
	$idp = $id;
	$categoriap = $array['nome_categoria'];
	$subcategoriap = $array['sub_categoria'];
	$subcategoria_id = $array['id_subcategoria'];
	$titulo = $array['titulo'];
	$descricao = $array['descricao'];

	$projetoCep = $array['projetoCep'];			
	$projetoRua = $array['projetoRua'];
	$num = $array['num'];		
	$projetoBairro = $array['projetoBairro'];		
	$projetoCidade = $array['projetoCidade'];		
	$projetoEstado = $array['projetoEstado'];		
	$lat = $array['lat'];		
	$lng = $array['lng'];									
}

$sql = mysql_query("SELECT * FROM foto WHERE id_projeto ='$id' ORDER BY id ASC LIMIT 10") or die(mysql_error());  
while($array = mysql_fetch_array($sql))  
{
	$imagemp[] = array($array['path'], $array['id']);
}
//echo "<pre>";print_r($imagemp);exit;

if ($_GET['acao'] == "update" and is_numeric($id) and !empty($id)) {
	for ($x=(count($imagemp[0])-1); $x <= 10; $x++) {
		if (!in_array($x, $arr_erros_img)) {
//		if (!in_array($x)) {			
			$imagem_produto = explode("/\/", $_POST['fakeupload'][$x]);
			$imagem_produto = $imagem_produto[count($imagem_produto) - 1];
			$imagem_produto = str_replace('fakepath', '', $imagem_produto);
			if (!empty($imagem_produto)) {
				//$sql = "INSERT INTO foto (id_produto, path, descricao) VALUES ($id, '$imagem_produto', '')";
				//$q = mysql_query($sql);
			}
		}
	}
	if($q){
		$url = "projetosEditar.php?id=".$_GET['id'];
		echo "<script> window.onload = function(){ window.location = '$url';}</script>";
	}
//Atualiza as fotos.
//echo "<pre>"; print_r($_POST['fakeupload']);
for ($x=0; $x<= (count($_POST['fakeupload']) - 1); $x++) {
	if (!empty($_POST['fakeupload'][$x])) {
		if (!is_null($imagemp[$x][1])) {
			$img_nome = $_POST['fakeupload'][$x];
			$img_id   = $imagemp[$x][1];
			//$sql = "UPDATE foto SET path = '$img_nome' WHERE id = $img_id";
			//mysql_query($sql);
		}
	}
}	
}

if ($_GET['acao'] == "exclui" and isset($_GET['fid']) ) {
	$idf = $_GET['fid'];
	$sql = mysql_query("SELECT * FROM foto WHERE id = '$idf'");
	if($sql){
		$res = mysql_fetch_assoc($sql);	
		$imagemBD = $res['path'];
		$destino = "../images/projetos/".$imagemBD;
		$sql = mysql_query("DELETE FROM foto WHERE id = '$idf'");
		@unlink($destino);
	}
	$url = "projetosEditar.php?id=".$_GET['id'];
	 echo "<script>window.location = '$url'</script>";
	 exit;
	}
	
$sql = mysql_query("SELECT data_destaque FROM projeto WHERE id ='$id' ") or die(mysql_error());  
	while($array = mysql_fetch_array($sql))  
{
	$data_destaque = $array['data_destaque'];
}	
	
?>
</div>

<div class="insereNoticia">
<p></p>
	<form action="projetosEditar.php?acao=update&id=<?=$idp;?>" method="post" enctype="multipart/form-data">
		<div class="tabcontent" id="tabproduto">          
          <label>Categoria:<span style="margin:0px 0 0 280px;">Subcategoria:</span></label>
          <select name="categoria" id="categoria" class="marromeno-input" onChange="getSubCategoria(this.value)">
			<?php echo $populara; ?>
         	<option value="<?=$categoriap;?>"><?=$categoriap;?></option>
         	<?php
					$sql = mysql_query("SELECT * FROM categoria") or die(mysql_error());  
						while($array = mysql_fetch_array($sql))  
					{ echo "<option value=".$array['id'].">".$array['nome']."</option>"; }
					?>
          </select>

			<div id="subcategoriadiv" style="position:relative;top:-29px;left:336px;">
				<select name="subcategoria" class="input">
					<?php
					$sql2 = mysql_query("SELECT * FROM subcategoria") or die(mysql_error());  
						while($array2 = mysql_fetch_array($sql2))  
						{ 
							if ($array2['id'] == $subcategoria_id) {
								echo "<option selected=\"selected\" value=".$array2['id'].">".$array2['nome']."</option>"; 
							} else {
								echo "<option value=".$array2['id'].">".$array2['nome']."</option>"; 
							}
						}
					?>
		    	</select>
			</div>
			
			<p>&nbsp;</p>
			
      		<?php 
				$cont = 1;
				//echo "<pre>";print_r($imagemp);exit;
				foreach ($imagemp as $img) {
			?>
				<div class="align-right caixaimagem">
					<label>(600x450px)</label>
					<span class="alignverticaltop">
						<a href="../images/projetos/<?=$img[0];?>" id="fancyimg"><img src="../images/projetos/<?=$img[0];?>" width="120" height="85" class="borda"></a>
					</span>
					<a href="projetosEditar.php?acao=exclui&fid=<?=$img[1]?>&id=<?=$id?>" title="Excluir">
    					<span class="button" style="width: 120px;text-align: center;">Excluir Imagem</span>
					</a>
					<br /><br />
					<!--
					<input id="fakeupload<?=$cont;?>" name="fakeupload[]" class="inputfile fakeupload" type="text" />
					<input id="path<?=$cont;?>" name="path[]" class="inputfile realupload" type="file"  value="<?=$img[0];?>" onchange="javascript:document.getElementById('fakeupload<?=$cont;?>').value = this.value.substr(12);document.getElementById('path<?=$cont;?>').value = this.value.substr(12);" />
					-->
				</div>
			<?php
				$cont++;
			}
			?>
			<br />
			<?php
				$xcont = $cont;
				for ($x = $cont; $x <= 1; $x++) {
				
			?>
			
			<div class="align-right caixaimagem">
					<label>(600x450px)</label>
					<br /><br />
					<input id="fakeupload<?=$x;?>" name="fakeupload[]" class="inputfile fakeupload" type="text" />
					<input id="path<?=$x;?>" name="path[]" class="inputfile realupload" type="file"  value="" onchange="javascript:document.getElementById('fakeupload<?=$x;?>').value = this.value.substr(12);document.getElementById('path<?=$x;?>').value = this.value.substr(12);" />					
			</div>
			<?php
			}
			?>

			<label>Mostra no site?</label>
			<input type="radio" id="data_destaque" name="data_destaque" value="0" <?php if ($data_destaque == 0) { echo "CHECKED"; } else { echo ""; } ?>> Sim
			<input type="radio" id="data_destaque" name="data_destaque" value="1" <?php if ($data_destaque == 1) { echo "CHECKED"; } else { echo ""; } ?>> Não
			<p></p>
											
   			<label>Título do Projeto:</label>
   			<input class="text-input large-input" type="text" id="titulo" name="titulo" value="<?=$titulo;?>">
			<p></p>

			<label>Descrição do Projeto:</label>
			<textarea class="text-input textarea wysiwyg" id="textarea" name="descricao" cols="79" rows="5"><?=$descricao;?></textarea>
      		<p></p>

		    <!-- Mapa -->
		    <div class="mapa_12">
		    <label>Endereço do Projeto:</label>    
		    <div class="mapa_4">
		        <div class="input-prepend cep-label">
		            <span class="add-on">CEP</span>
		            <input id="projetoCep" name="projetoCep" onsubmit="return false" prefix="projeto" class="cep-ws" type="text" value="<?=$projetoCep;?>" />
		        </div>
    
		        <div class="input-prepend">
		            <span class="add-on">Rua</span>
		            <input id="projetoRua" name="projetoRua" type="text"  value="<?=$projetoRua;?>" />
		        </div>
    
		        <div class="input-prepend">
		            <span class="add-on">Nº</span>
		            <input id="num" name="num" type="text"  value="<?=$num;?>" />
		        </div>
		    </div>
    
		    <div class="mapa_4">
		        <div class="input-prepend">
		            <span class="add-on">Bairro</span>
		            <input id="projetoBairro" name="projetoBairro" type="text"  value="<?=$projetoBairro;?>" />
		        </div>
    
		        <div class="input-prepend">
		            <span class="add-on">Cidade</span>
		            <input id="projetoCidade" name="projetoCidade" type="text"  value="<?=$projetoCidade;?>" />
		        </div>
    
		        <div class="input-prepend">
		            <span class="add-on">UF</span>
		            <input id="projetoEstado" name="projetoEstado" type="text"  value="<?=$projetoEstado;?>" />
		        </div>
        
		        <input id="lat" name="lat" type="hidden" />
		        <input id="lng" name="lng" type="hidden" />
		    </div>                        
    
		    <div class="mapa_8 map" id="map1"></div>
		    </div>

		    <!-- END Mapa -->
		    <p>&nbsp;</p> 
    
			</div> <!-- Final tabprodutos -->

			<div class="tabcontent" id="tabspecs">
				&nbsp;
			</div> <!-- Final tabspecs -->

			<div class="clear"></div>
			<p>&nbsp;</p>          
    			
			<input class="button" type="submit" value=" Alterar Projeto ">
		</form>

<script type="text/javascript">
		var prods=new ddtabcontent("insereprodutos")
		prods.setpersist(true)
		prods.setselectedClassTarget("link")
		prods.init()
</script>
<!-- END ABAS -->
</div>

<div class="clear"></div>
</div>

</div>
	<div class="clear"></div>
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