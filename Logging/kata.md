
Crea un programa ficticio de gestión de tareas que permita añadir, eliminar  y listar dichas tareas.
- _Añadir_: recibe nombre y descripción.✔️
- _Eliminar_: por nombre de la tarea. ✔️

Implementa diferentes mensajes de `log` que muestren información según la tarea ejecutada (a tu elección).

Utiliza el `log` para visualizar el tiempo de ejecución de cada tarea.


## `Task.php`

```php

<?php

require __DIR__."/vendor/autoload.php";


use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler; // sends log messages to a file on your disk


class Task
{

    private array $list = [];

    public function __construct(private Logger $logger) 
    {
        $logger->pushHandler(new StreamHandler('Logs/log.txt')); // Si no existe el archivo, lo crea
    }
    
    public function add(
        string $name = 'untitled', 
        string $description = ''
    ): array
    {
      $this->list[$name] = $description;
      $this->logger->info("$name was added");
      return $this->list;
    }
    
    public function all() : array
    {
        $this->logger->info("All tasks were listed");
        return $this->list;
    }

    function delete(string $name): void
    {
       $this->logger->info("$name was deleted");
       unset($this->list[$name]); 
    }
}
```

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

require __DIR__."/vendor/autoload.php"; // This tells PHP where to find the autoload file so that PHP can load the installed packages

use Monolog\Logger;

require_once('./Task.php');

$log = new Logger("task tracker"); // Le encasquetamos al index la responsabilidad de instanciar el Logger

$task = new Task($log); // Se lo mandamos al Task

$task->add();
$task->all();
$task->delete('untitled');
$task->all();
```

![image](https://github.com/user-attachments/assets/8c6bf2bb-d761-43c0-b406-b2f5907c0493)


