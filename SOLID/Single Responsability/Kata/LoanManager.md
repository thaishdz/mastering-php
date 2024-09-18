
# `LoanManager.php`


```php
<?php


require_once('./Book.php');
require_once('./UserManager.php');

class LoanManager
{
    private array $loans = [];
    /**
     * @param string $userID
     * @param Book[] $books
     */
    public function loanProcess(string $userID, array $bookList)
    {
        foreach ($bookList as $list) 
        {
            foreach ($list as &$book) 
            {
                //REFACTOR: Prestar > 1 copia x préstamo
                $this->updateCopies($book, -1);
                $this->loans[$userID][$book->title()] = 
                [
                    'AUTHOR'	=> $book->author(),
                    'COPIES'	=> 1
                ];
            }
            
        }
    }

    /**
     * @param string $userID
     * @param Book[] $books
     */
    public function returnProcess(string $userID, array $bookList)
    {
        $titles = array_keys($this->loans[$userID]);

        foreach ($bookList as $list) 
        {
            foreach ($list as &$book) 
            {
                if (in_array($book->title(), $titles))
            {
                $this->updateCopies($book, 1);
            }
                unset($this->loans[$userID]);
            }
            
        }
    }

    function updateCopies(Book $book, int $amount)
    {
        $book->setCopies($book->copies() + $amount);
    }

    function loans() : array 
    {
        return $this->loans;
    }
}

```

## What is `&` in `foreach ($books as &$book)`?

Los `foreach` por defecto, trabajan con una copia de cada elemento del array, __no con la referencia al elemento original.__
Por eso lo ponemos, porque es necesario cuando deseas modificar los elementos del array directamente.

```php
foreach ($books as &$book) 
{
    $this->updateCopies($book, -1);
    $this->loans[$userID][$book->title()] = 
    [
       'AUTHOR'	=> $book->author(),
       'REMAINING_COPIES' => $book->copies()
    ];
}
```

### Resumen
- El operador `&` hace que `$book` sea una referencia al elemento actual del array `$books`. 
- Esto significa que cualquier modificación a `$book` dentro del bucle `foreach` se reflejará en el array original `$books`. 
- Sin `&`, sólo estarías modificando una copia del elemento dentro del bucle, y NO el elemento en el array.
