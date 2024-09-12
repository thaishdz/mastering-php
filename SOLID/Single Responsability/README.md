

# Single Responsability

- Principio orientado a objetos.
- La clase se tiene que encargar de UNA SOLA RESPONSABILIDAD.
- NO PUEDEN EXISTIR funcionalidades casi iguales (rollo que se solapen) dentro una misma clase.
- Debe tener una única razón para cambiar (significa que si la clase tiene más de una responsabilidad y cambia, se rompe la clase).


## User.php

```php

class User
{
  public function __construct(private string $name, private string $email) {}

  public function saveToDatabase()
  {
      # haz cosas
  }

  public function sendEmail()
  {

      # haz cosas
  }  
}
```

Para detectar si cumple el SRP, vamos a hacernos 2 preguntitas:

### 1. ¿La clase `User` qué metas tiene en la vida?

Creación de un usuario y ... no sé pa qué más.

### 2. ¿Cuántas responsabilidades tiene ahora mismo?
Parece que tiene 3:
   - Crear al usuario
   - Guardarlo en BBDD
   - Enviar un mail

... joder es la clase más Fullstack que he visto jamás, como le encasquetemos más mierda nos denuncia por burnout.

## Momento Deep Thinking 🤔

Entonces ...

- La responsabilidad de _crear un usuario_ tiene sentido como meta universal de la clase `User`, 👍 así que nos la quedamos.
- _Guardar en una BBDD_, es una responsabilidad algo más genérica, ¿no?, te da lo mismo guardar usuarios que pipas (qué ricas).
- _Enviar un mail_, más de lo mismo, qué más me da que sea el de un usuario, bien podría ser de otra cosa, de hecho APESTA QUE TE CAGAS a clase propia, con sus propiedades, destinario, asunto ... No me digas que no.

---

# SRP aplicado

## User.php
```php

class User
{
  public function __construct(private string $name, private string $email) {}
}

```

## UserRepository.php
```php

class UserRepository // Tiene que ver con el Repository Pattern 
{
  public function save(User $user) {}
}

```

## Email.php
```php

class EmailService
{
  public function send(Email $email, string $message) {}
}

```

Esto nos permite que si el día de mañana, un usuario 👦, tiene "30 funcionalidades asociadas", las estaremos modelando todas de manera independiente.

- `User` siempre estará acotada a la representación de un usuario y yatáh.
- `UserRepository` tendrá la responsabilidad de tocar la base de datos para operaciones que tengan que ver con el usuario y yatáh.
- `EmailService` tendrá la responsabilidad de mandar mails o a las tareas relacionadas con mailing y yatáh.



## Ayuditas 🛎️

- [Single Responsability ~ Mouredev 📺](https://www.youtube.com/watch?v=ASBC5drF-QU)
- [Single Responsability ~ Secture 📰](https://secture.com/blog/principios-solid-single-responsibility/)
