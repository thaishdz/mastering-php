### Este código es síncrono y bloqueante
```php
<?php

/*
 * DIFICULTAD EXTRA (opcional):
 * Crea un simulador de pedidos de un restaurante utilizando callbacks.
 * Estará formado por una función que procesa pedidos.
 * Debe aceptar el nombre del plato, una callback de confirmación, una
 * de listo y otra de entrega. ✔️
 * - Debe imprimir un confirmación cuando empiece el procesamiento.
 * - Debe simular un tiempo aleatorio entre 1 a 10 segundos entre
 *   procesos. ✔️
 * - Debe invocar a cada callback siguiendo un orden de procesado. ✔️
 * - Debe notificar que el plato está listo o ha sido entregado. ✔️
 */

function processOrder(
    string $meal, 
    callable $confirmCallback, 
    callable $readyCallback, 
    callable $deliveredCallback
): void
{
    sleep(rand(1,10)); // Delay execution of the current script for x seconds
    echo $confirmCallback($meal);
    sleep(rand(1,10)); 
    echo $readyCallback($meal);
    sleep(rand(1,10)); 
    echo $deliveredCallback($meal);
}

function confirm(string $order) : string 
{
    return "$order confirmed \n";
}


function ready(string $order) : string 
{
    return "$order ready! \n";
}


function deliver(string $order) : string 
{
   return "Order delivered!, Enjoy your $order 😋 \n";
}



# Orders in queue

processOrder('Big Mac', 'confirm', 'ready', 'deliver');
processOrder('Happy Meal','confirm', 'ready', 'deliver');
processOrder('Mcflurry', 'confirm', 'ready', 'deliver');
```


En un flujo síncrono, cada línea de código se ejecuta de manera secuencial y bloqueante. 

### ¿Por qué?

1. Cada llamada a `processOrder` ejecuta completamente la orden antes de pasar a la siguiente.
2. La función `sleep()` bloquea la ejecución durante un tiempo determinado, simulando un retardo en el proceso.
3. No se inicia la siguiente orden hasta que la anterior se ha completado.

Esto significa que el código se ejecuta en el orden en que fue escrito y __no permite paralelismo o concurrencia.__


### Ejecución Síncrona Paso a Paso
1. Procesa el pedido de "Big Mac".
2. Llama a sleep() (bloquea la ejecución).
3. Ejecuta `confirmCallback`, `readyCallback`, y `deliveredCallback` secuencialmente, con más llamadas a `sleep()` entre cada paso.
4. Una vez que se completa todo el proceso para "Big Mac", se pasa a la siguiente orden ("Happy Meal") y así sucesivamente.

## Mejoras para Hacerlo Asíncrono
Para hacer este proceso más eficiente (por ejemplo, procesando múltiples órdenes simultáneamente), tendrías que utilizar técnicas asíncronas o concurrencia. 
`ReactPHP` sería una opción __si quisieras usar un enfoque basado en eventos__. Así podrías manejar varias órdenes a la vez sin bloquear el script en cada `sleep()`.

