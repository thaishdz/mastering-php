
# Array asociativo anidados/multidimensional


### Obtener el valor de "name" en estos arrays anidados

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



$types_in_columns = array_column($pokemon_types, "type"); 

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
