<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Sistema de Login</title>
	</head>
	<body>
		<h2>Login</h2>
		<form method="POST" action="./login/validar_login.php">
			<label>Usuário:</label>
			<input type="text" name="usuario" placeholder="Digite o seu usuário..."><br>
			
			<label>Senha:</label>
			<input type="password" name="senha" placeholder="Digite a sua senha..."><br>
			
			<input type="submit" name="BtnAcessar" value="Acessar">		
		</form>
		<p>User: user@test.com | Senha: 123</p>
	</body>
</html>