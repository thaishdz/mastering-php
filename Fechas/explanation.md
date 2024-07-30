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
