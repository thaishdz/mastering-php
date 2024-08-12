
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
