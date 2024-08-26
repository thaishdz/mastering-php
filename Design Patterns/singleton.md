
# Singleton


- UNA clase tiene que tener una única instancia y proporciona un punto de acceso global a dicha instancia.
- Útil cuando necesitas un único objeto que gestione un recurso compartido (conexión a base de datos o un registro de configuración).

# Cuándo usar Singleton
- Cuando se necesita un único punto de control o coordinación (por ejemplo, un gestor de configuración o de conexiones a la base de datos).
- Cuando se quiere __evitar la creación de múltiples instancias de una clase para ahorrar recursos.__



> ⚠️ Este patrón debe usarse con cuidado, ya que puede introducir un alto acoplamiento y dificultar los unit tests debido a su naturaleza global

```php





```





El problema en el contexto de Singleton es que alguien podría serializar la instancia, guardarla en una cadena y luego deserializarla para crear una nueva instancia, lo que rompería la unicidad.

Para evitarlo, se declara __wakeup() como privado o vacío:

```php
private function __wakeup() { }

```

# Resumen
- **Única instancia**: Garantiza que solo exista una instancia de la clase.
- **Acceso global**: Ofrece un método global para obtener esa única instancia.
