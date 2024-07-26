<?php

class LaMejorException extends Exception {}

function check_parameters($input)
{
    if (!is_array($input)) {
       // lanzada si un argumento no es del tipo previsto.
       throw new InvalidArgumentException("Error: Tienes que pasar un array \n"); 
    }

   if (count($input) < 5)
   {
       throw new Exception("Error: La longitud no puede ser < 5 \n");
   } 
   
   if($input[0] != 2)
   {
       throw new LaMejorException("Error: El primer elemento no es un 2 \n");
   }

}


try {
    check_parameters([1, 2, 3, 6, 9]);
    echo "0 Errores \n";
  
} catch (LaMejorException $e) {
    echo $e->getMessage();
  
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
  
} catch (Exception $e) {
    echo $e->getMessage();
  
} finally {
    echo "Ejecución Finalizada";
}
