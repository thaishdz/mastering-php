Las expresiones regulares (regex) son una herramienta poderosa para buscar y manipular texto. En PHP, 
puedes usar las funciones `preg_match`, `preg_match_all`, `preg_replace`, y `preg_split` para trabajar con expresiones regulares.

[Esta web te ayuda a visualizar las regex](https://regex-vis.com/samples)


![image](https://github.com/user-attachments/assets/39c361b5-d0d6-456b-9d37-983ab09d465d)





# Ejemplos 

## `preg_match`
Busca una coincidencia en una cadena.

```php
<?php
$pattern = "/hola/";
$string = "hola mundo";
if (preg_match($pattern, $string)) {
    echo "Coincidencia encontrada";
} else {
    echo "No se encontró coincidencia";
}
?>
```

## `preg_match_all`
Busca todas las coincidencias en una cadena.

```php
<?php
$pattern = "/\d+/";
$string = "Hay 3 manzanas y 5 naranjas";
preg_match_all($pattern, $string, $matches);
print_r($matches);
?>
```
Sí, `preg_match_all` llena el array `$matches` con los resultados de la búsqueda. Cada coincidencia encontrada en la cadena `$string` se almacena en este array. 

### Detalles del array `$matches`

- `$matches[0]` contiene todas las coincidencias completas.
- `$matches[1]`, `$matches[2]`, etc., contienen las subcoincidencias capturadas por los paréntesis en el patrón.

### Ejemplo detallado

Supongamos que queremos buscar todas las palabras que comienzan con "a" en una cadena.

```php
<?php
$pattern = "/\b(a\w*)\b/";  // \b indica un límite de palabra y \w* coincide con cualquier carácter de palabra 0 o más veces.
$string = "apple and apricot are amazing fruits";
preg_match_all($pattern, $string, $matches);
print_r($matches);
?>
```

### Salida esperada de `$matches`

```php
Array
(
    [0] => Array
        (
            [0] => apple
            [1] => and
            [2] => apricot
            [3] => are
            [4] => amazing
        )

    [1] => Array
        (
            [0] => apple
            [1] => and
            [2] => apricot
            [3] => are
            [4] => amazing
        )
)
```

En este ejemplo, `$matches[0]` contiene todas las coincidencias completas, y `$matches[1]` contiene las subcoincidencias capturadas por el primer paréntesis en el patrón (en este caso, son las mismas que las coincidencias completas).

Si tienes más grupos de captura en tu patrón, `$matches[2]`, `$matches[3]`, etc., contendrán las subcoincidencias correspondientes.

Las subcoincidencias se refieren a partes específicas del patrón que se capturan usando paréntesis. Estos paréntesis permiten dividir el patrón en grupos más pequeños y capturar porciones específicas del texto.

### Ejemplo de subcoincidencias

Supongamos que queremos extraer el nombre de usuario y el dominio de una dirección de correo electrónico:

```php
<?php
$pattern = "/([a-z0-9._%+-]+)@([a-z0-9.-]+\.[a-z]{2,4})/i";
$string = "Mi correo es ejemplo@example.com";
preg_match_all($pattern, $string, $matches);
print_r($matches);
?>
```

### Explicación del patrón

- `([a-z0-9._%+-]+)`: Captura el nombre de usuario (una o más letras, dígitos, o ciertos caracteres especiales).
- `@`: Coincide con el símbolo `@`.
- `([a-z0-9.-]+\.[a-z]{2,4})`: Captura el dominio (una o más letras, dígitos, puntos o guiones, seguido de un punto y dos a cuatro letras).

### Salida esperada de `$matches`

```php
Array
(
    [0] => Array
        (
            [0] => ejemplo@example.com
        )

    [1] => Array
        (
            [0] => ejemplo
        )

    [2] => Array
        (
            [0] => example.com
        )
)
```

### Detalles de `$matches`

- `$matches[0]`: Todas las coincidencias completas. En este caso, `ejemplo@example.com`.
- `$matches[1]`: Primera subcoincidencia (nombre de usuario). En este caso, `ejemplo`.
- `$matches[2]`: Segunda subcoincidencia (dominio). En este caso, `example.com`.

Las subcoincidencias te permiten extraer partes específicas de una coincidencia más grande, lo cual es útil para analizar y manipular texto de manera más precisa.

## `preg_replace`
Reemplaza todas las coincidencias en una cadena.

```php
<?php
$pattern = "/mundo/";
$replacement = "PHP";
$string = "Hola mundo";
$new_string = preg_replace($pattern, $replacement, $string);
echo $new_string; // Salida: Hola PHP
?>
```

## `preg_split`
Divide una cadena usando una expresión regular.

```php
<?php
$pattern = "/[\s,]+/";
$string = "manzana, naranja, plátano";
$fruits = preg_split($pattern, $string);
print_r($fruits);
?>
```

### Caracteres especiales

- `^`: Inicio de la cadena.
- `$`: Fin de la cadena.
- `.`: Cualquier carácter excepto nueva línea.
- `*`: Cero o más repeticiones.
- `+`: Una o más repeticiones.
- `?`: Cero o una repetición.
- `\d`: Cualquier dígito.
- `\w`: Cualquier carácter de palabra (letras, dígitos, guión bajo).
- `[]`: Conjunto de caracteres.
- `()` : Agrupación y captura.

### Ejemplo avanzado

Buscar una dirección de correo electrónico.

```php
<?php
$pattern = "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i";
$string = "Mi correo es ejemplo@example.com.";
if (preg_match($pattern, $string, $match)) {
    echo "Correo encontrado: " . $match[0];
} else {
    echo "No se encontró un correo";
}
?>
```
