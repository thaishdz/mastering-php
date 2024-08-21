# Closures

> Es una __función que captura y recuerda el entorno en el que fue creada, incluso después de que la función externa haya terminado de ejecutarse.__

💡 Un _closure_ tiene acceso a variables locales de su función contenedora después de que esta haya terminado. En PHP, esto se hace usando la palabra clave `use`.

![image](https://github.com/user-attachments/assets/1faaf2a4-126e-4522-b375-801ffca19366)

### Ejemplo de Closure:

```php
function crearContador() {
    $contador = 0;
    return function() use (&$contador) {
        $contador++;
        return $contador;
    };
}

$incrementar = crearContador();
echo $incrementar(); // Output: 1
echo $incrementar(); // Output: 2
```

En este caso, `$contador` es una variable externa que la función anónima captura y "recuerda" entre llamadas.


>💡 **no todas las funciones de primer orden son closures**, __pero una closure sí es una función de primer orden.__






### Uso de variables dentro de un `array_map`



```php

function arrayValuesToCommaString(array $target, array $keys): string
{
    
    $arrayResult = array_map(function($item) use ($keys)
    {
        return $item[$keys[1]];

    },array_column($target, $keys[0]));

    return implode(", ", $arrayResult); // convierte un array a string
}


```
> En PHP, las funciones anónimas (closures) __no tienen acceso a variables externas a menos que se las pases explícitamente usando la palabra clave `use` 
