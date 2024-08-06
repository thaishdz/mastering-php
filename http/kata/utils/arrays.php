<?php

function arrayValuesToCommaString(array $target, array $keys): string
{
    
    $arrayResult = array_map(function($item) use ($keys)
    {
        return $item[$keys[1]];

    },array_column($target, $keys[0]));

    return implode(", ", $arrayResult); // convierte un array a string
}
