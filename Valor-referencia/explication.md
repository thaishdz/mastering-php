# Asignación de variables por valor y referencia

## Por valor
![image](https://github.com/user-attachments/assets/4f203e26-625d-4ff3-a9c6-a46c614e0c9e)


- Se copia el valor de una variable a otra. 
- Las dos variables son independientes
- Los cambios en una no afectan a la otra.

```php
$a = 5;  // $a es un entero con valor 5
$b = $a; // $b es una copia de $a, también con valor 5

$b = 10; // Cambiamos el valor de $b a 10

echo $a; // Salida: 5
echo $b; // Salida: 10
```

## Tipos de datos por Valor
- Primitivos (integers, floats, strings, booleans ....)
- Arrays
- Null

## Por referencia
![image](https://github.com/user-attachments/assets/bb1dfc3a-db9a-41b1-b1ab-db5f98633429)

- Ambas variables apuntan al mismo valor. 
- Un cambio en una variable afecta a la otra.
- Los datos por referencia no copian su valor, **HEREDAN SU POSICIÓN DE MEMORIA**

```php
$a = 5;    // $a es un entero con valor 5
$b = &$a;  // $b es una referencia a $a

$b = 10;   // Cambiamos el valor de $b, que también cambia el valor de $a

echo $a; // Salida: 10
echo $b; // Salida: 10
```

## Tipos de datos por Referencia

- Objetos
- Recursos (recuros externos, ficheros, conexiones a BD, ...)

```php
$handle = fopen("file.txt", "r");
$anotherHandle = $handle;

// Ambos manejadores apuntan al mismo recurso de archivo

```
