# Autoload

El autoloading se refiere a la __capacidad de cargar clases automáticamente sin tener que incluir manualmente los archivos que las contienen__

Hay 2 formas para cargar clases en los scripts :
- Autoloading con Composer: Configura Composer para cargar automáticamente tus clases 
- Incluir Manualmente la Clase: Incluye manualmente el archivo de la clase en el script de prueba -> require_once 'src/Calculator'

### Dónde se coloca la llamada al autoload.php?

Para incluir el archivo de autoloading generalmente se coloca en el archivo principal de entrada de tu aplicación, que suele ser `index.php`

Si estás usando Composer ... 

Debes incluir el archivo vendor/autoload.php generado por Composer. Esto se hace normalmente al principio de index.php.

```
<?php
// index.php
require 'vendor/autoload.php';

// Ahora puedes usar tus clases y las dependencias gestionadas por Composer
$obj = new MyClass();

```
En este caso, asegúrate de ejecutar `composer install` para generar el archivo vendor/autoload.php, 
y asegúrate de que `composer.json` esté correctamente configurado con las dependencias y namespaces necesarios.


Para cargar las clases automáticamente en un proyecto PHP utilizando Composer, 
debes configurar el autoload en tu archivo `composer.json`. 

Solución 1: Autoloading con Composer en el `composer.json`

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

Luego, ejecuta:

```sh
composer dump-autoload
```

# A qué te refieres con eso de namespaces?

Cuando usas `namespace App`, estás definiendo el espacio de nombres (namespace) para tus clases en PHP. 
Esto es una característica __nativa de PHP__ y no está directamente relacionado con el autoloader de Composer, aunque ambos conceptos se usan comúnmente juntos.

### Espacios de Nombres (Namespaces) en PHP
Los espacios de nombres en PHP permiten organizar el código en diferentes "áreas" o "paquetes", evitando conflictos de nombres entre clases, funciones y constantes. Por ejemplo:

```php

<?php
namespace App;

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}
```

En el `composer.json` asociar la estrategia de carga a utilizar con el namespace y el directorio


```json
{
    "autoload": {
        "psr-4": {
            "YourNamespace\\": "src/"
        }
    }
}
```

Aquí, App es el espacio de nombres que ayuda a organizar la clase Calculator.

# Estrategias para cargar clases

Composer proporciona varias estrategias para cargar clases, las más comunes son:

1. **PSR-4 Autoloading**
2. **Classmap Autoloading**
3. **Files Autoloading**

Aquí te explico cómo configurar cada uno:

### 1. PSR-4 Autoloading

PSR-4 es un estándar para la carga automática de clases. Para usar PSR-4, especifica el espacio de nombres y la ruta a la que corresponden las clases en tu archivo `composer.json`.

Ejemplo de configuración para PSR-4:

```json
{
    "name": "phpsandbox/standard",
    "description": "Official scaffold for Standard notebooks on PHPSandbox",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Olatunbosun Egberinde",
            "email": "bosunski@gmail.com"
        }
    ],
    "minimum-stability": "dev",
    "prefer-stable": true,
    "require": {
        "phpunit/phpunit": "^11.2"
    },
    "autoload": {
        "psr-4": {
            "YourNamespace\\": "src/"
        }
    }
}
```

- `"YourNamespace\\": "src/"` mapea el espacio de nombres `YourNamespace` al directorio `src/`. Si tienes clases dentro de `src/` bajo el espacio de nombres `YourNamespace`, se cargarán automáticamente.

### 2. Classmap Autoloading

El Classmap Autoloading carga todas las clases desde un directorio específico. Esto es útil si no usas un espacio de nombres específico o si tus clases están en una estructura no compatible con PSR-4.

Ejemplo de configuración para Classmap:

```json
{
    "name": "phpsandbox/standard",
    "description": "Official scaffold for Standard notebooks on PHPSandbox",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Olatunbosun Egberinde",
            "email": "bosunski@gmail.com"
        }
    ],
    "minimum-stability": "dev",
    "prefer-stable": true,
    "require": {
        "phpunit/phpunit": "^11.2"
    },
    "autoload": {
        "classmap": [
            "src/"
        ]
    }
}
```

- `"src/"` indica que todas las clases en el directorio `src/` serán incluidas en el mapa de clases.

### 3. Files Autoloading

Si tienes funciones o clases globales que no están en un espacio de nombres, puedes incluir archivos específicos directamente.

Ejemplo de configuración para Files Autoloading:

```json
{
    "name": "phpsandbox/standard",
    "description": "Official scaffold for Standard notebooks on PHPSandbox",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Olatunbosun Egberinde",
            "email": "bosunski@gmail.com"
        }
    ],
    "minimum-stability": "dev",
    "prefer-stable": true,
    "require": {
        "phpunit/phpunit": "^11.2"
    },
    "autoload": {
        "files": [
            "src/helpers.php"
        ]
    }
}
```

- `"src/helpers.php"` carga el archivo PHP especificado al inicio del script.

### Actualización del Autoload

Después de modificar el archivo `composer.json`, siempre ejecuta el siguiente comando para actualizar el autoload:

```bash
composer dump-autoload
```

Esto regenerará el archivo de autoload de Composer y aplicará tus configuraciones.

Si sigues estos pasos y configuraciones, tus clases deberían cargarse automáticamente según la estrategia que elijas.

## Pero el `autoload` ve el código?
El `autoload` de Composer en sí no se "ve" directamente en el código que instanciarás o utilizarás en tus pruebas; más bien, 
__se encarga de resolver y cargar las clases automáticamente en el momento en que se necesitan__
Aquí te explico cómo funciona el autoload en relación con la instanciación de objetos y cómo puedes entender mejor su papel en el proceso.

### ¿Cómo Funciona el Autoload de Composer?

1. **Configuración en `composer.json`:** Defines cómo se deben cargar las clases, por ejemplo, usando PSR-4. Esto indica a Composer cómo mapear los espacios de nombres a directorios de archivos.

2. **Generación del Autoload:** Cuando ejecutas `composer dump-autoload`, Composer genera un archivo `vendor/autoload.php` que contiene la lógica para cargar las clases basadas en la configuración de tu `composer.json`.

3. **Inclusión en el Código:** En tus scripts PHP, como archivos de prueba, debes incluir el archivo `vendor/autoload.php`. Esto configura el autoload y permite que las clases se carguen automáticamente cuando se usan.

### ¿Qué Haces en el Código?

Cuando en tu código de prueba (`StudentTest.php`) instancias una clase, como en el método `setUp`:

```php
protected function setUp(): void
{
    $this->student = new Student(); // Instancia de la clase Student
}
```

Aquí está lo que realmente está pasando:

1. **`require 'vendor/autoload.php';`:** Esto incluye el autoload generado por Composer. Cuando el archivo de autoload se incluye, está configurado para buscar y cargar la clase `Student` cuando se necesite.

2. **Instanciación de la Clase:** Al llamar `new Student()`, el autoload de Composer se activa para buscar el archivo donde está definida la clase `Student`, basándose en la configuración en `composer.json`.

3. **Carga Automática de la Clase:** El autoload encuentra la clase `Student` en el directorio correcto (por ejemplo, `src/`) y la carga en la memoria, permitiendo que se cree una instancia de `Student`.

### Ejemplo Detallado

1. **Configuración en `composer.json`:**

   ```json
   {
       "autoload": {
           "psr-4": {
               "App\\": "src/"
           }
       }
   }
   ```

   Esto dice a Composer que las clases bajo el namespace `App\` están en el directorio `src/`.

2. **Archivo `Student.php` en `src/`:**

   ```php
    <?php 
    
    namespace App;
    
    
    class Student
    {
        private $studentData = [
            "name" => "Thais",
            "age"  => 25,
            "birth_date" => "10-11-92",
            "programming_languages" => ["php", "python", "javascript"]
        ];
    
        public function studentData() : array 
        {
            return $this->studentData;
        }
    }
   ```

3. **Archivo `StudentTest.php`:**

   ```php
   <?php

   require 'vendor/autoload.php'; // Incluye el autoload de Composer

   use PHPUnit\Framework\TestCase;
   use App\Student; // Importa la clase Student desde el namespace App

   class StudentTest extends TestCase
   {
       protected $student;

       protected function setUp(): void
       {
           $this->student = new Student(); // Instancia de la clase Student
       }

       function testStudentDataFieldsExist() 
       {
           // Implementa el test
       }
   }
   ```

### ¿Qué Hace el Autoload en el Contexto de `setUp`?

Cuando ejecutas `new Student();` en el método `setUp`, el autoload de Composer se encarga de:
- **Buscar:** Localiza el archivo que contiene la definición de la clase `Student` basado en el namespace `App\`.
- **Cargar:** Incluye el archivo PHP donde está definida la clase `Student` para que pueda ser instanciada y utilizada en tu prueba.

### Conclusión

- **Composer Autoload:** Gestiona la carga automática de clases en función de la configuración en `composer.json`.
- **Declaración `use`:** Simplifica el uso de clases con namespaces largos.
- **Inclusión de `vendor/autoload.php`:** Configura el autoload para que esté disponible durante la ejecución del script.


