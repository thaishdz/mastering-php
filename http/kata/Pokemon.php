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


    public function __construct(array $data)
    {
        $this->id           = $data['id'];
        $this->name         = $data['name'];
        $this->weight       = $data['weight'];
        $this->height       = $data['height'];
        $this->types        = $data['types'];
        $this->gamesIndices = $data['game_indices'];

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

    function __toString(): string 
    {   
        $types = arrayValuesToCommaString($this->types, ["type","name"]);
        $games = arrayValuesToCommaString($this->gamesIndices, ["version","name"]);

        return "
                ID:         $this->id       \n
                Name:       $this->name     \n
                Weight:     $this->weight   \n
                Height:     $this->height   \n
                Types:      $types          \n
                Appears in: $games          \n";
    }
}
