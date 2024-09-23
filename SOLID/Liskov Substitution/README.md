

# Liskov Substitution Principle


<p align=center>
  <img src="https://github.com/user-attachments/assets/f4f054b8-2315-4153-a462-3849e9fd891c" height="400" />
</p>

<p align=center>
  <em>Créditos de la imagen a IngenieroBinario</em>
</p>

> Las subclases que hereden de una clase madre deben utilizar los comportamientos y propiedades de su madre PERO, sin cambiar el funcionamiento del programa.

## `Bird.php` 🐦

```php

class Bird 
{
  public function fly(): string
  {
    echo "I can fly";
  }
}
```

## `Duck.php` 🦆

```php

class Duck 
{
  public function fly(): string
  {
    echo "Duckie is flying";
  }
}
```


# ¿Como sé que estoy violando el Liskov?

_La clase base : Debes cumplir con todo lo que te ofrezco_

_La subclase_:

<img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExM2d1ZmFoamV5cWZoNXQzMmJtdGl2emFrYTZkbjdrM3hydmxhMTk0NSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/Q7YYbx08JdJ0U7WdgJ/giphy.webp" height="300" />


⚠️ Cuando una subclase tenga métodos de la clase madre __SIN USAR o que NO aplican a la subclase__ que estemos creando. __VIOLA EL CONTRATO__ 

⚠️ Cuando una subclase __sobreescriba el método de manera que el tipo de retorno de ese método cambie.__ __VIOLA EL CONTRATO__ 

## `Penguin.php` 🐧

```php

class Penguin 
{
  public function fly(): string
  {
      throw new Exception("Penguins cannot fly"); // No pendejo, debes devolver una string NO UNA EXCEPCIÓN
  }
}

```

> 💡 Tip: Para saber de forma rápida si lo hemos violado, basta con mirar si los tests de la clase base funkan para la subclase. Si no funkan, te lo has cargado


# ¿Como solucionar la violación del principio?

Pues asegurándote de que las subclases cumplan con:

- Tener el mismo tipo de sus objetos
- Implementar los mismos métodos que la clase base
- Tener el mismo comportamiento que la clase base

Vamos, __cumplir CON EL FOKIN CONTRATO__

<img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExZ211ZnQ2a25yMWprOXE1czFlZzR3cnFoamFqZHVtbG1iZGk3NGMwaiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/dv4GB500NIyzKll8gE/giphy.webp" height="300" />


### Ayuditas 🛎️

- [Liskov Substitution Principle - by Secture 📰](https://secture.com/blog/principios-solid-3-liskov-substitution-principle/)
