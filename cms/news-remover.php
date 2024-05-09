<?php
include ("../inc/_funcoes.php");
include ("../inc/config_.php");

$email = $_GET['email'];
$codigo = $_GET['codigo'];

$confirma = mysql_query("DELETE FROM cadastro WHERE codigo = '$codigo'")
 or die(mysql_error());

if($confirma <= '0'){
 echo "Erro ao remover seu cadastro. Tente novamente!";
}else{
 echo "Seu email foi removido com sucesso!";

 $data = date('d/m/Y H:i');
 $msn = "

 <strong>Recebemos a solicitação de exclusão do seu cadastro!</strong>
 <br />
 <br />
	Informamos que a mesma foi realizada com sucesso!
 <br />
 <br />
 Removido em: $data

 ";

 $para = 'contato@hmdcar.com.br';
 $assunto = 'Cancelamento de News Concluido';

 $headers = "From: $para\n";
 $headers .= "Content-Type: text/html; charset=\"utf-8\"\n\n";

 mail($email,$assunto,$msn,$headers);

}

?>