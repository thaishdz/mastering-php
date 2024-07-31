
# Validar un email
 
 Aquí hay una expresión regular que es ampliamente utilizada y generalmente aceptada como efectiva para validar correos electrónicos:

```php

$pattern_mail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$mail = "loki%llo.93@co.uk";


if(preg_match($pattern_mail, $mail))
{
    echo "está chevere";
}else
{
    echo "malardo";
}

```

### Explicación del primer patrón (clase de caracteres)

- `^`: Inicio de la cadena.
- `[a-zA-Z0-9._%+-]+`: Uno o más caracteres que pueden ser letras (mayúsculas o minúsculas), dígitos, puntos, guiones bajos, signos de porcentaje, signos más o signos menos.
- `@`: Exactamente un símbolo de arroba.
- `[a-zA-Z0-9.-]+`: Uno o más caracteres que pueden ser letras (mayúsculas o minúsculas), dígitos, puntos o guiones.
- `\.`: Exactamente un punto.
- `[a-zA-Z]{2,}`: Dos o más letras (mayúsculas o minúsculas).
- `$`: Fin de la cadena.

En la expresión regular `[a-zA-Z0-9._%+-]+`, los caracteres `.`, `_`, `%`, `+`, y `-` se toman como literales. Esto significa que se buscarán exactamente esos caracteres en las posiciones especificadas. Aquí tienes una explicación detallada:

### Explicación de la clase de caracteres `[a-zA-Z0-9._%+-]+`

- `a-z`: Cualquier letra minúscula del alfabeto inglés (de la 'a' a la 'z').
- `A-Z`: Cualquier letra mayúscula del alfabeto inglés (de la 'A' a la 'Z').
- `0-9`: Cualquier dígito (de '0' a '9').
- `.`: Un punto literal.
- `_`: Un guion bajo literal.
- `%`: Un signo de porcentaje literal.
- `+`: Un signo de más literal.
- `-`: Un guion literal.

El conjunto de caracteres dentro de los corchetes `[ ]` define una clase de caracteres, que coincide con cualquier carácter individual dentro del conjunto. El signo `+` fuera de los corchetes indica que debe haber al menos uno de estos caracteres, pero puede haber más.

### Ejemplo

Si tomamos la cadena `user.name+example%test-email@domain.com`, la parte `user.name+example%test-email` coincide con el patrón `[a-zA-Z0-9._%+-]+`.

### Salida esperada

El correo `user.name+example%test-email@domain.com` será considerado válido porque todos los caracteres en la parte antes de `@` coinciden con `[a-zA-Z0-9._%+-]+`.

En resumen, sí, los caracteres `.`, `_`, `%`, `+`, y `-` se toman como literales y se buscan exactamente en la cadena, tal como están.

# Tercera parte de la regex

La tercera parte `\.[a-zA-Z]{2,}` de la regex se utiliza para validar el dominio de nivel superior (TLD) de un email.

### Desglose del patrón `\.[a-zA-Z]{2,}`

1. `\.`:
   - El carácter `.` tiene un significado especial en las expresiones regulares, donde coincide con cualquier carácter individual.
   - El `\` (barra invertida) se utiliza para escapar el `.` y hacer que coincida con un punto literal.

2. `[a-zA-Z]`:
   - Los corchetes `[ ]` definen una clase de caracteres.
   - `a-z` coincide con cualquier letra minúscula del alfabeto inglés (de la 'a' a la 'z').
   - `A-Z` coincide con cualquier letra mayúscula del alfabeto inglés (de la 'A' a la 'Z').
   - Juntos, `[a-zA-Z]` coinciden con cualquier letra, ya sea minúscula o mayúscula.

3. `{2,}`:
   - Las llaves `{ }` se utilizan para especificar un cuantificador.
   - `{2,}` indica que debe haber al menos 2 de los caracteres especificados en la clase de caracteres `[a-zA-Z]`, pero puede haber más.

### Combinación completa `\.[a-zA-Z]{2,}`

- `\.`: Coincide con un punto literal.
- `[a-zA-Z]{2,}`: Coincide con al menos dos letras consecutivas, que pueden ser mayúsculas o minúsculas.

### Ejemplos de coincidencias

- `.com`: Coincide porque tiene un punto seguido por tres letras.
- `.org`: Coincide porque tiene un punto seguido por tres letras.
- `.co.uk`: No coincide en su totalidad, pero `.co` coincide porque tiene un punto seguido por dos letras.
- `.example`: Coincide porque tiene un punto seguido por más de dos letras.

## Por qué en una clase de caracteres NO necesito escapar caracteres y fuera de ellas sí?

La razón por la que no necesitas escapar los caracteres ., _, %, +, y - dentro de una clase de caracteres (especificada con corchetes [ ]) es que dentro de una clase de caracteres, estos caracteres no tienen significados especiales. Veamos esto en detalle:

Clases de caracteres y caracteres literales
Clases de caracteres (entre corchetes [ ]):

Dentro de una clase de caracteres, la mayoría de los caracteres especiales pierden su significado especial y se tratan como literales.
Por ejemplo, [a-zA-Z0-9._%+-]:
. es tomado literalmente y coincide con un punto.
_ es tomado literalmente y coincide con un guion bajo.
% es tomado literalmente y coincide con un signo de porcentaje.
+ es tomado literalmente y coincide con un signo más.
- es tomado literalmente y coincide con un guion.
Fuera de las clases de caracteres:

Fuera de los corchetes, caracteres como . y + tienen significados especiales.
. coincide con cualquier carácter excepto una nueva línea.
+ es un cuantificador que coincide con una o más repeticiones del elemento precedente.
Escapado de caracteres especiales:

Para usar un carácter especial literalmente fuera de una clase de caracteres, debes escaparlo con una barra invertida `\`.
Por ejemplo, `\.` coincide con un punto literal y `\+` coincide con un signo más literal.

### Salida esperada

- `user@example.com`: Coincide y será considerado válido.
- `user@example.c`: No coincide y será considerado inválido (el TLD debe tener al menos dos letras).
- `user@example.community`: Coincide y será considerado válido.

En resumen, `\.[a-zA-Z]{2,}` asegura que haya un punto seguido por al menos dos letras, lo que ayuda a validar la parte del dominio de nivel superior en una dirección de correo electrónico.

### Consideraciones adicionales

1. **Subdominios**: Este patrón permite subdominios (por ejemplo, `user@mail.example.com`).
2. **TLD**: El patrón requiere que el TLD tenga al menos dos caracteres, lo cual cubre la mayoría de los casos comunes.
3. **Casos extremos**: La validación completa y precisa de correos electrónicos puede requerir más lógica adicional para manejar casos extremos que esta regex no cubre (como direcciones que contienen comillas o direcciones con dominios locales no válidos en el DNS público).
