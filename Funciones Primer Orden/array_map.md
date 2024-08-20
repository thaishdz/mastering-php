

# `array_map`

```php
function calculateAverageGrade(array $students)
{
   $grades = $students["grades"];
   $average = array_sum($grades) / count($grades);

   return [
      "name"      => $students["name"],
      "average"   => $average
   ];
}

$jsonDataStudents = file_get_contents("students.json");

$dataset = json_decode($jsonDataStudents, true);

$averageStudent = array_map('calculateAverageGrade', $dataset["dataStudents"]);
```
```json

students.json

{
    "dataStudents" : [
        {
            "name": "Thais",
            "dateBirth": "10-04-1992",
            "grades": {
                "Math" : 4.5,
                "Biology" : 6,
                "Physics": 8,
                "Philosophy" : 9,
                "History": 8
            }
        },
        {
            "name": "Cristina",
            "dateBirth": "30-08-1991",
            "grades": {
                "Math" : 7,
                "Biology" : 5,
                "Physics": 7,
                "Philosophy" : 10,
                "History": 8
            } 
        },
        {
            "name": "Iván",
            "dateBirth": "01-07-1993",
            "grades": {
                "Math" : 10,
                "Biology" : 10,
                "Physics": 10,
                "Philosophy" : 7.5,
                "History": 8
            } 
        },
        {
            "name": "Paula",
            "dateBirth": "20-01-1995",
            "grades": {
                "Math" : 3,
                "Biology" : 5,
                "Physics": 7,
                "Philosophy" : 5.5,
                "History": 1
            } 
        },
        {
            "name": "Betancort",
            "dateBirth": "18-02-1991",
            "grades": {
                "Math" : 3.4,
                "Biology" : 9.2,
                "Physics": 2.5,
                "Philosophy" : 5,
                "History": 8
            } 
        },
        {
            "name": "Jerico",
            "dateBirth": "07-06-1990",
            "grades": {
                "Math" : 10,
                "Biology" : 9.2,
                "Physics": 10,
                "Philosophy" : 9.3,
                "History": 8
            } 
        }
    ]
}

```

## Output

```php
  array(6) {
    [0]=>
    array(2) {
      ["name"]=>
      string(5) "Luisa"
      ["average"]=>
      float(7.1)
    }
    [1]=>
    array(2) {
      ["name"]=>
      string(8) "Cristina"
      ["average"]=>
      float(7.4)
    }
    [2]=>
    array(2) {
      ["name"]=>
      string(5) "Iván"
      ["average"]=>
      float(9.1)
    }
    [3]=>
    array(2) {
      ["name"]=>
      string(5) "Paula"
      ["average"]=>
      float(4.3)
    }
    [4]=>
    array(2) {
      ["name"]=>
      string(9) "Betancort"
      ["average"]=>
      float(5.62)
    }
    [5]=>
    array(2) {
      ["name"]=>
      string(6) "Jerico"
      ["average"]=>
      float(9.3)
    }
  }
```
