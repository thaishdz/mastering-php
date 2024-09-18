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

    function exists(string $title): array
    {
        return array_filter($this->books(), function ($book) use ($title)
        {
            return $book->title() === $title; // si coincide, guarda ESE OBJETO en el array resultante
        });
    }

    public function books(): array
    {
        return $this->books;
    }
}
