<?php
class Livro {
    public $id;
    public $titulo;
    public $autor;
    public $ano;

    public function __construct($id, $titulo, $autor, $ano) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
    }
}
