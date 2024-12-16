<?php include('conexao.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Gasto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Cadastrar Gasto</h1>
    <form method="POST" action="cadastrar.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Gasto</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria" required>
    <option value="Alimentação">Alimentação</option>
    <option value="Gasolina">Gasolina</option>
    <option value="Maconha">Maconha</option>
    <option value="Cigarro">Cigarro</option>
    <option value="Farra">Farra</option>
</select>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];

    $sql = "INSERT INTO gastos (nome, valor, categoria, data) VALUES ('$nome', '$valor', '$categoria', '$data')";

    if ($conexao->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Gasto cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conexao->error . "</div>";
    }
}
?>