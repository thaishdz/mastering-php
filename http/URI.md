**URI** (Uniform Resource Identifier), cadena de caracteres utilizada para identificar un recurso en Internet o en una red

![image](https://github.com/user-attachments/assets/97fca2b0-c171-429c-9015-8965e87d3a7c)


### Una URI puede ser de 2 tipos :

1. **URL (Uniform Resource Locator)**: Es una forma específica de URI que no solo identifica un recurso, sino que también proporciona un medio para acceder a él, especificando el protocolo y la ubicación. Por ejemplo, `https://pokeapi.co/api/v2/pokemon/pikachu` es una URL que no solo identifica el recurso (`pikachu` en la API de Pokémon) sino que también especifica cómo acceder a él a través del protocolo `https`.

2. **URN (Uniform Resource Name)**: Es otro tipo de URI que identifica un recurso de manera única sin proporcionar un medio para acceder a él. Por ejemplo, una URN podría ser algo como `urn:isbn:0451450523`, que identifica un libro por su ISBN, pero no indica dónde se puede encontrar el libro.

### ¿Cómo se usa una URI en la práctica?

En el contexto de las APIs y la programación web, la URI generalmente se refiere a una URL que se utiliza para hacer solicitudes a un servidor. Por ejemplo:

- **Base URI**: La URI base de una API es la parte común de la URL que se usa para acceder a diferentes endpoints de la API. Por ejemplo, en `https://pokeapi.co/api/v2/pokemon/`, la parte `https://pokeapi.co/api/v2/pokemon/` es la base URI.

- **Endpoint**: Especifica el recurso o la acción deseada en la API. En el caso de la API de Pokémon, un endpoint podría ser `pikachu`, que se adjunta a la base URI para obtener información sobre el Pokémon Pikachu.

### Ejemplo en el código PHP

En el código PHP que te proporcioné anteriormente, la base URI se establece como:

```php
$client = new Client([
    'base_uri' => 'https://pokeapi.co/api/v2/pokemon/',
]);
```

Esto significa que todas las solicitudes realizadas con este cliente tendrán `https://pokeapi.co/api/v2/pokemon/` como la base para construir la URL completa. Cuando haces una solicitud a un endpoint como `pikachu`, la URL completa será:

```
https://pokeapi.co/api/v2/pokemon/pikachu
```

La URI es fundamental para la comunicación en la web y en las APIs, ya que permite especificar exactamente qué recurso quieres obtener o manipular.
