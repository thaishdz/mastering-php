
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

    public function users(): array
    {
        return $this->users;
    }
}
    
