

![image](https://github.com/user-attachments/assets/76bc857b-dca0-4254-9b24-0a1634e39d8f)

# Trabajar con un `JSON`
Puedes usar la función `file_get_contents()` junto con `json_decode()`.

Supongamos que tienes un archivo llamado `data.json` con el siguiente contenido:

**data.json:**

```json
{
  "nombre": "Thais Hernández",
  "edad": 30,
  "correo": "thais.hdz@example.com"
}
```

**Código PHP para leer el JSON:**

```php
<?php
// Leer el contenido del archivo JSON
$json = file_get_contents('ruta/a/data.json');

// Convertir el JSON a un array asociativo en PHP
$data = json_decode($json, true);

// Acceder a los valores del array
echo "Nombre: " . $data['nombre'] . "\n";
echo "Edad: " . $data['edad'] . "\n";
echo "Correo: " . $data['correo'] . "\n";
?>
```

### Explicación:

- `file_get_contents('ruta/a/datos.json')`: Lee el contenido del archivo JSON.
- `json_decode($json, true)`: Decodifica el JSON en un array asociativo (si no añades `true`, se convierte en un objeto PHP concretamente el de una clase genérica `stdClass`*).
- Luego puedes acceder a los datos como si fueran un array en PHP.



## `stdClass`*
En PHP, `stdClass` es una __clase genérica o estándar utilizada cuando se decodifica un JSON a un objeto, o cuando se trabaja con objetos simples__. 

> 💡 Es el contenedor por defecto para cualquier objeto sin una clase específica.

Cuando usas `json_decode()` __sin el 2º parámetro__ (o lo estableces como `false`), __PHP convierte el JSON en un objeto de tipo `stdClass`__. 

```php
<?php
$json = '{"nombre": "Thais Hernández", "edad": 30, "correo": "thais.hdz@example.com"}';

// Decodifica el JSON a un objeto (stdClass)
$data = json_decode($json);

// Muestra la estructura del objeto
var_dump($data);
?>
```

El resultado sería algo como:

```sh
object(stdClass)#1 (3) {
  ["nombre"]=> string(10) "Thais Hernández"
  ["edad"]=> int(30)
  ["correo"]=> string(22) "thais.hdz@example.com"
}
```

- **`stdClass Object`**: Significa que PHP ha creado un objeto de la clase estándar `stdClass` para almacenar los datos.
- Los atributos del objeto pueden ser accedidos con la notación de flecha `->`, por ejemplo: `$data->nombre`.
- Si prefieres trabajar con arrays en lugar de objetos, puedes pasar `true` como segundo parámetro en `json_decode()`:

```php
$data = json_decode($json, true); // Ahora $data es un array asociativo.
```
Esto te permitirá acceder a los elementos como en un array: `$data['nombre']`.
