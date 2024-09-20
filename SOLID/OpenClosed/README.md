
# Open/Closed Principle

<p align=center>
  <img src="https://github.com/user-attachments/assets/5c7be335-722b-4511-b0e7-f4207cda023b" height="400" />
</p>

<p align=center>
  <em>Créditos de la imagen a IngenieroBinario</em>
</p>

# El Point 📍
Las clases tienen que ser capaces de estar abiertas a extender el comportamiento sin necesidad de modificar su código. 

# ¿Cómo sé si NO estoy cumpliendo con el `OCP`?

Fácil 👇

> _¿Tienes que modificar siempre los mismos archivos cada vez que tienes que hacer una nueva implementación?_

Entonces amiga (date cuenta), hazte un frapuccino, cuenta hasta 3 y di en voz alta _"PUTA MADRE, no cumple con el `OCP`, hay que refactorizar esta 💩"_

# Y ... ¿Cómo lo arreglo? 

✨ [Polimorfismo](https://github.com/thaishdz/mastering-php/blob/main/Polimorfismo/README.md)✨

- Con polimorfismo, en lugar de tener una clase principal que es capaz de saber cómo realizar una operación, __delega la lógica a los objetos que conocen como solucionar esta lógica__.

- Cada objeto, implementará una forma específica de resolución de la operación y según el tipo de operación se llamará al objeto encargado para solucionarlo.

---

# Ejemplo de Implementación de `OCP` con `abstract class`

### 1. **Clase abstracta `Payment`**:
  > 👉 Una `abstract class` __no puede ser instanciada directamente__, solo puede ser extendida por otras clases.

Esta clase define propiedades y un método abstracto que las subclases (`CredidCard`) deben implementar :

   ```php
   abstract class Payment {
       protected string $title;
       protected string $accountNumber;
       protected int $balance = 1000;
       protected int $last4Digits;
   ```

💡 A diferencia de una `interface`, una `abstract class` permite definir propiedades y constructores.

> 👉 En una `abstract class`, las propiedades suelen ser `protected` porque están pensadas para ser accesibles únicamente desde la clase misma o sus subclases

 ```php
   public function __construct(
          string $title, 
          string $accountNumber
  )
  {
       $this->title = $title;
       $this->accountNumber = $accountNumber;
       $this->last4Digits = substr($this->accountNumber, -4);
 }

   public abstract function pay(int $number);
```

La clase declara un método abstracto `pay()`, que debe ser implementado por las subclases. Esto obliga a cualquier clase que extienda de `Payment` a definir cómo se realizará el pago.

---

### 2. **Clase `CreditCard`**:

Esta clase extiende de `Payment` e implementa el método `pay()`.

```php
  class CreditCard extends Payment
  {
       private int $charges = 50;
  }
```

```php
   public function pay(int $number)
   {
       $this->balance = ($this->balance - $number) - $this->charges;
   }
```

   - **`pay(int $number)`**: Este método recibe un número (cantidad a pagar) y calcula el nuevo balance.
     - Resta el monto a pagar (`$number`) y también aplica los cargos (`$charges`).
     - La fórmula es: **nuevo balance = saldo actual - cantidad - cargos**.

  ```php
  printf(
      "Hello %s,\nPay successfully against xxxx-%s, Your remaining balance is %d\n", 
      $this->title, 
      $this->last4Digits, 
      $this->balance
  );

```

   - Usa `printf()` para imprimir un mensaje.
     - `%s` es un marcador para cadenas.
     - `%d` es un marcador para números enteros.
     - Muestra un mensaje que incluye el nombre del titular (`$title`), los últimos 4 dígitos de la cuenta (`$last4Digits`), y el saldo restante (`$balance`).

## Uso 
```php

$creditCard = new CreditCard("Muhammad Raza Bangi", "123456789");
$creditCard->pay(200);

```

```plaintext

(creditcard instance output)
Hello Muhammad Raza Bangi,
Pay successfully against xxxx-6789, Your remaining balance is 750

```

---

![image](https://github.com/user-attachments/assets/3065b367-415d-44c7-a0a6-8db95106e7af)


```plaintext
👨‍🦲 "Hey maquinarias, necesito que añadas Paypal como forma de pago" 
👨‍💻 No hay problemo
```

### 3. ✨ NEW FEATURE:  `Paypal` ✨

```php

class Paypal extends Payment {
    private $charges = 100;
    
    public function pay(int $number) {
        $this->balance = ($this->balance - $number) - $this->charges;
        
    printf(
        "Hello %s,\nPay successfully against xxxx-%s, Your remaining balance is %d\n", 
        $this->title, 
        $this->last4Digits, 
        $this->balance
    );
    }
}

```

```php

$paypal = new Paypal("Muhammad Raza Bangi", "987654321");
$paypal->pay(200);

```

```plaintext

(paypal instance output)
Hello Muhammad Raza Bangi,
Pay successfully against xxxx-4321, Your remaining balance is 700

```
---

### Resumen:
- **`Payment`** es una clase abstracta con un método abstracto `pay()`, que debe ser implementado por cualquier subclase.
- **`CreditCard`** extiende de `Payment` e implementa el método `pay()` con lógica para restar un monto del saldo, aplicando un cargo adicional.
- La clase usa los últimos 4 dígitos de la cuenta y proporciona un mensaje de éxito tras el pago.

---

### Ayuditas 🛎️

- [OCP - by Secture 📰](https://secture.com/blog/principios-solid-open-close-principle/)
- [OCP (abstract class and interface examples) - by Muhammad Raza Bangi 📰](https://blog.devgenius.io/open-closed-principle-ocp-by-using-php-solid-principle-f0ceae519bcf)
