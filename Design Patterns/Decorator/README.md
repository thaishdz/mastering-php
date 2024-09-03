

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

- Quieres añadir comportamiento o alguna funcionalidad específica a los objetos de una clase de clases pero la herencia no te vale de una 💩.
- Tienes clases con `final` (se usa para evitar que una clase siga extendiéndose). Entonces para añadir funcionalidad, la única forma de reutilizar el comportamiento existente será envolver la clase con tu propio `wrapper`.
- Necesites asignar funcionalidades adicionales a objetos durante el tiempo de ejecución sin joder el código que utilizan esos objetos.


<p align=center>
  <img src="https://github.com/user-attachments/assets/d721b003-e5cc-4f09-a2de-ca061bb31ce8" height="400" />
</p>
<p align=center>
  <em>Aquí los decoradores serían ponerte un suéter y un chubasquero, eres la misma persona pero abrigadita</em>
</p>



# ¿Cómo funka esta vaina?

Primero, *TRES* cosas a tener en cuenta :

- __Componente base__: ✨ *Interfaz* ✨ o ✨ *clase abstracta* ✨ que define la funcionalidad básica.
- __Clase concreta__: Implementa el componente base.
- __Decorator__: Clase que implementa __la misma interfaz o hereda de la clase base__ y contiene una referencia a un objeto de la misma interfaz o clase base. Este objeto es al que se le "decora" o añade la nueva funcionalidad.


# La movida con la herencia

Cuando tenemos que __alterar la funcionalidad de un objeto__, lo suyo es _extender una clase_. El tema es que la herencia tiene varias limitaciones importantes :

1. _La herencia es estática_. ❗ No se puede alterar la funcionalidad de un objeto existente durante el tiempo de ejecución. Sólo se puede sustituir el objeto completo por otro creado a partir de una subclase diferente.

2. _Las subclases sólo pueden tener una clase padre_. En la mayoría de lenguajes, __la herencia no permite a una clase heredar comportamientos de varias clases al mismo tiempo.__ ❗


# Ejemplos

- [TripPack: Hotel 🏨 + Taxi 🚗 ](https://github.com/thaishdz/mastering-php/blob/main/Design%20Patterns/Decorator/TripPack.md)
- [Biblioteca de Notificaciones 🔔]()

## Ayuditas 🛎️

- [Decorator - RefactoringGuru](https://refactoring.guru/es/design-patterns/decorator)
- [Decorator en PHP - Codenip](https://www.youtube.com/watch?v=XOvXMZ0DWCU)
