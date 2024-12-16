<?php
include('conexao.php'); // Inclui o arquivo de conexão

if (isset($conexao)) { // Verifica se a variável $conexao foi criada corretamente
    echo "Conexão com o banco de dados bem-sucedida!";
} else {
    echo "Erro de conexão: " . $conexao->connect_error;
}
?>
