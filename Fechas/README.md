# Fechas


## DateTime

```php

$birthDate = new DateTime('1992-11-10');
echo $birthDate->format('d-m-Y H:i:s'); // 10-11-1992 00:00:00

```

Nota : La hora por defecto es 00:00:00, por tanto, si no se especifica es la que saldrá

## Conversión de un Objeto `DateTime` a `string`

Puedes utilizar el método `format` de la clase `DateTime`. 
Este método te permite definir el formato en el que quieres que se muestre la fecha y hora.

1. **Mostrar Fecha y Hora Actual**

   ```php
   <?php
   $fechaActual = new DateTime();
   $fechaComoCadena = $fechaActual->format('Y-m-d H:i:s');
   echo $fechaComoCadena; // Salida ejemplo: 2024-07-30 15:45:12
   ?>
   ```

2. **Mostrar Solo la Fecha**

   ```php
   <?php
   $fecha = new DateTime('2024-07-30');
   $fechaComoCadena = $fecha->format('Y-m-d');
   echo $fechaComoCadena; // Salida: 2024-07-30
   ?>
   ```

3. **Mostrar Solo la Hora**

   ```php
   <?php
   $fecha = new DateTime('2024-07-30 10:00:00');
   $horaComoCadena = $fecha->format('H:i:s');
   echo $horaComoCadena; // Salida: 10:00:00
   ?>
   ```

4. **Formato Personalizado**

   Puedes usar varios caracteres de formato para personalizar la salida. Aquí algunos ejemplos:

   - `Y` - Año completo (e.g., 2024)
   - `m` - Mes con ceros a la izquierda (e.g., 07)
   - `d` - Día del mes con ceros a la izquierda (e.g., 30)
   - `H` - Hora en formato 24 horas con ceros a la izquierda (e.g., 15)
   - `i` - Minutos con ceros a la izquierda (e.g., 45)
   - `s` - Segundos con ceros a la izquierda (e.g., 12)
   - `l` - Nombre completo del día de la semana (e.g., Monday)
   - `F` - Nombre completo del mes (e.g., July)
   - `A` - AM o PM (e.g., PM)
  
   

   ```php
   <?php
   $fecha = new DateTime('2024-07-30 15:45:12');
   $fechaComoCadena = $fecha->format('l, j F Y \a\t H:i:s A');
   echo $fechaComoCadena; // Salida: Tuesday, 30 July 2024 at 15:45:12 PM
   ?>
   ```
## De `string` a `DateTime`


```php
<?php

$dateString = "2024-08-20 14:30:00"; // Fecha en formato "YYYY-MM-DD HH:MM:SS"
$date = new DateTime($dateString);

echo $date->format('Y-m-d H:i:s'); // Muestra la fecha en el formato "YYYY-MM-DD HH:MM:SS"
```


Si la fecha está en un formato específico que no es el formato estándar, puedes usar `DateTime::createFromFormat` para especificar el formato exacto de la cadena.

```php
<?php

$dateString = "20-08-2024 14:30"; // Fecha en formato "DD-MM-YYYY HH:MM"
$format = "d-m-Y H:i";
$date = DateTime::createFromFormat($format, $dateString);
echo $date->format('Y-m-d H:i:s'); // Muestra la fecha en el formato "YYYY-MM-DD HH:MM:SS"

```

La clase `DateTime` en PHP ofrece una amplia variedad de métodos para trabajar con fechas y horas. Aquí una lista de los métodos más comunes y útiles que puedes usar con objetos `DateTime`.

### Métodos de la Clase `DateTime`

1. **`__construct()`**
   - Crea un nuevo objeto `DateTime`.
   - Ejemplo: `$fecha = new DateTime('2024-07-30 10:00:00');`

2. **`format()`**
   - Formatea la fecha y la hora según un formato especificado.
   - Ejemplo: `$fecha->format('Y-m-d H:i:s');`

3. **`modify()`**
   - Modifica la fecha y hora del objeto `DateTime` según una cadena de modificación.
   - Ejemplo: `$fecha->modify('+1 day');`

4. **`add()`**
   - Agrega un intervalo de tiempo.
   - Ejemplo: `$fecha->add(new DateInterval('P1D'));` (Agrega 1 día)

5. **`sub()`**
   - Resta un intervalo de tiempo.
   - Ejemplo: `$fecha->sub(new DateInterval('P1D'));` (Resta 1 día)

6. **`diff()`**
   - Calcula la diferencia entre dos objetos `DateTime`.
   - Ejemplo: `$diferencia = $fecha1->diff($fecha2);`

7. **`setDate()`**
   - Establece la fecha.
   - Ejemplo: `$fecha->setDate(2024, 7, 30);`

8. **`setTime()`**
   - Establece la hora.
   - Ejemplo: `$fecha->setTime(14, 30, 0);` (Establece la hora a las 14:30:00)

9. **`setTimestamp()`**
   - Establece la fecha y la hora según una marca de tiempo Unix.
   - Ejemplo: `$fecha->setTimestamp(1609459200);` (1 de enero de 2021)

10. **`getTimestamp()`**
    - Devuelve la marca de tiempo Unix.
    - Ejemplo: `$timestamp = $fecha->getTimestamp();`

11. **`setTimezone()`**
    - Establece la zona horaria.
    - Ejemplo: `$fecha->setTimezone(new DateTimeZone('Europe/London'));`

12. **`getTimezone()`**
    - Obtiene la zona horaria del objeto `DateTime`.
    - Ejemplo: `$timezone = $fecha->getTimezone();`

13. **`createFromFormat()`**
    - Crea un objeto `DateTime` a partir de un formato específico.
    - Ejemplo: `$fecha = DateTime::createFromFormat('d/m/Y', '30/07/2024');`

14. **`createFromImmutable()`**
    - Crea un objeto `DateTime` a partir de un objeto `DateTimeImmutable`.
    - Ejemplo: `$fecha = DateTime::createFromImmutable($fechaInmutable);`

15. **`createFromInterface()`**
    - Crea un objeto `DateTime` a partir de una interfaz de `DateTimeInterface`.
    - Ejemplo: `$fecha = DateTime::createFromInterface($fechaInterface);`

16. **`format()`**
    - Devuelve la fecha y hora en el formato especificado.
    - Ejemplo: `$fecha->format('Y-m-d H:i:s');`

17. **`getLastErrors()`**
    - Devuelve los últimos errores ocurridos.
    - Ejemplo: `$errors = DateTime::getLastErrors();`

### Métodos Estáticos

1. **`createFromFormat()`**
   - Crea un objeto `DateTime` a partir de un formato específico.
   - Ejemplo: `$fecha = DateTime::createFromFormat('Y-m-d', '2024-07-30');`

2. **`createFromImmutable()`**
   - Crea un objeto `DateTime` a partir de un objeto `DateTimeImmutable`.
   - Ejemplo: `$fecha = DateTime::createFromImmutable($fechaInmutable);`

3. **`createFromInterface()`**
   - Crea un objeto `DateTime` a partir de una interfaz de `DateTimeInterface`.
   - Ejemplo: `$fecha = DateTime::createFromInterface($fechaInterface);`

4. **`getLastErrors()`**
   - Devuelve los últimos errores ocurridos en la creación/modificación del objeto `DateTime`.
   - Ejemplo: `$errors = DateTime::getLastErrors();`

### Ejemplo de Uso

Aquí tienes un ejemplo que utiliza varios de estos métodos:

```php
<?php
$fecha = new DateTime('2024-07-30 10:00:00');
echo $fecha->format('Y-m-d H:i:s'); // Salida: 2024-07-30 10:00:00

$fecha->modify('+1 day');
echo $fecha->format('Y-m-d H:i:s'); // Salida: 2024-07-31 10:00:00

$fecha->setTime(15, 30);
echo $fecha->format('Y-m-d H:i:s'); // Salida: 2024-07-31 15:30:00

$diferencia = $fecha->diff(new DateTime('2024-08-01 10:00:00'));
echo $diferencia->format('%a días'); // Salida: 1 días
?>
```
