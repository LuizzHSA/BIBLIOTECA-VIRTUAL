<?php
require_once __DIR__ . '/../src/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $ano = $_POST['ano'] ?? '';

    if ($titulo && $autor && $ano) {
        $service->adicionar($titulo, $autor, $editora, $ano);
        header("Location: index.php");
        exit;
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Biblioteca Virtual</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Lista de Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="cadastro.php">Cadastrar Livro</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo -->
<main class="container py-4 flex-grow-1">
    <h2 class="mb-4">Cadastrar Livro</h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="POST" class="card p-3 shadow-sm">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Ano</label>
            <input type="number" name="ano" class="form-control">
        </div>
        <div class="d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</main>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>&copy; <?= date("Y") ?> Biblioteca - Sistema CRUD em PHP + JSON</small>
</footer>

</body>
</html>
