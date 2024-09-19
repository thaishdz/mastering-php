
# Open/Closed

<p align=center>
  <img src="https://github.com/user-attachments/assets/5c7be335-722b-4511-b0e7-f4207cda023b" height="400" />
</p>

<p align=center>
  <em>Créditos de la imagen a IngenieroBinario</em>
</p>


# Los Points 📍

- __Abierto para extensión__: Podemos extender el comportamiento de una clase sin alterar su código fuente.
  
- __Cerrado para modificación__: No deberíamos modificar el código existente directamente para agregar nuevas funcionalidades, porque esto podría introducir errores o afectar el comportamiento ya probado.


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
La clase original no ha sido modificada (está cerrada), pero podemos extender su funcionalidad para manejar otros tipos de impuestos (está abierta).

## Beneficios

Promueve la __estabilidad y mantenibilidad del código__, ya que las clases probadas y en producción no necesitan ser cambiadas directamente cuando hay nuevas funcionalidades.
