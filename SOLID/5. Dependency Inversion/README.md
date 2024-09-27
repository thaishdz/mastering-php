
# Dependency Inversion Principle

<p align="center">
  <img src="https://github.com/user-attachments/assets/58a39715-ecdb-4489-9010-7d7dac075132" height="400" />
</p>



- **Módulos de alto nivel**: son aquellos que contienen la lógica de negocio o las funciones más importantes del sistema.
- **Módulos de bajo nivel**: son los que implementan detalles concretos, como conexiones a bases de datos, interfaces con el usuario, etc.


# ¿Cómo detectar que estamos violando el `DIP`?

- Evaluando si estamos dependiendo de módulos de bajo nivel.
  
- Nuestros módulos de alto nivel, carecen de interfaces.
  
- __¿Qué ocurriría si cambias un módulo de bajo nivel?__, si la respuesta es que para realizar el cambio de un módulo de bajo nivel hay que realizar cambios en el código del módulo de alto nivel, es que no lo estás aplicando correctamente.
  
- Con Unit tests. Si testeando nos damos cuenta que tienen una gran complejidad debido a las dependencias podemos empezar a sospechar que estamos violando el principio.


## Sin `DIP`

```php
class MySQLConnection {
    public function connect() {
        // Conecta a la base de datos MySQL
    }
}

class UserService {
    private $dbConnection;

    public function __construct(MySQLConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function getUser() {
        // Lógica que usa $dbConnection
    }
}
```

`UserService` depende directamente de `MySQLConnection`, lo que crea un fuerte acoplamiento. Si necesitamos cambiar la base de datos a otro tipo (por ejemplo, PostgreSQL), tendríamos que modificar `UserService`.

# ¿Cómo solucionar la violación del principio?

__Creando interfaces y abstracciones.__


## Aplicando `DIP`

```php
// Abstracción (interfaz)
interface DatabaseConnectionInterface {
    public function connect();
}

// Implementación de bajo nivel
class MySQLConnection implements DatabaseConnectionInterface {
    public function connect() {
        // Conecta a MySQL
        echo "Connecting with MySQL ✅";
    }
}

// Implementación de bajo nivel
class PostgreSQLConnection implements DatabaseConnectionInterface {
    public function connect() {
        // Conecta a PostgreSQL
        echo "Connecting with PosgreSQL ✅";
    }
}

// Servicio de alto nivel
class UserService {
    private $dbConnection;

    public function __construct(DatabaseConnectionInterface $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function getUser() {
        // Lógica que usa $dbConnection
    }
}
```
### El point 📍

```php
public function __construct(DatabaseConnectionInterface $dbConnection)
{
    $this->dbConnection = $dbConnection;
}
```

- El constructor espera que se le pase un objeto que implemente la interfaz `DatabaseConnectionInterface`. Esto significa que cualquier objeto que cumpla con esa interfaz (como `MySQLConnection` o `PostgreSQLConnection`) puede ser inyectado.
- Esto es lo que se llama inyección de dependencias, ya que el objeto `DatabaseConnectionInterface` (la dependencia) es “inyectado” en la clase `UserService`.

Aquí, `UserService` depende de una abstracción (`DatabaseConnectionInterface`), no de una implementación concreta. Esto permite que las implementaciones de la base de datos puedan cambiar sin afectar a `UserService`, haciendo el sistema más flexible y fácil de mantener.

### El testeito que comprueba la `DIP`

```php

function testDip()
{
    $mysql = new MySQLConnection();
    $posgre = new PostgreSQLConnection();

    $userService = new UserService($posgre);
    $userService->getUser();
}

testDip();
```
### Output

Tirando con uno y luego el otro conseguimos:

<img width="616" alt="Captura de pantalla 2024-09-27 a las 18 28 02" src="https://github.com/user-attachments/assets/31c2172e-3478-4bae-9ad5-c91a742188a3">


---

### Ayuditas 🛎️
- [Dependency inversion by Secture 📰](https://secture.com/blog/solid-dependency-inversion-principle/)
