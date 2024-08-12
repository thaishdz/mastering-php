# PSR-15: HTTP Handlers (Status: Accepted ✔️)
Antes de ver cual es el objetivo de este estándar, convendría aclarar __dos__ conceptos:

- `Request handler`: es un componente individual que procesa una __petición `HTTP`__ y produce también una __respuesta `HTTP`__, ambas definidas por `PSR-7`. Normalmente se implementa para ir ejecutando una pila de `middleware` aunque también nos lo podemos encontrar como el último elemento de dicha pila ejecutando código de la aplicación. No es necesario que los “Controllers” o las acciones de dominio que resuelvan la petición implementen un request handler, aunque es posible hacerlo.
- `Middleware`: es un componente individual que participa a menudo junto a otros componentes `middleware` en el procesado de una request haciendo comprobaciones o modificándola para generar una respuesta, bien delegando en un request handler o generándola de forma interna.

La especificación `PSR-7 (HTTP messages)` no contiene ninguna referencia a `request handler` o `middleware` y a partir de ahí surge :
> `PSR-15`, un estándar para describir interfaces formales y comunes para `request handlers` y `middlewares` de servidores `HTTP`

Algunos de los beneficios de la definición de estos interfaces son:

- Proporcionar un estándar formal para que los desarrolladores puedan usarlo.
- Habilitar un componente middleware que funcione en cualquier framework compatible.
- Eliminar la duplicidad de varios interfaces existentes definidos por distintos frameworks.
- Evitar discrepancias en las firmas de los métodos.


Más información sobre `PSR-15` en este [enlace](https://blog.shadowhand.me/announcing-psr-15/)
