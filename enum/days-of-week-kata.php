<?php
/*
  * EJERCICIO:
  * Empleando tu lenguaje, explora la definición del tipo de dato
  * que sirva para definir enumeraciones (Enum).
  * Crea un Enum que represente los días de la semana del lunes
  * al domingo, en ese orden. Con ese enumerado, crea una operación
  * que muestre el nombre del día de la semana dependiendo del número entero
  * utilizado (del 1 al 7).
*/

enum DaysOfTheWeek: string
{
   case Monday    = 'monday';
   case Tuesday   = 'tuesday';
   case Wednesday = 'wednesday';
   case Thursday  = 'thursday';
   case Friday    = 'friday';
   case Saturday  = 'saturday';
   case Sunday    = 'sunday';
}



function getDayNumber(DaysOfTheWeek $dayOfWeek) : int
{
    return match($dayOfWeek) {
        DaysOfTheWeek::Monday    => 1,
        DaysOfTheWeek::Tuesday   => 2,
        DaysOfTheWeek::Wednesday => 3,
        DaysOfTheWeek::Thursday  => 4,
        DaysOfTheWeek::Friday    => 5,
        DaysOfTheWeek::Saturday  => 6,
        DaysOfTheWeek::Sunday    => 7,
    };
}


$today = DaysOfTheWeek::Monday;
echo(getDayNumber($today));
