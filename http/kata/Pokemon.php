<?php

require_once(__DIR__ . '/../utils/arrays.php');

class Pokemon
{
    private int $id;
    private string $name;
    private int $weight;
    private int $height;
    private array $types;
    private array $gamesIndices;
    private ?array $evolutionChain;


    public function __construct(array $data)
    {
        $this->id                   = $data['id'];
        $this->name                 = $data['name'];
        $this->weight               = $data['weight'];
        $this->height               = $data['height'];
        $this->types                = $data['types'];
        $this->gamesIndices         = $data['game_indices'];
        $this->evolutionChain       = $data['evolution_chain'] ?? []; // evalúa que exista la key "evolution_chain", si no, pone []

    }


    function id() : int 
    {
        return $this->id;
    }

    function name() : string 
    {
        return $this->name;
    }

    function weight() : int 
    {
        return $this->weight;
    }

    function height() : int 
    {
        return $this->height;
    }

    function types() : array 
    {
        return $this->types;
    }

    function gamesIndices() : array 
    {
        return $this->gamesIndices;
    }

    function evolutionChain() : array 
    {
        return $this->evolutionChain;
    }

    function hasEvolution() : bool 
    {
        return empty($this->evolutionChain); // TRUE está vacío, FALSE NO está vacío 👍
    }

    private function formatTypesToString() : string 
    {
        return arrayValuesToCommaString($this->types, ["type","name"]);
    }

    private function evolutionChainSummary() : string 
    {
        if ($this->hasEvolution()) {
            return 'No Evolutions';
        }
        $evolutionDetails = array_map(function ($evolution) 
        {
            return $evolution["name"] . " (lv. {$evolution['min_level']})";
        },
        $this->evolutionChain);
        
        return implode(", ", $evolutionDetails);
    }

    private function appearanceInGames() : string 
    {
        return arrayValuesToCommaString($this->gamesIndices, ["version","name"]);
    }

    function __toString(): string 
    {   
        $types                  = $this->formatTypesToString();
        $gamesSummary           = $this->appearanceInGames();
        $evolutionChainSummary  = $this->evolutionChainSummary();
        return "
                ID:         $this->id               \n
                Name:       $this->name             \n
                Weight:     $this->weight           \n
                Height:     $this->height           \n
                Types:      $types                  \n  
                Evolutions: $evolutionChainSummary  \n       
                Appears in: $gamesSummary           \n";
    }
}
