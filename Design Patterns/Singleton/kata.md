


# Sesión de Usuario

Utiliza el patrón de diseño `Singleton` para __representar una clase que haga referencia a la sesión de usuario__ de una aplicación ficticia.

- La sesión debe permitir asignar un usuario (`id`, `username`, `nombre` y `email`)
- Recuperar los datos del usuario y borrar los datos de la sesión.


# Mi implementación 💙

Decidí separar responsabilidades (La S de SOLID bien dentro del peshito) por eso tengo 2 clases :
- `User`
- `Session`

### `User.php` 📜

```php
<?php

class User
{
    private string $id;
    private static $instance = null;


    // Constructor con Promoted Properties (no sé me apeteció usarlo)
    private function __construct(
        private string $username,
        private string $name,
        private string $email,
    )
    {
        $this->id = bin2hex(random_bytes(16)); // convertir bytes a hexadecimal
    }

    public static function getInstance(string $username,string $name,string $email)
    {
        if (is_null(self::$instance))
        {
            self::$instance = new self($username, $name, $email);
        }
        return self::$instance;
    }

    public function data(): array
    {
        return [
            'ID'        => $this->id,
            'Username'  => $this->username,
            'Name'      => $this->name,
            'Email'     => $this->email
        ];
    }

    public function reset(): void
    {
        $this->id = '';
        $this->username = '';
        $this->name = '';
        $this->email = '';
    }

    private function __clone() {}

    public function __wakeup() 
    {
        throw new \Exception('Cannot unserialize a Singleton');
    }
}
```

### `Session.php` 📜

```php

<?php

require_once('./User.php');

class Session
{
    private string $id;
    private User $user;


    public function __construct(
        private string $username,
        private string $name,
        private string $email,
    )
    {
        $this->id = bin2hex(random_bytes(16)); 
        $this->user = User::getInstance($username, $name, $email);
    }

    public function id()
    {
        return $this->id;
    }

    public function user()
    {
        $userData = $this->user->data();

        // Solo añadir 'SessionID' si la sesión está activa
        if ($this->id) {
            $userData['SessionID'] = $this->id;
        }
        return $userData;
    }

    public function logout()
    {
       $this->id = '';
       return $this->user->reset();
    }

}
```
## `index.php` 📜

```php

<?php
require_once("./Session.php");

$session = new Session("toxicPlayer69", "Federico", "toxicPlayer@gmail.com");
```

## Output

```plaintext
--------------------------------------------------- var_dump($session->user()); ------------------------------------------
array(5) {
  ["ID"]=>
  string(32) "5333651ed6a8fcd3d8b2a9df41ba52a0"
  ["Username"]=>
  string(13) "toxicPlayer69"
  ["Name"]=>
  string(8) "Federico"
  ["Email"]=>
  string(21) "toxicPlayer@gmail.com"
  ["SessionID"]=>
  string(32) "177ffa6a9363d77824294f16e81605d2"
}
--------------------------------------------------------------------------------------------------------------------------
$session->logout();
---------------------------------------------------- var_dump($session->user()); ------------------------------------------
array(4) {
  ["ID"]=>
  string(0) ""
  ["Username"]=>
  string(0) ""
  ["Name"]=>
  string(0) ""
  ["Email"]=>
  string(0) ""
}
--------------------------------------------------------------------------------------------------------------------------
```

## Traza hipótetica

1. El user hace login
2. Se crea la instancia 
3. Arranca una sesión
4. Se comparte esa instancia entre todas las partes de la aplicación
5. El user hace logout
6. Se va al carajo la instancia porque se resetean todas las propiedades
7. El user hace login
8. Se crea una nueva instancia
9. Arranca una nueva sesión


## ¿Qué Está Pasando en el código?

### Método `user()` en `Session`
Este método obtiene los datos del usuario a través de `$this->user->data()`.

### Añade `SessionID` al array copiado y luego lo retorna.
> ⚠️`$userData['SessionID'] = $this->id;` __SOLO afecta a la copia del array__ y no al estado interno de la instancia `User`. Esta clave __SOLO existe en la copia__ que se retorna y no en el objeto `User` en sí.

### Método `logout()` en `Session`:

### Resetea el `ID` de la sesión (`$this->id = ''`).
... Y luego Llama al método `reset()` en el objeto `User`, lo que pone en blanco todas las propiedades del usuario.

---

# Sin separar responsabilidades | `UserSession` by ChatGPT 🤖

```php

<?php

class UserSession
{
    // Instancia única de la clase
    private static ?UserSession $instance = null;

    // Propiedades de la clase para almacenar datos de usuario
    private ?int $id = null;
    private ?string $username = null;
    private ?string $name = null;
    private ?string $email = null;

    // Constructor privado para evitar la creación directa de instancias
    private function __construct() {}

    // Método estático para obtener la única instancia de la clase
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Método para asignar datos de usuario a la sesión
    public function setUser(int $id, string $username, string $name, string $email): void
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
    }

    // Método para recuperar los datos del usuario
    public function getUser(): ?array
    {
        if ($this->id !== null) {
            return [
                'id' => $this->id,
                'username' => $this->username,
                'name' => $this->name,
                'email' => $this->email,
            ];
        }
        return null; // Si no hay un usuario asignado, devolver null
    }

    // Método para borrar los datos de la sesión
    public function clearSession(): void
    {
        $this->id = null;
        $this->username = null;
        $this->name = null;
        $this->email = null;
    }
}

// Ejemplo de uso
$session = UserSession::getInstance();

// Asignar datos de usuario
$session->setUser(1, 'johndoe', 'John Doe', 'johndoe@example.com');

// Recuperar los datos de usuario
$userData = $session->getUser();
print_r($userData);

// Borrar los datos de la sesión
$session->clearSession();

// Verificar que la sesión ha sido borrada
$userDataAfterClear = $session->getUser();
var_dump($userDataAfterClear); // Debería ser null
```
