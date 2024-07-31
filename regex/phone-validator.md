# Validar un teléfono 

```
/\+\d{1,3}[\s.-]?\d{1,4}[\s.-]?\d{1,4}[\s.-]?\d{1,9}/
```

## Explicación
- `\+`: Coincide con el signo + (recuerda que como está fuera de `[]` se tiene que poner \ para especificar que es un `+` literal).
- `\d{1,3}`: Coincide con el código de país de 1 a 3 dígitos.
- `[ -]?`: Permite un espacio o guion opcional después del código de país.
- `\(?\d{1,4}\)?`: Permite opcionalmente paréntesis alrededor del código de área o grupo inicial de dígitos.
- `[ -]?`: Permite un espacio o guion opcional entre grupos de dígitos.
- `\d{1,4}`: Coincide con grupos de dígitos de 1 a 4 dígitos.
- `[ -]?`: Permite un espacio o guion opcional entre grupos de dígitos.
- `\d{1,9}`: Coincide con el resto del número, de hasta 9 dígitos.

Esta expresión regular debería capturar números en los siguientes formatos:
```
+1 212 456 7890
+1-212-456-7890
+1(212)456-7890
+44 20 7946 0958
+34 911 123 456
+49 (0) 170 1234567
```
