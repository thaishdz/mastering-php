<?php

/*
 * EJERCICIO:
 * Crea dos variables utilizando los objetos fecha (date, o semejante) de tu lenguaje:
 * - Una primera que represente la fecha (día, mes, año, hora, minuto, segundo) actual.
 * - Una segunda que represente tu fecha de nacimiento (te puedes inventar la hora).
 * Calcula cuántos años han transcurrido entre ambas fechas.
 *
 * DIFICULTAD EXTRA (opcional):
 * Utilizando la fecha de tu cumpleaños, formatéala y muestra su resultado de
 * 10 maneras diferentes. Por ejemplo:
 * - Día, mes y año.
 * - Hora, minuto y segundo.
 * - Día de año.
 * - Día de la semana.
 * - Nombre del mes.
 * (lo que se te ocurra...)
 */
 
$currentDate = new DateTime();
$birthDate   = new DateTime('1992-11-10 22:00:00');

echo $currentDate->format('Y') - $birthDate->format('Y');

# Día, mes y año
echo $birthDate->format('d-m-Y'); // 10-11-1992

# Hora, minuto y segundo.
echo $birthDate->format('H:i:s'); // 22:00:00

# Día de año
$birthDate = $birthDate->format('z'); // 314
$birthDate++; // // Incrementamos en 1 porque 'z' devuelve un índice basado en 0
echo $birthDate; // 315

# Día de la semana
echo $birthDate->format('l'); // Tuesday

# Nombre del mes 
echo $birthDate->format('F'); // November

