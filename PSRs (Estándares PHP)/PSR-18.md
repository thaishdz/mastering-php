# PSR-18: HTTP Client (Status: Accepted ✔️)
> Este estándar trata de describir un interface común para el envío de peticiones HTTP y la recepción de respuestas HTTP.


Con `PSR-7` sabemos que las peticiones y las respuestas se parecen, pero no define nada sobre como una petición debería ser enviada o recibida. 

Gracias a `PSR-18` y a los clientes HTTP que lo implementen, los programadores podrán desarrollar librerías desacopladas de las distintas implementaciones particulares de cada cliente `HTTP`, lo que hará que dichas librerías sean más reutilizables.
