# Namespaces

> Se usan para organizar el código y para evitar conflictos de nombres entre :
> - clases
> - interfaces
> - funciones y constantes

![image](https://github.com/user-attachments/assets/3099c95a-8aa7-4e88-926e-8a378418f763)




## Beneficios de los Namespaces
- __Evita Conflictos de Nombres__: Permite que diferentes partes del código o bibliotecas utilicen los mismos nombres sin interferencias.
- __Organización del Código__: Facilita la organización y estructura del código en proyectos grandes.
- __Autoloading__: Facilita la carga automática de clases utilizando estándares como PSR-4.

# Cómo usar namespaces

### **1. Definir y usar un Namespace**

Puedes definir un namespace usando la palabra clave `namespace`, y luego usarlo para agrupar clases, funciones y constantes.

**📜`src/Library/Book.php`**

```php
<?php
namespace Library;

class Book {
    public function getTitle() {
        return "The Great Book";
    }
}
```

**📜`src/Library/Author.php`**

```php
<?php
namespace Library;

class Author {
    public function getName() {
        return "John Doe";
    }
}
```

**📜`index.php`**

```php
<?php
require 'src/Library/Book.php';
require 'src/Library/Author.php';

use Library\Book;
use Library\Author;

$book = new Book();
echo $book->getTitle();  // Salida: The Great Book

$author = new Author();
echo $author->getName();  // Salida: John Doe
```

### **2. Importar Namespaces**

Puedes importar _namespaces_ usando la palabra clave `use`, lo que facilita el uso de clases y otros elementos sin tener que escribir el namespace completo.

**📜`index.php`**

```php
<?php
require 'src/Library/Book.php';
require 'src/Library/Author.php';

use Library\Book;
use Library\Author;

$book = new Book();
$author = new Author();

echo $book->getTitle();  // Salida: The Great Book
echo $author->getName();  // Salida: John Doe
```

### **3. Usar Aliases para Namespaces**

Puedes asignar un alias a un _namespace_ largo o complejo para simplificar el código.

**📜`index.php`**

```php
<?php
require 'src/Library/Book.php';

use Library\Book as LibBook;

$book = new LibBook();
echo $book->getTitle();  // Salida: The Great Book
```

### **4. Definir un Namespace en una Función o Método**

Los _namespaces_ también pueden ser utilizados dentro de funciones y métodos.

**📜`src/Library/Utils.php`**

```php
<?php
namespace Library\Utils;

function helperFunction() {
    return "Helper function";
}
```

**📜`index.php`**

```php
<?php
require 'src/Library/Utils.php';

use Library\Utils;

echo Utils\helperFunction();  // Salida: Helper function
```

### **5. Usar Namespaces con Autoloading**

Con el uso de _autoloading_, puedes cargar automáticamente clases usando _namespaces_.

**📜`composer.json`**

```json
{
    "autoload": {
        "psr-4": {
            "Library\\": "src/Library/"
        }
    }
}
```

**📜`src/Library/Book.php`**

```php
<?php
namespace Library;

class Book {
    public function getTitle() {
        return "The Great Book";
    }
}
```

**📜`index.php`**

```php
<?php
require 'vendor/autoload.php';

use Library\Book;

$book = new Book();
echo $book->getTitle();  // Salida: The Great Book
```

# Importando clases

En PHP, __no necesitas importar clases nativas como `DateTime` cuando no estás utilizando namespaces.__
Sin embargo, cuando trabajas en un __contexto__ donde estás __usando namespaces__, 
es una __buena práctica referenciar explícitamente las clases, incluso las nativas__, para evitar cualquier posible conflicto de nombres.

## Sin Importar
Usa el nombre completo de la clase con el prefijo `\` para asegurarte de que PHP busca la clase en el espacio de nombres global.

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
> OJITO 👁️ ❗ ... a este ejemplo donde en ambas clases usamos el buscador global de namespaces para `DateTime` => `\DateTime`

### Resumen
Cuando trabajas en un contexto de _namespaces_ en PHP, __es una buena práctica utilizar el prefijo `\` con las clases nativas de PHP 
para referenciarlas desde el espacio de nombres global__. Esto asegura que PHP busque la clase en el espacio de nombres global, 
evitando conflictos con cualquier clase definida en tu espacio de nombres actual.

#### Ejemplo
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
