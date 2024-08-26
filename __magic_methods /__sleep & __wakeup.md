# `__sleep()`






# `__wakeup()`


 Se invoca al __deserializar un objeto__. La deserialización en PHP se realiza con `unserialize()`, que __convierte una cadena de texto en un objeto.__



## Ejemplo Completo

Este código implementa una clase `TableAccess` que maneja consultas de base de datos con límites de filas

```php

<?php

class TableAccess
{
    private $table;
    private $rowsLimit;
    private $connection = null;

    public function __construct(string $table, int $rowsLimit, $connection)
    {
        $this->table = $table;
        $this->rowsLimit = $rowsLimit;
        $this->connection = $connection;
    }

    public function queryAll()
    {
        $query = "SELECT * FROM {$this->table} LIMIT {$this->rowsLimit}";

        return $this->connection->execute($query)->get();
    }

    public function __sleep()
    {
        return ['table', 'rowsLimit'];
    }

    public function __wakeup()
    {
        $this->connection = DB::connectionInstance();
    }
}


```

### Explicación del Código

#### Propiedades de la Clase:
- **`private $table;`**: Guarda el nombre de la tabla a consultar.
- **`private $rowsLimit;`**: Almacena el límite de filas a devolver en la consulta.
- **`private $connection = null;`**: Mantiene la conexión a la base de datos.

#### Constructor:
```php
public function __construct(string $table, int $rowsLimit, $connection)
{
    $this->table = $table;
    $this->rowsLimit = $rowsLimit;
    $this->connection = $connection;
}
```
Este constructor inicializa las propiedades con los valores que se pasan al crear una instancia de la clase.

#### Método `queryAll()`:
```php
public function queryAll()
{
    $query = "SELECT * FROM {$this->table} LIMIT {$this->rowsLimit}";

    return $this->connection->execute($query)->get();
}
```
Este método genera una consulta SQL para seleccionar todas las filas de la tabla con el límite especificado y la ejecuta usando el objeto de conexión a la base de datos.

### Los Métodos Mágicos `__sleep()` y `__wakeup()`

#### Método `__sleep()`:
```php
public function __sleep()
{
    return ['table', 'rowsLimit'];
}
```
El método `__sleep()` se llama cuando se intenta serializar el objeto. Su función es especificar qué propiedades deben ser serializadas. En este caso, solo se serializan las propiedades `table` y `rowsLimit`, **excluyendo** la conexión a la base de datos (`connection`). La razón para esto es que las conexiones a bases de datos no suelen ser serializables; es mejor restaurarlas después de deserializar.

#### Método `__wakeup()`:
```php
public function __wakeup()
{
    $this->connection = DB::connectionInstance();
}
```
El método `__wakeup()` se llama cuando el objeto es deserializado. Aquí, la conexión a la base de datos se restaura usando un método estático `DB::connectionInstance()`. Esto asegura que el objeto pueda volver a funcionar correctamente después de deserializarse.

### ¿Por Qué Se Usan `__sleep()` y `__wakeup()`?
- **`__sleep()`**: Controla qué propiedades deben ser serializadas. Excluir la conexión a la base de datos evita problemas y reduce la cantidad de datos serializados.
- **`__wakeup()`**: Restaura la conexión a la base de datos para que el objeto sea completamente funcional tras la deserialización.

### Ejemplo de Uso:
Imagina que serializas un objeto de esta clase, lo almacenas o lo envías a través de la red, y luego lo deserializas. El flujo sería algo como esto:

```php
$access = new TableAccess('users', 10, $dbConnection);

// Serializar el objeto
$serialized = serialize($access);

// En este punto, solo se guardan las propiedades 'table' y 'rowsLimit'

// Deserializar el objeto
$restoredAccess = unserialize($serialized);

// Se llama automáticamente a __wakeup(), restaurando la conexión a la base de datos

$results = $restoredAccess->queryAll(); // Ahora puedes hacer consultas
```

### Resumen:
- **`__sleep()`** se usa para controlar qué propiedades son serializadas.
- **`__wakeup()`** se usa para restaurar recursos como la conexión a la base de datos.
- Este patrón es útil cuando trabajas con objetos que tienen dependencias externas que no son serializables, como conexiones a bases de datos.


### ¿Por qué usar `unserialize()` en lugar de llamar a `__wakeup()` directamente?

1. Propósito de `__wakeup()`: `__wakeup()` no está diseñado para ser llamado directamente por el usuario. Su propósito principal es preparar un objeto después de que ha sido deserializado con `unserialize()`. Es decir, es una especie de "gancho" (hook) que PHP llama automáticamente cuando ocurre una deserialización.

2. Contexto de `__wakeup()`: Al llamar a `__wakeup()` directamente, solo estarías ejecutando el código dentro de ese método, pero no estarías restaurando el estado original del objeto a partir de una cadena serializada.

3. `unserialize()` restaura el estado: La función `unserialize()` toma una cadena serializada (como la generada por `serialize()`) y recrea el objeto original, con su estructura y datos. Luego, si `__wakeup()` está definido, PHP lo llama automáticamente para realizar tareas adicionales después de la deserialización.

### Ayuditas 🛎️
[__sleep And __wakeup Magic Methods: How And When To Use Them?](https://medium.com/@lukaspereyra8/php-sleep-and-wakeup-magic-methods-how-and-when-to-use-them-938591584bdc)
