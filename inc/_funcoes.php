<?php
// $pagina = explode("/",$_SERVER['PATH_INFO']); 

$paginaAtual = basename($_SERVER['REQUEST_URI']);

//sem http
$request_url=$_SERVER['REQUEST_URI'];
//echo $request_url;

//com http
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//echo $url;


// --------------------------------------------
function virg2ponto($valor)
// --------------------------------------------
{
	return str_replace(',', '.', $valor);
}
// --------------------------------------------
function ponto2virg($valor)
// --------------------------------------------
{
	return str_replace('.', ',', $valor);
}

// --------------------------------------------
// Converte Data formato Brasil para formato Mysql
// Exemplo: 20/06/2009 --> 2009-06-20
function data2mysql($data)
// --------------------------------------------
{
	return substr($data, 6, 4) . '-' . substr($data, 3, 2) 
		. '-' . substr($data, 0, 2);
}
// --------------------------------------------
// Converte Data formato Mysql para formato Brasil
// Exemplo: 2009-06-20 --> 20/06/2009
function mysql2data($data)
// --------------------------------------------
{
	if ($data=='')
		return '';
	else
		return substr($data, 8, 2) . '/' . substr($data, 5, 2) 
		. '/' . substr($data, 0, 4);
}
// --------------------------------------------
// verifica se o usuario esta logado no sistema
function login_ok()
// --------------------------------------------
{
	// cria sessao ou entra em sessao ja existente
	session_start();
	// verifica se existe a variavel de sessao USUARIO
	if (!isset($_SESSION['USUARIO']))
		// se nao existir, volta para login com erro de 
		//		ACESSO NEGADO!
		header('location:index.php?erro=2');
}
/** 
* Get category name from a category id 
*
*/
function getCategoryName($categoryId) {
$select_category_query = sprintf("SELECT * FROM categorias WHERE id='%s'", mysql_real_escape_string($categoryId));
$select_category_result = mysql_query($select_category_query);

if (!$select_category_result) {
$message = 'Invalid query: ' . mysql_error() . "\n";
$message .= 'Whole query: ' . $select_category_query;
die($message);
}

$rowc = mysql_fetch_row($select_category_result);
return $rowc[1];
}
/** 
* Get subcategory name from a category id 
*
*/
function getSubCategoryName($subcategoryId) {
$select_subcategory_query = sprintf("SELECT * FROM subcategoria WHERE id='%s'", mysql_real_escape_string($subcategoryId));
$select_subcategory_result = mysql_query($select_subcategory_query);

if (!$select_subcategory_result) {
$message = 'Invalid query: ' . mysql_error() . "\n";
$message .= 'Whole query: ' . $select_subcategory_query;
die($message);
}

$rows = mysql_fetch_row($select_subcategory_result);
return $rows[1];
}

/** 
* Get product name from a product id 
*
*/
function getProductName($productId) {
$select_product_query = sprintf("SELECT * FROM produto WHERE id='%s'", mysql_real_escape_string($productId));
$select_product_result = mysql_query($select_product_query);

if (!$select_product_result) {
$message = 'Invalid query: ' . mysql_error() . "\n";
$message .= 'Whole query: ' . $select_product_query;
die($message);
}

$rowp = mysql_fetch_row($select_product_result);
return $rowp[1];
}

/** 
  * Return URL-Friendly string slug
  * @param string $string 
  * @return string 
  */
function seoURL($string) {
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
}

/***
 * Função para remover acentos de uma string
 * Apenas remove os acentos:
 * echo removeAcentos(' [Resolvido] » Problemas na conversão de página html');
 * [resolvido] » problemas na conversao de pagina html
 * Cria um slug da string:
 * echo removeAcentos(' [Resolvido] » Problemas na conversão de página html', '-');
 * resolvido-problemas-na-conversao-de-pagina-html
 */
function removeAcentos($string, $slug = false) {
	$string = strtolower($string);

	// Código ASCII das vogais
	$ascii['a'] = range(224, 230);
	$ascii['e'] = range(232, 235);
	$ascii['i'] = range(236, 239);
	$ascii['o'] = array_merge(range(242, 246), array(240, 248));
	$ascii['u'] = range(249, 252);

	// Código ASCII dos outros caracteres
	$ascii['b'] = array(223);
	$ascii['c'] = array(231);
	$ascii['d'] = array(208);
	$ascii['n'] = array(241);
	$ascii['y'] = array(253, 255);

	foreach ($ascii as $key=>$item) {
		$acentos = '';
		foreach ($item AS $codigo) $acentos .= chr($codigo);
		$troca[$key] = '/['.$acentos.']/i';
	}

	$string = preg_replace(array_values($troca), array_keys($troca), $string);

	// Slug?
	if ($slug) {
		// Troca tudo que não for letra ou número por um caractere ($slug)
		$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
		// Tira os caracteres ($slug) repetidos
		$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
		$string = trim($string, $slug);
	}

	return $string;
}

/**
  * Retorna a pagina atual
  * echo currentPageURL()
  */
    function currentPageURL() {
    	$curpageURL = 'http';
    		if ($_SERVER["HTTPS"] == "on") {$curpageURL.= "s";}
    	$curpageURL.= "://";
    		if ($_SERVER["SERVER_PORT"] != "80") {
    	$curpageURL.= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    		} else {
    	$curpageURL.= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    	return $curpageURL;
    }
?>