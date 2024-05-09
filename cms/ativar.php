<?php
	ini_set('display_errors', true);
	include "include/parametros.php";	
	include "include/_config.php";
	$dadosUsuario	=	$_SESSION['exp_user'];
	require_once("login.class.php");
	$login = new Login();
	$login->verificar("login.php");
	
	$id_usuario = $_GET['id'];
	
	if ($_GET['acao'] == 'ativar') {
		$ativo = $_GET['ativo'];
		$param_ativo = ($ativo == 1) ? 0 : 1;
		//Ativa ou desativa o usuário.
		$sql = "UPDATE usuarios SET ativo = $param_ativo
				WHERE id = $id";
		mysql_query($sql);
	}
	
	header("Location: usuariosE.php");