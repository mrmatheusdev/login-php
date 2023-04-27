<?php
	$host = "localhost";
	$user = "root";
	$senha = "";
	$db = "login";
	
	//Cria conexão com banco de dados
	$conn = mysqli_connect($host, $user, $senha, $db);
	mysqli_set_charset($conn,"utf8");
	date_default_timezone_set('America/Sao_Paulo');

	// Verifica a conexão
	if (!$conn) {
    	die("Falha ao conectar: " . mysqli_connect_error());
	}

?>