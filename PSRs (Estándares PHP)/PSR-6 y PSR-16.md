

# PSR-6: Caching Interface (Status: Accepted)
La __caché__ es la forma más común de mejorar el rendimiento de cualquier proyecto, por esto mismo, las librerías de caché son una de las características más comunes en frameworks y librerías de uso general.

## Problema
La variedad existente de librerías de __caché__ en la que cada una implementaba su propia forma de uso, creó una dificultad extra tanto a los desarrolladores que las mantenían como a los que las utilizaban. A los que las mantenían porque tenían que decidir si querían desarrollar para un grupo reducido de frameworks o adaptarse a muchos. Para los que las usaban, porque tenían que aprenderse la manera concreta en la que funcionaba cada una.

De esa dispersión de librerías y definiciones : ✨ nació la necesidad de definir `PSR-6` ✨, cuya pretensión y objetivo era crear una *`interface`* común para el desarrollo y uso de sistemas de caché sin necesidad de desarrollos personalizados. 
> De manera que si quieres desarrollar una librería de caché y quieres seguir el estándar, deberías implementar PSR-6 y si vas a usar una librería de caché, asegúrate de que lo cumple.



# PSR-16: Simple Cache (Status: Accepted)
Como se comentó anteriormente con el estándar `PSR-6`, la __caché__ es la forma más común de mejorar el rendimiento en cualquier aplicación. 

Esto implica que las librerías de caché son una de las características más extendidas entre muchos frameworks y librerías. 

`PSR-6` ya soluciona en parte este problema, pero de una manera muy formal y detallada que dificulta el uso en casos de uso más simples. 

`PSR-16` es independiente de `PSR-6` pero ha sido diseñado para que la compatiblidad sea lo más sencilla posible.

> Este estándar define una *`interface`* más simple, para casos comunes, para implementar un driver y un elemento de caché.

Las implementaciones finales que cada uno desarrolle pueden decorar los objetos con más funcionalidad pero deben implementar la funcionalidad del interface en primer lugar.
