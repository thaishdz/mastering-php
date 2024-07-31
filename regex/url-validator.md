# Validar una URL

```
https?:\/\/(?:www\.)?[\w-]+\.(?:[\w-]+\.)?[a-zA-Z]{2,}

```
Nota: NO valida puertos ni queries ni la de abajo


## Explicación
- `https?`: Coincide con http o https.
- `:\/\/`: Coincide con ://.
- `(?:www\.)?`: Coincide opcionalmente con www. (sin capturarlo como un grupo).
- `[\w-]+`: Coincide con el dominio, permitiendo letras, dígitos y guiones.
- `\.[a-zA-Z]{2,}`: Coincide con el TLD, permitiendo entre 2 y más caracteres. Esto cubre la mayoría de los TLDs modernos.


### Por qué no haría falta escapar los `:` ?

Ls caracteres especiales como los dos puntos (:) no necesitan ser escapados con una barra invertida (\). 
Los dos puntos tienen un significado especial en los patrones de expresiones regulares en algunos contextos (como en las clases de caracteres), 
pero fuera de esos contextos, simplemente se tratan como caracteres literales.

```
https?:\/\/
```
Aquí, `://` se trata como una secuencia literal de caracteres. En este caso, los dos puntos no necesitan ser escapados porque no están en un contexto donde tienen un significado especial. La barra invertida (\) se utiliza principalmente para escapar caracteres que tienen un significado especial en el lenguaje de expresiones regulares, como . (punto), * (asterisco), + (más), ? (signo de interrogación), etc.

### Qué mierdas es ese `?` del principio y por qué se agrupa entre () el `(?:www\.)?`

- `(?:...)`: Es una forma de agrupar sin capturar. Esto significa que el contenido dentro de los paréntesis se agrupa para aplicar cuantificadores o para establecer precedencia, pero no se guarda como un grupo que pueda ser referenciado posteriormente. Es útil cuando deseas agrupar partes del patrón sin crear un grupo de captura.

Ejemplo: `(?:www\.)?` significa que www. es opcional en la URL.

### `?` Después de un Grupo
?: Colocado después de un grupo o carácter, hace que ese grupo o carácter sea opcional. Es decir, coincide con 0 o 1 ocurrencia del patrón.

Ejemplo: En `(?:www\.)?`, el `?` hace que www. sea opcional, es decir, puede estar presente o no en la URL.

### Corchetes []
[...]: Se usa para definir una clase de caracteres. Dentro de los corchetes, los caracteres que incluyas se tratarán como un conjunto y la expresión coincidirá con cualquier carácter dentro de ese conjunto. No es necesario escapar los caracteres dentro de una clase de caracteres a menos que el carácter tenga un significado especial dentro de la clase (como el guion - que se usa para definir rangos, o el corchete ] que se usa para cerrar la clase).

Ejemplo: [a-zA-Z\d] coincide con cualquier letra mayúscula o minúscula, o un dígito.

## Partes de una URL

```
https://www.example.com:8080/path/to/resource?query=abc#section
```

Puedes dividirla en partes de la siguiente manera:

```

Protocolo: https
Host: www.example.com
Puerto: 8080
Ruta: /path/to/resource
Consulta: query=abc
Fragmento: section

```
## Qué es un TLD

Un **TLD** (Top-Level Domain, o Dominio de Nivel Superior) __es la extensión que aparece después del nombre de dominio principal y del subdominio (si hay alguno)__. 
Los TLDs ayudan a identificar el tipo de organización o el país asociado con la dirección web.

### Tipos de TLDs

1. **TLD Genéricos (gTLDs)**:
   - Estos no están vinculados a un país específico y se utilizan a nivel global. Ejemplos incluyen:
     - `.com` (para comercio)
     - `.org` (para organizaciones)
     - `.net` (para redes)
     - `.info` (para información)
     - `.edu` (para instituciones educativas)
     - `.gov` (para gobiernos)

2. **TLD de Código de País (ccTLDs)**:
   - Estos están asociados a países o territorios específicos. Ejemplos incluyen:
     - `.us` (para Estados Unidos)
     - `.uk` (para el Reino Unido)
     - `.de` (para Alemania)
     - `.jp` (para Japón)
     - `.au` (para Australia)

3. **TLDs de Primer Nivel Especiales (sTLDs)**:
   - Estos son TLDs genéricos que tienen un propósito específico y suelen estar restringidos a ciertos tipos de organizaciones o usos. Ejemplos incluyen:
     - `.museum` (para museos)
     - `.aero` (para la industria aeronáutica)
     - `.coop` (para cooperativas)

4. **TLDs de Segundo Nivel**:
   - Dentro de un ccTLD, a veces hay TLDs de segundo nivel que son específicos para regiones o usos particulares dentro de un país. Por ejemplo:
     - `.co.uk` (para empresas en el Reino Unido)
     - `.com.au` (para empresas en Australia)

5. **TLDs Internacionales (IDN TLDs)**:
   - Estos permiten caracteres no ASCII, como caracteres en otros alfabetos. Ejemplos incluyen:
     - `.рф` (para Rusia en cirílico)
     - `.中国` (para China en chino)

### Ejemplo de Estructura de una URL

Considera la URL:

```
https://www.example.co.uk
```

En esta URL:

- **`https`** es el esquema o protocolo.
- **`www`** es el subdominio.
- **`example`** es el dominio principal.
- **`co.uk`** es el TLD compuesto, donde `uk` es el ccTLD para el Reino Unido y `co` es un TLD de segundo nivel para comercio en ese país.

### Uso de TLDs

Los TLDs ayudan a clasificar y organizar sitios web en Internet. Además, ciertos TLDs pueden indicar la finalidad o la ubicación del sitio web, lo que puede ser útil para usuarios que buscan información específica o para estrategias de SEO (optimización en motores de búsqueda).
