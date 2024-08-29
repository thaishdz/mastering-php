
# Biblioteca de Notificaciones 🔔


Estás currando en una biblioteca de notificaciones que permite a otros programas notificar a usuarios sobre de eventos importantes 

La versión primigenia de la biblioteca se basaba en la clase `Notifier` que contaba con :
- Varios campos
- 1 `constructor`
- 1 Método `send`.

<p align=center>
  <img src="https://github.com/user-attachments/assets/423507dc-67ad-4097-9061-b5b826830cd3" />
</p>

- `send` aceptaba, como argumento, un mensaje ✉️ de un cliente y enviar el mensaje ✉️ a una lista de correos electrónicos que se pasaban a la clase `Notifier` a través de su constructor. 
- La aplicación de un tercero que actuaba como cliente debía crear y configurar el objeto `Notifier` una vez y después utilizarlo cada vez que sucediera algo importante.


Eres persona avispada 🐝 y te das cuenta de que los usuarios de la biblioteca quieren más cositas como :

- A muchos, les gustaría recibir __SMS__.
- Otros, recibir las notificaciones por __Facebook__
- A La gente business 💼 le encantaría recibir notificaciones por __Slack__.

<p align=center>
  <img src="https://github.com/user-attachments/assets/be6a9993-362b-4453-9c51-4849fa397266" />
</p>

Dijiste ... OLRAIT!, PUES
✨`INTERFACES`✨, entonces extendiste la clase `Notifier` y le metiste los métodos adicionales de notificación a las nuevas subclases 👍.

Ahora el cliente debería instanciar la clase notificadora deseada y utilizarla para el resto de notificaciones.

![image](https://github.com/user-attachments/assets/3b201612-804c-4430-94e2-7103e692fc11)

> “¿Por qué no se pueden utilizar varios tipos de notificación al mismo tiempo?. 
Si tu casa está en llamas 🏠🔥, querrás saberlos por TODOS los canales existente, hasta por paloma mensajera”.

<p align=center>
  <img src="https://github.com/user-attachments/assets/d3c79f1b-bf68-49c7-9fa1-39eff5c44ddc" />
</p>

Mira como sigamos inventando situaciones no habrán más subclases que meter porque ahora hay combos de clases y esto es insostenible.
