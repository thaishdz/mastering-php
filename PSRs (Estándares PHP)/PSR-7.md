# PSR-7: HTTP message interfaces (Status: Accepted ✔️)

> Estándar que define interfaces para las solicitudes `HTTP (Request)` y las respuestas `HTTP (Response)`


Los mensajes `HTTP` son la base del desarrollo web. Los navegadores y los clientes HTTP como cURL, crean un mensaje de petición HTTP para enviar al servidor web respondiendo este con un mensaje de respuesta, tamibén `HTTP`.

Los mensajes `HTTP` normalmente se abstraen el del usuario final pero los programadores necesitamos conocerlos para saber como están estructurados para acceder a ellos o manipularlos según la tarea que tengamos que desarrollar.

Las interfaces definidos en `PSR-7` son los siguientes:

- `Psr\Http\Message\MessageInterface` : Representa un mensaje HTTP
- `Psr\Http\Message\RequestInterface` : Representa una solicitud saliente desde el lado del cliente
- `Psr\Http\Message\ServerRequestInterface` : Representa una solicitud entrante desde el lado del servidor
- `Psr\Http\Message\ResponseInterface` : Representa una solicitud de respuesta de salida desde el lado del servidor.
- `Psr\Http\Message\StreamInterface` : Representa un stream de datos
- `Psr\Http\Message\UriInterface Value Object` : Representa una URI
- `Psr\Http\Message\UploadedFileInterface` : Value Object que representa un archivo subido a través de una petición HTTP

Symfony implementa PSR-7, o mejor dicho, implementaba, con uno de sus componentes. Precisamente el 2 de Marzo de 2019 su creador Fabien Potencier escribía en Twitter:

> #Symfony cannot implement PSR7. So, it cannot implement PSRs based on PSR7. That simple.

Con ese mensaje, F. Potencier anunciaba que Symfony deja de implementar PSR-7 en beneficio del ecosistema de Symfony.

El [repositorio](https://github.com/php-fig/http-message) con los interfaces 
