<?php

/*
 * DIFICULTAD EXTRA (opcional):
 * Crea un simulador de pedidos de un restaurante utilizando callbacks.
 * Estará formado por una función que procesa pedidos.
 * Debe aceptar el nombre del plato, una callback de confirmación, una
 * de listo y otra de entrega. ✔️
 * - Debe imprimir un confirmación cuando empiece el procesamiento. ✔️
 * - Debe simular un tiempo aleatorio entre 1 a 10 segundos entre
 *   procesos. ✔️
 * - Debe invocar a cada callback siguiendo un orden de procesado. ✔️
 * - Debe notificar que el plato está listo o ha sido entregado. ✔️
 */


function processOrder(string $meal, callable $callback) : string
{
    $seconds = rand(1,10);
    sleep($seconds); // Delay execution of the current script for x seconds
    return call_user_func($callback, $meal);
}

function confirm(string $order) : string 
{
    return "$order confirmed \n";
}


function ready(string $order) : string 
{
    return "$order ready! \n";
}


function deliver(string $order) : string 
{
   return "Order delivered!, Enjoy your $order 😋 \n";
}



# Cadena de procesamiento

echo processOrder('Big Mac', 'confirm');
echo processOrder('Big Mac', 'ready');
echo processOrder('Big Mac', 'deliver');
