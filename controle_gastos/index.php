<?php include('conexao.php'); ?>
<?php
// Calcula o total gasto por categoria
$totais = [];
$categorias = ['Alimentação', 'Gasolina', 'Maconha', 'Cigarro', 'Farra'];
foreach ($categorias as $categoria) {
    $result = $conexao->query("SELECT SUM(valor) as total FROM gastos WHERE categoria = '$categoria'");
    $row = $result->fetch_assoc();
    $totais[$categoria] = $row['total'] ?? 0; // Define 0 se não houver gastos
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Gastos</title>

    <!-- Vincula o Manifesto -->
    <link rel="manifest" href="manifest.json">
    
    <!-- Adiciona o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Adiciona ícones do PWA -->
    <link rel="icon" href="icons/icon-192x192.png" sizes="192x192">
    <link rel="icon" href="icons/icon-512x512.png" sizes="512x512">
</head>
<body>
    <div class="container mt-5">
        <h1>Meus Gastos</h1>
        <a href="cadastrar.php" class="btn btn-success mb-3">Adicionar Gasto</a>

        <!-- Tabela de Gastos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Categoria</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conexao->query("SELECT * FROM gastos ORDER BY data DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>R$ {$row['valor']}</td>
                        <td>{$row['categoria']}</td>
                        <td>{$row['data']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabela de Totais por Categoria -->
        <div class="mt-4">
            <h3>Totais por Categoria</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($totais as $categoria => $total) { ?>
                        <tr>
                            <td><?php echo $categoria; ?></td>
                            <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Scripts do PWA -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('service-worker.js')
                    .then((registration) => {
                        console.log('Service Worker registrado com sucesso:', registration);
                    })
                    .catch((error) => {
                        console.log('Erro ao registrar o Service Worker:', error);
                    });
            });
        }
    </script>
</body>
</html>