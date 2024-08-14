
# Promises

Una *promise* representa un valor que puede estar disponible:
- __ahora__ 👍
- __en el futuro__ 🔮
- __NUNCAAAAAAAA__ 😱

![image](https://github.com/user-attachments/assets/ba97d5c8-946c-447c-b771-40753ba4689c)

### Estados de una Promesa

   - **Pendiente (`pending`)** ⚠️⚠️ : El estado inicial. La promesa __aún no se ha resuelto ni rechazado__.
   - **Resuelta (`fulfilled`)** ✔️✔️: La promesa __se ha completado exitosamente y tiene un valor__.
   - **Rechazada (`rejected`)** 🛑🛑: La promesa __ha fallado y tiene una razón para el fallo (por ejemplo, un error)__.

### Métodos Principales
   - **`then(callable $onFulfilled, callable $onRejected = null)`**: Permite manejar el valor cuando la promesa se resuelve exitosamente (`onFulfilled`) o cuando es rechazada (`onRejected`).
   - **`catch(callable $onRejected)`**: Permite manejar el caso cuando la promesa es rechazada, similar a un bloque `catch` en excepciones.
   - **`finally(callable $callback)`**: Se ejecuta independientemente de si la promesa se resuelve o se rechaza, útil para limpieza de recursos.

### Ejemplo Sencillo

Supongamos que tienes una operación que toma tiempo, como __leer un archivo o hacer una solicitud HTTP__. Puedes usar una promesa para manejar la respuesta cuando esté lista:

```php
use React\Promise\Promise; // estmaos usando la librería ReactPHP

function asyncOperation() {
    return new Promise(function ($resolve, $reject) {
        // Simula una operación asincrónica
        $success = true;

        if ($success) {
            $resolve("Operación completada exitosamente");
        } else {
            $reject("Error en la operación");
        }
    });
}

// Uso de la promesa
asyncOperation()
    ->then(function ($result) {
        echo $result; // Imprime "Operación completada exitosamente"
    })
    ->catch(function ($error) {
        echo $error; // Se ejecutaría si hubiera un error
    });
```

### Ventajas de Usar Promesas
- **Manejo de código asincrónico**: Las promesas permiten escribir código que se ejecuta cuando las operaciones asincrónicas se completan, evitando el bloqueo del código.
- **Encadenamiento**: Puedes encadenar múltiples operaciones asincrónicas de manera más limpia y manejable que con callbacks anidados, a menudo referido como "callback hell".
- **Errores manejados uniformemente**: Las promesas facilitan la gestión de errores en operaciones asincrónicas, permitiendo un manejo centralizado de excepciones.

### ReactPHP y Promesas

En el contexto de ReactPHP:
- **Promesas y el Event Loop**: ReactPHP usa promesas para manejar operaciones que ocurren en el loop de eventos, como temporizadores, operaciones de I/O, y más.
- **Concurrencia no bloqueante**: Las promesas en ReactPHP permiten que múltiples tareas se ejecuten concurrentemente sin bloquear el loop, haciendo el código más eficiente.  Fíjate que no hemos hablado de "pararlelo" ya que, no es "paralelo" en el sentido tradicional (como en la ejecución en múltiples hilos o procesos), sino más bien concurrente, donde se aprovecha el tiempo de inactividad (como la espera de I/O) para realizar otras tareas.
