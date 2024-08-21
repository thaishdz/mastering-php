# Closures

> Es una __función que captura y recuerda el entorno en el que fue creada, incluso después de que la función externa haya terminado de ejecutarse.__

💡 Un _closure_ tiene acceso a variables locales de su función contenedora después de que esta haya terminado. En PHP, esto se hace usando la palabra clave `use`.

<img src="https://github.com/user-attachments/assets/1faaf2a4-126e-4522-b375-801ffca19366" width="300" height="300"/>

# Ejemplo de Closure:

```php
function createClosure($x) {
    return function($y) use ($x) {
        return $x + $y;
    };
}

$closure = createClosure(10);
echo $closure(5);  // Salida: 15
```

La función anónima `function($y) use ($x)` es un _closure_ porque captura el valor de `$x` del contexto externo de `createClosure`.


>💡 **No todas las funciones de primer orden son closures**, __pero una closure sí es una función de primer orden.__


![image](https://github.com/user-attachments/assets/613b8fe1-8c7d-4ddb-a866-b3c1958b2d17)

Ah otra cosa, una función anónima no significa que sea un _closure_ aunque podría serlo 👍

![image](https://github.com/user-attachments/assets/2a5cc63a-1764-416b-8356-d0d5f3539c20)



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
