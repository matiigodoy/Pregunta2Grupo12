<?php

class RankingModel
{

    private $database;

    public function __construct($database){
        $this->database=$database;
    }

    public function getNameAndScoreByPositionOfUsers(){
        return $this->database->queary('SELECT fullname, score,
       (SELECT COUNT(*) + 1 FROM usuario AS u2 WHERE u2.Puntaje_max > u1.Puntaje_max) AS Posicion 
        FROM usuario as u1 
        ORDER BY score DESC;');
    }

}