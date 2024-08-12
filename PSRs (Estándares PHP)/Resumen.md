


[Buen post de Manu Pijierro](https://mpijierro.medium.com/psr-estándares-en-php-ccde7d9014e6#:~:text=PSR-7%3A%20HTTP%20message%20interfaces,la%20base%20del%20desarrollo%20web.)


# ¿Qué son los PSRs?
> PSRs (PHP Standards Recommendations), define un conjunto de estándares que facilitan el desarrollo de aplicaciones y la interoperabilidad entre proyectos.

# ¿Quién define los PSRs?
Los estándares de PHP están definidos por el PHP -FIG (PHP-Framework Interop Group).

# Objetivos del PHP-FIG 
- Promover el ecosistema de PHP
- Definir estándares basados en la investigación, experimentación y sobre todo en la experiencia del mundo real
- Facilitar la colaboración entre programadores y proyectos.


# Listado de estándares PSR

## PSR-0 Autoloading Standard (Status: Deprecated 🛑)
Fue marcado como deprecated (obsoleto) el 21–10–2014 en favor de __PSR-4__. El estándar PSR-0 describe los requisitos obligatorios (prácticas y restricciones), que deben ser satisfechos para la interoperabilidad del autocargador, es decir, para la carga automática de clases.

Cuando programamos, lo más normal es tener una clase por archivo. Antes de utilizar una clase PHP debe conocerla, es decir, debemos indicarle a PHP en que archivo se encuentra. Si el proyecto es pequeño y tiene pocas dependencias, casi que nosotros de manera manual podemos decirle a PHP donde se encuentra cada clase pero, si el proyecto es grande y tiene muchas dependencias, puede ser realmente complicado.

Después de la introducción de los namespaces en PHP 5.3, fue cuando se propuso este estándar para que en base a ciertas características definidas de cada namespace de cada clase, se pudiera “autodescubrir” de forma automática cuando necesitáramos una instancia de dicha clase.

Es decir, PSR-0 viene a decirnos como definir los namespaces de cada clase para que PHP pueda hacer la “magia” necesaria para encontrarlas.

## PSR-1: Basic Coding Standard (Status: Accepted ✔️)
> Este estándar comprende como debería ser la codificación de los elementos necesarios para asegurar la interoperabilidad de código compartido. 

Es decir, indican normas de codificación básica a muy bajo nivel como por ejemplo la codificación de caracteres en UTF-8 o el tipo de escritura que deben seguir los nombres de las clases (StudlyCaps) o métodos (camelCase).


# PSR-17: HTTP Factories (Status: Accepted ✔️)
> Describe un estándar común para factorías que crean objetos HTTP compatibles con PSR-7 ya que este no incluye recomendaciones sobre como crear objetos HTTP dificultando el crear nuevos objetos HTTP en componentes que no estén vinculados a PSR-7.

Más información en el siguiente [enlace](https://www.php-fig.org/psr/psr-17/meta/)

# PSR-18: HTTP Client (Status: Accepted ✔️)
> Este estándar trata de describir un interface común para el envío de peticiones HTTP y la recepción de respuestas HTTP.
Con PSR-7 sabemos que las peticiones y las respuestas se parecen, pero no define nada sobre como una petición debería ser enviada o recibida. Gracias a PSR-18 y a los clientes HTTP que lo implementen, los programadores podrán desarrollar librerías desacopladas de las distintas implementaciones particulares de cada cliente HTTP, lo que hará que dichas librerías sean más reutilizables.
