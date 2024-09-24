<?php


// Solo crea instancia de usuarios

class User
{
    public function __construct(
        private string $id,
        private string $name,
        private string $email
    ) 
    {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
       return $this->email; 
    }
}
