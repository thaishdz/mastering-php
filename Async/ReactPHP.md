

<div align="center">
  <img src="https://github.com/user-attachments/assets/2326f6d6-c5bd-44c3-9fbe-270704ea4e92" alt="meme" width="500">
</div>


[Explicación ReactPHP (Inglés)](https://www.honeybadger.io/blog/getting-started-with-reactphp/)
# Qué es ReactPHP

> Es una librería que permite convertir PHP en algo como Go o Node.js para que las tareas se puedan realizar de forma asíncrona.

- Tenga en cuenta que ReactPHP es sólo una __biblioteca que se instala con Composer__. 
- Con el modelo asíncrono, algunas tareas, como el procesamiento de un archivo subido, se realiza de forma incremental.

Tomemos como ejemplo el pedido de comida a un restaurante 🍔. Esto ciertamente no sigue el modelo `solicitar → ejecutar → responder` porque si lo hiciera, habría un montón de clientes enfadados 😠. 
Por lo tanto, en lugar de :

1. tomar un pedido de un cliente 🧔
2. preparar su comida 🍕
3. proceder al siguiente cliente una vez que esté terminado 👱

... simplemente tomamos pedidos de todos los clientes y hacemos que otro miembro del personal prepare la comida. Esto significa que ✨no todos los pedidos se servirán en el orden en que se hicieron✨, ya que un pedido puede tardar más en prepararse que los demás, y otro puede ser más fácil de preparar. 
Sin embargo, al final del día, todos los pedidos se cumplirán en algún momento ✔️. 


Así funciona el __modelo asíncrono.__

# Event-driven architecture
Por defecto, __PHP trabaja de forma síncrona__, por lo que tiene que esperar a que las operaciones de I/O se completen antes de poder empezar a hacer otra tarea. 

Con _Event-driven architecture_, en lugar de eso le pasamos la operación de I/O que consume tiempo al SO y hacemos que nos notifique una vez que la tarea se ha completado.

Mientras el SO hace su magia, el script puede dedicarse a otra tarea. Una vez que recibe la notificación de que la tarea se ha completado ☑️, puede seguir procesándola.


## Core Components

ReactPHP tiene varios componentes como el:
- [Event loop](https://reactphp.org/event-loop/)
- [Promise](https://reactphp.org/promise/)
- [Streams](https://reactphp.org/stream/)
- [Async](https://reactphp.org/async/)

Al instalar ReactPHP, se instalan estos componentes y algunos más, por lo que no es necesario instalarlos por separado 👍


# Event Loop

Es un bucle sin fin que escucha eventos y llama a los manejadores de los mismos. 

Por ejemplo, estos son los pasos generales que se realizan cuando se leen datos de la base de datos:

1. The event loop is run
2. The main thread receives a request from the client to query the database. (El hilo principal recibe una petición del cliente para consultar la base de datos.)
3. The task of querying the database is handed over to the operating system. (La tarea de consultar la base de datos se transfiere al SO.)
4. Another user triggers a database query, so steps 2 and 3 are performed again. (Otro usuario lanza una consulta a la base de datos, por lo que los pasos 2 y 3 se realizan de nuevo.)
5. The operating system is finished with one of the requests, so it triggers an event with the data being requested. (El sistema operativo termina con una de las peticiones, por lo que lanza un evento con los datos solicitados.)
6. The main thread receives this event and hands over the result to the client. (El hilo principal recibe este evento y entrega el resultado al cliente.)
7. After some time, the other task is also completed, so steps 5 and 6 are performed for that task. (Transcurrido un tiempo, la otra tarea también ha finalizado, por lo que se ejecutan los pasos 5 y 6 para esa tarea.)

Fíjate en que sólo hay ✨un hilo✨, y cada petición es recibida y procesada por ✨ese hilo✨ en nanosegundos, así que es muy rápido. 

El `Event Loop` también utiliza una `queue`, por lo que sabe cuál procesar primero. 

El principal factor decisivo es la rapidez con la que el SO devuelve los datos solicitados. Por lo tanto, las peticiones que llegan primero no necesariamente se completan primero.

```php
use React\EventLoop\Factory; 

# 1. Created an event loop
$loop = Factory::create(); 


# 2. Registered a callback for a specific event

$loop->addTimer(
    1, # 1 sg
    function(){
        echo "After\n";
    });

echo "Before\n";

# 3. Run the loop:

$loop->run();
```

### Output

```
Before <-- this shows up immediately when you run the script
After  <-- this shows up a second later
```


Cómo trabaja el Event Loop, consultar el apartado [Event Loop](https://www.honeybadger.io/blog/getting-started-with-reactphp/)
