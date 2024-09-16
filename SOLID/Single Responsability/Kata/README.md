

Desarrolla un sistema de gestión para una biblioteca. El sistema necesitará:
 * Registro de Libros ✔️
 * Gestión de Usuarios ✔️
 * Procesamiento de Préstamos de Libros ✔️

   
///////////////////////////////////////////////////////////////////////////////
# Use Cases
1. __Registrar Libros__: El sistema debe permitir agregar nuevos libros con información básica como título, autor y número de copias disponibles.
 -------------------------------------------------------------------------------
2. __Registrar Usuarios__: El sistema debe permitir agregar nuevos usuarios con información básica como nombre, número de identificación y correo electrónico.
 -------------------------------------------------------------------------------
3. __Procesar Préstamos de Libros__: El sistema debe permitir a los usuarios tomar prestados y devolver libros.

///////////////////////////////////////////////////////////////////////////////
# Instrucciones
## 1. Diseña una clase que no cumpla el `SRP`:

Crea una clase `Library` que maneje los 3 aspectos mencionados anteriormente.


### `BadLibrary.php`
``` php
<?php


class BadLibrary
{
    private array $books = [];
    private array $users = [];
    private array $loans = [];

    public function addBook(string $title,string $author,int $copies)
    {
        $this->books[] = 
        [
            'title'     => $title,
            'author'    => $author, 
            'copies'    => $copies
        ];
    }

    public function addUser(string $name,string $id,string $email)
    {
        $this->users[] = 
        [
            'id'    => $id,
            'name'  => $name, 
            'email' => $email
        ];
    }

    public function loanBook(string $id, array $booksToLoan) 
    {
        foreach ($booksToLoan as $bookLoan) 
        {
            foreach ($this->books as &$book) {
                if ($book['title'] == $bookLoan && $book['copies'] > 0) 
                {
                    $book['copies'] -= 1;
                    if (count($booksToLoan) > 1) {
                        $this->loans[$id][] = $bookLoan; 
                    }else {
                        $this->loans[$id] = $bookLoan; 
                    }
                    
                }
            }
              
        }
        
    }

    public function returnBook(string $id, array $booksToReturn) 
    {
        if (isset($this->loans[$id])) // Verifica si el ID está en los préstamos
        {
            foreach ($booksToReturn as $bookReturn) {
                foreach ($this->books as &$book) 
                {
                    if ($book['title'] == $bookReturn) {
                        $book['copies'] += 1;
                    }
                }
            }
            unset($this->loans[$id]);
        }

    }

    public function users(): array
    {
        return $this->users;    
    }
    
    public function books(): array
    {
        return $this->books;    
    }

    public function loans(): array
    {
        return $this->loans;    
    }
}



$library = new BadLibrary();


$library->addUser('Thais', '6282178', 'thais@correito.com');
$library->addUser('Eufemio', '453786', 'lokito_89@correito.com');

$library->addBook('Los Viajes de Gulliver', 'Jonathan Swift', 2);
$library->addBook('Blackwater', 'Michael McDowell', 16);
$library->addBook('Juego de Tronos (Canción de Hielo y Fuego)', 'George R.R. Martin', 20);


$library->loanBook('6282178', ['Juego de Tronos (Canción de Hielo y Fuego)']);
$library->loanBook('453786', ['Los Viajes de Gulliver', 'Blackwater']);

$library->returnBook('453786', ['Los Viajes de Gulliver', 'Blackwater']);

print_r($library->loans());



```
## 2. Refactoriza el código

Separa las responsabilidades en diferentes clases siguiendo el Principio de Responsabilidad Única.

Modelé 3 entidades : 
- [User]()
- [Book]()
- [Loan]()


El tema es que cada una de ellas tenía operaciones como añadir algo, entonces creé los managers (el ejemplo con la clase `Library` que hace Mouredev no me terminó de convencer ya que vuelve a aglutinar todos los conextos en uno) :

Aparte que la misma idea la tuvo también un señor que hizo managers y me ayudó a apoyar esa decisión de hacerlo así.

- [UserManager]()
- [BookManager]()
- [LoanManager]()
