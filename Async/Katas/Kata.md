
# Requerimientos

Crea el siguiente programa que ejecuta en este orden:
- Una función `C` que dura 3 segundos. ✔️
- Una función `B` que dura 2 segundos. ✔️
- Una función `A` que dura 1 segundo.  ✔️
- Una función `D` que dura 1 segundo.  ✔️
- Las funciones `C`, `B` y `A` se ejecutan en paralelo. ✔️
- La función `D` comienza su ejecución cuando las 3 anteriores han finalizado. ✔️

❗ ATENCIÓN ❗ : Esta kata fue realizada con funciones independientes, con propósitos de experimentación

# Solución
- Para ejecutar en paralelo usaremos `parallel()`
- Para mostrar por pantalla los mensajes resueltos por las promesas en las funciones `A`, `B`, y `C`, necesitamos manejar las promesas devueltas por `parallel` y luego procesar sus resultados con `then`

```php
require __DIR__ . '/vendor/autoload.php';

use React\EventLoop\Loop;
use React\Promise\Promise;
use function React\Async\parallel;

function C()
{
    $functionName = __FUNCTION__; // Obtener el nombre de la función

    return new Promise(function ($resolver) use ($functionName) {
        Loop::addTimer(3, function () use ($resolver, $functionName) {
            $resolver("Soy la función $functionName 👹");
        });
    });
}

function B()
{
    $functionName = __FUNCTION__;

    return new Promise(function ($resolver) use ($functionName) {
        Loop::addTimer(2, function () use ($resolver, $functionName) {
            $resolver("Soy la función $functionName 👽");
        });
    });
}

function A()
{
    $functionName = __FUNCTION__;

    return new Promise(function($resolver) use ($functionName) {
        Loop::addTimer(1, function () use ($resolver, $functionName) {
            $resolver("Soy la función $functionName 🤖");
        });
    });
}

function D()
{
    $functionName = __FUNCTION__;

    Loop::addTimer(1, function () use ($functionName) {
        echo "Soy la función $functionName 👻" . PHP_EOL;
    });
}

// Ejecutar las funciones A, B y C en paralelo
parallel([
    'C', 
    'B', 
    'A'
])->then(function (array $results){
    // Muestra los resultados de las promesas
    foreach ($results as $result) {
        echo "$result\n";
    }
    D(); // D se ejecutará cuando las promesas se resuelvan
});


// Iniciar el loop de eventos
Loop::get()->run();
```

### Explicación del Código:

1. **Funciones `A`, `B`, `C`, `D`**:
   - Las funciones `A`, `B`, y `C` retornan promesas que se resuelven después de 1, 2, y 3 segundos, respectivamente.
   - La función `D` simplemente imprime un mensaje después de 1 segundo, sin utilizar promesas.

2. **`parallel([...])`**:
   - Ejecuta las funciones `A`, `B`, y `C` en paralelo. `parallel` devuelve una promesa que se resuelve cuando todas las promesas pasadas se han completado.

3. **Manejo de Resultados (`then`)**:
   - Cuando todas las promesas se resuelven, el callback dentro de `then` se ejecuta y muestra los resultados.

4. **Iniciar el Loop de Eventos**:
   - `Loop::get()->run();` inicia el loop de eventos, lo que es necesario para que los temporizadores funcionen y las promesas se resuelvan.

### Resultado Esperado

Al ejecutar este código, deberías ver los siguientes mensajes en el orden en que las promesas se resuelven:

```plaintext
Soy la función A 🤖
Soy la función B 👽
Soy la función C 👹
Soy la función D 👻
```

La función `D` mostrará su mensaje cuando acaben las funciones `A`, `B` y `C`.
