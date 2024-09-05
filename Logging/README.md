

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

### ¿Qué cojones es ese `StreamHandler`?

Es el encargado de determinar dónde se enviarán o almacenarán los mensajes de `log`. Define el "canal" de salida del `log`, como puede ser un archivo 📜.

⚠️ `StreamHandler` es esencial porque `Monolog`, por sí solo, no sabe (es mogolo) en dónde debe escribir los mensajes. El `StreamHandler` le indica que los mensajes de `log` deben ser enviados a un `stream` específico, como un archivo de texto.


## ¿Por qué usarlo?
- __Flexibilidad__: Puedes tener múltiples `handlers` para diferentes destinos. Por ejemplo, uno para errores críticos que se envíe por correo y otro para mensajes informativos que se guarden en un archivo.
- __Control del flujo__: Te permite _configurar distintos niveles de severidad_ para cada destino, haciendo el `logging` más eficiente y organizado.


## Niveles de severidad en Monolog (y en muchos sistemas de logging)

### [Concepto clave 💡] : Severidad

Se refiere al nivel de importancia o gravedad de un evento o mensaje registrado en el sistema de `logs`.

### Niveles de severidad en `Monolog` (y en muchos sistemas de logging):

1. **DEBUG** 🐞: Información detallada sobre la aplicación, vamos la depuración de toda la laif. Es el __nivel más bajo__.
   - Ejemplo: Información sobre variables, rutas, etc.
   
   ```php
   $log->debug('pene');
   ```

2. **INFO** ℹ️: Información general sobre el estado de la aplicación. No indica un problema, pero puede ser útil para el seguimiento de eventos normales.
   - Ejemplo: Confirmación de que se ha realizado una operación correctamente.
   
   ```php
   $log->info('Usuario inició sesión correctamente');
   ```

3. **NOTICE** 🛃: Indica algo que podría necesitar atención, pero que no representa un error.
   - Ejemplo: Una operación que se completó, pero con advertencias menores.
   
   ```php
   $log->notice('La cuota de disco está cerca de llenarse');
   ```

4. **WARNING** ⚠️: Señala situaciones que no son críticas, pero que podrían causar problemas si no se corrigen.
   - Ejemplo: Uso elevado de memoria o recursos.
   
   ```php
   $log->warning('El archivo de configuración no se encuentra');
   ```

5. **ERROR** ❌: Indica un fallo que impide que una parte de la aplicación funcione correctamente.
   - Ejemplo: Una consulta a la base de datos falló.
   
   ```php
   $log->error('Error al conectar con la base de datos');
   ```

6. **CRITICAL** 🔴: Un error severo que podría hacer que el sistema no funcione correctamente.
   - Ejemplo: Caída de un servicio esencial de la aplicación.
   
   ```php
   $log->critical('El sistema de pagos ha fallado');
   ```

7. **ALERT** ☢️: Un problema urgente que requiere una intervención inmediata.
   - Ejemplo: Pérdida de datos importante o vulnerabilidad crítica.
   
   ```php
   $log->alert('Falla crítica de seguridad detectada');
   ```

8. **EMERGENCY** 🚨: El nivel __MÁS ALTO__ de severidad. Indica que el sistema ha dejado de funcionar o está completamente inoperable.
   - Ejemplo: El servidor ha caído y todos los servicios están offline.
   
   ```php
   $log->emergency('Servidor inoperativo');
   ```

### ¿Por qué es importante la severidad?

Porque nos ayuda a **filtrar y priorizar** los mensajes de `log`. En lugar de tener _panics attack_, nos podemos concentrar en los más críticos o urgentes, como errores o problemas de seguridad.

Además, permite configurar diferentes **handlers** en `Monolog` para que manejen distintos niveles de severidad, de modo que los mensajes de error vayan a un archivo y las emergencias envíen una alerta por correo, por ejemplo.

## Escoger dónde se guardan los logs📍

Puedes configurar dónde se guardan los logs en el archivo, p.e en el `php.ini`:

```
log_errors = On
error_log = /ruta/a/archivo_de_log.log
```


