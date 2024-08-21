# Closures

> Es una __función que captura y recuerda el entorno en el que fue creada, incluso después de que la función externa haya terminado de ejecutarse.__

💡 Un _closure_ tiene acceso a variables locales de su función contenedora después de que esta haya terminado. En PHP, esto se hace usando la palabra clave `use`.

<img src="https://github.com/user-attachments/assets/1faaf2a4-126e-4522-b375-801ffca19366" width="300" height="300"/>

# Ejemplo de Closure

```php
function createClosure($x) {
    return function($y) use ($x) {
        return $x + $y;
    };
}

$closure = createClosure(10);
echo $closure(5);  // Salida: 15
```

La función anónima `function($y) use ($x)` es un _closure_ porque captura el valor de `$x` del contexto externo de `createClosure`.
Pero ... te has dado cuenta de algo?, estamos llamando a `createClosure` 2 veces, qué ocurrirá si llamamos solo 1 vez? 🤔

```php

function createClosure($x) {
    return function($y) use ($x) {
        return $x + $y;
    };
}

echo createClosure(10); // Fatal error: Uncaught Error: Object of class Closure could not be converted to string

```
khé ...?
![image](https://github.com/user-attachments/assets/954b6b35-6f8b-4a4d-aa60-5711fb67c0d0)

```php

echo createClosure(10); // Fatal error: Uncaught Error: Object of class Closure could not be converted to string

```

Claro es que lo que te devuelve `createClosure` es una función 👍 y te está diciendo :

> Closure : vale mi ciela pero los `echo` son para strings y esas mierdas, yo soy una `CLOSURE`, ósea una función
de toda la vida, pero metida por el culo de otra, así que TAMBIÉN me tienes que invocar como si fuese Satanás`"

<img src="https://github.com/user-attachments/assets/24224174-ac06-4210-86f0-4191644c6086" width="650" height="450" />

LO CHACHI, es que esta función interna tiene pillado el contexto de la función de arriba (la de primer orden)
con el argumento que se le está pasando `$x`, entonces cuando la llamemos, ella sabrá lo que es `$x` porque se lo estamos pasando con `use ($x)`
y podrá hacer la sumita.

```php
function createClosure($x) {
    return function($y) use ($x) {
        return $x + $y;
    };
}

$closure = createClosure(10);
echo $closure(666);  // 676
```

> Closure : Bien lo pillaste 👍, ahora el `echo` sí te funka porque te estoy dando el resultado de una suma en (presumiblemente) `int`

<img src="https://github.com/user-attachments/assets/ae0e64c9-814f-441d-aae4-80f44dbc0696" width="650" height="450" />



### ¿Sabías qué ... ?
![image](https://github.com/user-attachments/assets/954b6b35-6f8b-4a4d-aa60-5711fb67c0d0)
>💡 **No todas las funciones de primer orden son closures**, __pero una closure sí es una función de primer orden.__


Y una función anónima no significa que sea un _closure_ aunque podría serlo 👍

![image](https://github.com/user-attachments/assets/2a5cc63a-1764-416b-8356-d0d5f3539c20)
