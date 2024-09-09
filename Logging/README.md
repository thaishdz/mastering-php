

# Logging

Consiste en registrar la actividad de un sistema, por si en un futuro hay malandros o alguien la cagó, ver capasao.


<p align=center>
 <img src="https://github.com/user-attachments/assets/9f4acb43-e57b-4fc3-94a8-ac2f73c83e10" height=400/>
</p>
<p align=center>
  <em>In Log, We Trust</em>
</p>

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

### `index.php`

```php

require __DIR__."/vendor/autoload.php"; // This tells PHP where to find the autoload file so that PHP can load the installed packages

use Monolog\Logger; // The Logger instance
use Monolog\Handler\StreamHandler; // StreamHandler sends log messages to a file on your disk

// Crear un logger con nombre 'daily'
$log = new Logger('daily');

// La salida será la estándar (en este caso la consola)
$streamHandler = new StreamHandler("php://stdout");
$logger->pushHandler($streamHandler);

// La salida se guardará en un archivo
$streamHandlerFile = new StreamHandler("./my_log.txt");
$logger->pushHandler($streamHandlerFile);


$logger->debug("Buenas tardes");  // Se ha mandado tanto a la consola y al archivo

```

💡También puedes definir directamente la severidad en el constructor de `StreamHandler`

```php
$logger->pushHandler(new StreamHandler('ruta/a/mi_log.log', Logger::WARNING));
```


### Output

`stdout`

```plaintext
notebook@xp0ua:/var/www$ php index.php
[2024-09-05T17:43:18.151852+00:00] daily.DEBUG: Buenas tardes [] []
```

`Archivo`

<img width="1079" alt="image" src="https://github.com/user-attachments/assets/3d71fdb1-a53c-46f8-9dfd-932f3c1ef718">

```plaintext

Notice that this output has a few sections:

- The date and time [2024-09-05T17:43:18.151852+00:00],
- The log channel followed by the log level (daily.DEBUG),
- The actual log message (Buenas tardes),
- Some extra information ([] []). They are empty now, but we'll demonstrate how to fill them later.

```
Vale ahora, 2 cositas:

```php

require __DIR__."/vendor/autoload.php";

use Monolog\Logger; 
use Monolog\Handler\StreamHandler; 

```

- `Logger`: Define los canales de log, así como los niveles de severidad
- `StreamHandler`: Responsable de mandar los mensajes de `logs` a la consola, o de almacenarlos en un archivo, o en cualquier otro PHP Stream (sip, se llaman así). Con él, puedes :

  - __Tener múltiples `handlers` para diferentes destinos__: P.e, uno para errores críticos que se envíe por correo y otro para mensajes informativos que se guarden en un archivo.
  - __Configurar distintos niveles de severidad para cada destino__.

> ⚠️ `StreamHandler` es esencial porque `Monolog`, por sí solo, no sabe (es mogolo) en dónde debe escribir los mensajes. El `StreamHandler` le indica que los mensajes de `log` deben ser enviados a un `stream` específico, como un archivo de texto.


---
## Niveles de severidad en Monolog (y en muchos sistemas de logging)

### [Concepto clave 💡] : Severidad

Se refiere al nivel de importancia o gravedad de un evento o mensaje registrado en el sistema de `logs`.

### Niveles de severidad en `Monolog` (y en muchos sistemas de logging):

1. **DEBUG** 🐞: Información detallada sobre la aplicación, vamos la depuración de toda la laif. Es el __nivel más bajo__.
   - _P.e: Información sobre variables, rutas, etc._
   
   ```php
   $log->debug('pene');
   ```

2. **INFO** ℹ️: Información general sobre el estado de la aplicación. No indica un problema, pero puede ser útil para el seguimiento de eventos normales.
   - _P.e: Confirmación de que se ha realizado una operación correctamente._
   
   ```php
   $log->info('Usuario inició sesión correctamente');
   ```

3. **NOTICE** 🛃: Indica algo que podría necesitar atención, pero que no representa un error.
   - _P.e: Una operación que se completó, pero con advertencias menores._
   
   ```php
   $log->notice('La cuota de disco está cerca de llenarse');
   ```

4. **WARNING** ⚠️: Señala situaciones que no son críticas, pero que podrían causar problemas si no se corrigen.
   - _P.e: Uso elevado de memoria o recursos._
   
   ```php
   $log->warning('El archivo de configuración no se encuentra');
   ```

5. **ERROR** ❌: Indica un fallo que impide que una parte de la aplicación funcione correctamente.
   - _P.e: Una consulta a la base de datos falló._
   
   ```php
   $log->error('Error al conectar con la base de datos');
   ```

6. **CRITICAL** 🔴: Un error severo que podría hacer que el sistema no funcione correctamente.
   - _P.e: Caída de un servicio esencial de la aplicación._
   
   ```php
   $log->critical('El sistema de pagos ha fallado');
   ```

7. **ALERT** 🚨: Un problema urgente que requiere una intervención inmediata.
   - _P.e: Pérdida de datos importante o vulnerabilidad crítica._
   
   ```php
   $log->alert('Falla crítica de seguridad detectada');
   ```

8. **EMERGENCY** ☢️: El nivel __MÁS ALTO__ de severidad. Indica que el sistema ha dejado de funcionar o está completamente inoperable.
   - _P.e: El servidor ha caído y todos los servicios están offline._
   
   ```php
   $log->emergency('Servidor inoperativo');
   ```

### ¿Por qué es importante la severidad?

Porque nos ayuda a **filtrar y priorizar** los mensajes de `log`. En lugar de tener _panics attack_, nos podemos concentrar en los más críticos o urgentes, como errores o problemas de seguridad.

Además, permite configurar diferentes **handlers** en `Monolog` para que manejen distintos niveles de severidad, de modo que los mensajes de error vayan a un archivo y las emergencias envíen una alerta por correo, por ejemplo.

---
## Escoger dónde se guardan los logs📍

Puedes configurar dónde se guardan los logs en el archivo, p.e en el `php.ini`:

```
log_errors = On
error_log = /ruta/a/archivo_de_log.log
```

## Si usas Docker 🐳 o Kubernetes tengo una cosa que decirte ...

Es común mandar los `logs` a la salida estándar, ósea `php://stdout` o `php://stderr` para que los `logs` se integren fácilmente con las herramientas de monitoreo y `logging` de contenedores.

### Explícame eso de `php://stdout`

Es una interfaz de flujo (stream) nativa de PHP que permite enviar datos a la salida estándar (_standard output, `stdout`_). 

- __La salida estándar es el lugar donde los programas normalmente escriben su salida__.
- En PHP, puede ser una terminal o consola en la que se ejecuta el script.

#### 1. Salida estándar
- Cuando un script PHP utiliza `php://stdout`, está escribiendo directamente en la consola (si se ejecuta en CLI), o en el flujo de salida del servidor web (en aplicaciones web).
- En entornos web, se relaciona con el contenido de la respuesta `HTTP` (aunque el uso de `stdout` directamente en una página web no es habitual).

#### 2. CLI
En aplicaciones de línea de comandos (CLI), `php://stdout` mostrará la info directamente en la consola, sin necesidad de escribir en archivos.

#### 3. Docker o Kubernetes
- En contenedores como Docker, los `logs` enviados a `stdout` se capturan fácilmente con las herramientas de `logging` del sistema, como __Docker logs__ o Kubernetes.
- Es una buena práctica enviar `logs` a `php://stdout` en vez de escribir en archivos locales dentro del contenedor.

---
## Ayuditas 🛎️

- [How to start logging with Monolog](https://betterstack.com/community/guides/logging/how-to-start-logging-with-monolog/) ⭐

