

# ¿Qué es un trait en PHP?

Es como un _hack_ que usamos para cargarnos el no poder hacer herencia múltiple.

> En PHP, una clase solo puede heredar de otra clase, no existe la herencia múltiple

Es decir, 

```php

class Charmander extends Pokemon // Chachi 👍

```

Charmander no solo es un Pokémon, también evoluciona por lo que si le queremos encasquetar la clase `Evolution`, CAGAMOS

```php

class Charmander extends Pokemon, Evolution // JAJAJAJAN´T

```

# Implementación ⚒️

```php

trait EvolutionTrait
{
  public function evolves(){
  	echo "I am a Charmeleon, bitch";
  }
}

```
> 💡 Puedes meterlos en una carpeta llamada `Traits`

```php

class Charmander extends Pokemon
{
  use EvolutionTrait;
}

```

```php

$charmandito = new Charmander();
echo $charmandito->evolves(); 

```

```plaintext

I am a Charmeleon, bitch

```

Una vez los utilizamos en una clase, todos sus métodos y propiedades, sean del ámbito que sean, pertenecen a su clase y pueden ser utilizados.

### Uso de múltiples `traits` (ejemplo con Laravel)

```php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
}

```

> Laravel hace uso intensivo de `Traits`, de hecho ha sido el principal impulsor de esta vaina


### Ayuditas

- [Traits](https://www.cursosdesarrolloweb.es/blog/traits-php)
- [Qué es un trait](https://phpsensei.es/que-es-un-trait-en-php/)
