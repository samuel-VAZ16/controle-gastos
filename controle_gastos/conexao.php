<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "controle_gastos";

// Criando a conexão com o banco de dados
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}
?>
