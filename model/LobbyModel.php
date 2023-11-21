<?php

class LobbyModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }

/*     public function getUserGender($username){
        $result=$this->database->uniqueQuery("SELECT gender FROM user WHERE username = '$username'");
        return $result['gender'];
    } */

}

?>