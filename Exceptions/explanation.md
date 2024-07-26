# Exceptions
<p align="center">
  <img src="https://github.com/user-attachments/assets/7dc15b4e-7309-47a1-8d15-d62c74099ef7" />
</p>

## Excepciones Básicas

PHP tiene una clase base llamada `Exception` de la cual derivan otras clases de excepción. 
### Cómo utilizar la clase base `Exception`:

```php
<?php
try {
    // Código que puede lanzar una excepción
    if (!file_exists("archivo.txt")) {
        throw new Exception("El archivo no existe.");
    }
} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage();
}
?>
```

## Excepciones Personalizadas

```php
<?php
class MiExcepcionPersonalizada extends Exception {}

try {
    // Código que puede lanzar una excepción personalizada
    throw new MiExcepcionPersonalizada("Este es un error personalizado.");
} catch (MiExcepcionPersonalizada $e) {
    echo "Excepción personalizada capturada: " . $e->getMessage();
}
?>
```

## Excepciones Integradas en PHP

PHP también incluye varias excepciones integradas, como `RuntimeException`, `InvalidArgumentException`, entre otras. 
Aquí tienes algunos ejemplos:

### `RuntimeException`

```php
<?php
try {
    // Código que puede lanzar una RuntimeException
    throw new RuntimeException("Esto es una RuntimeException.");
} catch (RuntimeException $e) {
    echo "RuntimeException capturada: " . $e->getMessage();
}
?>
```

### `InvalidArgumentException`

```php
<?php
function dividir($a, $b) {
    if ($b == 0) {
        throw new InvalidArgumentException("El divisor no puede ser cero.");
    }
    return $a / $b;
}

try {
    echo dividir(10, 0);
} catch (InvalidArgumentException $e) {
    echo "InvalidArgumentException capturada: " . $e->getMessage();
}
?>
```

### Jerarquía de Excepciones

Capturar diferentes tipos de excepciones en un orden específico:

```php
<?php
class MiExcepcionA extends Exception {}
class MiExcepcionB extends Exception {}

try {
    // Código que puede lanzar diferentes excepciones
    throw new MiExcepcionB("Error tipo B.");
} catch (MiExcepcionB $e) {
    echo "MiExcepcionB capturada: " . $e->getMessage();
} catch (MiExcepcionA $e) {
    echo "MiExcepcionA capturada: " . $e->getMessage();
} catch (Exception $e) {
    echo "Exception capturada: " . $e->getMessage();
}
?>
```

### `finally`

El bloque `finally` se ejecuta independientemente de si se lanzó o no una excepción:

```php
<?php
try {
    // Código que puede lanzar una excepción
    throw new Exception("Este es un error.");
} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage();
} finally {
    echo "Este bloque se ejecuta siempre.";
}
?>
```

```php

<?php

/*
 *
 * DIFICULTAD EXTRA (opcional):
 * Crea una función que sea capaz de procesar parámetros, pero que también
 * pueda lanzar 3 tipos diferentes de excepciones (una de ellas tiene que
 * corresponderse con un tipo de excepción creada por nosotros de manera
 * personalizada, y debe ser lanzada de manera manual) en caso de error.
 * - Captura todas las excepciones desde el lugar donde llamas a la función.
 * - Imprime el tipo de error.
 * - Imprime si no se ha producido ningún error.
 * - Imprime que la ejecución ha finalizado.
 */
```


