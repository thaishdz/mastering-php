

# Polimorfismo


<p align=center>
  <img src="https://github.com/user-attachments/assets/df7d9dce-4757-457e-9a87-9a2b4f313579" height="300" />
</p>

<p align=center>
  <em>La capacidad de un objeto para tomar muchas formas </em>
</p>

- Principio clave en la POO
- Puedes usar el mismo método o función para distintos tipos de objetos, y estos objetos pueden comportarse de manera diferente aunque tengan el mismo nombre de método.
- En PHP, __se logra mediante el uso de clases e interfaces.__

# Ejemplo - Polimorfismo mediante Herencia



![image](https://github.com/user-attachments/assets/25b91e9d-81b7-4ef4-af3e-f4005826b99a)

Beast Boy se transforma en animales, tú le dices que se transforme en algo pero no necesitas saber en qué animal lo hará, solo le pides que lo haga. Beast Boy decidirá si transformarse en tigre, águila, tiburón, etc. dependiendo de la situación.

# `BeastBoy.php`

```php
class BeastBoy 
{
	public function transform()
	{
		# do something stupida
	}
}
```

__Cambio de forma (`transform`)__: Beast Boy puede adoptar diferentes formas de animales, pero sigue siendo él mismo en esencia. 

> 👉 En el polimorfismo, un objeto puede representar diferentes formas de una clase base, pero sigue siendo un objeto del mismo tipo.


<img src="https://github.com/user-attachments/assets/fa6856b1-4802-4db5-a988-6cc101e6c606" height="300" />


# `Gorilla.php`

```php
class Gorilla extends BeastBoy
{
	public function transform()
	{
		echo "BeastBoy transforms into a Gorilla!\n";
	}

}
```

<img src="https://github.com/user-attachments/assets/a1510410-64b6-4e33-bca6-c91a702b2617" height="300" />

# Dino.php

```php

class Dino extends BeastBoy
{
	public function transform()
	{
		echo "BeastBoy transforms into a DINOSAUR!\n";
	}

}

```

__Comportamientos diferentes__: Aunque Beast Boy se transforme en diferentes animales, el comportamiento cambia según la forma :
- El gorila hará cosas de gorila
- El T-rex hará cosas del jurásico.

> 👉 En el polimorfismo, el mismo método puede comportarse de manera diferente según el objeto que lo implemente (una clase hija puede sobrescribir el comportamiento de una clase padre).

## 3. Uso del polimorfismo

Esta función __no necesita saber en qué animal se transformará Beast Boy__, solo llama al método `transform()`. 

> 👉 Aquí está la magia 🪄 del polimorfismo, puedes pasar cualquier clase (`Gorilla`, `Dino`, `Shark` ...), y la función llamará al método adecuado.


```php

function seeTransform(BeastBoy $form)
{
    $form->transform();
}

```


## 4. Usando las clases

Aquí es donde ves el polimorfismo en acción. Llamas a showTransform() y, dependiendo del tipo de objeto que le pases, hará algo diferente.

```php

$gorilla = new Gorilla();
echo seeTransform($gorilla); // BeastBoy transforms into a Gorilla!


$dino = new Dino();
echo seeTransform($dino); // BeastBoy transforms into a DINOSAUR!
 
```


# Ejemplo - Polimorfismo mediante Interfaces


```php
interface BeastBoy 
{
	public function behavior();
}

```

```php

class Gorilla implements BeastBoy
{
	public function behavior()
	{
		echo "Gorilla is eating bananas 🍌🦍\n";
	}

}


class Dino implements BeastBoy
{
	public function behavior()
	{
		echo "Dino IS DESTRYOING THE CITY 🔥🌇🦖\n";
	}

}

```

## Uso del polimorfismo con interfaz

```php

function behavior(BeastBoy $form)
{
    $form->behavior();
}


$gorilla = new Gorilla();
$dino = new Dino();


echo behavior($gorilla); // Gorilla is eating bananas 🍌🦍
echo behavior($dino); // Dino IS DESTRYOING THE CITY 🔥🌇🦖

```

Todos esos objetos comparten el mismo "contrato" o interfaz (_BeastBoy_), que define que deben tener el método `behavior()`. Pero cada uno lo implementa a su manera.

### Ayuditas 🛎️

- [Polimorfismo en PHP - by NorvicSoftware](https://norvicsoftware.com/polimorfismo-en-php/)


