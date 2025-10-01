<?php
$dataFile = 'data.json';
$books = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Filtro de pesquisa
$search = $_GET['search'] ?? '';
if ($search) {
    $books = array_filter($books, function($book) use ($search) {
        return stripos($book['title'], $search) !== false ||
                stripos($book['author'], $search) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Biblioteca</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="create.php">Adicionar Livro</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo -->
<div class="container mt-4 flex-grow-1">
    <h1 class="mb-4">Lista de Livros</h1>

    <!-- Form de Pesquisa -->
    <form method="GET" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Pesquisar por título ou autor..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
    </form>

    <?php if (empty($books)): ?>
        <div class="alert alert-info">Nenhum livro encontrado.</div>
    <?php else: ?>
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-primary">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $i => $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['year']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $i ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="delete.php?id=<?= $i ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este livro?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; <?= date("Y") ?> Biblioteca - Todos os direitos reservados.</p>
</footer>

</body>
</html>
