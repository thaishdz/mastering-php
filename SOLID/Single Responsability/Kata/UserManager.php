<?php

require_once('./User.php');

// Se encarga de manejar tareas con usuarios

class UserManager
{
    private array $users  = [];

    public function add(User $user): void 
    {
       $this->users[] = $user;
    }

    function exists(string $id): array
    {
        return array_filter($this->users(), function ($user) use ($id)
        {
            return $user->id() === $id;
        });
    }

    public function users(): array
    {
        return $this->users;
    }
}
    
