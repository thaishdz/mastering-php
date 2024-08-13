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
 * - Muestra el nombre de su cadena de evoluciones ✔️
 * - Muestra los juegos en los que aparece ✔️
 * - Controla posibles errores 
 */


 //IDEA: Este index dejarlo únicamente para hacer las requests

$client = new \GuzzleHttp\Client([
    "base_uri" => "https://pokeapi.co/api/v2/",
    "timeout"  => 5.0 // 5 sg
]);

//REFACTOR: Esta función hace una apicall y construye el objeto pokemon, divídela
function fetchPokemonData(string|int $identifier): Pokemon
{
    global $client;
    $ENDPOINT = "pokemon/{$identifier}";
    try {
        $response = $client->request('GET', $ENDPOINT);
        $evolutionChain = getEvolutionChain($identifier);
        $pokemonData = json_decode($response->getBody(), true); // 'true', convierte el JSON en un array asociativo
        $pokemonData['evolution_chain'] = $evolutionChain;
        return new Pokemon($pokemonData);

    } catch (RequestException $e) {
        echo "RequestException " . $e->getMessage();
    }

}

//DUDA: esta función podría considerarse de un servicio pokemon?
function getEvolutionChain(string|int $identifier): array
{
    global $client;
    $ENDPOINT = "pokemon-species/{$identifier}";
    $baseUriObject = $client->getConfig('base_uri');
    $evolutionData = [];

    try {
        $response = $client->request('GET', $ENDPOINT);
        $evolutionPokemonSpeciesResponse = json_decode($response->getBody(),true);

        $namePokemonBase = $evolutionPokemonSpeciesResponse["name"];

        //Refactor : Extraer a una función donde se haga la petición a la API
        $evolutionChainURI = $evolutionPokemonSpeciesResponse["evolution_chain"]["url"];

        $endpointEvolutionChain = str_replace((string)$baseUriObject, '', $evolutionChainURI);
        $response = $client->request('GET', $endpointEvolutionChain);
        $evolutionChainResponse = json_decode($response->getBody(), true);

        if(hasEvolution($evolutionChainResponse)) {
            $evolutionData[] = firstEvolution($evolutionChainResponse);
            $evolutionData[] = secondEvolution($evolutionChainResponse);
            return $evolutionData;
        }

        return [];

    } catch (RequestException $e) {
        echo "RequestException " . $e->getMessage();
    }
}

//TODO: Considerar crear la clase Evolution 

function hasEvolution(array $evolutionChain)
{
    if (!$evolutionChain["chain"]["evolves_to"]) {
        return false;
    }

    return true;
}

function firstEvolution(array $evolutionChainResponse) : array 
{
    $nameEvolution  = $evolutionChainResponse["chain"]["evolves_to"][0]["species"]["name"];
    $minLevel       = $evolutionChainResponse["chain"]["evolves_to"][0]["evolution_details"][0]["min_level"];
    return createEvolutionEntry(
        'first', 
        $nameEvolution, 
        $minLevel
    );
}

function secondEvolution(array $evolutionChainResponse) : array 
{
    $nameEvolution  = $evolutionChainResponse["chain"]["evolves_to"][0]["evolves_to"][0]["species"]["name"];
    $minLevel       =  $evolutionChainResponse["chain"]["evolves_to"][0]["evolves_to"][0]["evolution_details"][0]["min_level"];
        
    if ($nameEvolution) {
        return createEvolutionEntry(
            'second',
            $nameEvolution,
            $minLevel
        );
    }
    return [];
}

function createEvolutionEntry(string $type = '', string $name = '', int $minLevel = 0) : array 
{
    return [
        'type'      => $type, 
        'name'      => $name,
        'min_level' => $minLevel
    ]; 
}


$input = readline('Search Pokemon: '); // Recoge el nombre o el id del pokémon por CLI
$pokemon = fetchPokemonData($input);

echo($pokemon);
