<?
 $pagina = $_GET["pagina"];
 $sql = mysql_query("SELECT * FROM categoria") or die(mysql_error());
 $Qtde = 5;
 $Total = mysql_num_rows($sql);
 $Paginas = ceil($Total/$Qtde);
 if(empty($pagina)){
   $limit = 0;
   $PaginaCorrente = 1;
 } else  {
   $limit = $pagina-1;
   $PaginaCorrente = $pagina;
 }
 $inicio = $limit * $Qtde;
 $sql = mysql_query("SELECT * FROM categoria ORDER BY nome DESC Limit $inicio, $quantidade") or die(mysql_error());  

?>

 <form id="frm_resultados" action="<?=$PHP_SELF?>" method="post">
 <?
	echo "<span style='float:left;margin-left:10px;margin-top:8px;'>Total de Registros: <span style='color:red'>".$Total."</span></span>";	
	
     if($pagina > 1){
	$menos = $pagina -1;
	$url ="$PHP_SELF?pagina=$menos";
	echo "<a href='".$url."'>Anterior</a> |";
    }
    echo " P&aacute;gina $PaginaCorrente de $Paginas ";
    if($pagina < $Paginas)
   {
      $mais = $pagina+1;
      $url ="$PHP_SELF?pagina=$mais";
     echo " | <a href='".$url."' >Pr&oacute;xima</a>";
   }
   echo " Ir para a p&aacute;gina &nbsp; <input type='text' id='pagina' size='3'    maxlength='3' value=\"$pagina\" />
<input type='button' value='ok' onclick=\"fctTrocaPagina('$PHP_SELF',$Paginas)\" />";
 ?>
 </form>

<script type="text/javascript">
function fctTrocaPagina(Pagina,Total) {
  var Form = document.getElementById("frm_resultados");
	if (Form==null) return;
 
	var objePagina = document.getElementById("pagina");
	if (objePagina==null){
  	return;
	}
	if((objePagina.value =='') || parseInt(objePagina.value) > Total ||
	parseInt(objePagina.value) < 1){
		alert("Digite somente números de 1 a "+Total+".");
		objePagina.select();
		objePagina.focus();
		return false;
	}
 window.location = Pagina+"?pagina="+objePagina.value;
}
</script>