
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
| Modifica el array original | Sí, (por referencia `&`). 		       | No, devuelve un nuevo array ✨transformado✨ |
| Retorno             | `true` o `false` (no un array).                        | Un nuevo array con los elementos modificados.  |
| Uso de referencia   | Requiere usar `&` para modificar elementos.            | No necesita `&`, la función no modifica el array original. |
| Múltiples arrays    | No soporta múltiples arrays como entrada.             | Puede recibir múltiples arrays como entrada y aplicar la función en paralelo. |
| Propósito principal | Realizar cambios en el array original o efectos colaterales (ej: logging). | Transformación funcional para crear un nuevo array. |

### ¿Cuándo usar cada uno?

- **Usa `array_walk()`** cuando necesites modificar un array existente, sin crear un nuevo array (por ejemplo, si deseas formatear los valores directamente o aplicar una acción a cada uno sin cambiar la estructura del array).
- **Usa `array_map()`** cuando quieras **transformar y crear un nuevo array** basado en uno o más arrays de entrada.


# Ejemplo culerísimo

Tenemos un listado de pokemones que queremos evolucionar

```php

$pokemones = ['bulbasaur','mewtwo', 'pikachu'];

function getEvolutions($pokemon)
{
	switch($pokemon)
	{
		case 'bulbasaur':
			return ['ivysaur', 'venasaur'];
		case 'mewtwo':
			return $pokemon;
		case 'pikachu':
			return 'raichu';
		default:
			return "";
	};
}

$evolutions = array_map('getEvolutions', $pokemones);
```
1. El `array_map` coge cada Pokémon y lo _evoluciona_ (si existe evolución si no 💩) con la función que le mandamos como `callback` => `getEvolutions()`.
2. En el `switch` se evalúa cada Pokémon del array y se ✨transforma✨
3. Cada `return` actúa como si estuviéramos haciendo un `push` a un array, es decir, estamos añadiendo un nuevo valor en cada iteración al array que devolverá el `map`

## Output

```php
Array
(
    [0] => Array
        (
            [0] => ivysaur
            [1] => venasaur
        )

    [1] => mewtwo
    [2] => raichu
)

```

La salida del array `$pokemones` indica que todo sigue igual

```php

print_r($pokemones); // esta vaina para visualizar arrays y objetos (a menos que este tenga propiedades privadas) 👍

Array
(
    [0] => bulbasaur
    [1] => mewtwo
    [2] => pikachu
)

```
### Vamos con otro ejemplo por si todavía derrapas ...



# Transformar un valor del array, de string a un objeto

Me vas a ✨transformar✨ esas fechas a un objeto `DateTime`

```php

$mapStudents = [
    ['name'=> 'pepito', 'birthday'=> '10-11-1990'],
    ['name'=> 'juanito','birthday'=> '20-07-1995']
];

$result = array_map(function($student){
    $student['birthday'] = DateTime::createFromFormat('d-m-Y', $student['birthday']);
    return $student;
}, $mapStudents);

```
## Explicación Paso a Paso
- `$mapStudents`: Es un array de arrays asociativos (lo que viene siendo una matrioska). Cada sub-array tiene info de un estudiante.
- `array_map()` : Esta función recorre cada elemento de `$mapStudents` y aplica la función anónima en cada uno de ellos. El resultado de esta transformación se guarda en el array `$result`.
- El `callback` : Dentro de la función anónima se hace lo siguiente:

1. Se toma el campo `birthday` del array actual (`$student`) y se convierte en un objeto `DateTime` usando `DateTime::createFromFormat('d-m-Y', $student['birthday'])`.
2. Luego, el valor de `birthday` se reemplaza con el objeto `DateTime` correspondiente.
3. `return $student`: __Aquí es donde está la clave__. `array_map()` requiere que la función devuelva un valor para cada iteración. Este valor será lo que se guarde en el array de resultados (`$result`).
4.  Debes retornar `$student` porque el objetivo de `array_map()` es generar un nuevo array con los elementos transformados.
   
> 💡 Si no retornas `$student`, __el array resultante no tendría los datos modificados.__

## Ouput

```php
Array
(
    [0] => Array
        (
            [name] => pepito
            [birthday] => DateTime Object
                (
                    [date] => 1990-11-10 15:57:16.000000
                    [timezone_type] => 3
                    [timezone] => UTC
                )

        )

    [1] => Array
        (
            [name] => juanito
            [birthday] => DateTime Object
                (
                    [date] => 1995-07-20 15:57:16.000000
                    [timezone_type] => 3
                    [timezone] => UTC
                )

        )

)
```
Se transformó cada string de `birthday` en un objeto `DateTime` como ves
