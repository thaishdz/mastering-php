

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


```php

<?php

// Todas las notificaciones que implementemos dependerán de esta Abstracción
interface NotifierInt
{
    function send(): void;
}

// Implementación de bajo nivel (la específica)
class Email implements NotifierInt
{
    public function send(): void 
    {
        echo "Sending email 📬...";
    }
}

// Implementación de bajo nivel 🔻
class Push implements NotifierInt
{
    public function send(): void 
    {
        echo "Sending PUSH 📲...";
    }
}

// Implementación de bajo nivel 🔻
class Sms implements NotifierInt
{
    public function send(): void 
    {
        echo "Sending sms 📩 ...";
    }
}

// Implementación de ALTO nivel 🔺
class Notifier
{
    private NotifierInt $notifier;

    public function __construct(NotifierInt $notifier) { 
        $this->notifier = $notifier;
    }

    function send(): void 
    {
        echo "{$this->notifier->send()}";
    }
}


function testNotifier() 
{
    $sms = new Sms();
    $email = new Email();
    $push = new Push();

    $notifier = new Notifier($push);
    $notifier->send();
}

testNotifier();

```

### Output

<img width="616" alt="Captura de pantalla 2024-09-27 a las 18 59 09" src="https://github.com/user-attachments/assets/d115f0f1-c0df-473a-8273-6525267101db">
