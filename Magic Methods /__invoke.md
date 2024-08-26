# `__invoke()` - Llamar a un objeto como si fuese una función 

> __Invocar un objeto como si se tratara de una función__.

- Si no definiéramos `__invoke` y tratáramos de utilizar el objeto como si se tratara de una función escupiría un error.

```php

class Calculator
{
    public function __invoke($a, $b)
    {
        return $a + $b;
    }
}


$suma = new Calculator();

echo $suma(5,3); // 8

```
