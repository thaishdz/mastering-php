# `array_column`

__Extrae una sola columna de un array multidimensional__. 

Esta vaina se emplea mucho __cuando trabajas con datos obtenidos de bases de datos__, sobretodo si consultas los resultados como __arrays asociativos.__

### Ejemplito
Tenemos este listado de tipos de Pokémons, donde cada uno tiene una "columna" `name` y `url`.

Con `array_column`, podemos obtener fácilmente solo los nombres en un array separado.

## Obtén los nombres de los tipos en este array anidado 

```php

$pokemon_types = [
    "type_1" => ["name" => "flying", "url" => "https://pokeapi.co/api/v2/type/10/"],
    "type_2" => ["name" => "fire",   "url" => "https://pokeapi.co/api/v2/type/3/"]
];

$types = array_column($pokemon_types, "name"); // [[0] => flying [1] => fire]

```


```php

$pokemon_types = [
    [
        "slot" => 0, 
        "type" => ["name" => "flying", "url" => "https://pokeapi.co/api/v2/type/10/"]
    ],
                
    [
        "slot" => 1,
        "type" => ["name" => "fire",   "url" => "https://pokeapi.co/api/v2/type/3/"]
    ]
];


// Nos extraerá la columna `type` que a su vez tiene un array
$types_in_columns = array_column($pokemon_types, "type"); 

// Aquí podemos volver a usar programación funcional para obtener por fin los valores de los tipos
$types = array_map(function($type)
{
   return $type["name"]; 
}, $types_in_columns);

```

#### Output `$types_in_columns`

```php

Array
(
    [0] => Array
        (
            [name] => flying
            [url] => https://pokeapi.co/api/v2/type/10/
        )
    [1] => Array
        (
            [name] => fire
            [url] => https://pokeapi.co/api/v2/type/3/
        )
)

```
#### Output `$types`

```php

Array
(
    [0] => flying
    [1] => fire
)

```
