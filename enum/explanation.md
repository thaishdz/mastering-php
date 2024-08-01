# enum

- Es un tipo de dato que permite definir un conjunto de valores posibles para una variable. 
- PHP 8.1 adds support for Enumerations. An Enumeration, or an Enum for short, is an enumerated type that has a fixed number of possible values.

[Enums explicación de lo que ves aquí pero con más](https://php.watch/versions/8.1/enums)

A popular analogy for an Enum is suits in a deck of playing cards. A deck of playing cards has four suits, and they are fixed: 

- Hearts
- Clubs
- Diamonds
- Spades


![image](https://github.com/user-attachments/assets/45a000f3-cdaa-4583-9803-6ceb62d4c525)

In PHP, these suits (palos) can be enumerated with an `Enum`:


```php
enum Suit {
    case Clubs;
    case Diamonds;
    case Hearts;
    case Spades;
}

```
With `Suit` Enum, it is now possible to enforce types when accepting or returning a suit value:

```php 
function pick_card(Suit $suit) {}
```
```php
pick_card(Suit::Clubs);
pick_card(Suit::Diamonds);
pick_card(Suit::Hearts);
pick_card(Suit::Spades);
```
In contrast to using special strings or numbers internally (i.e. magic numbers) to store and work with parameters, Enums make the application code more readability, and avoids unexpected application state.

# `Enum` Syntax
PHP 8.1 reserves and uses `enum` keyword to declare Enums. The syntax is similar to a trait/class/interface syntax:

```php
enum Suit {
    case Clubs;
    case Diamonds;
    case Hearts;
    case Spades;
}
```

Enums are declared with the `enum` keyword, followed by the name of the Enum. An Enum can optionally declare string or int as backed values. Enums can also extend a class and/or implement interfaces.

Internally at the PHP parser level, there is a new token with named T_ENUM with value 369 assigned.

Enums can also hold a value for each case, which makes them Backed Enums.

```php
enum HTTPMethods: string {
    case GET = 'get';
    case POST = 'post';
}
```

Following is an example of an Enum that declares backed value type, and implements an interface.

```php
enum RolesClassLikeNamespacedEnum: string implements TestFor {  
  case Admin = 'Administrator';  
  case Guest = 'Guest';  
  case Moderator = 'Moderator';  
}
```

### Ejemplo de uso de Enum en PHP

```php
<?php

enum Status: string {
    case Pending = 'pending';
    case Active = 'active';
    case Archived = 'archived';
}

function getStatusMessage(Status $status): string {
    return match($status) {
        Status::Pending => 'The status is pending.',
        Status::Active => 'The status is active.',
        Status::Archived => 'The status is archived.',
    };
}

$status = Status::Active;
echo getStatusMessage($status); // Output: The status is active.
```

### Explicación
- **Definición de Enum**: `enum Status: string` define un enum llamado `Status` con valores de tipo `string`.
- **Casos**: `case Pending = 'pending';` define un caso del enum con el valor 'pending'.
- **Uso en Función**: La función `getStatusMessage` toma un parámetro de tipo `Status` y usa una declaración `match` para devolver un mensaje basado en el valor del enum.
- **Acceso a los Casos**: Para acceder a un caso del enum, se usa `Status::Active`.

## Explicación del `match`

El `match` no es exclusivo de los enums.

- **Sintaxis**: `match($status)` toma una expresión y compara su valor con cada caso especificado.
- **Casos**: `Status::Pending => 'The status is pending.'` define una expresión que se devuelve si `$status` es `Status::Pending`.
- **Devuelve un Valor**: `match` devuelve el valor de la expresión correspondiente al primer caso coincidente. Si no hay coincidencias, lanzará una excepción si no se proporciona un valor por defecto.


### Beneficios de Usar Enums
1. **Legibilidad**: El código es más fácil de leer y entender.
2. **Seguridad de Tipo**: Se asegura que solo valores válidos definidos en el enum pueden ser usados.
3. **Mantenimiento**: Facilita el mantenimiento del código al centralizar los posibles valores en una única definición.

