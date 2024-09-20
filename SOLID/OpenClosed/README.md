
# Open/Closed Principle

<p align=center>
  <img src="https://github.com/user-attachments/assets/5c7be335-722b-4511-b0e7-f4207cda023b" height="400" />
</p>

<p align=center>
  <em>Créditos de la imagen a IngenieroBinario</em>
</p>

# El Point 📍
Las clases tienen que ser capaces de estar abiertas a extender el comportamiento sin necesidad de modificar su código. 


# Ejemplo

Tenemos una clase que calcula el precio de un producto con impuestos:


```php

class CalculadoraPrecio {
    public function calcular($precio) {
        return $precio * 1.18; // 18% de impuesto
    }
}

```

Si necesitamos cambiar el cálculo del impuesto en el futuro, según este principio, en lugar de modificar esta clase, la extenderemos. Por ejemplo, podríamos crear una subclase para un impuesto diferente sin alterar la original:


```php

class CalculadoraPrecioReducido extends CalculadoraPrecio {
    public function calcular($precio) {
        return $precio * 1.08; // 8% de impuesto
    }
}

```
La clase original no ha sido modificada (está cerrada) pero podemos extender su funcionalidad para manejar otros tipos de impuestos (está abierta).


# ¿Cómo sé si me estoy cargando el `Open/Closed`?

> 👉 Cuando añades funcionalidad, acabas modificando siempre los mismos archivos.

Si detectamos este patrón, tendremos que hacer una pausa, entender por qué nos ocurre y realizar una refactorización para cumplir con el principio.

# ¿Cómo lo arreglo? 

✨ [Polimorfismo](https://github.com/thaishdz/mastering-php/blob/main/Polimorfismo/README.md)✨

- Con polimorfismo, en lugar de tener una clase principal que es capaz de saber cómo realizar una operación, __delega la lógica a los objetos que conocen como solucionar esta lógica__.

- Cada objeto, implementará una forma específica de resolución de la operación y según el tipo de operación se llamará al objeto encargado para solucionarlo.

---

### Ayuditas 🛎️

- [Open/Closed Principle - by Secture📰](https://secture.com/blog/principios-solid-open-close-principle/)
