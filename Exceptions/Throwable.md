
# Throwable

![image](https://github.com/user-attachments/assets/cc615de4-8746-4863-bbb5-2d60f0ad8b19)

- La clase `Throwable` en PHP es la interfaz base para cualquier cosa que pueda ser lanzada (throwable). 
- Esto incluye tanto excepciones (`Exception`) como errores (`Error`). Es decir, cualquier clase que implemente la interfaz `Throwable` puede ser usada en un bloque `catch`.


### Jerarquía de `Throwable`

- `Throwable` (interfaz)
  - `Exception` (clase)
    - `ErrorException` (clase)
    - Otras subclases de `Exception`
  - `Error` (clase)
    - `TypeError` (clase)
    - `ParseError` (clase)
    - `AssertionError` (clase)
    - Otras subclases de `Error`

### Uso en un bloque `catch`

Al usar `catch (\Throwable $th)`, se está indicando que se desea capturar cualquier tipo de excepción o error que pueda ocurrir durante la ejecución del bloque `try`.

### Ejemplo

```php
try {
    // Código que puede lanzar una excepción o un error.
} catch (\Throwable $th) {
    // Manejo de la excepción o error.
    echo 'Se ha producido un error o excepción: ' . $th->getMessage();
}
```

En este ejemplo, cualquier excepción (`Exception`) o error (`Error`) que se lance dentro del bloque `try` será capturado por el bloque `catch`, y se ejecutará el código dentro de ese bloque para manejar la situación.

### Importancia

Usar `catch (\Throwable $th)` es útil para asegurarse de que se manejan tanto excepciones como errores, lo cual puede ser crucial en aplicaciones donde es necesario tener un manejo robusto de cualquier tipo de fallo que pueda ocurrir.
