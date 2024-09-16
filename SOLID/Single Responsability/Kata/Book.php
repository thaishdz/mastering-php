<?php

class Book
{
    public function __construct(
        private string  $title  = 'untitled', 
        private string  $author = '', 
        private int     $copies = 0
    )
    {
        $this->title  = $title;
        $this->author = $author;
        $this->copies = $copies;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function copies(): int
    {
        return $this->copies;
    }

    function setCopies(int $copies) 
    {
        $this->copies = $copies;
    }
}
