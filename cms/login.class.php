<?php
class Login {

	private $SenhaUsuario, $tabela, $campoLogin, $campoSenha;
	public $LoginUsuario, $msgErro;

	function Login($tabela = "usuarios", $campoLogin = "usuario", $campoSenha = "senha", $redireciona = "index.php") {
		$this->tabela = $tabela;
		$this->campoLogin = $campoLogin;
		$this->campoSenha = $campoSenha;
		$this->msgErro = $msgErro;
	}

	function logar($login,$senha,$redireciona = false) {

		$this->SenhaUsuario = mysqli_real_escape_string(addslashes($senha));
		$this->LoginUsuario = mysqli_real_escape_string(addslashes($login));

		$consulta = @mysqli_query("SELECT ".$this->campoLogin.",".$this->campoSenha.", ativo, nivel FROM ".$this->tabela." WHERE ".$this->campoLogin." = '".$this->LoginUsuario."' LIMIT 0,1");
		$campos = @mysqli_num_rows($consulta);

		if($campos != 0):
			if($this->SenhaUsuario != @mysqli_result($consulta,0,$this->campoSenha)):
				return $this->msgErro;
			else:
				session_start();
				if (@mysqli_result($consulta,0, 'ativo') == 0) {
					return $this->msgErro;
					$redireciona = null;
				}
				$_SESSION['LoginUsuario'] = $login;
				$_SESSION['SenhaUsuario'] = $senha;
				$_SESSION['Nivel'] = @mysqli_result($consulta,0, 'nivel');
				if ($redireciona):
					header("Location: ".$redireciona."");
				endif;
			endif;
		else:
			return $this->msgErro;
		endif;
	}

	function verificar($redireciona = false) {
		session_start();
		if(isset($_SESSION['LoginUsuario']) and isset($_SESSION['SenhaUsuario'])):
			global $LoginUsuario;
			$LoginUsuario = $_SESSION["LoginUsuario"];
			return true;
		else:
			if ($redireciona):
				header("Location: ".$redireciona."");
			endif;
			return false;
			exit;
		endif;
	}

	function logout($redireciona = false) {
		session_start();
		$_SESSION = array();
		session_destroy();
		session_regenerate_id();
		if ($redireciona):
			header("Location: ".$redireciona."");
			exit;
		endif;
	}
}
?>