

# Decorator

> Ponerle capas extra a algo que ya tienes, sin cambiar lo que hay debajo.

Tengo un café ☕ (objeto principal) y quiero echarle azúcar 🧊 (funcionalidad extra). En lugar de hacer un café nuevo con azúcar, le añado el 🧊 al ☕ que ya tengo.

<p align=center>
  <img src="https://github.com/user-attachments/assets/3166bd22-7c4f-48f7-9c2e-48037a5126cc" height="400" />
</p>

# PA QUÉ ES ESTO ❔

- Cuando deseas extender el comportamiento de clases


---

# Características

- Patrón de diseño __ESTRUCTURAL__
- Bastante común en PHP, especialmente con los `streams`.
- Se reconoce __por métodos de creación o el constructor que acepta objetos de la misma clase o interfaz que la clase actual.__


<p align=center>
  <img src="https://github.com/user-attachments/assets/127fb5ab-54c1-44e8-a978-fca226fba6cf" />
</p>


# Cómo funka la vaina❔

Tienes *TRES* cosas a tener en cuenta :

- __Componente base__: ✨ *Interfaz* ✨ o ✨ *clase abstracta* ✨ que define la funcionalidad básica.
- __Clase concreta__: Implementa el componente base.
- __Decorator__: Clase que implementa __la misma interfaz o hereda de la clase base__ y contiene una referencia a un objeto de la misma interfaz o clase base. Este objeto es al que se le "decora" o añade la nueva funcionalidad.


# Biblioteca de Notificaciones 🔔 - Ejemplo


Estás inmerso currando en una biblioteca de notificaciones que permite a otros programas notificar a usuarios sobre de eventos importantes 

La versión primigenia de la biblioteca se basaba en la clase `Notifier` que contaba con :
- Varios campos
- 1 `constructor`
- 1 Método `send`.

<p align=center>
  <img src="https://github.com/user-attachments/assets/423507dc-67ad-4097-9061-b5b826830cd3" />
</p>

- `send` aceptaba, como argumento, un mensaje ✉️ de un cliente y enviar el mensaje ✉️ a una lista de correos electrónicos que se pasaban a la clase `Notifier` a través de su constructor. 
- La aplicación de un tercero que actuaba como cliente debía crear y configurar el objeto `Notifier` una vez y después utilizarlo cada vez que sucediera algo importante.


Eres persona avispada 🐝 y te das cuenta de que los usuarios de la biblioteca quieren más cositas como :

- A muchos, les gustaría recibir __SMS__.
- Otros, recibir las notificaciones por __Facebook__
- A La gente business 💼 le encantaría recibir notificaciones por __Slack__.

<p align=center>
  <img src="https://github.com/user-attachments/assets/be6a9993-362b-4453-9c51-4849fa397266" />
</p>

Dijiste ... OLRAIT!, PUES
✨`INTERFACES`✨, entonces extendiste la clase `Notifier` y le metiste los métodos adicionales de notificación a las nuevas subclases 👍.

Ahora el cliente debería instanciar la clase notificadora deseada y utilizarla para el resto de notificaciones.

![image](https://github.com/user-attachments/assets/3b201612-804c-4430-94e2-7103e692fc11)

> “¿Por qué no se pueden utilizar varios tipos de notificación al mismo tiempo?. 
Si tu casa está en llamas 🏠🔥, querrás saberlos por TODOS los canales existente, hasta por paloma mensajera”.

<p align=center>
  <img src="https://github.com/user-attachments/assets/d3c79f1b-bf68-49c7-9fa1-39eff5c44ddc" />
</p>

Mira como sigamos inventando situaciones no habrán más subclases que meter porque ahora hay combos de clases y esto es insostenible.


# LA MAGIA DEL DECORATOR ⭐

Cuando tenemos que __alterar la funcionalidad de un objeto__, lo suyo es _extender una clase_. El tema es que la herencia tiene varias limitaciones importantes :

1. _La herencia es estática_. ❗ No se puede alterar la funcionalidad de un objeto existente durante el tiempo de ejecución. Sólo se puede sustituir el objeto completo por otro creado a partir de una subclase diferente.

2. _Las subclases sólo pueden tener una clase padre_. En la mayoría de lenguajes, __la herencia no permite a una clase heredar comportamientos de varias clases al mismo tiempo.__ ❗

```php

// Componente base
interface Notificador {
    public function enviar($mensaje);
}

// Clase concreta
class NotificadorEmail implements Notificador {
    public function enviar($mensaje) {
        echo "Enviando notificación por email: $mensaje\n";
    }
}

// Decorador base
class NotificadorDecorator implements Notificador {
    protected $notificador;

    public function __construct(Notificador $notificador) {
        $this->notificador = $notificador;
    }

    public function enviar($mensaje) {
        $this->notificador->enviar($mensaje);
    }
}

// Decorador concreto que añade funcionalidad extra
class NotificadorSMS extends NotificadorDecorator {
    public function enviar($mensaje) {
        parent::enviar($mensaje);
        echo "Enviando notificación por SMS: $mensaje\n";
    }
}

// Uso del patrón Decorator
$notificador = new NotificadorEmail();
$notificadorSMS = new NotificadorSMS($notificador);

$notificadorSMS->enviar("Hola, este es un mensaje importante!");

```

## Explicación del código
1. `Notificador`: Es la interfaz base.
2. `NotificadorEmail`: Es la clase concreta que implementa el método enviar.
3. `NotificadorDecorator`: Es la clase decoradora que añade funcionalidad adicional.
4. `NotificadorSMS`: Es un decorador concreto que añade el envío de mensajes SMS.

Cuando ejecutas el código, `NotificadorSMS` envía primero el email y luego el SMS, demostrando cómo el patrón `Decorator` añade funcionalidad de manera dinámica.
