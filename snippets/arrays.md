
# Array asociativo multidimensional


### Obtener el nombre

```php

$pokemon_types = [
    "type_1" => ["name" => "flying", "url" => "https://pokeapi.co/api/v2/type/10/"],
    "type_2" => ["name" => "fire",   "url" => "https://pokeapi.co/api/v2/type/3/"]
];

$types = array_column($pokemon_types, "name"); // [[0] => flying [1] => fire]

```
