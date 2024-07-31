# EJERCICIO

Crea una regex que sea capaz de encontrar y extraer todos los número de un texto.


```php


 $pattern = '/\d+/';
 $text = 'hfn2ry73gbd02ru829eh';
 
 preg_match_all($pattern, $text, $matches);
 
 print_r($matches); 

```
-------------------------------------------------------------------------------------------------------------
### Explicación del patrón

- `\d`: Coincide con una o más cifras consecutivas. `\d` representa cualquier dígito (0-9)
-  `+` indica que debe haber al menos una cifra, pero puede haber más.

### Salida de `$matches`

```php
Array
(
    [0] => Array
        (
            [0] => 2
            [1] => 73
            [2] => 02
            [3] => 829
        )
)
```

### Detalles de `$matches`

- `$matches[0]`: Contiene todas las secuencias de números encontradas en la cadena. En este caso, `2`, `73`, `02`, y `829`.

Este código buscará todas las secuencias de dígitos en la cadena y las almacenará en el array `$matches`.


El funcionamiento de `preg_match_all` con una expresión regular que busca números es el siguiente:

1. **Encuentra una coincidencia**: La función busca la primera secuencia de uno o más dígitos en la cadena.
2. **Almacena la coincidencia en `$matches`**: La coincidencia encontrada se almacena en el array `$matches`.
3. **Continúa buscando**: La función continúa buscando desde el punto donde encontró la última coincidencia.
4. **Almacena cada nueva coincidencia en la siguiente posición**: Cada nueva secuencia de dígitos encontrada se almacena en la siguiente posición del array.
5. **Interrumpe cuando no hay coincidencia**: Si la función encuentra caracteres que no son números, deja de almacenar y continúa buscando la siguiente secuencia de dígitos.
   

### Desglose de la operación

- **Inicio**: 
  - Cadena: `hfn2ry73gbd02ru829eh`
  - Patrón: `/\d+/`

- **Primera coincidencia**:
  - Encuentra `2` en `hfn2ry73gbd02ru829eh`
  - Almacena `2` en `$matches[0][0]`
  - Continúa después de `2`

- **Segunda coincidencia**:
  - Encuentra `73` en `hfn2ry73gbd02ru829eh`
  - Almacena `73` en `$matches[0][1]`
  - Continúa después de `73`

- **Tercera coincidencia**:
  - Encuentra `02` en `hfn2ry73gbd02ru829eh`
  - Almacena `02` en `$matches[0][2]`
  - Continúa después de `02`

- **Cuarta coincidencia**:
  - Encuentra `829` en `hfn2ry73gbd02ru829eh`
  - Almacena `829` en `$matches[0][3]`
  - Continúa después de `829`

- **Fin**:
  - No se encuentran más secuencias de dígitos

### Salida esperada de `$matches`

```php
Array
(
    [0] => Array
        (
            [0] => 2
            [1] => 73
            [2] => 02
            [3] => 829
        )
)
```

Así, `$matches[0]` contendrá todas las secuencias de números encontradas en la cadena, cada una almacenada en una posición separada del array.
