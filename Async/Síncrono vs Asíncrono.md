![image](https://github.com/user-attachments/assets/a46dcd81-5a9f-41f0-a169-d6650c978e83)




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

### Output

```plaintext

notebook@emsfu:/var/www$ php index.php
Big Mac confirmed 
Big Mac ready! 
Order delivered!, Enjoy your Big Mac 😋 
Happy Meal confirmed 
Happy Meal ready! 
Order delivered!, Enjoy your Happy Meal 😋 
Mcflurry confirmed 
Mcflurry ready! 
Order delivered!, Enjoy your Mcflurry 😋 

```

## Mejoras para Hacerlo Asíncrono
Para hacer este proceso más eficiente (por ejemplo, procesando múltiples órdenes simultáneamente), tendrías que utilizar técnicas asíncronas o concurrencia. 
`ReactPHP` sería una opción __si quisieras usar un enfoque basado en eventos__. Así podrías manejar varias órdenes a la vez sin bloquear el script en cada `sleep()`.


# Código Asíncrono usando ReactPHP con Event Loop & Promises

```php
<?php

require 'vendor/autoload.php';

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

use React\EventLoop\Loop;
use React\Promise\Deferred;

function processOrder(
    string $meal, 
    callable $confirmCallback, 
    callable $readyCallback, 
    callable $deliveredCallback
): void
{
    $deferredConfirm = new Deferred(); // crea una promesa

    // Etapa Confirm
    Loop::addTimer(rand(1,10), function() use ($meal, $confirmCallback,$deferredConfirm)
    {
        echo $confirmCallback($meal);
        $deferredConfirm->resolve($meal); // se le pasa el pedido a la siguiente etapa
    });

    // Encadenar la siguiente etapa - Ready y se pasan los callback que necesita para las siguientes etapas
    $deferredConfirm->promise()->then(function($meal) use($readyCallback, $deliveredCallback)  
    {   
        $deferredReady = new Deferred(); // nueva promesa ya que la anterior se resolvió

        Loop::addTimer(rand(1,10), function() use ($meal, $readyCallback, $deliveredCallback, $deferredReady)
        {
            echo $readyCallback($meal);
            $deferredReady->resolve($meal);    
        });
        // Encadenar la siguiente etapa - Delivered
        $deferredReady->promise()->then(function($meal) use ($deliveredCallback)
        {
            Loop::addTimer(rand(1,10), function() use ($meal, $deliveredCallback)
            {
                echo $deliveredCallback($meal);
            });
        });
    });
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

processOrder('Big Mac 🍔', 'confirm', 'ready', 'deliver');
processOrder('Happy Meal 🍟','confirm', 'ready', 'deliver');
processOrder('Mcflurry 🍦', 'confirm', 'ready', 'deliver');
```


## Output

```plaintext
Big Mac 🍔 confirmed 
Mcflurry 🍦 confirmed 
Big Mac 🍔 ready! 
Happy Meal 🍟 confirmed 
Order delivered!, Enjoy your Big Mac 🍔 😋 
Mcflurry 🍦 ready! 
Order delivered!, Enjoy your Mcflurry 🍦 😋 
Happy Meal 🍟 ready! 
notebook@emsfu:/var/www$ our Happy Meal 🍟 😋


* Si al ejecutar los ves en orden disperso es porque el rand() habrá dado valores diferentes
* P.e :
* Big Mac 🍔 habrá tardado 1 sg, entonces aparece primero diciendo "confirmed", pasa a la siguiente etapa
* Mcflurry 🍦  habrá tardado 2 sg, confirmed y pasa a la siguiente
* Big Mac 🍔 ahora dice que está ready, pasa a la siguiente etapa
* Happy Meal 🍟 ha tardo 10 seg y dice que está confirmed
* Eso es ejecución "paralela o concurrente?", en todo caso, se ejecutan al mismo tiempo sin 
* bloquear
```

### Explicación

- __EventLoop__: `ReactPHP` utiliza un bucle de eventos que maneja las tareas asíncronas. Para crear el bucle siempremente usamos `Loop`.

- __Timers Asíncronos (addTimer)__: En lugar de usar `sleep()`, utilizamos temporizadores no bloqueantes con `addTimer`. Estos se ejecutan de forma asíncrona sin bloquear el bucle principal.

- __Deferred y Promesas__: Utilizamos promesas para encadenar las etapas de confirmación, preparación y entrega. __Cada etapa solo se ejecuta cuando la promesa anterior se resuelve.__

- __Paralelismo__: Al usar `addTimer` y manejar cada orden por separado, `ReactPHP` permite procesar todas las órdenes al mismo tiempo sin que ninguna bloquee la ejecución.

### Resultado
Cuando ejecutas el código, las órdenes se procesan de forma asíncrona, es decir, pueden confirmarse, prepararse y entregarse en cualquier orden, dependiendo de los tiempos aleatorios.

¡Ahora tienes un flujo no bloqueante usando ReactPHP!

# `Deferred`

El uso de `$deferred = new Deferred();` es crucial para manejar la lógica asíncrona con promesas en `ReactPHP`.

## ¿Qué es `Deferred`?
`Deferred` es un __objeto que te permite crear y controlar una promesa.__ Una promesa representa una operación que puede completarse en el futuro, ya sea de manera exitosa o fallida. Con `Deferred`, __tú decides cuándo se resuelve o se rechaza esa promesa.__

## ¿Por qué se necesita en este caso?
En el ejemplo anterior, estamos manejando operaciones que son asíncronas (no bloquean la ejecución). Cada una de estas operaciones se realiza en etapas (confirmación, preparación y entrega). Usamos `Deferred` para:

- __Crear una Promesa__: Con `$deferred = new Deferred();`, creamos una promesa que podemos manejar manualmente. __Esta promesa es accesible a través de `$deferred->promise()`.__

- __Resolver la Promesa__: Cuando la operación asíncrona se completa (por ejemplo, después de que el temporizador de __addTimer__ termina), llamamos a `$deferred->resolve($valor);` para indicar que la operación fue exitosa y que el siguiente paso puede continuar.

- __Encadenar Operaciones__: Al usar la promesa que devuelve `$deferred->promise()`, podemos encadenar la siguiente operación con `->then()`. Esto permite __ejecutar la siguiente etapa solo cuando la anterior se haya completado.__

## ¿Por qué no simplemente usar el temporizador directamente?
Podrías usar temporizadores directamente sin promesas, pero `Deferred` y promesas __permiten un código más organizado y fácil de leer__, especialmente __cuando tienes múltiples etapas encadenadas que dependen de la anterior__. Además, es el __enfoque recomendado cuando trabajas con `ReactPHP`__, ya que este estilo es muy común para manejar flujos asíncronos complejos.

### `$deferred->resolve($meal);` ¿Por qué se le pasa `$meal`?
__Para transmitir información o un resultado a la siguiente etapa del proceso asíncrono__. 

En este caso específico, `$meal` representa el nombre del pedido (como "Big Mac" o "Happy Meal"), y __se pasa para que las etapas posteriores sepan qué pedido están manejando.__

### Desglose del Proceso:

1. **Creación del `Deferred`**: 
   ```php
   $deferred = new Deferred();
   ```
   Aquí se crea un objeto `Deferred`, que __contiene la promesa.__

2. **Resolviendo la Promesa con `$meal`:**
   ```php
   $deferred->resolve($meal);
   ```
   Al resolver la promesa, se pasa `$meal` como argumento. Esto se convierte en el valor resultante que se envía a los callbacks subsiguientes.

3. **Uso del Resultado en la Siguiente Etapa:**
   ```php
   $deferred->promise()->then(function ($meal) use ($loop, $readyCallback, $deliveredCallback) {
       // $meal contiene el valor que se pasó al resolver la promesa
       echo $readyCallback($meal);
   });
   ```
   En la cadena de promesas, el valor pasado a `resolve()` (en este caso, `$meal`) es recibido en el siguiente callback como argumento. Esto asegura que cada etapa tenga la información necesaria sobre el pedido actual.

### ¿Por Qué Es Necesario?

En un flujo asíncrono, especialmente cuando hay múltiples etapas que dependen unas de otras, es crucial mantener el contexto. En este caso:

- **Primera Etapa (Confirmación)**: Procesa la confirmación del pedido y luego pasa `$meal` a la siguiente etapa.
- **Segunda Etapa (Preparación)**: Usa `$meal` para identificar qué pedido está listo, y lo pasa nuevamente a la última etapa.
- **Tercera Etapa (Entrega)**: Finalmente, `$meal` se usa para saber qué pedido se está entregando.

