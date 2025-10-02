<?php
// cadastro.php - Cadastrar novo livro
$dataFile = 'data.json';
$books = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor  = trim($_POST['autor'] ?? '');
    $ano    = trim($_POST['ano'] ?? '');

    // Validação mínima
    if ($titulo === '' || $autor === '' || $ano === '') {
        $erro = 'Preencha todos os campos.';
    } elseif (!ctype_digit($ano) || intval($ano) < 0) {
        $erro = 'Ano inválido.';
    } else {
        // Adiciona e salva
        $books[] = [
                'titulo' => $titulo,
                'autor'  => $autor,
                'ano'    => $ano
        ];
        file_put_contents($dataFile, json_encode(array_values($books), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar Livro - Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link active" href="cadastro.php">Cadastrar Livro</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo centralizado -->
<main class="flex-grow-1 d-flex justify-content-center align-items-start py-5">
    <div class="container">
        <div class="card shadow-lg p-4" style="max-width:700px; margin:auto;">
            <h1 class="text-center mb-4">Adicionar Livro</h1>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="POST" class="w-100">
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" value="<?= isset($titulo) ? htmlspecialchars($titulo) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input type="text" name="autor" class="form-control" value="<?= isset($autor) ? htmlspecialchars($autor) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ano</label>
                    <input type="number" name="ano" class="form-control" value="<?= isset($ano) ? htmlspecialchars($ano) : '' ?>" required min="0" step="1">
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                    <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">CRUD Biblioteca &copy; <?= date('Y') ?> — Desenvolvido em PHP + Bootstrap</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
