
# Singleton

> También llamado: Instancia única

- Patrón de diseño __CREACIONAL__, que nos permite asegurarnos de que __una clase tenga una única instancia__.
- Proporciona un __punto de acceso global a la instancia__ en todo el programa.
- *Útil para* :
  - __Sesiones de usuario__ => Evitamos tener que loguear al user constantemente (?), la sesión de usuario debe compartirse en toda la aplicación.
  - __Conexión a base de datos__  => 1 conexión activa en todo momento, lo que mejora la gestión de recursos 👍.
  - __Registro de configuración__ => Cuando tienes configuraciones globales que necesitas cargar una sola vez y luego utilizar en varios lugares de tu aplicación.
  - __Gestión de registros o seguimiento__ => Para llevar un registro de eventos o actividad en tu aplicación y asegurarte de que se mantenga una sola instancia de registro.

## THE POINT 💡
Queremos restringuir ⛔ __la creación de objetos de una clase a una ÚNICA instancia__, independientemente de cuántas veces se intente instanciarla❗. 

SIEMPRE, obtendrás ❇️ __LA MISMA FOKIN INSTANCIA__ ❇️

<p align=center>
  <img src="https://github.com/user-attachments/assets/d1c0bad6-016b-4b57-9d0e-f225c43b436c"/>
</p>


## Esqueleto por defecto 💀

<p align=center>
  <img src="https://github.com/user-attachments/assets/56daf58b-f2bf-4b6b-9b2f-0f30e2c64eb9"/>
</p>

```php

class Singleton
{
    // Para almacenar la ÚNICA instancia que tendremos SIEMPRE
    private static $instance = null;

    // Moar properties ... 

    private function __construct()
    {
       // Lógica de inicialización, si fuese necesaria
    }

    
    public static function getInstance(): self
    {
        if (!self::$instance) 
        {
            self::$instance = new self(); 
        }   
        return self::$instance; 
    }


    // Moar methods ...
}

$singletitoMal = new Singleton(); // JAJAJAN'T Uncaught Error: Call to private Singleton::__construct() from global scope

$singletitoBien = Singleton::getInstance();
```

## Output

```plaintext
------------------------------------------------ var_dump($singletitoBien); ----------------------------------------

object(Singleton)#1 (0) {}

--------------------------------------------------------------------------------------------------------------------

- object(Singleton): Indica que el objeto es una instancia de la clase Singleton.

- #1: Identificador único asignado a la instancia del objeto. En este caso, #1 significa que es la primera instancia de la clase Singleton creada en este contexto.

- (0): Indica el número de propiedades públicas del objeto. En este caso, (0) significa que el objeto no tiene propiedades públicas.

- {}: Dentro de las llaves se muestran las propiedades del objeto. En este caso, las llaves están vacías, lo que significa que no hay propiedades públicas visibles en la representación del objeto.
```

Esto para PHP, pero si usas otro lenguaje, debes buscar cómo se usa el `Singleton` pero en verdad todos siguen las mismas directrices :


1. __Privatizar el constructor__: Para evitar que se creen nuevas instancias, constructor como privado debes poner.

2. __Crear una propiedad estática para la instancia__: Esta propiedad almacenará la única instancia de la clase.
  
4. __Proporcionar un método estático para obtener la instancia__: A través de este método, se accederá a la única instancia de la clase, creándola si aún no existe.
  
5. __Evitar la clonación y la serialización__ (🐘 *PHP*): Si es necesario, puedes implementar los métodos `__clone()` y `__wakeup()` para evitar la creación de copias de la instancia y problemas de serialización.


> ⚠️ [ADVERTENCIA]: Puede introducir un __Alto Acoplamiento__ y __dificultar los Unit Tests__ debido a su naturaleza global 

# Analogía con el mundo real

El Gobierno, es un ejemplo de patrón `Singleton`. 

- Un país *sólo* puede tener un gobierno oficial.
- Independientemente de las identidades personales de los individuos que forman el gobierno
- El título “Gobierno de X” es un punto de acceso global que identifica al grupo de personas a cargo.


```php

<?php

class Government
{
    // Propiedad estática para almacenar la única instancia del gobierno
    private static $instance = null;

    // Información del país y la composición del gobierno
    private $country;
    private $members;

    // Constructor privado para evitar que se cree más de una instancia
    private function __construct($country)
    {
        $this->country = $country;
        $this->members = [];
    }

    // Método estático para obtener la única instancia del gobierno
    public static function getInstance($country)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($country); // Crea la instancia única si no existe
        }
        return self::$instance;
    }

    // Method to add a member to the government
    public function addMember($name)
    {
        $this->members[] = $name;
    }

    // Method to display the government composition
    public function showGovernment()
    {
        echo "Government of {$this->country}:\n";
        foreach ($this->members as $member) {
            echo "- $member\n";
        }
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance by making __wakeup public but controlled
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}

// Example usage
$government = Government::getInstance("Españita");
$government->addMember("President: Pedrito");
$government->addMember("Minister of Finance: Montero");
$government->addMember("Minister of Health: Mónica García");

$government->showGovernment();

// Trying to get another instance
$anotherGovernment = Government::getInstance("Irlanda");
$anotherGovernment->showGovernment();
```

### Output


```php
------------- $government->showGovernment() -------------

Government of Españita:
- President: Pedrito
- Minister of Finance: Montero
- Minister of Health: Mónica García

La instancia

------------- $anotherGovernment->showGovernment() -------------

Government of Españita:
- President: Pedrito
- Minister of Finance: Montero
- Minister of Health: Mónica García


La misma puta instancia

```



# Preguntitas ❔
### ¿Por qué `__wakeup` es público si intentamos proteger la serialización de la instancia?
Bien ahí!, es verdad que alguien podría serializar la instancia, guardarla en una cadena y luego deserializarla para crear una nueva instancia y te haría TODO UN CRISTO.
El tema es que como buen *magic method*, PHP necesita que sea público, si no te ladrará un pedazo warning ⚠️ diciéndotelo.
Por eso lo dejamos así, con excepción incluida para avisar (vamos que te lo dejo público pero controlado 👁️)

```php
public function __wakeup()
{
 throw new \Exception("Cannot unserialize a singleton.");
}

```

Entonces ... por qué `__clone` siendo un magic method no necesita ser `public`?

![image](https://github.com/user-attachments/assets/54a5f125-e25e-4d97-a8c0-42506e64575f)

Porque la clonación de un objeto en PHP solo se realiza cuando alguien INTENCIONALMENTE utiliza la palabra clave `clone`. Si el método `__clone()` es privado o protegido, simplemente no se podrá clonar el objeto, ya que PHP lanzará un error si se intenta. La deserialización, puede ocurrir ✨automáticamente ✨ cuando se utiliza `unserialize()` y PHP requiere que el método `__wakeup()` sea accesible públicamente para poder restaurar el estado del objeto correctamente.

Vamos que tú no invocas a `__wakeup` INTENCIONALMENTE, lo hace PHP cuando tú INTENCIONALMENTE llamas a `unserialize()`

O ... tú has visto por algún lado una llamada al `wakeup`?, porque yo no.

<p align=center>
  <img src="https://github.com/user-attachments/assets/2a269b90-03de-448f-9c69-9ddbf4406514" width=500/>
</p>

### Ayuditas 🛎️

- [Singleton - Refactoring Guru](https://refactoring.guru/es/design-patterns/singleton)
- [Singleton - GuiaPHP](https://guiaphp.com/desarrollo/patron-singleton-en-php-garantizando-una-unica-instancia/)
