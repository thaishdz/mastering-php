
# `array_filter`



```php
$averageStudent = [
    [
        "name" => "Luisa",
        "average" => 7.1
    ],
    [
        "name" => "Cristina",
        "average" => 7.4
    ],
    [
        "name" => "Iván",
        "average" => 9.1
    ],
    [
        "name" => "Paula",
        "average" => 4.3
    ],
    [
        "name" => "Betancort",
        "average" => 5.62
    ],
    [
        "name" => "Jerico",
        "average" => 9.3
    ]
];
```

## La magia
```php

function isTopStudent(array $student)
{
   return $student["average"] >= 9;
}

$bestStudents = array_filter($averageStudent, 'isTopStudent');

```

> Sí, en el `array_filter` se pone primero el array y luego el callback 👍 

## Ouput 


```php
array(2) {
  [2]=> Indica la posición dentro del array $averageStudent
  array(2) {
    ["name"]=>
    string(5) "Iván"
    ["average"]=>
    float(9.1)
  }
  [5]=>
  array(2) {
    ["name"]=>
    string(6) "Jerico"
    ["average"]=>
    float(9.3)
  }
}
```
