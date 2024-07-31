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
