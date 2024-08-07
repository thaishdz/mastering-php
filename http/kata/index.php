<?php

require_once 'vendor/autoload.php';
require_once 'src/Pokemon.php';

use GuzzleHttp\Exception\RequestException;

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


 /*
 * TODO: 
 * Preguntar chatgpt qué es PSR7
 * 
*/


$client = new \GuzzleHttp\Client([
    "base_uri" => "https://pokeapi.co/api/v2/",
    "timeout"  => 5.0 // 5 sg
]);

function fetchPokemonData(string|int $identifier): Pokemon
{
    global $client;
    $ENDPOINT = "pokemon/{$identifier}";
    try {
        $response = $client->request('GET', $ENDPOINT);
        $evolutionChain = getEvolutionChain($identifier);
        $pokemon_data = json_decode($response->getBody(), true); // 'true', convierte el JSON en un array asociativo

        return new Pokemon($pokemon_data);
    } catch (RequestException $e) {
        echo "RequestException " . $e->getMessage();
    }

}


function getEvolutionChain(string|int $identifier): array
{
    global $client;
    $ENDPOINT = "pokemon-species/{$identifier}";

    try {
        $response = $client->request('GET', $ENDPOINT);
        $evolutionResponse = json_decode($response->getBody(),true);
        $evolutionChainURI = $evolutionResponse["evolution_chain"]["url"];

        $response = $client->request('GET', substr($evolutionChainURI, -18));
        $evolutionChain = json_decode($response->getBody(), true));
        //TODO: devolver array con evoluciones
        return [];
    } catch (RequestException $e) {
        echo "RequestException " . $e->getMessage();
    }
}


$input = readline('Search Pokemon: '); // Recoge el nombre o el id del pokémon por CLI
$pokemon = fetchPokemonData($input);

echo($pokemon);
