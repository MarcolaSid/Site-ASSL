<h2>Clique no email que deseja remover.</h2>
<?php 

include ("../inc/_funcoes.php");
include ("../inc/config_.php");

if(isset($_POST['deletar']) && $_POST['deletar'] == 'excluir'){

 $id_email = $_POST['id_do_email'];

 $remover_email = mysql_query("DELETE FROM cadastro WHERE id = '$id_email';")
 or die(mysql_error());

 if ($remover_email <= '0'){
 echo "erro ao exluir";
 }else{
 echo "Email removido";
 }
}
?>
<?php if(isset($_POST['deletar_inativos']) && $_POST['deletar_inativos'] == 'excluir'){

 $remover_email = mysql_query("DELETE FROM cadastro WHERE status = 'inativo';")
 or die(mysql_error());

 if ($remover_email <= '0'){
 echo "erro ao exluir";
 }else{
 echo "Email removido";
 }
}
?>
<p>
<form name="deletar_inativos" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="deletar_inativos" value="excluir" />
<input type="submit" name="Remover" value="Para remover todos os inativos clique aqui" />
</form>
</p>
<ul>
<?php
$seleciona = $emails = mysql_query("SELECT id, email, status FROM cadastro ORDER BY status ASC")
 or die(mysql_error());
$contar_emails = mysql_num_rows($emails);

if($contar_emails <= '0'){
 echo "nem um email encontrado";
}else{

 while($res_email = mysql_fetch_array($seleciona)){

 $id = $res_email[0];
 $email = $res_email[1];
 $status = $res_email[2];
?>
<form name="deletar" action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id_do_email" value="<?php echo $id;?>" />
<input type="hidden" name="deletar" value="excluir" />
<input type="submit" name="Remover" value="<?php echo $email;?> &raquo; <?php echo $status;?>" />

</form>
</li>

<?php
 }
}
?>
</ul>