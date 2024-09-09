<?php


use PHPUnit\Framework\TestCase;
use App\Student;


class StudentTest extends TestCase
{
    protected $student;

    protected function setUp(): void
    {
        $this->student = new Student();
    }

    public function testStudentDataFieldsExist()
    {
        $this->assertArrayHasKey("name", $this->student->studentData());
        $this->assertArrayHasKey("age", $this->student->studentData());
        $this->assertArrayHasKey("birth_date", $this->student->studentData());
        $this->assertArrayHasKey("programming_languages", $this->student->studentData());
    }
    
    /* 
    *  ⬆️⬆️⬆️⬆️⬆️⬆️
    * 2 ways of defining an assertion
    *  ⬇️⬇️⬇️⬇️⬇️⬇️
    */

    function testStudentDataIsCorrect() 
    {
        self::assertIsString($this->student->studentData()["name"]);
        self::assertIsInt($this->student->studentData()["age"]);
        self::assertInstanceOf(\DateTime::class, $this->student->studentData()["birth_date"]);
        self::assertIsArray($this->student->studentData()["programming_languages"]);
    }
    
}
