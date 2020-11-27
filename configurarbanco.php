<?php
include('C:\wamp64\www\logingoogle\vendor\taq\torm\torm.php');
//ARQUIVO CONFIGURAÇÃO BANCO DE DADOS
$host = 'localhost';
$usuario = 'root';
$senha = '';

	$minhaConexao = mysqli_connect($host, $usuario, $senha);
	if (!$minhaConexao) {
  	die("FALHOU CONEXÃO " . mysqli_connect_error());
	}else{
	//echo "CONECTADO COM SUCESSO !";

	$comandoCriarBanco = "CREATE DATABASE IF NOT EXISTS demo_login_google_vitor_augusto";
	$comandoCriarTabela = "CREATE TABLE IF NOT EXISTS users(id INT PRIMARY KEY, name TEXT, email TEXT, fotoperfil TEXT)";

	if(mysqli_query($minhaConexao, $comandoCriarBanco)){
		//echo "Banco de dados criado com sucesso";
	}else{
		mysqli_error($minhaConexao);
	}

	mysqli_query($minhaConexao,"use demo_login_google_vitor_augusto");

	if(mysqli_query($minhaConexao, $comandoCriarTabela)){
		//echo "TABELA CRIADA COM SUCESSO !!";
	}else{
		mysqli_error($minhaConexao);
	}

	mysqli_close($minhaConexao);
}


//CONFIGURANDO ORM
try {
  $conn = new PDO("mysql:host=$host;dbname=demo_login_google_vitor_augusto", $usuario, $senha);
  //$conn = new PDO("mysql:host=$host", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexão com Banco de Dados OK !";

} catch(PDOException $e) {
	echo "ERRO DE CONEXÃO !";
    echo 'ERROR: ' . $e->getMessage();
}

TORM\Connection::setConnection($conn);
TORM\Connection::setDriver("mysql");

?>