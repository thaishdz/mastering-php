

# Decorator

> Ponerle capas extra a algo que ya tienes, sin cambiar lo que hay debajo (te suena de principio SOLID, Open/Closed ... abierta pa extensión ... cerrada paaaaraaaa ... modificación)

<p align=center>
  <img src="https://github.com/user-attachments/assets/d721b003-e5cc-4f09-a2de-ca061bb31ce8" height="400" />
</p>

<p align=center>
  <em>Obtienes un efecto combinado vistiendo varias prendas de ropa</em>
</p>

Vestir ropa es un ejemplo de `Decorator`. 
- Cuando tienes frío, te pones un suéter.
- Si sigues teniendo frío, te pones una chaqueta encima.
- Si está lloviendo, puedes ponerte un chubasquero. 
- Todas estas prendas *extienden* tu comportamiento básico pero no son parte de ti, puedes quitarte cualquier prenda cuando quieras.

# PA QUÉ ES ESTO ❔

- Cuando quieres añadir comportamiento o alguna funcionalidad específica a los objetos de una clase de clases pero la herencia no te vale una 💩.
- Tienes clases con `final` (se usa para evitar que una clase siga extendiéndose). Entonces para añadir funcionalidad, la única forma de reutilizar el comportamiento existente será envolver la clase con tu propio `wrapper`.
- Necesites asignar funcionalidades adicionales a objetos durante el tiempo de ejecución sin descomponer el código que utiliza esos objetos.
  - `Decorator` te permite __estructurar tu lógica de negocio en capas__, crear un decorador para cada capa y componer objetos con varias combinaciones de esta lógica, durante el tiempo de ejecución. El código cliente puede tratar a todos estos objetos de la misma forma, ya que todos siguen una interfaz común.

<p align=center>
  <img src="https://github.com/user-attachments/assets/127fb5ab-54c1-44e8-a978-fca226fba6cf" />
</p>


# Cómo funka la vaina❔

Tienes *TRES* cosas a tener en cuenta :

- __Componente base__: ✨ *Interfaz* ✨ o ✨ *clase abstracta* ✨ que define la funcionalidad básica.
- __Clase concreta__: Implementa el componente base.
- __Decorator__: Clase que implementa __la misma interfaz o hereda de la clase base__ y contiene una referencia a un objeto de la misma interfaz o clase base. Este objeto es al que se le "decora" o añade la nueva funcionalidad.


# Ejemplos

- [Pack : Hotel 🏨 + Taxi 🚗 ]()
- [Notificacion 🔔]()


# La movida con la herencia

Cuando tenemos que __alterar la funcionalidad de un objeto__, lo suyo es _extender una clase_. El tema es que la herencia tiene varias limitaciones importantes :

1. _La herencia es estática_. ❗ No se puede alterar la funcionalidad de un objeto existente durante el tiempo de ejecución. Sólo se puede sustituir el objeto completo por otro creado a partir de una subclase diferente.

2. _Las subclases sólo pueden tener una clase padre_. En la mayoría de lenguajes, __la herencia no permite a una clase heredar comportamientos de varias clases al mismo tiempo.__ ❗


```php



```



### Ayuditas 🛎️

- [Decorator - RefactoringGuru](https://refactoring.guru/es/design-patterns/decorator)
- [Decorator en PHP - Codenip](https://www.youtube.com/watch?v=XOvXMZ0DWCU)
