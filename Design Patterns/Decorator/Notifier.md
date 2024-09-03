
# Una alerta 🔔 para dominarlas a todas 

<p align=center>
  <img src="https://github.com/user-attachments/assets/848d058b-c7f9-4f77-b295-6317209c0962" height="450" />
</p>


# Objetivo 

Que los usuarios se enteren por múltiples canales de cuándo ha ocurrido un eventos importante.

Hay tiquismiquis que quieren :

- Recibir __SMS__.
- Otros, ser notificados por __Facebook__.
- A La gente business 💼 le molaría recibir notificaciones por __Slack__.

# Implementación ⚒️

### [Paso 1] Crear la interfaz que será el objeto común a todos los canales de comunicación que se te ocurran

 ... ahora mismo solo serán SMS, Facebook y Slack.

```php

<?php

interface NotifierInt 
{
    public function send(string $message): void;
}

```


### [Paso 2] Crear la clase que tendrá la notificación más básica de todas
```php

<?php

require_once('./NotifierInt.php');


class Notifier implements NotifierInt
{
    public function send(string $message): void
    {
        echo "Notificación por defecto: {$message}\n";
    }
}

```

### [Paso 3] Creas la abstracta que recuerda, será como un Kangaskhan abrazando a su bebé

```php

<?php

require_once('./NotifierInt.php');


abstract class NotifierDecorator implements NotifierInt
{
    protected $wrapped;

    public function __construct(NotifierInt $notifier)
    {
        $this->wrapped = $notifier;
    }

    public function send(string $message): void
    {
        $this->wrapped->send($message);
    }
}

```

`NotifierDecorator` se encargará de envolver un objeto `NotifierInt` (el `$wrapped`) y delegar la llamada al método `send` al objeto envuelto. 

Además, permitirá a las subclases añadir o modificar el comportamiento. Como hacemos en este mismo ejemplo

### [Paso 4] Implementas todos los canales que quieras

```php

<?php

require_once('NotifierDecorator.php');

class FacebookDecorator extends NotifierDecorator
{

    function send(string $message): void
    {
        $this->sendFacebook($message);
    }


    private function sendFacebook(string $message): void 
    {
       echo "Enviando a Facebook: {$message}\n"; 
    }
}

```

### [Paso 5] Uso del `Decorator` 

```php

<?php


require_once('./Notifier.php');
require_once('./Decorators/SMSDecorator.php');
require_once('./Decorators/FacebookDecorator.php');
require_once('./Decorators/SlackDecorator.php');


/*
* Esta es la manera que tenemos de encadenar múltiples canales
*/


// Notificación by default
$notifier = new Notifier();

// SMS Notification
$notifier = new SMSDecorator($notifier);

// Facebook Notification
$notifier = new FacebookDecorator($notifier);

// Slack Notification
$notifier = new SlackDecorator($notifier);


// Se enviará a los 3 canales anteriores
$notifier->send("CHACHO HA OCURRIDO ALGO MEGA FUERTE, DEFCON 1 MÍNIMO, TE LLAMOOO");

```

Cada decorador envuelve el objeto anterior, permitiendo añadir comportamiento de forma acumulativa sin modificar las clases concretas. Así, puedes notificar de múltiples formas con un solo objeto.

### Secuencia de Salida Esperada

1. "Enviando SMS: CHACHO HA OCURRIDO ALGO MEGA FUERTE, DEFCON 1 MÍNIMO, TE LLAMOOO"
2. "Publicando en Facebook: CHACHO HA OCURRIDO ALGO MEGA FUERTE, DEFCON 1 MÍNIMO, TE LLAMOOO"
3. "Enviando mensaje a Slack: CHACHO HA OCURRIDO ALGO MEGA FUERTE, DEFCON 1 MÍNIMO, TE LLAMOOO"

💡 En la consola veremos que la salida de `$notifier->send("CHACHO HA OCURRIDO ALGO MEGA FUERTE, DEFCON 1 MÍNIMO, TE LLAMOOO");` es la del punto 3, porque fue la última llamada, en este caso a `SlackDecorator`.
