
# Singleton

> También llamado: Instancia única

- Patrón de diseño __creacional__, que nos permite asegurarnos de que __una clase tenga una única instancia__. A la vez que proporciona un punto de acceso global a dicha instancia.
- Útil cuando necesitas un único objeto que gestione un recurso compartido (conexión a base de datos o un registro de configuración).

<p align=center>
  <img src="https://github.com/user-attachments/assets/d1c0bad6-016b-4b57-9d0e-f225c43b436c"/>
</p>

> ⚠️ Este patrón debe usarse con cuidado, ya que puede introducir un alto acoplamiento y dificultar los unit tests debido a su naturaleza global



# Cuándo usarlo
- __Cuando una clase tan solo deba tener una instancia disponible para todos los clientes__;
  - p.e : un único objeto de base de datos compartido por distintas partes del programa. (evitando la creación de múltiples instancias de una clase, ahorras recursos).

- Cuando necesites un __control más estricto de las variables globales__.
  - Al contrario que las variables globales, el patrón `Singleton` garantiza que haya una única instancia de una clase.
  - A excepción de la propia clase `Singleton`, nada puede sustituir la instancia en caché.
  - Ten en cuenta que siempre podrás ajustar esta limitación y permitir la creación de cierto número de instancias `Singleton`.
  - La única parte del código que requiere cambios es el cuerpo del método `getInstance`.



## Por qué se inventó esta 💩

### 1. ¿Por qué querría alguien controlar cuántas instancias tiene una clase? 

El motivo más habitual es controlar el acceso a algún recurso compartido, por ejemplo, una base de datos o un archivo.

<p align=center>
  <img src="https://github.com/user-attachments/assets/22c1d81c-a5ac-4a9f-ad4a-c903e77bed4c" width=500/>
</p>


Esta wea funciona ASÍ : 

Imagina que has __creado un objeto__ y al cabo de un tiempo __decides crear otro nuevo__. En lugar de recibir un objeto nuevo, obtendrás el que ya habías creado 👍.

Este comportamiento es IMPOSIBLE de implementar con un constructor normal, ya que una llamada al constructor de toda la vida SIEMPRE debe devolver un nuevo objeto por diseño.

## 2. Proporcionar un punto de acceso global a dicha instancia

¿Sabes esas variables globales que utilizaste para almacenar objetos esenciales?. Aunque son muy útiles, también son poco seguras, ya que cualquier código podría sobrescribir el contenido de esas variables y descomponer la aplicación.
Al igual que una variable global, el patrón `Singleton` nos permite acceder a un objeto desde cualquier parte del programa. No obstante, también evita que otro código sobreescriba esa instancia.

Este problema tiene otra cara: no queremos que el código que resuelve el primer problema se encuentre disperso por todo el programa. Es mucho más conveniente tenerlo dentro de una clase, sobre todo si el resto del código ya depende de ella.


## Implementación ⚒️

Todas las implementaciones del patrón `Singleton` tienen DOS pasos en común:

1. __Hacer privado el constructor por defecto__,para evitar que otros objetos utilicen el operador new con la clase Singleton.
2. __Crear un método de creación estático que actúe como constructor__. Tras bambalinas, este método invoca al constructor privado para crear un objeto y lo guarda en un campo estático. Las siguientes llamadas a este método devuelven el objeto almacenado en caché.

Si tu código tiene acceso a la clase Singleton, podrá invocar su método estático. De esta manera, cada vez que se invoque este método, siempre se devolverá el mismo objeto.



# Analogía en el mundo real

El Gobierno, es un ejemplo excelente del patrón `Singleton`. 

- Un país sólo puede tener un gobierno oficial.
- Independientemente de las identidades personales de los individuos que forman el gobierno
- El título “Gobierno de X” es un punto de acceso global que identifica al grupo de personas a cargo.

![image](https://github.com/user-attachments/assets/56daf58b-f2bf-4b6b-9b2f-0f30e2c64eb9)


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


### ¿Por qué `__wakeup` es público si intentamos proteger la serialización de la instancia?
Bien ahí, alguien podría serializar la instancia, guardarla en una cadena y luego deserializarla para crear una nueva instancia y te haría un CRISTO TODO.
El tema es que como buen *magic method*, PHP necesita que sea público, si no te dará un pedazo de warning ⚠️ diciéndotelo.
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
