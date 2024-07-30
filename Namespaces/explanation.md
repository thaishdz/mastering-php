# Namespaces

Es una forma de encapsular evitando así conflictos de nombres en el código como :
- clases
- interfaces
- funciones y constantes




# Beneficios de los Namespaces
- __Evita Conflictos de Nombres__: Permite que diferentes partes del código o bibliotecas utilicen los mismos nombres sin interferencias.
- __Organización del Código__: Facilita la organización y estructura del código en proyectos grandes.
- __Autoloading__: Facilita la carga automática de clases utilizando estándares como PSR-4.


# Importando clases

En PHP, __no necesitas importar clases nativas como `DateTime` cuando no estás utilizando namespaces.__
Sin embargo, cuando trabajas en un __contexto__ donde estás __usando namespaces__, 
es una __buena práctica referenciar explícitamente las clases, incluso las nativas__, para evitar cualquier posible conflicto de nombres.

## Sin Importar
Usa el nombre completo de la clase con el prefijo "\" para asegurarte de que PHP busca la clase en el espacio de nombres global.

```php
<?php

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private $student;

    protected function setUp(): void
    {
        $this->student = new Student();
    }

    public function testBirthDateIsDateTime()
    {
        // Uso del nombre completo de la clase DateTime
        self::assertInstanceOf(\DateTime::class, $this->student->getStudentData()["birth_date"]);
    }
}

class Student
{
    private $studentData;

    public function __construct()
    {
        $this->studentData = [
            "name" => "Thais",
            "age"  => 25,
            "birth_date" => new \DateTime("1998-11-10"), // Uso del nombre completo de la clase DateTime
            "programming_languages" => ["php", "python", "javascript"]
        ];
    }

    public function getStudentData()
    {
        return $this->studentData;
    }
}
```
OJITO a este ejemplo donde en ambas clases usamos el buscador global de namespaces para `DateTinme`

## Importando
Usa `use DateTime;` para importar la clase nativa `DateTime` si estás en un archivo con namespaces.

```php
<?php

use PHPUnit\Framework\TestCase;
use DateTime; // Importación explícita de la clase DateTime

class StudentTest extends TestCase
{
    private $student;

    protected function setUp(): void
    {
        $this->student = new Student();
    }

    public function testBirthDateIsDateTime()
    {
        self::assertInstanceOf(DateTime::class, $this->student->getStudentData()["birth_date"]);
    }
}
```
