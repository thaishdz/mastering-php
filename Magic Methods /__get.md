# `__get()` - No es lo mismo que un getter ⚠️

- `__get()` __recibe un único parámetro__, que es la propiedad a la que se quiere acceder.

- Definir `__get` nos __permitirá acceder desde fuera del objeto y "de forma genérica" a cualquier propiedad del mismo__ ...

✨independientemente de que si está declara como `private` o `protected`✨
![image](https://github.com/user-attachments/assets/5cdbbc5f-f4b0-4fb7-82ef-51a187cf185f)


- Hay que ser cuidadosos en su implementación ya que, es como si __hubiéramos declarado todos los atributos como públicos__, perdiendo así las ventajas de la ocultación o encapsulamiento.
  
- Este método es reemplazado por los llamados métodos __getters__, que nos permiten “individualizar” los accesos a un atributo.

- La buena práctica *(no sé yo Rick 🤨)*, sería definir mediante `getters` los accesos a los atributos del objeto evitando declarar el método `__get` que definiría el acceso general a todos los atributos privados o no declarados.
