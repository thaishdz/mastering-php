
# Magic Methods


![image](https://github.com/user-attachments/assets/98e87e43-7ad1-48cc-a095-2d6a6ef2cbce)

En PHP, 
- __Los métodos mágicos son aquellos que comienzan con dos guiones bajos (`__`).__
- Son llamados ✨sin que nosotros lo hagamos explícitamente✨
- __Se autoinvocan cuando se dispara una condición o evento__; es decir, sin necesidad de especificar el nombre del método en concreto.
- El método `__toString()` es uno de estos *magic methods*.

> 💡 Los métodos mágicos nos permiten saber cuándo un programador está interactuando con un objeto; permitiéndonos realizar acciones antes o después de esto.


### ¿Por Qué Doble Guión Bajo (`__`)?
- El doble guión bajo se usa para diferenciar estos métodos mágicos de los métodos normales de la clase.
- Esto evita conflictos de nombres y hace que sea claro que estos métodos tienen un propósito especial definido por PHP.

## `__toString()`
- El método `__toString()` se invoca automáticamente cuando se trata de convertir un objeto a una cadena de texto.
- Es útil cuando deseas definir cómo debería verse una instancia de la clase cuando se usa en un contexto que espera una cadena de texto, como `echo` o `print`.

### Otros Métodos Mágicos
Aquí hay algunos otros métodos mágicos comunes en PHP:

- `__construct()`: Se llama cuando se crea una nueva instancia de la clase (constructor).
- `__destruct()`: Se llama cuando el objeto se destruye (destructor).
- `__get($name)`: Se invoca cuando se intenta acceder a una propiedad inaccesible o no definida.
- `__set($name, $value)`: Se invoca cuando se intenta establecer el valor de una propiedad inaccesible o no definida.
- `__call($name, $arguments)`: Se invoca cuando se llama a un método inaccesible o no definido.
- `__sleep()`: Se invoca antes de que un objeto sea serializado.
- `__wakeup()`: Se invoca cuando un objeto serializado es deserializado.
- `__invoke()`: Se invoca cuando se intenta llamar a un objeto como una función.

### Ejemplo con `__toString()`

- __Evento que lo dispara__: este método es llamado luego de la invocación de las funciones de impresión `echo(), print() y printf()`.
- __Finalidad__: Permite asociar un string a un objeto, que será mostrado si dicho objeto es invocado como una cadena


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
        return "ID: {$this->id}, Name: {$this->name}, Weight: {$this->weight}kg, Height: {$this->height}cm, Types: {$types}";
    }
}

// Ejemplo de uso
$data = [
    'id' => 1,
    'name' => 'Bulbasaur',
    'weight' => 69,
    'height' => 70,
    'types' => ['Grass', 'Poison']
];

$pokemon = new Pokemon($data);
echo $pokemon; // Output: ID: 1, Name: Bulbasaur, Weight: 69kg, Height: 70cm, Types: Grass, Poison
```
## `__construct()`

Si no defines un constructor en tu clase, PHP utiliza un constructor por defecto. Esto significa que puedes crear instancias de la clase sin inicializar propiedades u otros datos ...

... 

### AAH FILHO DA PUTA AGORA SIM ENTENDOOOO  
![image](https://github.com/user-attachments/assets/77de7f67-5552-4aca-aba5-b5a67fd82abd)

SE ACABA DE DESBLOQUEAR EL MISTERIO DE CÓMO SE LLAMABA ✨MÁGICAMENTE✨ a ese constructor por defecto, sin que tuviésemos uno definido.

## `__invoke()` - Llamar a un objeto como si fuese una función 
- __Evento que lo dispara__: Este método es llamado cuando se intenta invocar un objeto como si se tratara de una función.

- __Finalidad__: Permite controlar el comportamiento de un objeto cuando este intenta ser llamado como a una función. Es decir, Si no definiéramos `__invoke` y tratáramos de utilizar el objeto como si se tratara de una función obtendremos un error.

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


