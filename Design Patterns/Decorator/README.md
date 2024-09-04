

# Decorator

Te vas al Mcdonald's y decides pillarte una hamburguesa de 1€, pero resulta que esa mierda se te queda corta.

Le dices al empleado que quieres la 🍔, con extra de ✨ PEPINILLO ✨ y quesito 🧀.

El empleado te dice, que esos _decoradores_ serán de +1€ a pagar, entonces el total ascenderá a 2 euracos.

Sigues queriendo la misma burguer pero te toca pagar __DECORATORS__.

<p align=center>
  <img src="https://github.com/user-attachments/assets/0c27ab6b-c8af-422f-9bd0-9f4b13e46276" height="650" />
</p>


<p align=center>
  <em>¿Y si ... me pido un Happy Meal?</em>
</p>


# ¿Qué me resuelve esto?

- Añadir alguna funcionalidad o comportamiento nuevo a los objetos de una clase SIN ALTERAR NADA DEL CÓDIGO.
- Te topas con que la solución va por herencia múltiple, pero PHP no tiene 👍.
- Tienes clases con `final` (se usa para evitar que una clase siga extendiéndose).

<p align=center>
  <img src="https://github.com/user-attachments/assets/d721b003-e5cc-4f09-a2de-ca061bb31ce8" height="400" />
</p>
<p align=center>
  <em>Aquí los decoradores serían ponerte un suéter y un chubasquero, eres la misma persona pero abrigadita</em>
</p>



# Los 4 jinetes del Apocalipsis 🏇

Sí, porque serán *CUATRO*, las cosas a tener en cuenta :



- __Interfaz__: TODOS los componentes DEBEN implementar esta interfaz ⚠️
    ```php
      interface CoffeeInt
      {
        public function getCost(): int;
        public function getDescription(): string;
      }
    ```
- __Clase Base__: Implementa la interfaz
    ```php
    class SimpleCoffee implements CoffeeInt
    {
      public function getCost(): int
      {
          return 10;
      }
  
      public function getDescription(): string
      {
          return 'Simple Coffee';
      }
    }
    ```
- __Decorator Abstracto__: Implementa __la misma interfaz o hereda de la clase base__ y contiene una referencia a un objeto de la misma interfaz o clase base.
  ```php
      abstract class CoffeeDecorator implements CoffeeInt
      {
        protected $decoratedCoffee;
    
        public function __construct(CoffeeInt $decoratedCoffee) // ojito aquí mai diar 👁️
        {
            $this->decoratedCoffee = $decoratedCoffee;
        }
      }
  ```

- __Los sabores del helado 🍦__:  Los _addons_ que quieras tener, en este caso queremos añadirle lechita 🥛 al coffee ☕.
  ```php
    class MilkCoffee extends CoffeeDecorator
    {
        private const PRICE = 2; // esto es caro mai friend
        
        public function getCost(): int
        {
            return $this->decoratedCoffee->getCost() + self::PRICE;
        }
    
        public function getDescription(): string
        {
            return $this->decoratedCoffee->getDescription() . ', milk';
        }
    }
  ```

# La movida con la herencia

Cuando tenemos que __alterar la funcionalidad de un objeto__, lo suyo es _extender una clase_. El tema es que la herencia tiene varias limitaciones importantes :

1. _La herencia es estática_. ⚠️No se puede alterar la funcionalidad de un objeto existente durante el tiempo de ejecución. Sólo se puede sustituir el objeto completo por otro creado a partir de una subclase diferente.

2. _Las subclases sólo pueden tener una clase padre_. En la mayoría de lenguajes, ⚠️ __la herencia __NO__ permite a una clase heredar comportamientos de varias clases al mismo tiempo.__ 


# Ejemplos

- [Enviar UNA notificación a MÚLTIPLES cananles 🔔](https://github.com/thaishdz/mastering-php/blob/main/Design%20Patterns/Decorator/Notifier.md)
- [Packs de viajes: Hotel 🏨 + Taxi 🚗 ](https://github.com/thaishdz/mastering-php/blob/main/Design%20Patterns/Decorator/TripPack.md)


## Ayuditas 🛎️

- [Decorator - RefactoringGuru](https://refactoring.guru/es/design-patterns/decorator)
- [Decorator en PHP - Codenip](https://www.youtube.com/watch?v=XOvXMZ0DWCU)
- [Enhance Your PHP Code with Decorator Design Pattern](https://kongulov.dev/blog/enhance-your-php-code-with-decorator-design-pattern)
