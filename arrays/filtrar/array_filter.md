
# `array_filter`

- Toma un array y lo filtra usando una función que contiene la lógica que necesitas para filtrar.
- Esa función se aplica a cada elemento del array y los elementos que hacen que la función devuelva `true` __se mantienen en el array resultante__
- Los elementos que hacen que la función devuelva `false` __se eliminan.__


## Tienes un array de arrays y quieres obtener una lista con los __✨ best students ✨__ :

### Cómo funciona en la práctica

```php
$averageStudent = [
    ["name" => "Bob", "average" => 8.5],
    ["name" => "Jerico", "average" => 9.0],
    ["name" => "Marina", "average" => 2.0],
    ["name" => "Cristina", "average" => 9.2],
];
```

#### Cuando llamas a `array_filter`

```php
$bestStudents = array_filter($averageStudent, 'isTopStudent');
```
1. `$averageStudent` es el array que queremos filtrar. Es un array de arrays, donde cada array interno representa a un estudiante con varios atributos, incluyendo "average".
2. `array_filter` recorrerá cada estudiante en `$averageStudent`.
3. Para cada estudiante, llamará a `isTopStudent` con el array del estudiante.
4. `isTopStudent` es la función __que `array_filter` usará para decidir si cada elemento del array `$averageStudent` debería ser incluido en el resultado o no.__
```plaintext
Para Bob: isTopStudent(["name" => "Bob", "average" => 8.5]) devuelve false.
Para Jerico: isTopStudent(["name" => "Jerico", "average" => 9.0]) devuelve true
```
5. Solo los estudiantes para los cuales `isTopStudent` devuelve `true` se incluirán en `$bestStudents.`

## La función `isTopStudent`:

Esta es la función de callback que usamos con `array_filter`:

```php

function isTopStudent(array $students)
{
   return $students["average"] >= 9;
}

```
- Esta función toma un array `$students` como parámetro.
- Retorna `true` __si el valor asociado a `average` es mayor o igual a 9.__
- De lo contrario, retorna `false.`

## Ouput 

```php
array(2) {
  [1]=> Indica la posición dentro del array $averageStudent
  array(2) {
    ["name"]=>
    string(6) "Jerico"
    ["average"]=>
    float(9)
  }
  [3]=>
  array(2) {
    ["name"]=>
    string(8) "Cristina"
    ["average"]=>
    float(9.2)
  }
}
```

# Filtrar Elementos que no sean estrictamente Booleanos

Puedes usar `array_filter` para eliminar valores :
- `false` (bueno este sí es estrictamente booleano 🤡)
- `null`
- elementos vacíos => `[]`

```php
$array = [0, 1, false, 2, null, [], 3];
$filteredArray = array_filter($array);
```
Por defecto, `array_filter` eliminará todos los valores que se consideren _falsy_ (`0`, `false`, `null`, `''`, ...).

### Output

```php
Array
(
    [1] => 1
    [3] => 2
    [6] => 3
)
```

# Obtén los pares

```php

$array = [1, 2, 3, 4, 5];

// Función de callback que devuelve un valor booleano
$filteredArray = array_filter($array, function($value) {
    return $value % 2 === 0; // Filtra números pares
});
```

### Output

```php
Array
(
    [1] => 2
    [3] => 4
)
```

