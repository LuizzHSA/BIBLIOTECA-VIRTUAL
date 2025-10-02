<?php
// edit.php - editar livro
$dataFile = 'data.json';
$books = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id === null || !isset($books[$id])) {
    header('Location: index.php');
    exit;
}

$livro = $books[$id];

// Se formulário enviado → salvar edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $books[$id]['titulo'] = $_POST['titulo'] ?? $livro['titulo'];
    $books[$id]['autor']  = $_POST['autor'] ?? $livro['autor'];
    $books[$id]['ano']    = $_POST['ano'] ?? $livro['ano'];

    file_put_contents($dataFile, json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Livro - Biblioteca</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Biblioteca</a>
    </div>
  </nav>

  <!-- Formulário -->
  <main class="flex-grow-1 d-flex justify-content-center align-items-start py-5">
    <div class="container">
      <div class="card shadow-lg p-4" style="max-width:700px; margin:auto;">
        <h1 class="text-center mb-4 text-primary">Editar Livro</h1>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($livro['titulo']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($livro['autor']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Ano</label>
            <input type="number" name="ano" class="form-control" value="<?= htmlspecialchars($livro['ano']) ?>" required>
          </div>
          <div class="d-flex justify-content-between">
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <p class="mb-0">CRUD Biblioteca &copy; <?= date('Y') ?></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>