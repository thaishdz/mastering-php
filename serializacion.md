## Qué carajos es Serializar?

__Convertir un objeto en una cadena de texto__, se utiliza, por ejemplo, para almacenar el estado de un objeto en un archivo o transmitirlo a través de la red


```php

class Usuario {
    public $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
}

$usuario = new Usuario("Thais");
$serializado = serialize($usuario);

echo $serializado; // Salida: O:7:"Usuario":1:{s:4:"name";s:5:"Thais";}

```

![image](https://github.com/user-attachments/assets/ac9ff8f3-3009-4c42-a0ac-4f3fd75bce68)


```php
O:7:"Usuario":1:{s:4:"name";s:5:"Thais";}
```

### Representación visual:

```
Objeto (O)
|
+-- Clase: "Usuario" (7 caracteres)
|
+-- Propiedades:
    +-- Nombre: "name" (cadena de 4 caracteres)
    +-- Valor: "Thais" (cadena de 5 caracteres)

```
### Más detallado
- `:1:` Indica el número de propiedades que tiene el objeto. En este caso, tiene 1 propiedad.

- `{s:4:"name";s:5:"Thais";}`:

- `s:4:"name"`:
  - `s` indica que se trata de una cadena de texto (string).
  - `4` es la longitud de la cadena "nombre" (tiene 6 caracteres).
  - `nombre` nombre de la propiedad.

- `s:5:"Thais"`:
  - `s` indica una cadena.
  - `4` es la longitud de la cadena "Juan".
  - `Thais` es el valor de la propiedad.


Entonces ... `deserializar` es ...

<img src="https://github.com/user-attachments/assets/0948e7b8-45b0-4767-ad1a-c9ce9f3aa564" width="200" height="200"/>

 Convertir una cadena de texto, en un objeto, restaurando su estado original👍.

```php

$deserializado = unserialize($serializado);

echo $deserializado->name; // Salida: Thais

```

## OLRAIT ... Y pa qué vergas quiero esto?

 Porque necesitas manipular datos que de otra manera no podrías tratar si no los transformas.

- Almacenar un objeto en una base de datos o archivo.
  - Necesitas manejar el estado del objeto que interactúa con la BBDD, por eso dices, vale necesito traerme esta `row` y manipularla
- Enviar un objeto a través de una red (como en una API).


### Consideraciones de seguridad 👮 🚨
La deserialización puede ser peligrosa si se aplica a datos no confiables. Si deserializas datos que provienen de una fuente externa, como un usuario, pueden ser manipulados para ejecutar código malicioso o alterar el comportamiento de tu aplicación.
