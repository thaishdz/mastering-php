
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

    function exists(string $id): bool
    {
        return isset($this->users[$id]);
    }

    public function users(): array
    {
        return $this->users;
    
