<?php
require_once __DIR__ . '/../models/Livro.php';

class LivroService {
    private $file;

    public function __construct($filePath) {
        $this->file = $filePath;
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function listar() {
        return json_decode(file_get_contents($this->file), true);
    }

    public function salvar($livros) {
        file_put_contents($this->file, json_encode($livros, JSON_PRETTY_PRINT));
    }

    public function adicionar($titulo, $autor, $ano) {
        $livros = $this->listar();
        $id = uniqid();
        $livros[] = ["id" => $id, "titulo" => $titulo, "autor" => $autor, "ano" => $ano];
        $this->salvar($livros);
    }

    public function deletar($id) {
        $livros = $this->listar();
        $livros = array_filter($livros, fn($l) => $l['id'] !== $id);
        $this->salvar(array_values($livros));
    }
}
