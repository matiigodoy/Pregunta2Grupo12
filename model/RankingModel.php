<?php

class RankingModel
{

    private $database;

    public function __construct($database){
        $this->database=$database;
    }

    public function getNameAndScoreByPositionOfUsers(){
        return $this->database->query('SELECT fullname, score, username,
       (SELECT COUNT(*) + 1 FROM user AS u2 WHERE u2.score > u1.score) AS Posicion 
        FROM user as u1 
        ORDER BY score DESC;');
    }

}