<?php

/*
 *
 * Desarrolla un sistema de gestión para una biblioteca. El sistema necesita
 * manejar diferentes aspectos como:
 * Registro de Libros ✔️
 * Gestión de Usuarios ✔️
 * Procesamiento de Préstamos de Libros ✔️
 *
  ///////////////////////////////////////////////////////////////////////////////
 * Constraints:
 * 1. Registrar Libros: El sistema debe permitir agregar nuevos libros con
 * información básica como título, autor y número de copias disponibles.
 -------------------------------------------------------------------------------
 * 2. Registrar Usuarios: El sistema debe permitir agregar nuevos usuarios con
 * información básica como nombre, número de identificación y correo electrónico.
 -------------------------------------------------------------------------------
 * 3. Procesar Préstamos de Libros: El sistema debe permitir a los usuarios
 * tomar prestados y devolver libros.
 * 
 ///////////////////////////////////////////////////////////////////////////////
 * Instrucciones:
 * 1. Diseña una clase que no cumple el SRP: Crea una clase Library que maneje
 * los tres aspectos mencionados anteriormente (registro de libros, registro de
 * usuarios y procesamiento de préstamos).
 

 * 2. Refactoriza el código: Separa las responsabilidades en diferentes clases
 * siguiendo el Principio de Responsabilidad Única.
 */


require_once('./User.php');
require_once('./Book.php');
require_once('./BookManager.php');
require_once('./LoanManager.php');

///////////////////// USERS ///////////////////////////////////
$user = new User('6282178', 'Thais', 'thais@correito.com');


$userManager = new UserManager();
$userManager->add($user);
////////////////////// BOOKS ///////////////////////////////////
$book1 = new Book('Los Viajes de Gulliver', 'Jonathan Swift', 2);
$book2 = new Book('Juego de Tronos (Canción de Hielo y Fuego)', 'George R.R. Martin', 20);

$bookManager = new BookManager();

$bookManager->add($book1);
$bookManager->add($book2);

///////////////////// PRÉSTAMO /////////////////////
$loan = new LoanManager();
$loan->loanProcess($user, $bookManager->books());

print_r($loan->loans());
print_r($bookManager->books()); // las copies de los objetos se han actualizado

///////////////////// DEVOLUCIÓN /////////////////////
$loan->returnProcess($user, $bookManager->books());

print_r($loan->loans());
print_r($bookManager->books()); // las copies de los objetos se han vuelto a actualizar
