
## Requisitos 🎯

Desarrolla un sistema de gestión para una biblioteca, necesitará:
- __Registrar Libros__: El sistema debe permitir agregar nuevos libros con información básica como:
   - `título`
   - `autor`
   - `número de copias disponibles`
- __Registrar Usuarios__: El sistema debe permitir agregar nuevos usuarios con información básica como ...
   - `nombre`
   - `número de identificación`
   - `email`
- __Procesar Préstamos de Libros__: El sistema debe permitir a los usuarios
   - `prestar libros`
   - `devolver libros`.

<img src="https://i.pinimg.com/originals/ac/b8/b2/acb8b2676e80ecb24cb62112baa6ba9e.gif" />
   

# Instrucciones ⚙️

1. __Diseña una clase que no cumpla el `SRP`__: Crea una clase `Library` que maneje los 3 aspectos mencionados anteriormente.

## Bad Design 🤮

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
--- 
2. __Refactoriza el código__: Separa las responsabilidades en diferentes clases siguiendo el Principio de Responsabilidad Única.


## Good Design 👍

Modelé 2 entidades : 
- [User](https://github.com/thaishdz/mastering-php/blob/main/SOLID/Single%20Responsability/Kata/User.php)
- [Book](https://github.com/thaishdz/mastering-php/blob/main/SOLID/Single%20Responsability/Kata/Book.php)

Nota: Modelé una entidad Loan pero dije, "a la verga", vamos a hacer esto sencillo.

El tema es que cada una de ellas tenía operaciones como añadir algo, entonces creé los managers (el ejemplo con la clase `Library` que hace Mouredev no me terminó de convencer ya que vuelve a aglutinar todos los conextos en uno) :

Aparte que la misma idea la tuvo también un señor que hizo managers y me ayudó a apoyar esa decisión de hacerlo así.

- [UserManager](https://github.com/thaishdz/mastering-php/blob/main/SOLID/Single%20Responsability/Kata/UserManager.md)
- [BookManager](https://github.com/thaishdz/mastering-php/blob/main/SOLID/Single%20Responsability/Kata/BookManager.md)
- [LoanManager](https://github.com/thaishdz/mastering-php/blob/main/SOLID/Single%20Responsability/Kata/LoanManager.md)



### `GoodLibrary.php`

```php

<?php

require_once('./User.php');
require_once('./Book.php');
require_once('./UserManager.php');
require_once('./BookManager.php');
require_once('./LoanManager.php');

class GoodLibrary
{
    private UserManager $userManager;
    private BookManager $bookManager;
    private LoanManager $loanManager;

    public function __construct() 
    {
        $this->userManager = new UserManager();
        $this->bookManager = new BookManager();
        $this->loanManager = new LoanManager();
    }
    ///////////////////// USERS ///////////////////////////////////
    
    function addUser($name, $email) 
    {
        // La creación del ID ya pa otro día, estoy cansá
        $user = new User('6282178', $name, $email);
        $this->userManager->add($user);
    }
    
    ////////////////////// BOOKS ///////////////////////////////////

    function addBook($title, $author, $copies) 
    {
        $book = new Book($title, $author, $copies); 
        $this->bookManager->add($book);
    }

    ///////////////////// GESTIÓN LIBROS ///////////////////////////

    function handleBook(string $userID, array $books, string $handle) 
    {
        $bookTitles = [];
        if ($this->userManager->exists($userID)) 
        {
            foreach ($books as $title) 
            {
                $bookTitles[] = $this->bookManager->exists($title);
            }

            if ($bookTitles)
            {
                switch ($handle) {
                    case 'loan':
                        $this->loanBook($userID, $bookTitles);
                        break;
                    
                    case 'return':
                        $this->returnBook($userID, $bookTitles);
                        break;
                    
                    default:
                        echo 'Invalid option';
                        break;
                }
               
            }else 
            {
                echo 'Books Not Found';
            }
            
        }else 
        {
            echo 'User Not Found';
        }
    }


    ///////////////////// PRÉSTAMO /////////////////////
    /**
     * @param string $userID
     * @param Book[] $books
     */
    function loanBook(string $userID, array $books)
    {
       $this->loanManager->loanProcess($userID, $books);
       print_r($this->loanManager->loans());
       print_r($this->bookManager->books()); // las copies de los objetos se han actualizado
    }


    ///////////////////// DEVOLUCIÓN /////////////////////
    /**
     * @param string $userID
     * @param Book[] $books
     */
    function returnBook(string $userID, array $books)
    {
        $this->loanManager->returnProcess($userID, $books);
        print_r($this->loanManager->loans());
        print_r($this->bookManager->books()); // las copies de los objetos se han vuelto a actualizar tras la devolución 
    }
    
}
```

### `index.php`

```php

<?php

require_once('./GoodLibrary.php');


$goodLibrary = new GoodLibrary();


$goodLibrary->addUser('Thais', 'thais@correito.com');

$goodLibrary->addBook('Los Viajes de Gulliver', 'Jonathan Swift', 2);
$goodLibrary->addBook('1984', 'George Orwel', 16);
$goodLibrary->addBook('Juego de Tronos (Canción de Hielo y Fuego)', 'George R.R. Martin', 20);



$goodLibrary->handleBook('6282178', ['Los Viajes de Gulliver', '1984'], 'loan');
$goodLibrary->handleBook('6282178', ['Los Viajes de Gulliver', '1984'], 'return');

```


### Demo completa

- [Source Code - PHPSandbox](https://phpsandbox.io/n/solid-single-responsability-54psx)
