
# Closures



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
