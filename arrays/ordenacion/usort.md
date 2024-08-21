
# `usort()`

- Se utiliza para __ordenar arrays indexados (no asociativos) usando un callback de comparación definido por ti__. 
- Sin embargo, __se puede usar con arrays asociativos si trabajas con una estructura más compleja como un array de arrays `[ [], [] ]`__.

```php
<?php

$productos = [
    ['nombre' => 'Portátil', 'precio' => 1500],
    ['nombre' => 'Ratón', 'precio' => 20],
    ['nombre' => 'Teclado', 'precio' => 50],
    ['nombre' => 'Monitor', 'precio' => 300],
];

// Usamos usort para ordenar por precio en orden ascendente.
usort($productos, function($a, $b) {
    return $a['precio'] <=> $b['precio'];
});

print_r($productos);
```

### Explicación
- **`usort($productos, function($a, $b) {...});`**: Aquí, el array `$productos` __se ordena usando la función anónima.__
- **`$a['precio'] <=> $b['precio']`**: El operador "nave espacial" (`<=>`) devuelve `-1`, `0`, o `1` dependiendo de si `$a` es menor, igual o mayor que `$b`. Esto se usa para definir el orden de los elementos.

El resultado será:

```php
Array
(
    [0] => Array
        (
            [nombre] => Ratón
            [precio] => 20
        )

    [1] => Array
        (
            [nombre] => Teclado
            [precio] => 50
        )

    [2] => Array
        (
            [nombre] => Monitor
            [precio] => 300
        )

    [3] => Array
        (
            [nombre] => Portátil
            [precio] => 1500
        )
)
```

💡 Los productos están ordenados por precio de menor a mayor.



> ⚠️`usort()` **no devuelve `true` o `false`**; devuelve `true` si la ordenación fue exitosa y `false` si falló. Sin embargo, **modifica directamente** el array original, por lo que __NO es necesario asignarlo a una nueva variable.__ 

La función de comparación dentro de `usort()` (la *closure*) determina el orden de los elementos, pero **no devuelve `true` o `false` directamente**. En su lugar, devuelve:

- **`-1`** si `$a` debe ir antes que `$b`.  
- **`1`** si `$a` debe ir después de `$b`.  
- **`0`** si son iguales y no cambia el orden relativo.

```php
<?php

$numeros = [3, 2, 5, 1, 4];

// Ordenamos el array con usort, usando una función de comparación.
usort($numeros, function($a, $b) {
    return $a <=> $b; // Orden ascendente
});

print_r($numeros);
```

Resultado:

```php
Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
)
```

### Puntos clave:
- `usort()` **modifica el array original**; no necesitas asignarlo a una nueva variable.
- La función de comparación (closure) no devuelve `true` o `false`, sino valores numéricos (`-1`, `0`, `1`) para determinar el orden.
- La función retorna `true` si se realiza la ordenación correctamente.

## [Kata] Obtén una lista de estudiantes ordenada desde el más joven 

```json

{
    "dataStudents" : [
        {
            "name": "Thais",
            "birthday": "10-09-1993",
            "grades": {
                "Math" : 4.5,
                "Biology" : 6,
                "Physics": 8,
                "Philosophy" : 9,
                "History": 8
            }
        },
        {
            "name": "Cristina",
            "birthday": "30-08-1991",
            "grades": {
                "Math" : 7,
                "Biology" : 5,
                "Physics": 7,
                "Philosophy" : 10,
                "History": 8
            } 
        },
        {
            "name": "Iván",
            "birthday": "01-07-1993",
            "grades": {
                "Math" : 10,
                "Biology" : 10,
                "Physics": 10,
                "Philosophy" : 7.5,
                "History": 8
            } 
        },
        {
            "name": "Paula",
            "birthday": "20-01-1995",
            "grades": {
                "Math" : 3,
                "Biology" : 5,
                "Physics": 7,
                "Philosophy" : 5.5,
                "History": 1
            } 
        },
        {
            "name": "Betancort",
            "birthday": "18-02-1991",
            "grades": {
                "Math" : 3.4,
                "Biology" : 9.2,
                "Physics": 2.5,
                "Philosophy" : 5,
                "History": 8
            } 
        },
        {
            "name": "Jerico",
            "birthday": "07-06-1990",
            "grades": {
                "Math" : 10,
                "Biology" : 9.2,
                "Physics": 10,
                "Philosophy" : 9.3,
                "History": 8
            } 
        }
    ]
}
```
## Solución
```php

$jsonDataStudents = file_get_contents("students.json");
$dataset = json_decode($jsonDataStudents, true);


function formatStudentWithAge(array $student) : array
{
    // Convertimos la fecha de nacimiento a un objeto DateTime
    $birthdate = DateTime::createFromFormat('d-m-Y', $student["birthday"]);
    $currentDate = new DateTime();

    // Calculamos la diferencia en años entre las fechas
    $age = $birthdate->diff($currentDate)->y;

    return [
        "name"      => $student["name"],
        "age"       => $age,
        "birthdate" => $student["birthday"]
    ];
}


function sortStudentsByAge(array $dataset) : array 
{
    $studentsWithAges = array_map('formatStudentWithAge', $dataset);

    usort($studentsWithAges, function ($studentA, $studentB) {
        return $studentA["age"] <=> $studentB["age"];
    });

    return $studentsWithAges;
}


$sortAgeStudents = sortStudentsByAge($dataset["dataStudents"]);

print_r($sortAgeStudents);
```

## Output

```php
Array
(
    [0] => Array
        (
            [name] => Paula
            [age] => 29
            [birthdate] => 20-01-1995
        )

    [1] => Array
        (
            [name] => Iván
            [age] => 31
            [birthdate] => 01-07-1993
        )

    [2] => Array
        (
            [name] => Thais
            [age] => 32
            [birthdate] => 10-11-1992
        )

    [3] => Array
        (
            [name] => Cristina
            [age] => 33
            [birthdate] => 30-08-1991
        )

    [4] => Array
        (
            [name] => Betancort
            [age] => 33
            [birthdate] => 18-02-1991
        )

    [5] => Array
        (
            [name] => Jerico
            [age] => 34
            [birthdate] => 07-06-1990
        )
```
