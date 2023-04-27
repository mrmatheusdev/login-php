<?php
session_start();
include_once("../conexao.php");
// Ler o IP do usuário
function client_ip()
{
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if (isset($_SERVER['HTTP_X_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	else if (isset($_SERVER['HTTP_FORWARDED']))
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	else if (isset($_SERVER['REMOTE_ADDR']))
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}
$user_ip = client_ip();

$BtnAcessar = filter_input(INPUT_POST, 'BtnAcessar', FILTER_SANITIZE_STRING);
if($BtnAcessar){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

	if((!empty($usuario)) AND (!empty($senha))){
		// Seleciona todas as colunas da tabela usuarios
		// Busca o usuário no banco de dados
		$query = "SELECT * FROM usuarios WHERE usuario='$usuario' LIMIT 1";
		$result = mysqli_query($conn, $query);
		if($result){
			// Atualiza o IP do usuário no banco de dados
			mysqli_query($conn, "UPDATE usuarios SET ip = '{$user_ip}'");
			$row = mysqli_fetch_assoc($result);
			if(password_verify($senha, $row['senha'])){
				$_SESSION['id'] = $row['id'];
				$_SESSION['nome'] = $row['nome'];
				$_SESSION['email'] = $row['email'];
				header("Location: ../painel/dashboard.php");
			}else{
				$_SESSION['msg'] = "Usuário ou senha incorretos!";
				header("Location: ../index.php");
			}
		}
	}
}
