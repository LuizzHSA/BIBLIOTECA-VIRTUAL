<?php
// Carregar dados do JSON
$dataFile = 'data.json';
$books = [];

if (file_exists($dataFile)) {
    $books = json_decode(file_get_contents($dataFile), true);
}

// Filtrar pesquisa
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
if ($search !== '') {
    $books = array_filter($books, function ($book) use ($search) {
        return strpos(strtolower($book['titulo']), $search) !== false ||
                strpos(strtolower($book['autor']), $search) !== false ||
                strpos(strtolower($book['ano']), $search) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biblioteca - CRUD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastrar Livro</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo principal -->
<main class="flex-grow-1 d-flex justify-content-center align-items-start py-5">
    <div class="container">
        <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4">Lista de Livros</h1>

            <!-- Barra de pesquisa -->
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar por título, autor ou ano..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                    <a href="index.php" class="btn btn-secondary">Limpar</a>
                </div>
            </form>

            <!-- Tabela de livros -->
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($books)): ?>
                        <?php foreach ($books as $index => $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['titulo']) ?></td>
                                <td><?= htmlspecialchars($book['autor']) ?></td>
                                <td><?= htmlspecialchars($book['ano']) ?></td>
                                <td>
                                    <a href="editar.php?id=<?= $index ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="excluir.php?id=<?= $index ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Nenhum livro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">CRUD Biblioteca &copy; <?= date("Y") ?> - Desenvolvido em PHP + Bootstrap</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
