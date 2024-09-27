
# Dependency Inversion Principle

<p align="center">
  <img src="https://github.com/user-attachments/assets/58a39715-ecdb-4489-9010-7d7dac075132" height="400" />
</p>



- **Módulos de alto nivel**: son aquellos que contienen la lógica de negocio o las funciones más importantes del sistema.
- **Módulos de bajo nivel**: son los que implementan detalles concretos, como conexiones a bases de datos, interfaces con el usuario, etc.



Si una clase depende de algo muy específico (p.e, una base de datos MySQL), entonces si necesitas cambiar ese detalle (a otra base de datos, como PostgreSQL), tendrás que modificar la clase principal. 
Esto es problemático porque tienes que cambiar muchas partes del sistema.

# ¿Cómo detectar que estamos violando el `DIP`?

- Evaluando si estamos dependiendo de módulos de bajo nivel.
  
- Nuestros módulos de alto nivel, carecen de interfaces.
  
- Haciéndote la preguntas : __¿Qué ocurre si cambiamos un módulo de bajo nivel?__, Si al responder nos damos cuenta que para realizar el cambio de un módulo de bajo nivel hay que realizar cambios en el código del módulo de alto nivel, es que no estamos utilizando el principio correctamente.
  
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
    }
}

// Implementación de bajo nivel
class PostgreSQLConnection implements DatabaseConnectionInterface {
    public function connect() {
        // Conecta a PostgreSQL
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

Aquí, `UserService` depende de una abstracción (`DatabaseConnectionInterface`), no de una implementación concreta. Esto permite que las implementaciones de la base de datos puedan cambiar sin afectar a `UserService`, haciendo el sistema más flexible y fácil de mantener.


### Ayuditas 🛎️
- [Dependency inversion by Secture 📰](https://secture.com/blog/solid-dependency-inversion-principle/)
