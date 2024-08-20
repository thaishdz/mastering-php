# Funciones de Primer Orden

![image](https://github.com/user-attachments/assets/89134bfb-e6cd-4018-87fc-209562afcf1a)


Las **funciones de primer orden** (también llamadas **first-class functions**) son aquellas que pueden ser tratadas como cualquier otra variable. Esto significa que puedes:

- Asignar una función a una variable.
- Pasar una función como argumento a otra función.
- Devolver una función desde otra función.

## Ejemplos

### 1. **Asignar una función a una variable:**

```php
$saludar = function($nombre) {
    return "Hola, $nombre!";
};

echo $saludar("Juan"); // Output: Hola, Juan!
```

En este caso, `$saludar` almacena una función anónima que puede ser llamada como cualquier función normal.

### 2. **Pasar una función como argumento:**

```php
function procesarSaludo($nombre, $callback) {
    return $callback($nombre);
}

$saludoPersonalizado = function($nombre) {
    return "¡Hola, $nombre! ¡Bienvenido!";
};

echo procesarSaludo("Cristina", $saludoPersonalizado); // Output: ¡Hola, Cristina! ¡Bienvenido!
```

Aquí, la función `procesarSaludo` recibe como argumento otra función (callback) que define cómo saludar.

### 3. **Devolver una función desde otra función:**

```php
function crearSaludo($saludo) {
    return function($nombre) use ($saludo) {
        return "$saludo, $nombre!";
    };
}

$saludoFormal = crearSaludo("Buenos días");
echo $saludoFormal("Thais"); // Output: Buenos días, Thais!
```

En este ejemplo, `crearSaludo` retorna una función personalizada según el saludo que le pases.

### Resumen

- Las funciones de primer orden son comunes en __paradigmas funcionales__, dándote la __capacidad de manejar funciones como si fueran datos__. 
- Esto es especialmente útil para __callbacks, closures y patrones como el "Strategy Pattern".__


# Paradigma Funcional

![image](https://github.com/user-attachments/assets/02f9a07a-b721-42ac-8831-b5e988c3a309)

El ejemplo más claro para relacionar esta verga es cuando vas a hacer operaciones con __Arrays__,
y dices, "joder, qué pereza hacer ahora un puto `foreach` para obtener los valores y hacer una media, ojalá no tuviese que hacer un bucle".

Pues use el `array_map` señora :

```php
$jsonDataStudents = file_get_contents("students.json");

$dataset = json_decode($jsonDataStudents, true);
 
function calculateAverageGrade($student)
{
   $grades = $student["grades"];
   $average = array_sum($grades) / count($grades);

   return [
      "name"      => $student["name"],
      "average"   => $average
   ];
}
 
$averageStudent = array_map('calculateAverageGrade', $dataset["dataStudents"]);
 
 
var_dump($averageStudent);
```

> Ósea me estás diciendo que toda estas vainas de `array_sum`, `array_values`, `array_filter`, ... __ES PROGRAMACIÓN FUNCIONAL__?

Yes

![image](https://github.com/user-attachments/assets/72a64a5e-a0c2-4e6a-8495-575b7ec48655)

# Entonces ... en la programación funcional 
- __No hay ciclos__ : La programación funcional hace uso de la ✨__recursividad__✨
- __No hay variables ni asignaciones… o bueno, mejor dicho: inmutabilidad__. Una vez que un valor ha sido establecido y almacenado este no puede ser cambiado a lo largo de la ejecución del programa del bloque del programa en el que fue definido.
- __No tienen estados, evita los efectos colaterales.__ : En la programación funcional, el llamar a una función multiples veces con las mismas entrdas siempre devolverá los mismos resultados, estos no se verán influenciados por condiciones externas o estados almacenados previamente. [Fuente ~ thatcsharguy](https://thatcsharpguy.com/tv/funcional/)


