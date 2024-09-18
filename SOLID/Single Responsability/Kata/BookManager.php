<?php

require_once('./Book.php');

// Se encarga de manejar tareas relacionadas con libros

class BookManager
{
    private array $books  = [];

    public function add(Book $book): void 
    {
       $this->books[] = $book;
    }

    public function books(): array
    {
        return $this->books;
    }
}
