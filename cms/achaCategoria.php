<?php $categ=intval($_GET['categ']);
$link = mysql_connect('localhost', 'root', 'feras');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('assl');
$query="SELECT * FROM subcategoria WHERE id_categoria='$categ'";
$result=mysql_query($query);

?>
<select name="subcategoria">
<option>Selecione a Subcategoria</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['nome']?></option>
<? } ?>
</select>
