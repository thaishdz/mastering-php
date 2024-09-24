

# Interface Segregation Principle

<p align=center>
    <img src="https://github.com/user-attachments/assets/80249995-f039-4bbe-89f2-ce9d33aed483" height="400" />
</p>

<p align=center>
    <b>Una clase no debe estar obligada a implementar métodos que no utiliza</b>
</p>

# ¿Cómo detecto que estoy violando el `ISP`?

-  Si tenemos clases que implementan métodos de interfaces que no se usan.
-  Definimos interfaces con parámetros que no se van a utilizar en todas las clases.
-  Cuando tenemos interfaces muy grandes. Probablemente estemos definiendo métodos que no son genéricos y que otras clases que implementen esta interfaz no puedan usar.

## Bad Design 🤮

### `SuperHeroInt.php`

```php

interface SuperHeroInt
{
    public function fly();
    public function shootLasers();
    public function superStrength();
    public function regenerate();
}

```

<img src="https://github.com/user-attachments/assets/7f04abf3-8f40-44f3-bbe4-2cde1c1f5b56" height="300" />


Si intentamos implementar esta interfaz con diferentes superhéroes, vamos a tener problemas. 

Porque:

- Spider-Man no vuela ❌
- Iron Man no se regenera ❌
- Hulk no lanza rayos ❌

### `Spiderman.php`

```php
class SpiderMan implements SuperHeroInt
{
    public function fly() {
        // Spider-Man can't fly, but has to implement this method.
    }
    
    public function shootLasers() {
        // Spider-Man doesn't shoot lasers.
    }
    
    public function superStrength() {
        echo "Spider-Man has super strength.";
    }
    
    public function regenerate() {
        // Spider-Man doesn't regenerate.
    }
}

```
![image](https://github.com/user-attachments/assets/c78854c3-c483-4617-8801-e5ba55ec4569)


> ⛔ This design violates the `ISP` because `SpiderMan` is forced to implement methods it doesn't need.


# ¿Cómo lo arreglo? 

Divide la interfaz en interfaces más pequeñas y específicas para cada funcionalidad 


## Good Design 👍

```php

interface CanFly {
    public function fly();
}

interface CanShootLasers {
    public function shootLasers();
}

interface HasSuperStrength {
    public function superStrength();
}

interface CanRegenerate {
    public function regenerate();
}

```

Now, each hero implements only the interfaces that make sense for their powers:

### `Spiderman.php`

```php
class SpiderMan implements HasSuperStrength
{
    public function superStrength()
    {
        echo "Spider-Man has super strength.";
    }
}
```

<img src="https://github.com/user-attachments/assets/b7ad264e-dd4e-4ddc-ae35-8c7b6528d06e" height="300" />


### `IronMan.php`

```php

class IronMan implements CanFly, CanShootLasers, HasSuperStrength {
    public function fly() {
        echo "Iron Man can fly with his suit.";
    }

    public function shootLasers() {
        echo "Iron Man shoots lasers from his repulsors.";
    }

    public function superStrength() {
        echo "Iron Man has super strength thanks to his suit.";
    }
}
```
<img src="https://github.com/user-attachments/assets/4e966a70-49c2-4a3b-91d7-d0860fc58dad" height="300" />

### `Hulk.php`

```php
class Hulk implements HasSuperStrength, CanRegenerate {
    public function superStrength() {
        echo "Hulk has incredible strength.";
    }

    public function regenerate() {
        echo "Hulk can regenerate quickly.";
    }
}
```

<img src="https://github.com/user-attachments/assets/2a34113b-ef91-4f15-ac69-7559e0ef9a7b" height="300" />



> El `ISP` busca que las interfaces sean lo más pequeñas y específicas posible de modo que cada clase solo implemente los métodos que necesita.


### Ayuditas 🛎️
-[Principio Segregación Interfaces ~ by Secture📰](https://secture.com/blog/principios-solid-interface-segregation-principle/)
