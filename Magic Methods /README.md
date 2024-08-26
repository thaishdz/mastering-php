
# Magic Methods


![image](https://github.com/user-attachments/assets/98e87e43-7ad1-48cc-a095-2d6a6ef2cbce)

En PHP, 
- __Los métodos mágicos son aquellos que comienzan con dos guiones bajos (`__`).__
- Son llamados ✨sin que nosotros lo hagamos explícitamente✨
- __Se autoinvocan cuando se dispara una condición o evento__; es decir, sin necesidad de especificar el nombre del método en concreto.
- El método `__toString()` es uno de estos *magic methods*.

> 💡 Los métodos mágicos nos permiten saber cuándo un programador está interactuando con un objeto; permitiéndonos realizar acciones antes o después de esto.


### ¿Por Qué Doble Guión Bajo (`__`)?
- El doble guión bajo se usa para diferenciar estos métodos mágicos de los métodos normales de la clase.
- Esto evita conflictos de nombres y hace que sea claro que estos métodos tienen un propósito especial definido por PHP.

## `__construct()`

> Si no defines un constructor en tu clase, __PHP utiliza un constructor por defecto__. Esto significa que puedes crear instancias de la clase sin inicializar propiedades u otros datos ...

WAIT A MOMENT ... entonces ... todo este tiempo ... se ha estado invocando ...

<img src="https://github.com/user-attachments/assets/f422ddf7-073a-4ec3-b724-56f6b01019cd" width="300" />


### AAH FILHO DA PUTA AGORA SIM ENTENDOOOO  
![image](https://github.com/user-attachments/assets/77de7f67-5552-4aca-aba5-b5a67fd82abd)

SE ACABA DE DESBLOQUEAR EL MISTERIO DE CÓMO SE LLAMABA ✨MÁGICAMENTE✨ a ese constructor por defecto, sin que tuviésemos uno definido.

---

### Otros Métodos Mágicos
Aquí hay algunos otros métodos mágicos comunes en PHP:

- `__construct()`: Se llama cuando se crea una nueva instancia de la clase (constructor).
- `__destruct()`: Se llama cuando el objeto se destruye (destructor).
- `__get($name)`: Se invoca cuando se intenta acceder a una propiedad inaccesible o no definida.
- `__set($name, $value)`: Se invoca cuando se intenta establecer el valor de una propiedad inaccesible o no definida.
- `__call($name, $arguments)`: Se invoca cuando se llama a un método inaccesible o no definido.
- `__sleep()`: Se invoca antes de que un objeto sea serializado.
- `__wakeup()`: Se invoca cuando un objeto serializado es deserializado.
- `__invoke()`: Se invoca cuando se intenta llamar a un objeto como una función.
