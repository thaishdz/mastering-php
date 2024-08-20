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

### Conclusión

Las funciones de primer orden son comunes en __paradigmas funcionales__, dándote la __capacidad de manejar funciones como si fueran datos__. 

Esto es especialmente útil para __callbacks, closures y patrones como el "Strategy Pattern".__
