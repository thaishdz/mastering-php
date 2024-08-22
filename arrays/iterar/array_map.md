
# `array_map`

- __Aplica una función a cada elemento de uno o más arrays__ y **devuelve un nuevo array** con los valores transformados.
- __No modifica__ el array original.
- Está __diseñado__ para **transformar y crear** __un nuevo array__ basado en los elementos de uno o más arrays de entrada.

```php
$numbers = [1, 2, 3, 4];

$doubled = array_map(function($value) {
    return $value * 2; // Crea un nuevo array con los valores transformados
}, $numbers);

print_r($doubled); // [2, 4, 6, 8]
print_r($numbers); // [1, 2, 3, 4] (el array original no se modifica)
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
