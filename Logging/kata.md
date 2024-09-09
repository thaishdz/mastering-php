
Crea un programa ficticio de gestión de tareas que permita añadir, eliminar  y listar dichas tareas.
- _Añadir_: recibe nombre y descripción.✔️
- _Eliminar_: por nombre de la tarea. ✔️
- Implementa diferentes mensajes de `log` que muestren información según la tarea ejecutada (a tu elección). ✔️
- Utiliza el `log` para visualizar el tiempo de ejecución de cada tarea. ✔️


## `TaskManager.php`

```php

<?php

require __DIR__."/vendor/autoload.php"; // This tells PHP where to find the autoload file so that PHP can load the installed packages

use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler; // sends log messages to a file on your disk


class TaskManager
{
    private array $list = [];

    public function __construct(private Logger $logger) 
    {
        $this->logger->pushHandler(new StreamHandler('Logs/log.txt'));
    }
    
    public function add(
        string $name = 'untitled', 
        string $description = ''
    ): void
    {
      $start = microtime(true); // true indica que lo queremos como float

      if (!$this->exists($name)) 
      {
        $this->list[$name] = $description;
        $this->logger->info("$name was added");
      }
      $this->logger->warning("$name already exits");

      $end = microtime(true); 
      $this->timeExecution($start, $end);
    }
    
    public function all(): void
    {
        $start = microtime(true);

        $this->logger->info("All tasks were listed");
        foreach ($this->list as $task => $description) 
        {
            echo "[$task - $description]\n";
        }

        $end = microtime(true); 
        $this->timeExecution($start, $end);
    }

    function delete(string $name): void
    {
       $start = microtime(true);

       if($this->exists($name))
       {
        $this->logger->info("$name was deleted");
        unset($this->list[$name]); 
       }
       $this->logger->warning("$name could not be deleted because it doesn't exist");

       $end = microtime(true); 
       $this->timeExecution($start, $end);
    }

    function exists(string $name): bool
    {
        return array_key_exists($name, $this->list);
    }

    function timeExecution($start, $end)
    {
        $total = ($end - $start) / 1000000; // convertimos de microsegundo a segundo
        $total_formateado = number_format($total,15); //  formatea el número en notación científica a 15 decimales.
        return $this->logger->debug("Execution Time: $total_formateado s");
    }
}
```

> [Dato de Interés 💡] : `private Logger $logger` es una promoted property, lo que significa que PHP la está considerando una propiedad privada de la clase pero a su vez un argumento del constructor, por lo que puede recibir mierda desde fuera, pero al mismo tiempo actuar como propiedad de la clase, sin ser accesible desde fuera.

## FAQ

### 1. ¿Por qué le pasas `Logger` al constructor?
- En PHP, las variables de __instancia__ deben ser inicializadas dentro del constructor o mediante métodos de instancia. No directamente en la clase
### 2. ¿Por qué puedo instanciar `$list` fuera del constructor?
-  En PHP, la inicialización (normal) de propiedades de clase puede hacerse de 2 maneras principales:
    - Arribita del todo, en la propia clase.
    - Dentro del `__construct`.

Ambas formas son válidas. Además de que `$list` tiene relación con la `Task`, `Logger` es una dependencia externa que necesitamos.
 
### 3. ¿Inyectar una dependencia?
- Zí, es lo que estamos haciendo, la _inyección de dependencias_ es un patrón de diseño que consiste en pasarle a una clase las dependencias que necesita (o podría necesitar como el `Logger` en este caso) desde el exterior en lugar de que la clase las cree por sí misma.

### 4. ¿Por qué creaste una propiedad `Logger` pero no una proiedad `StreamHandler`?
- Vamos a ver los propósitos de cada uno:
    - Propósito del `Logger`:
       El `Logger` es un objeto que va a registrar cositas. Tiene una vida útil más larga y una configuración que puede ser compartida y utilizada en diferentes partes del programa. Además de que puede tener múltiples handlers (como `StreamHandler`) agregados a él.
    
    - Propósito del `StreamHandler`:
      Generalmente, no es necesario mantener una propiedad separada para él, ya que __su tarea es configurar el `Logger`__ y luego se puede eliminar de la referencia directa. El `Logger` sigue manejando el `StreamHandler` internamente.

### 5. ¿Pero no habría que separar responsabilidades?
- Es verdad que el `Logger` no tiene mucho sentido con la clase `Task`, pero sigue siendo importante para registrar eventos o errores. Pasar el `Logger` al constructor asegura que su configuración esté claramente definida y separada de la lógica principal de la `Task`.


## `index.php`
```php

<?php

require __DIR__."/vendor/autoload.php"; 

use Monolog\Logger;

require_once('./TaskManager.php');

$log = new Logger("task tracker"); // Le encasquetamos al index la responsabilidad de instanciar el Logger

$task = new TaskManager($log); // Se lo mandamos al Task

$task->add("Hacer la compra", "Manzana, pan, huevos");
$task->all();
$task->delete('untitled');
$task->all();
```

![image](https://github.com/user-attachments/assets/5c07a6c3-391c-4093-925f-255807116ed7)





# Ayuditas 🛎️
- [Task Manager](https://phpsandbox.io/n/monolog-logs-r8oad#TaskManager.php)
- [Ruta de estudio programación | 25 - LOGS](https://www.youtube.com/watch?v=y2O6L1r_skc)
