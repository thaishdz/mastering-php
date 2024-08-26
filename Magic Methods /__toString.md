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

## Otros usos

- Lanzar excepciones
- Registros (logs)
- Testing
- Debugging

En general te sirve para todas aquellas ocasiones en las que __quieras representar un objeto como una cadena__.

## Y ... `serialize()` no me serviría también para representar el objeto?

También existe esa opción, pero `__toString` te da más libertad a la hora de «representar» el objeto como una cadena. 

## Ejemplo con `serialize()`

Para que veas la diferencia, con `serialize()` el objeto `$persona` quedaría así:

```php

class Human
{

    private $name;
    private $firstName;

    public function __construct(string $name, string $firstName)
    {
        $this->name = $name;
        $this->firstName = $firstName;
    }
}

$humana = new Human('Thais', 'Hdz');

echo serialize($humana) . PHP_EOL;

```

```plaintext

O:5:"Human":2:{s:11:"�Human�name";s:5:"Thais";s:16:"�Human�firstName";s:3:"Hdz";}

```

### ¿Qué pasa si no añado este método a mi clase?
Absolutamente nada. Puedes prescindir de él y tus clases seguirán funcionando a la perfección 👍.

### Ayuditas 🛎️

- [__toString - PHPSensei](https://phpsensei.es/el-metodo-__tostring-en-php/)
