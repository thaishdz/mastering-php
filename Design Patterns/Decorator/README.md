

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
