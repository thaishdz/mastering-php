

# Logging

Consiste en registrar la actividad de un sistema, por si en un futuro hay malandros o alguien hizo algo que no debió hacer, ver capasao.


## ¿Por qué es importante?

- __Depuración__: Te ayuda a identificar errores o comportamientos no deseados en la aplicación.
- __Auditoría__: Mantiene un registro de eventos importantes, como cambios de datos, inicios de sesión, etc.
- __Monitoreo__: Proporciona información en tiempo real sobre el estado de la aplicación.


## Cómo implementar logging en PHP

PHP no tiene un sistema de logging nativo robusto, pero se pueden usar varias técnicas o bibliotecas.

### 1. `error_log()`

Una función nativa del PHP para escribir en el archivo de `log` que, o bien está en el `php.ini` o en un archivo específico.

```php

 // Escribir un mensaje en el log de errores de PHP
error_log("Mensaje de log");

// Especificar un archivo de log personalizado
error_log("Mensaje de log", 3, "/ruta/a/mi_log.log");



```

### 2. `Monolog`

Es una biblioteca popular de `logging` en PHP. Tiene registros en varios formatos (archivos, bases de datos, correos, etc.).

Instalarlo con Composer

```sh
composer require monolog/monolog
```


```php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Crear un logger
$log = new Logger('mi_logger');

// Añadir un manejador (archivo de salida)
$log->pushHandler(new StreamHandler('ruta/a/mi_log.log', Logger::WARNING));

// Registrar mensajes
$log->warning('Esto es una advertencia');
$log->error('Esto es un error');


```

## Escoger dónde se guardan los logs 

Puedes configurar dónde se guardan los logs en el archivo, p.e en el `php.ini`:

```
log_errors = On
error_log = /ruta/a/archivo_de_log.log
```


