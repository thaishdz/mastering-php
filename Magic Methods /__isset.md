# `__isset`

> Determina la existencia o no de una variable

... pero si quisiéramos utilizar la función `isset` para saber si existe un atributo no definido o inexistente de un objeto debemos definir primero el método mágico `__isset`. 

- Se llama automáticamente cuando se invoca la función `isset()` sobre un atributo inaccesible o no definido de un objeto.
  ```php
    $year = 0;
    if (isset($year)) {  // True because $year is set
      echo "year is set";  
    }
  ```

- Permite programar acciones con posterioridad a la invocación de la función `isset()`.

- __Recibe un único argumento que es el nombre del atributo que se quiere analizar__.
  
- ⚠️ Es importante aclarar que la utilización de la función `empty()` también disparara la ejecución de `__isset()` ya que según el manual de PHP, `empty()` es equivalente a negar un __isset__ `(!isset($variable))`.
