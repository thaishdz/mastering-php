![image](https://github.com/user-attachments/assets/25b91e9d-81b7-4ef4-af3e-f4005826b99a)

### Polimorfismo = Capacidad de un objeto para tomar muchas formas 


```php
<?php

/*
 *
 * DIFICULTAD EXTRA (opcional):
 * Implementa la jerarquía de una empresa de desarrollo formada por Empleados que
 * pueden ser Gerentes, Gerentes de Proyectos o Programadores.
 
 * Cada empleado tiene un identificador y un nombre.
 
 * Dependiendo de su labor, tienen propiedades y funciones exclusivas de su
 * actividad, y almacenan los empleados a su cargo.
 */


class Employee 
{
    private $id;
    private $name;
    private static $counter = 1;
    private $employees;
    
    public function __construct($name) 
    {
        $this->id = self::$counter++; // Asigna y luego incrementa el contador
        $this->name = $name;
        $this->employees = [];
    }
    
    public function id()
    {
        return $this->id;
    }
    
    public function add($employee)
    {
        $this->employees[] = $employee;
    }
    
    public function employees()
    {
        return $this->employees;
    }
}

class Manager extends Employee 
{
    public function managing()
    {
        return "Well, I'm doing manager stuff";
    } 
}
 
 
class ProjectManager extends Employee
{
    public function managingProjects()
    {
        return "Well, I'm doing manager PROJECTS stuff";
    }
}


class Programmer extends Employee
{
    private $team;
    public function __construct($team) 
    {
        $this->team = $team;
    }
    public function coding()
    {
        echo "FUCK!, I missed a semi-colon \n";
    }
    
    public function team()
    {
        return $this->team;
    }
    
    public function add($employee)
    {
        echo "Programmers cannot add employees";
    }
    
}

$employee_1 = new Programmer("Thais");
$employee_2 = new ProjectManager("Ignacio");
$employee_3 = new Manager("Sarah");

echo("{$employee_1->coding()} {$employee_1->add("Carlos")} \n");
echo("{$employee_3->managing()}\n");

echo($employee_2->add("Catherine"));
echo ("El PROJECT Manager tiene a los siguientes empleados a su cargo:");
print_r($employee_2->employees());

echo("El Manager quiere añadir a Iván{$employee_3->add("Iván")} \n");
echo ("El Manager tiene a los siguientes empleados a su cargo:");
print_r($employee_3->employees());

```
