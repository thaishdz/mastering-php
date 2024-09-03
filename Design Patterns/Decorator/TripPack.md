
# TripPack ✈️

Tienes un Booking culero, donde solo puedes reservar el vuelo y YA ESTÁ.

Pero _culero_ no es nuestro apellido, así que vamos a añadirle MANDANGA 👻

<img src="https://github.com/user-attachments/assets/225d4999-f09b-4052-a26c-0556b787fac5" height="400" />

Para empezar, va a tener *packs adicionales* donde la gente pueda escoger :

- Vuelo ✈️ + Hotel 🏨
- Vuelo ✈️ + Hotel 🏨 + Alquiler de Coche 🚗
- Vuelo ✈️ + Hotel 🏨 + Servicio de Taxi al aeropuerto 🚖

... Y todos los combos locos que se nos ocurran.

<img src="https://github.com/user-attachments/assets/e3568e79-b9f7-4b36-b2cc-32d7a83639fd" width="600" height="400" />


# ¿Por qué necesitamos el Decorator en este caso?

Porque nos permite agregar dinámicamente responsabilidades (en este caso, servicios adicionales como *vuelo*, *hotel*, *taxi*, etc.) __a un objeto sin modificar su estructura original__. Esto es útil cuando tienes un objeto base, como `VanillaTrip`, y necesitas extender su funcionalidad (agregar más servicios) sin tocar su código original.


# Implementación ⚒️

Vamos a implementar el patrón Decorador para que podamos añadir dinámicamente servicios adicionales al `VanillaTrip`.

1. Interfaz `TripInterface`: Define los métodos que TODAS las clases de viaje deben implementar.
2. Clase `VanillaTrip`: Implementa `TripInterface` y representa el viaje básico.
3. Clase abstracta `TripDecorator`: Implementa `TripInterface` y sirve como clase base para los decoradores concretos.
4. Decoradores concretos: Añaden funcionalidad (por ejemplo, vuelo, hotel, taxi) al viaje básico.


## 1. `TripInterface`

Será la plantilla con lo mínimo que tendrá que tener cada viaje :

- Coste
- Descripción

```php

<?php

// Todos los viajes tendrán un coste y una descripción

interface TripInterface
{
    public function cost(): int;
    public function description(): string;

}

```

## 2. `VanillaTrip`

```php

<?php

require_once("./TripInterface.php");

// Define un viaje básico con un costo fijo y una descripción básica.

class VanillaTrip implements TripInterface
{
    private const BASIC_PRICE = 150; // no necesitamos un tipo explícito ya que con las constantes en PHP no es necesario 

    public function cost(): int
    {
        return self::BASIC_PRICE; // este precio no puede ser modificado
    }

    public function description() : string 
    {
        return 'Paquete Básico';
    }

}

```

## 3.  `TripDecorator`

Esta✨ clase abstracta ✨ es una de las claves del `Decorator`, que tiene que implementar la interfaz del objeto que queremos manipular, en este caso el "viajecito".

Delegará las llamadas a su componente interno, que es otro objeto `TripInterface`. __Esto permite extender el comportamiento sin cambiar el código del objeto original.__

```php

require_once("./TripInterface.php");

// Sirve como plantilla para los "packs" (decoradores) que creemos.

abstract class TripDecorator implements TripInterface
{
    protected $trip;

    public function __construct(TripInterface $trip) {
        $this->trip = $trip;
    }

    public function cost(): int
    {
        return $this->trip->cost();
    }

    public function description() : string 
    {
        return $this->trip->description();
    }
}

```

Se utiliza `protected $trip`; para permitir que las subclases como `FlightDecorator`, `HotelDecorator`, etc. Accedan a esta propiedad directamente.

> 💡 Recuerda : `protected` da acceso a la __clase donde se declara__ y en todas sus __subclases__, pero NO desde fuera de estas clases.


## 4. `FlightDecorator`


```php

<?php


require_once("./TripDecorator.php");


class FlightDecorator extends TripDecorator
{
    private const FLIGHT_COST = 200;

    public function cost(): int
    {
        return $this->trip->cost() + self::FLIGHT_COST; // Coste Base + Vuelo
    }

    public function description() : string 
    {
        return "{$this->trip->description()} + Vuelo = {$this->cost()}€ \n";
    }
}

```


## 4.a `HoteltDecorator`


```php

<?php

class HotelDecorator extends TripDecorator
{
    private const HOTEL_COST = 350;

    public function cost(): int
    {
        return $this->trip->cost() + self::HOTEL_COST; // Coste Base + Hotel
    }

    public function description() : string 
    {
        return "{$this->trip->description()} + Hotel = {$this->cost()}€ \n";
    }
}

```

### ¿Cómo llamas a `$trip` si no está definida en `FlightPackDecorator`?

El objeto `$trip`, está definido en la clase abstracta `TripDecorator`, y todas las subclases de esta vaina, como :

- `FlightDecorator`
- `HotelDecorator`

✨heredan esta propiedad ✨. Por eso, cuando usas `$this->trip` en cualquier subclase, estás __accediendo a la propiedad heredada de `TripDecorator`.__


## `index.php` - Ejemplo de Uso

```php


<?php

require_once ("./VanillaTrip.php");
require_once ("./FlightDecorator.php");
require_once ("./HotelDecorator.php");

// Uso del patrón Decorador para crear un viaje con vuelo, hotel y taxi.

$basicTrip = new VanillaTrip(); 
$basicPlusFlightTrip = new FlightDecorator($basicTrip);
$basicPlusFlightPlusHotelTrip  = new HotelDecorator($basicPlusFlightTrip);


echo $basicPlusFlightTrip->description(); # Paquete básico + vuelo
echo $basicPlusFlightPlusHotelTrip->description(); # Paquete básico + vuelo + hotel
```

## Output

```plaintext


------------------ echo $basicPlusFlightTrip->description(); --------------------

Paquete Básico + Vuelo = 350€

---------------------------------------------------------------------------------


------------------ echo $basicPlusFlightPlusHotelTrip->description(); --------------------

Paquete Básico + Vuelo = 350€ 
 + Hotel = 700€ 

---------------------------------------------------------------------------------

```

[Código en sandbox](https://phpsandbox.io/n/decorator-ugra5#index.php)
