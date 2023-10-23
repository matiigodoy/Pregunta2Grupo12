<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getRandomQuestion()
    {
        $query = "SELECT * FROM question ORDER BY RAND() LIMIT 1";
        return $this->database->query($query);
    }

}