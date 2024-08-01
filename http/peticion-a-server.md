# Petición HTTP a una web


![image](https://github.com/user-attachments/assets/b27b7f33-6b36-4169-9212-d94c849b8e6a)


 Puedes usar varias técnicas :
 
- Con la extensión `cURL`
- La función `file_get_contents`
- Bibliotecas como `GuzzleHTTP` (anda Raulillo 😝)


# Petición HTTP `GET` con `cURL`

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

Puedes usar GuzzleHTTP de la siguiente manera:
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
