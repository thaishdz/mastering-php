
# `array_walk`

- Aplica una función a cada elemento del array **pasándolo por referencia** (`&`).
- __Modifica el array original__
- __No devuelve un nuevo array__; simplemente retorna `true` si se ejecuta correctamente.
- Su propósito principal es realizar operaciones o transformaciones sobre cada elemento del array original.
- Puedes acceder tanto al valor como a la clave del array dentro de la función.

```php
$numbers = [1, 2, 3, 4];

array_walk($numbers, function(&$value) {
    $value *= 2; // Modifica el array original
});

print_r($numbers); // [2, 4, 6, 8]
```

### **Diferencias Clave entre `array_walk()` y `array_map()`**

| Característica       | `array_walk()`                                        | `array_map()`                                  |
|----------------------|-------------------------------------------------------|------------------------------------------------|
| Modifica el array original | Sí, modifica el array directamente (por referencia). | No, devuelve un nuevo array transformado.      |
| Retorno             | `true` o `false` (no un array).                       | Un nuevo array con los elementos modificados.  |
| Uso de referencia   | Requiere usar `&` para modificar elementos.            | No necesita `&`, la función no modifica el array original. |
| Múltiples arrays    | No soporta múltiples arrays como entrada.             | Puede recibir múltiples arrays como entrada y aplicar la función en paralelo. |
| Propósito principal | Realizar cambios en el array original o efectos colaterales (ej: logging). | Transformación funcional para crear un nuevo array. |

### ¿Cuándo usar cada uno?

- **Usa `array_walk()`** cuando necesites modificar un array existente, sin crear un nuevo array (por ejemplo, si deseas formatear los valores directamente o aplicar una acción a cada uno sin cambiar la estructura del array).
- **Usa `array_map()`** cuando quieras **transformar y crear un nuevo array** basado en uno o más arrays de entrada.
