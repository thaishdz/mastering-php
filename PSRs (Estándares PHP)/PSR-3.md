## PSR-3: Looger Interface (Status: Accepted ✔️)
Entendemos por ‘log’ al registro o grabación secuencial en un sistema de persistencia eventos que ocurren en nuestro sistema, de manera que posteriormente puedan ser procesados y obtener así las evidencias que sean oportunas.

PSR-3 define un interface común para librerías de loggin de manera que pueda utilizarse esta funcionalidad en cualquier aplicación de forma sencilla. Cada librería de log, posteriormente, puede estar implementada como mejor considere, pero, para asegurarse que cualquier aplicación pueda usarla sin problemas debe cumplir PSR-3.

La definición de Logger Interface expone ocho métodos (debug, info, notice, warning, error, critical, alert, emergency), correspondientes a los ocho niveles de log definidos en el RF 5424.

Es decir, si queremos implementar una librería de log que sea compatible con otras aplicaciones, debe cumplir con PSR-3. Y si usamos una librería de loggin que cumpla PSR-3 sabemos que debe funcionar.

Ejemplo de [Logger Inteface](https://github.com/php-fig/log)
