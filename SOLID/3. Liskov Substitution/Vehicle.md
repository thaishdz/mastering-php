// TODO: Quita el formato que no me funkaba

## Instrucciones

1. Crea la clase `Vehículo` 🚙.
2. Añade 2 subclases de `Vehículo` 🚙.
3. Implementa las operaciones `acelerar` y `frenar` como corresponda.
4. Desarrolla un código que compruebe que se cumple el LSP.

<p align=center>
  <img src="https://github.com/user-attachments/assets/6a362881-703d-4b39-8727-a04343715149"  />
</p>

### `Vehicle.php` 🚙

```php

class Vehicle
{
   private int $speed;
	
   public function __construct()
   {
	$this->speed = 0;
   }
	
   public function accelerate(int $increment)
   {
	$this->speed += $increment;
   }
	
   public function brake(int $decrement)
   {
	if($this->speed - $decrement >= 0)
	{
	   $this->speed -= $decrement;
	}else{
	   $this->speed = 0;
	}
   }
}

```


<img src="https://github.com/user-attachments/assets/81020006-5af2-4d75-a2f1-eed8b9f7e67e" height="300" />

### `Truck.php` 

```php

class Truck extends Vehicle
{
    private int $cargoWeight;
	
    public function __construct(int $cargoWeight)
    {
	parent::__construct();
	$this->cargoWeight = $cargoWeight;
    }

    // Aplicamos polimorfismo
    public function accelerate(int $increment)
    {
	if ($this->cargoWeight >= 1000) 
	{
	    $increment = (int)$increment / 2;
	}
		
	// Llama al método madre (Vehicle)
	 parent::accelerate($increment);
    }
}

```



### `Airplane.php` ✈️

<img src="https://github.com/user-attachments/assets/302c2a59-cb4e-4b28-820a-63622ce87b66" height="300" />


```php

class Airplane extends Vehicle
{
    private int $altitude;
    private int $fuel;

    public function __construct(int $fuel)
    {
	parent::__construct();
	$this->altitude = 0; // Empieza en tierra
	$this->fuel = $fuel;
    }

    public function accelerate(int $increment)
    {
	// Si hay poco combustible, reduce aceleración || el avión está a 10.000m de altitud
	if ($this->fuel < 500 || $this->altitude > 10000) 
	{
	    $increment = (int)$increment / 2;
	}

	parent::accelerate($increment);
	$this->fuel -= 100; // Reducir el combustible tras acelerar
    }

    public function ascend(int $altitudeGain)
    {
	$this->altitude += $altitudeGain;
    }

    public function descend(int $altitudeLoss)
    {
	if ($this->altitude - $altitudeLoss >= 0) {
	    $this->altitude -= $altitudeLoss;
	} else {
           $this->altitude = 0;
	}
    }

    public function altitude(): int
    {
        return $this->altitude;
    }

    public function fuelLevel(): int
    {
        return $this->fuel;
    }
}

```

## Comprobación del `LSP` con test ([truco](https://github.com/thaishdz/mastering-php/edit/main/SOLID/Liskov%20Substitution/#como-sé-que-estoy-violando-el-liskov))

```php

function test_vehicle(Vehicle $vehicle)
{
    $vehicle->accelerate(10);
    $vehicle->brake(5);
}

$plane = new Airplane(500);
$truck = new Truck(1000);


test_vehicle($truck); // 5
test_vehicle($plane); // 10

```

---

### Ayuditas 🛎️

- [Explicación ~ by Mouredev📺](https://www.youtube.com/watch?v=SgHoiF1KLTo)
