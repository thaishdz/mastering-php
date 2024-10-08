

Crea un sistema de notificaciones

<img src="https://github.com/user-attachments/assets/a66b1eb8-53a7-472c-b3a7-43f3a8172c50" height="300" />


## Requisitos 🎯

1. El sistema puede enviar Email, PUSH y SMS (implementaciones específicas).
2. El sistema de notificaciones no puede depender de las implementaciones específicas.

## Instrucciones ⚙️

1. Crea la interfaz o clase abstracta.
2. Desarrolla las implementaciones específicas.
3. Crea el sistema de notificaciones usando el DIP.
4. Desarrolla un código que compruebe que se cumple el principio.

### `index.php`

```php

<?php

// Todas las notificaciones que implementemos dependerán de esta Abstracción
interface NotifierInt
{
    function send(string $message): void;
}

// Implementación de bajo nivel (la específica)
class EmailNotifier implements NotifierInt
{
    public function send(string $message): void 
    {
        echo "Sending email 📬... $message";
    }
}

// Implementación de bajo nivel 🔻
class PUSHNotifier implements NotifierInt
{
    public function send(string $message): void 
    {
        echo "Sending PUSH 📲... $message";
    }
}

// Implementación de bajo nivel 🔻
class SMSNotifier implements NotifierInt
{
    public function send(string $message): void 
    {
        echo "Sending sms 📩 ... $message";
    }
}

// Implementación de ALTO nivel 🔺
class NotificationService
{
    private NotifierInt $notifier;

    public function __construct(NotifierInt $notifier) { 
        $this->notifier = $notifier;
    }

    function send(string $message): void 
    {
        echo "{$this->notifier->send($message)}";
    }
}


function testNotifier() 
{
    $sms = new SMSNotifier();
    $email = new EmailNotifier();
    $push = new PUSHNotifier();

    $notifier = new NotificationService($push);
    $notifier->send('💩');
}

testNotifier();
```

### Output

<img width="616" alt="Captura de pantalla 2024-09-27 a las 19 47 34" src="https://github.com/user-attachments/assets/9c36eab4-fc94-48f7-97be-9253dd692035">
