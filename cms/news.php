<?php header("Content-Type: text/html; charset=iso-8859-1",true) ?>
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
<html lang="en" class="no-js">
<head>
  <meta charset="<?=$pr['ISO88591'];?>">
    <title><?=$pr['SITE_NOME'];?> - News</title>
	
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

</head>
<?php flush(); ?>
<body>
	
<div id="sidebar">
<div id="sidebar-wrapper"><?php include 'include/inc_menu.php';?></div>
</div>
	
<div id="main-content">
<div class="content-box">			
<div class="content-box-header">
	<h3 style="cursor: s-resize; "><?=$pr['SITE_NOME'];?> - News</h3>
	<div class="clear"></div>
</div>
			
<div class="content-box-content">              		  

<table>
	<thead>
		<tr>
		 <th width="85%">Lista de emails</th>
		</tr>
	</thead>
	<tfoot>
		<tr><td></td></tr>
	</tfoot>
	<tbody>
		<tr bgcolor="<?="$cor"?>">
		<td class="alignverticaltop"> 
		
			<?php
			$emails = mysql_query("SELECT * FROM cadastro")
			 or die(mysql_error());
			$contar_emails = mysql_num_rows($emails);

			$emails_ativos = mysql_query("SELECT * FROM cadastro WHERE status = 'ativo'")
			 or die(mysql_error());
			$contar_emails_ativos = mysql_num_rows($emails_ativos);

			$emails_inativos = mysql_query("SELECT * FROM cadastro WHERE status = 'inativo'")
			 or die(mysql_error());
			$contar_emails_inativos = mysql_num_rows($emails_inativos);
			?>
			Emails Cadastrados = <?php echo $contar_emails;?><br />
			Emails ativos = <?php echo $contar_emails_ativos;?><br />
			Emails inativos = <?php echo $contar_emails_inativos;?><br />		
		
		</td>
		</tr>
		<tr>
			<td>
				<h4>Clique no email que deseja remover.</h4>
				<?php 

				if(isset($_POST['deletar']) && $_POST['deletar'] == 'excluir'){

				 $id_email = $_POST['id_do_email'];

				 $remover_email = mysql_query("DELETE FROM cadastro WHERE id = '$id_email';")
				 or die(mysql_error());

				 if ($remover_email <= '0'){
				 echo "Erro ao exluir o email";
				 }else{
				 echo "Email removido";
				 }
				}

 				if(isset($_POST['deletar_inativos']) && $_POST['deletar_inativos'] == 'excluir'){

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
					<li>
				<?php
					$seleciona = $emails = mysql_query("SELECT id, email, status FROM cadastro ORDER BY status ASC")
						or die(mysql_error());
					$contar_emails = mysql_num_rows($emails);

					if($contar_emails <= '0'){
						echo "Nenhum email encontrado";
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
				<?php
				 }
				}
				?>
					</li>				
				</ul>
			</td>
		</tr>
	</tbody>
</table>       

</div>
</div>
	<div class="clear"></div>
</div>
	<?php include ('./include/javascript.php'); ?>
</body>
</html>
<?php ob_end_flush(); ?>