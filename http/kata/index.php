<?php

require_once 'vendor/autoload.php';
require_once 'src/Pokemon.php';


/*
 * DIFICULTAD EXTRA (opcional):
 * Utilizando la PokéAPI (https://pokeapi.co), crea un programa por
 * terminal al que le puedas solicitar información de un Pokémon concreto
 * utilizando su nombre ✔️ o número ✔️
 * - Muestra el nombre, id, peso, altura y tipo(s) del Pokémon ✔️
 * - Muestra el nombre de su cadena de evoluciones ❓
 * - Muestra los juegos en los que aparece ✔️
 * - Controla posibles errores
 */


function getPokemonDataAPI(string|int $name): Pokemon
{
    //TODO: try-catch por si p.e falla la conexión al servidor
    $client = new \GuzzleHttp\Client();
    $HTTP_GET_METHOD = 'GET';
    $BASE_URL = "https://pokeapi.co/api/v2/pokemon/{$name}";

    $response = $client->request($HTTP_GET_METHOD, $BASE_URL);
    $pokemon_data = json_decode($response->getBody(), true); // 'true', convierte el JSON en un array asociativo

    return new Pokemon($pokemon_data);
}




$pokemon_1 = 'pikachu';
$pokemon_2 = 'charizard';
$pokemon_4 = 666;

$pokemon = getPokemonDataAPI($pokemon_1);

echo($pokemon);
