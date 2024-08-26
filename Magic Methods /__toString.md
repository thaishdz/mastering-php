# `__toString()`

> Muestra el texto que queramos cuando alguien quiera convertir nuestra clase en una cadena.

- __Se invoca automáticamente cuando se trata de convertir un objeto a una cadena de texto__.
- Es útil cuando quieres ver la instancia de una clase usando un contexto que espera una `string`, ese contexto, son cositas como los `echo(), print() o printf()`.

```php
<?php

class Pokemon
{
    private int $id;
    private string $name;
    private int $weight;
    private int $height;
    private array $types;

    public function __construct(array $data)
    {
        $this->id       = $data['id'];
        $this->name     = $data['name'];
        $this->weight   = $data['weight'];
        $this->height   = $data['height'];
        $this->types    = $data['types'];
    }

    public function __toString() : string
    {
        $types = implode(', ', $this->types);
        return "ID: {$this->id},
                Name: {$this->name},
                Weight: {$this->weight}kg,
                Height: {$this->height}cm,
                Types: {$types}";
    }
}
```

## Usage

```php

$data = [
    'id' => 1,
    'name' => 'Bulbasaur',
    'weight' => 69,
    'height' => 70,
    'types' => ['Grass', 'Poison']
];

$pokemon = new Pokemon($data);
echo $pokemon; 
```

## Output 

```plaintext

--------- echo $pokemon; ---------

ID: 1,
Name: Bulbasaur,
Weight: 69kg,
Height: 70cm,
Types: Grass, Poison

----------------------------------
```
