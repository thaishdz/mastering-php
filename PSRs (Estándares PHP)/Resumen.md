


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

## PSR-2: Coding Style Guide (Status: Accepted ✔️)
> Este estándar extiende a PSR-1. La finalidad de PSR-2 es reducir la carga cognitiva que supone leer y entender código de diferentes desarrolladores.

Para ello, enumera unas normas de estilo básicas que consiguen hacer que el código de un proyecto sea más simétrico y predecible. En PHP, PSR-2 suponen las normas más básicas de codificación que un equipo de desarrollo debiera tener en cuenta a la hora de programar.

## PSR-3: Looger Interface (Status: Accepted ✔️)
Entendemos por ‘log’ al registro o grabación secuencial en un sistema de persistencia eventos que ocurren en nuestro sistema, de manera que posteriormente puedan ser procesados y obtener así las evidencias que sean oportunas.

PSR-3 define un interface común para librerías de loggin de manera que pueda utilizarse esta funcionalidad en cualquier aplicación de forma sencilla. Cada librería de log, posteriormente, puede estar implementada como mejor considere, pero, para asegurarse que cualquier aplicación pueda usarla sin problemas debe cumplir PSR-3.

La definición de Logger Interface expone ocho métodos (debug, info, notice, warning, error, critical, alert, emergency), correspondientes a los ocho niveles de log definidos en el RF 5424.

Es decir, si queremos implementar una librería de log que sea compatible con otras aplicaciones, debe cumplir con PSR-3. Y si usamos una librería de loggin que cumpla PSR-3 sabemos que debe funcionar.

Ejemplo de [Logger Inteface](https://github.com/php-fig/log)


## PSR-4: Autoloader (Status: Accepted ✔️)
Muy relacionada con PSR-0. En este caso, PSR-4 describe también una especificación sobre como tiene que ser la autocarga de clases.

Es compatible con PSR-0, aunque con otras características que lo mejoran. Entre sus diferencias más notables tenemos por ejemplo que PSR-0 mantiene compatibilidades con características de PEAR mientras que PSR-4 las elimina. También, PSR-0 obliga a mantener una estructura de directorios similar al espacio de nombres definido mientras que PSR-4 no.

En este [enlace](https://stackoverflow.com/questions/24868586/what-are-the-differences-between-psr-0-and-psr-4) se pueden observar más diferencias.

### Traducción

Son muy similares, por lo que no es sorprendente que sea un poco confuso. El resumen es que PSR-0 tenía algunas características de compatibilidad retroactiva para nombres de clases al estilo PEAR que PSR-4 eliminó; por lo tanto, PSR-4 solo admite código con namespaces. Además, PSR-4 no te obliga a que todo el namespace sea una estructura de directorios, solo la parte que sigue al punto de anclaje.

Por ejemplo, si defines que el namespace `Acme\Foo\` está anclado en `src/`, con PSR-0 significa que buscará `Acme\Foo\Bar` en `src/Acme/Foo/Bar.php`, mientras que en PSR-4 lo buscará en `src/Bar.php`, lo que permite estructuras de directorios más cortas. Por otro lado, algunos prefieren tener toda la estructura de directorios para ver claramente qué está en cada namespace, por lo que también puedes decir que `Acme\Foo\` está en `src/Acme/Foo` con PSR-4, lo cual te dará un comportamiento equivalente al descrito con PSR-0.

En resumen, para nuevos proyectos y para la mayoría de los casos, puedes usar PSR-4 y olvidarte de PSR-0.

### ¿Qué es PEAR-STYLE?

El estilo PEAR (PHP Extension and Application Repository) es un estándar de nomenclatura y organización de archivos en PHP utilizado antes de la adopción general de namespaces. En el estilo PEAR, las clases y sus nombres se organizaban en una jerarquía de directorios que reflejaba el nombre completo de la clase.

**Ejemplo de PEAR-Style:**

Si tienes una clase llamada `Foo_Bar`, su archivo se colocaría en un directorio basado en el nombre de la clase, como `Foo/Bar.php`.

```php
// PEAR-style classname
class Foo_Bar {
    // Código de la clase
}
```

Este estilo fue popular antes de que se adoptaran los namespaces en PHP, pero se volvió menos común con la llegada de PSR-0 y PSR-4, que promueven una estructura de directorios y una organización de clases más moderna y flexible.


# PSR-17: HTTP Factories (Status: Accepted ✔️)
> Describe un estándar común para factorías que crean objetos HTTP compatibles con PSR-7 ya que este no incluye recomendaciones sobre como crear objetos HTTP dificultando el crear nuevos objetos HTTP en componentes que no estén vinculados a PSR-7.

Más información en el siguiente [enlace](https://www.php-fig.org/psr/psr-17/meta/)

# PSR-18: HTTP Client (Status: Accepted ✔️)
> Este estándar trata de describir un interface común para el envío de peticiones HTTP y la recepción de respuestas HTTP.
Con PSR-7 sabemos que las peticiones y las respuestas se parecen, pero no define nada sobre como una petición debería ser enviada o recibida. Gracias a PSR-18 y a los clientes HTTP que lo implementen, los programadores podrán desarrollar librerías desacopladas de las distintas implementaciones particulares de cada cliente HTTP, lo que hará que dichas librerías sean más reutilizables.
