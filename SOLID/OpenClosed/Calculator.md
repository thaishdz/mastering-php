

Desarrolla una calculadora que necesita realizar diversas operaciones matemáticas.

## Requisitos 🎯
Debes diseñar un sistema que permita agregar nuevas operaciones utilizando el OCP.

## Instrucciones ⚙️

1. Implementa las operaciones de `suma`, `resta`, `multiplicación` y `división`.
2. Comprueba que el sistema funciona.
3. Agrega una quinta operación para calcular `potencias`.
4. Comprueba que se cumple el OCP.

# `Add.php`

```php

require_once('./OperationInt.php');

class Add implements OperationInt
{
    public function calculate(array $numbers): float 
    {
        // Utiliza array_reduce para sumar todos los números del array
        return array_reduce($numbers, function ($accumulator, $number) 
        {
            return $accumulator + $number
        }, 0);
    }
}

```
### Explicación 🕶️

> `array_reduce` se utiliza en este caso, para recorrer todos los elementos del array y acumular la suma.

#### Operación de suma

En cada iteración, devuelves el `$accumulator + $number (número actual)`.

PHP asigna automáticamente el resultado de `$accumulator + $number` al acumulador en cada iteración.

> 👉 Se usa `0` como valor inicial, porque es el elemento neutro de la suma.

#### ¿Por qué no usar `$accumulator += $number`?
No es necesario porque la expresión `return $accumulator + number` ya hace la suma de los valores y pasa el resultado acumulado a la siguiente iteración. 

La asignación adicional con `+=` es redundante en este caso.

---

# `Substract.php`

```php

require_once('./OperationInt.php');

class Subtract implements OperationInt
{
    public function calculate(array $numbers): float 
    {
        if (count($numbers) === 0)
        {
            return 0; 
        }
        
        // Toma el primer número como valor inicial y aplica la resta a los demás
        return array_reduce(array_slice($numbers, 1), function ($accumulator, $number) 
        {
            return $accumulator - $number;
        }, $numbers[0]);
    }
}

```

### Explicación 🕶️

- `array_slice($numbers, 1)`: Se omite el primer número del array, ya que lo usamos como valor inicial. Ahora el acumulador empieza en el primer número y se le restan los valores restantes del array.

- __Resta__: En cada iteración, el acumulador va restando cada número del array, obteniendo el resultado acumulado.

> 👉 Se usa el 1er elemento del array (`$numbers[0]`) como valor inicial, ya que si pondríamos `0` como en la suma generaría catastróficas desdichas. 

---

# `Multi.php`

```php

<?php

require_once('./OperationInt.php');

class Multi implements OperationInt
{
    public function calculate(array $numbers): float 
    {
        return array_reduce($numbers, function ($accumulator, $number) 
        {
            return $accumulator * $number;
        }, 1);
    }
}
```

### Explicación 🕶️

#### ¿Por qué usar `1` como valor inicial?

Si aprobaste primaria conocerás la célebre cita «`Cualquier número x 0` dará como resultado `0`». 

Por eso es `1`, porque es el valor neutral, como en la suma el `0`.


### Flujo ⚙️

Con este array el flujo sería :

```php
$numbers = [2, 3, 4];
```

- Valor inicial: `1`
1. paso: `1 * 2` = 2
2. paso: `2 * 3` = 6
3. paso: `6 * 4` = 24

---

# `Divide.php`

```php

<?php

require_once('./OperationInt.php');

class Divide implements OperationInt
{
    /**
    * @param float[] $numbers
    */
    public function calculate(array $numbers): float 
    {
        if (count($numbers) != 2) 
        {
            return "Two operators are necesary\n";
            return 0;
        }

        if ($numbers[1] == 0) 
        {
            echo "Cannot divide by zero motherfucker\n";
            return 0;
        }  

        return $numbers[0] / $numbers[1];
    }
```

### Explicación 🕶️

- `* @param float[] $numbers`: Aunque declares en PHPDoc que es un array de `float[]`, PHP no impone estrictamente el tipo, por lo que podríamos recibir `0` como entero 👍.

- `if ($numbers[1] == 0)`: Funkará tanto para `0` como para `0.0`, ya que la comparación no estricta `==` compara solo el valor y no el tipo.

---

# `index.php`

Pega más que `Calculator` sea una clase que contenga toda esta parafernalia pero fui revaga, discúlpame.

```php

require_once('./Add.php');
require_once('./Substract.php');
require_once('./Multi.php');
require_once('./Divide.php');


function calculator(OperationInt $operation, array $numbers) 
{
    echo ("{$operation->calculate($numbers)}\n");
}

////////////////////////// SUMA //////////////////////////

#calculator(new Add(), [2,3,5]); // 10

//////////////////////// RESTA //////////////////////////

#calculator(new Substract(), [1.0, 5.2, -33]); // 26.8


//////////////////// MULTIPLICACIÓN /////////////////////

calculator(new Multi(), [2, 3, 4]); // 24

////////////////////// DIVISIÓN ////////////////////////

#calculator(new Divide(), [55, 0.0]); // 6.1111111111111

```





