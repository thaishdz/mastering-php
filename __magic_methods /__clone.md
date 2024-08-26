

# `__clone`


- Se llama cuando quieres clonar un objeto 👍

<p align=center>
    <img src="https://github.com/user-attachments/assets/d890efb8-8fb3-4d96-8493-24b5d891ddae" width="500" height="500" />
</p>

Por defecto, PHP permite clonar objetos usando la palabra clave `clone`

```php

class SunWukong {
    public $monkey;

    public function __construct($monkey) {
        $this->monkey = $monkey;
    }

    // Método que se ejecuta al clonar el objeto
    public function __clone() {
        $this->monkey = "Monkey Clone"; // Puedes redefinir propiedades al clonar
    }
}

$original = new SunWukong("Original");
$clon = clone $original; // Se llama a __clone()

echo $clon->monkey;

```

# ¿Cómo funciona `clone`?

Cuando ejecutas

```php
$clon = clone $original; // Se llama a __clone()
```

Internamente, PHP :

1. Crea una copia superficial del objeto `$original`.
__Significa que las propiedades del objeto original se copian al nuevo objeto__. Sin embargo, si alguna propiedad es un objeto (en lugar de un valor primitivo como un número o cadena), ambas instancias compartirán la referencia al mismo objeto.

2. Llama automáticamente al método mágico `__clone()`, si está definido, en la nueva instancia creada.
Después de crear la copia superficial, PHP ejecuta el método `__clone()` si está presente, permitiéndote modificar la copia.

Por lo tanto, ⛔ __NO NECESITAS__ hacer algo como esto:

```php
$clon = clone($original); // Incorrecto
```
