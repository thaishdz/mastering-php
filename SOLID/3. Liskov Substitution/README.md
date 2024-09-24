

# Liskov Substitution Principle

<p align=center>
  <img src="https://github.com/user-attachments/assets/f4f054b8-2315-4153-a462-3849e9fd891c" height="400" />
</p>

<p align=center>
  <em>Créditos de la imagen a IngenieroBinario</em>
</p>

# ¿Como sé que estoy violando el `LSP`?

_La clase base : Debes cumplir con todo lo que te ofrezco_

_La subclase_:

<img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExM2d1ZmFoamV5cWZoNXQzMmJtdGl2emFrYTZkbjdrM3hydmxhMTk0NSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/Q7YYbx08JdJ0U7WdgJ/giphy.webp" height="300" />

 La hija rebelde estará violando el contrato cuando:

⚠️ Tenga métodos de la madre __SIN USAR o que NO aplican a la subclase__ que estemos creando. 

⚠️ __Sobreescriba el método de la madre de manera que el tipo de retorno cambie.__ 


# Bad Design 🤮

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

## `Penguin.php` 🐧 ⚠️❗

```php

class Penguin 
{
  public function fly(): string
  {
      throw new Exception("Penguins cannot fly"); ❌❌❌ PENDEJA, debes devolver una string NO UNA EXCEPCIÓN
  }
}

```

# ¿Cómo lo arreglo?

Asegurándote de que las subclases cumplan con:

- Tener el mismo tipo de sus objetos
- Implementar los mismos métodos que la clase base
- Tener el mismo comportamiento que la clase base

Vamos, __cumplir CON EL FOKIN CONTRATO__

<img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExZ211ZnQ2a25yMWprOXE1czFlZzR3cnFoamFqZHVtbG1iZGk3NGMwaiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/dv4GB500NIyzKll8gE/giphy.webp" height="300" />


# Good Design 👍

### `Bird.php` 🐦

```php

class Bird 
{
  public function move()
  {
    echo "I can moving!\n";
  }
}
```

### `Duck.php` 🦆

```php

class Duck 
{
  public function move()
  {
    echo "Duckie is flying\n";
  }
}
```

### `Penguin.php` 🐧 🛠️ (fixed)

```php

class Penguin 
{
  public function move()
  {
      echo "Penguin is swimming 🏊‍♂️";
  }
}
```


## index.php

```php

$bird = new Bird();
echo $bird->move();
$penguin = new Penguin();
echo $penguin->move();


// Cambiamos las implementaciones y todo sigue funcionando igual

$bird = new Penguin();
echo $bird->move();
$penguin = new Bird();
echo $penguin->move();

```
```plaintext
I can moving!
Penguin is swimming
Penguin is swimming
I can moving!
```
<img src="https://github.com/user-attachments/assets/0707f529-546c-47e6-806d-b8051dc30431" height="300" />

<em>Barbara happy</em>


## Tip 💡

¿Los ✨ __tests__ ✨ de la clase base te funkan con cada subclase?

Si no funkan, te lo has cargado. 👍

<img src="https://github.com/user-attachments/assets/a61682d0-69e3-4fd2-b119-8268ac9e0d60" height="300" />

<em>Barbara unhappy</em>




### Ayuditas 🛎️

- [Liskov Substitution Principle - by Secture 📰](https://secture.com/blog/principios-solid-3-liskov-substitution-principle/)
