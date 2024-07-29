# Unit Testing




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

