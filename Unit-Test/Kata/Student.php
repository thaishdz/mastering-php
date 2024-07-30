<?php 

namespace App;


class Student
{
    private $studentData; 
    /*
    * Al lanzar el test salta esto :
    * PHP Fatal error:  New expressions are not supported in this context in /var/www/src/Student.php on line 8
    * La definición de propiedades de clase en PHP 
    * no puede contener expresiones complejas ni llamadas a constructores 
    * 
            private $studentData = [
            "name" => "Thais",
            "age"  => 25,
            "birth_date" => new \DateTime("1992-11-10"), (NO puedo instanciar DateTime aquí mismo por eso ladra)
            "programming_languages" => ["php", "python", "javascript"]
        ];
    * por lo tanto
    * he tenido que ponerlo dentro del constructor de la clase Student
    *
    */
    public function __construct()
    {
        $this->studentData = [
            "name" => "Thais",
            "age"  => 25,
            "birth_date" => new \DateTime("1992-11-10"),
            "programming_languages" => ["php", "python", "javascript"]
        ];
    }

    public function studentData() : array 
    {
        return $this->studentData;
    }
}
