# Petición HTTP a una web

![image](https://github.com/user-attachments/assets/b27b7f33-6b36-4169-9212-d94c849b8e6a)

- HTTP es el protocolo que usamos para transmitir información en la web. 
- Cuando visitas una página web, tu navegador envía una solicitud HTTP al servidor donde está alojada esa página.
- El servidor luego responde enviando los datos de la página de vuelta a tu navegador, que los muestra en tu pantalla.
- Piensa en HTTP como el lenguaje que tu navegador y el servidor utilizan para "hablar" entre ellos.
- Cuando escribes una dirección web en tu navegador, es como si estuvieras diciendo "quiero ver esta página". HTTP se encarga de llevar ese mensaje y traer la respuesta.

En resumen: HTTP es el protocolo que hace posible que puedas ver páginas web en tu navegador.


 Puedes usar varias técnicas para hacer peticiones http :
 
- Con la extensión `cURL`
- La función `file_get_contents`
- Bibliotecas como `GuzzleHTTP` (anda Raulillo 😝)


# Petición HTTP `GET` con `cURL`

> Cuando buscas algo en Google estás haciendo una petición `GET`
![image](https://github.com/user-attachments/assets/3d468404-a977-4e4a-8945-212ec1639c4c)

Este ejemplo hace una petición `GET` a un API pública y obtiene los datos.

```php
<?php

$url = 'https://jsonplaceholder.typicode.com/posts/1'; // URL del API

// Inicializar cURL
$ch = curl_init();

// Configurar cURL
curl_setopt($ch, CURLOPT_URL, $url); // URL a la que hacer la petición
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Devolver el resultado como cadena de texto

// Ejecutar la petición
$response = curl_exec($ch);

// Verificar si hubo errores
if ($response === false) {
    echo 'Error en la petición: ' . curl_error($ch);
} else {
    // Convertir la respuesta JSON a un array
    $data = json_decode($response, true);
    print_r($data);
}

// Cerrar cURL
curl_close($ch);
```

## Explicación

```php
$ch = curl_init();
```
`curl_init()` inicializa una nueva sesión cURL y devuelve un manejador de recurso. Este manejador (guardado en $ch) es necesario para realizar operaciones con cURL.
```php
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
```
En esta sección, curl_setopt() se usa para establecer varias opciones para la sesión cURL. La variable `$ch` se pasa a `curl_setopt()` para especificar a qué sesión de cURL se aplican estas opciones.

```php
$response = curl_exec($ch);
```
`curl_exec()` ejecuta la sesión cURL configurada, y `$ch` indica qué sesión se debe ejecutar. La respuesta de la solicitud se guarda en la variable `$response`.

```php
curl_close($ch);
```
`curl_close()` cierra la sesión cURL identificada por `$ch` y libera cualquier recurso asociado con ella.
 
# Petición HTTP POST con cURL
Este ejemplo envía datos a un API usando una petición POST.

```php
<?php

$url = 'https://jsonplaceholder.typicode.com/posts'; // URL del API
$data = [
    'title' => 'foo',
    'body' => 'bar',
    'userId' => 1
]; // Datos a enviar

// Inicializar cURL
$ch = curl_init();

// Configurar cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true); // Indicar que es una petición POST
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Datos a enviar
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la petición
$response = curl_exec($ch);

// Verificar si hubo errores
if ($response === false) {
    echo 'Error en la petición: ' . curl_error($ch);
} else {
    // Convertir la respuesta JSON a un array
    $data = json_decode($response, true);
    print_r($data);
}

// Cerrar cURL
curl_close($ch);

```

## Explicación de Opciones de cURL
- __CURLOPT_URL__: La URL a la que se enviará la petición.
- __CURLOPT_RETURNTRANSFER__: Indica que se debe devolver la respuesta como una cadena de texto en lugar de mostrarla directamente.
- __CURLOPT_POST__: Indica que la petición es de tipo POST.
- __CURLOPT_POSTFIELDS__: Los datos que se enviarán en la petición POST.

# GuzzleHTTP 
- GuzzleHTTP es una biblioteca PHP para hacer peticiones HTTP de manera más sencilla y con más funcionalidades.
- Debes instalar GuzzleHTTP usando Composer.

```sh
composer require guzzlehttp/guzzle
```

# Kata

```php

<?php

require_once 'vendor/autoload.php';


/*
 * Utilizando un mecanismo de peticiones HTTP de tu lenguaje, realiza
 * una petición a la web que tú quieras, verifica que dicha petición
 * fue exitosa y muestra por consola el contenido de la web.
 */

$client = new \GuzzleHttp\Client();


$response = $client->request('GET', 'https://www.instagram.com');

echo $response->getStatusCode();
echo $response->getHeaderLine('content-type');
echo $response->getBody();

```

También puedes usar GuzzleHTTP de la siguiente manera:
```php
<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

// Petición GET
$response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts/1');
$data = json_decode($response->getBody(), true);
print_r($data);

// Petición POST
$response = $client->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
    'form_params' => [
        'title' => 'foo',
        'body' => 'bar',
        'userId' => 1
    ]
]);
$data = json_decode($response->getBody(), true);
print_r($data);
```
