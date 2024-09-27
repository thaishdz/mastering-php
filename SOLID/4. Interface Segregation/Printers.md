
Crea un gestor de impresoras

<p align="center">

  <img src="https://github.com/user-attachments/assets/3357ab55-6f0d-46a8-9294-42e3860bf82c" height="400" />

</p>


## Requisitos 🎯
1. Algunas impresoras sólo imprimen en blanco y negro.
2. Otras sólo a color.
3. Otras son multifunción, pueden imprimir, escanear y enviar fax.


## Instrucciones ⚙️
1. Implementa el sistema, con los diferentes tipos de impresoras y funciones.
2. Aplica el ISP a la implementación.
3. Testea que efectivamente se cumple el ISP


⚠️ No pongo las interfaces porque ya con sus implementaciones te haces una idea del contrato de cada una.

### `index.php`
```php

<?php

require_once("./PrintInt.php");
require_once("./ColorInt.php");
require_once("./ScannerInt.php");
require_once("./FaxInt.php");


class Printer implements PrintInt
{
    public function print(): void
    {
        echo "imprímeme esta 🍆\n"; 
    }
}


class ColorPrinter implements ColorInt
{
   public function printColor(string $color): void
   {
      echo "se imprimió esto 🍆 con el color $color\n";
   }

}


class MultifunctionPrinter implements PrintInt, ScannerInt, FaxInt
{
    public function print(): void
    {
        echo "imprímeme este 🍑\n"; 
    }

    public function scan(): void
    {
        echo "escanéame esta 🍆\n"; 
    }

    public function faxear(): void
    {
        echo "fáxeame esta 🍆\n"; 
    }
}


$printer = new Printer();
$printer->print();

$colorPrinter = new ColorPrinter();
$colorPrinter->printColor('rojo');


$multiPrinter = new MultifunctionPrinter();
$multiPrinter->scan();
```

3. Testeamos

```php

function test_printers()
{
    $printer = new Printer();
    $colorPrinter = new ColorPrinter();
    $multiPrinter = new MultifunctionPrinter();


    $printer->print();
    $colorPrinter->printColor('rojo');
    $multiPrinter->print();
    $multiPrinter->scan();
    $multiPrinter->faxear();
}


test_printers();
```
### Output
<img width="609" alt="image" src="https://github.com/user-attachments/assets/836c6b78-679e-41e9-ae75-058be7a4a63b">
