<?php if(isset($_POST['enviar_boletim']) && $_POST['enviar_boletim'] == 'envia'){

$emails = mysql_query("SELECT email FROM cadastro WHERE status = 'ativo'")
 or die(mysql_error());
$contar_emails = mysql_num_rows($emails);

if($contar_emails <= '0'){
 echo "Nenhum email encontrado";
}else{

 while($res_email = mysql_fetch_array($emails)){

 $email = $res_email[0];

?>

<?php
 $codigo = md5($email);
 $data = date('d/m/Y H:i');
 $msn = $_POST['msn'];
 $msn .= "
 <br />
 <br />
 <table width=\"500\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
 <tr>
 <td style=\"font:14px Georgia, 'Times New Roman', Times, serif; color:#333;\">
 Este e-mail foi enviado através do sistema de news da <strong>HMD Car Design</strong><br />
 Se não deseja mais receber nossa news
 <a href=\"http://hmdcar.com.br/news/remover.php?email=$email&amp;codigo=$codigo\">Clique Aqui</a>
 <br />
 <br />
 Enviado em: $data
 </td>
 </tr>
 </table>
 ";

 $para = 'contato@hmdcar.com.br';
 $assunto = $_POST['assunto'];

 $headers = "From: $para\n";
 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

 mail($email,$assunto,$msn,$headers);

 echo "Mensagem enviada com sucesso para <strong>$email</strong>!<br />";
 ?>
<?php
 }
 }
}
?>
<form name="enviar_news" action="" method="post" enctype="multipart/form-data">

 <label>
 <span>Assunto:</span>
 <input type="text" name="assunto" size="60" />
 </label>

 <label>
 <span>Mensagem</span>
 <textarea name="msn" rows="5" cols="50"></textarea>
 </label>

 <input type="hidden" name="enviar_boletim" value="envia" />
 <input type="submit" name="Enviar" value="Enviar" />
</form>