# Unit Testing


<p align="center">
  <img src="https://github.com/user-attachments/assets/d388b4ed-6801-4c41-9dac-56d1bf149ffe" />
</p>


Para crear tests unitarios en PHP, se utiliza comúnmente `PHPUnit`, una __herramienta que facilita la creación y ejecución de tests__


# Pasos básicos para configurar y escribir un test unitario:

### Instalación de PHPUnit

1. Instala PHPUnit utilizando Composer:
   ```sh
   composer require --dev phpunit/phpunit ^9
   ```

2. Verifica la instalación:
   ```sh
   vendor/bin/phpunit --version
   ```

### Configuración `phpunit.xml`

Crea un archivo `phpunit.xml` en la raíz de tu proyecto para configurar PHPUnit:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php"
         colors="true"
         stopOnFailure="false">
    <testsuites>
        <testsuite name="Application Test Suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

### Creación de un Test

1. Crea un directorio llamado `tests` en la raíz de tu proyecto.
2. Dentro del directorio `tests`, crea un archivo para tus tests, por ejemplo `CalculatorTest.php`.

### Ejemplo de un Test Unitario

Supongamos que tienes una clase `Calculator` con un método `add` que suma dos números. El código de la clase podría ser algo como esto:

```php
<?php
// src/Calculator.php
class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}
```

Ahora, el test unitario para esta clase sería:

```php
<?php
// tests/CalculatorTest.php
use PHPUnit\Framework\TestCase;
require_once 'src/Calculator';  // adición manual de la carga de la clase (sin autoload)

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }
}
```

### Ejecutar los Tests

Para ejecutar los tests, simplemente corre el siguiente comando en la raíz de tu proyecto:

```sh
vendor/bin/phpunit
```

Esto ejecutará todos los tests en el directorio `tests` y mostrará los resultados en la terminal.

### Resumen

1. Instala PHPUnit con Composer.
2. Configura PHPUnit con un archivo `phpunit.xml`.
3. Crea tus tests en el directorio `tests`.
4. Ejecuta los tests con `vendor/bin/phpunit`.


## `setUp()`

Método especial en PHPUnit que **se ejecuta antes de cada prueba individual**
Es útil para preparar el entorno de prueba, __incluyendo la creación de instancias de clases que necesitarás en tus tests.__


Puedes usar el método `setUp` para inicializar los objetos necesarios para tus pruebas, 
lo cual evita la repetición de código en cada método de prueba.

### Calculator.php

```php

<?php
namespace App;

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        return $a - $b;
    }
}


```


### CalculatorTest.php
```php

<?php
use PHPUnit\Framework\TestCase;
use App\Calculator;

class CalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdd() 
    {
        $result = $this->calculator->add(2, 2);
        $this->assertEquals(4, $result);
    }

    public function testSubtract() 
    {
        $result = $this->calculator->subtract(5, 3);
        $this->assertEquals(2, $result);
    }
}


```


## Razones para Usar protected en setUp
- __Encapsulación__: Usar `protected` ayuda a mantener el método encapsulado dentro del contexto de las pruebas, limitando el acceso solo a las subclases de `TestCase`. No es necesario que el método setUp sea accesible desde fuera de la jerarquía de clases de prueba.

- __Herencia__: Permite que las clases derivadas (subclases) puedan sobreescribir y extender el comportamiento del método `setUp` si es necesario. Esto es útil si tienes una jerarquía de clases de prueba donde deseas configurar un entorno específico en una clase base y refinarlo en subclases.

- __Consistencia__: Es una convención en PHPUnit y en muchos frameworks de pruebas que los métodos de configuración (como `setUp` y `tearDown`) sean protected. Esto ayuda a mantener un estilo de código consistente y fácil de entender para otros desarrolladores que lean o mantengan tus pruebas.


## Lanzamiento batería de test comprobación ejecución setUp

Aquí se puede ver perfectamente la traza de ejecución, se han lanzado 2 tests individuales (de la misma clase `StudentTest`)
y en cada uno de ellos se ha ejecutado el `setUp` para instanciar en este caso la clase Student

```
EE                                                                  2 / 2 (100%)

Time: 00:00.005, Memory: 8.00 MB

There were 2 errors:

1) StudentTest::testFieldExist
Error: Class "Student" not found

/var/www/tests/StudentTest.php:14

2) StudentTest::testData
Error: Class "Student" not found

/var/www/tests/StudentTest.php:14


```

# Mostrar valores en el test a través de consola

```php 
<?php


use PHPUnit\Framework\TestCase;
use App\Student;


class StudentTest extends TestCase
{
    protected $student;

    protected function setUp(): void
    {
        $this->student = new Student();
    }

    public function testStudentDataFieldsExist()
    {
        echo var_export($this->student->studentData(), true);
        
    }
    
}

```

Output

```
Runtime:       PHP 8.3.9
Configuration: /var/www/phpunit.xml

array (
  'name' => 'Thais',
  'age' => 25,
  'birth_date' => '10-11-92',
  'programming_languages' => 
  array (
    0 => 'php',
    1 => 'python',
    2 => 'javascript',
  ),
).                                                                   1 / 1 (100%)

Time: 00:00.003, Memory: 8.00 MB


```
