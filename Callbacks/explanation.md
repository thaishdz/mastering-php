

# Callbacks


> En PHP, es una función que se pasa como argumento a otra función. 

# Ventajas
- Crear funciones más genéricas y flexibles__ que puedan ser utilizadas para diferentes propósitos.
- Útiles cuando deseas que una función realice una acción personalizada que depende de la situación.

# Uso

Para usar callbacks en PHP, se puede hacer uso de la función `call_user_func()` o `call_user_func_array()`, que permiten llamar a una función pasando como argumento su nombre o una variable que la contenga.


## Ejemplo



```php 
 function processNumbers(array $numbers, callable $callback) : array 
 {
    $result = [];

    foreach ($numbers as $number) 
    {
        $result[] = call_user_func($callback, $number);
    }

    return $result;
 }


 function byTwo(int $number)
 {
    return $number * 2;
 }


 function byThree(int $number)
 {
    return $number * 3;
 }

$numbers = [1,2,3,4,5];

print_r(processNumbers($numbers, 'byTwo'));
print_r(processNumbers($numbers, 'byThree'));

```

### Output

```
notebook@emsfu:/var/www$ php index.php
Array
(
    [0] => 2
    [1] => 4
    [2] => 6
    [3] => 8
    [4] => 10
)
Array
(
    [0] => 3
    [1] => 6
    [2] => 9
    [3] => 12
    [4] => 15
)

```



[Cómo utilizar Callbacks en PHP](https://asilvabe.dev/blog/callbacks-in-php)

