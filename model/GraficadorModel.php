<?php

class GraficadorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }



    public function getCantidaddeJugadores(){
        return $this->database->query("SELECT COUNT(*) FROM user");
    }
/*
    public function getPartidasJugadas(){
        return $this->database->query("SELECT COUNT(*) FROM user");
    }
*/
    public function getCantidadPreguntaseneljuego(){
        return $this->database->query("SELECT COUNT(*) FROM question");
    }

    public function getCantidadPreguntasCreadas(){
        return $this->database->query("SELECT COUNT(*) FROM question");
    }
    /*
    public function getCantidadUsuariosNuevos(){
        return $this->database->query("SELECT COUNT(*) FROM user");
    }
    */
    /*
    public function getPorcentajedePreguntasRespondidasCorrectamentePorUsuario(){
        return $this->database->query("SELECT COUNT(*) FROM user");
    }
    */
    public function getCantidadUsuariosPorPais($idCountry){
        return $this->database->query("SELECT COUNT(*) FROM question q where $idCountry=q.idCountry");
    }
    public function getCantidadUsuariosPorGenero($gender){
        return $this->database->query("SELECT COUNT(*) FROM question q where $gender=q.gender");
    }

    /*
    public function getCantidadUsuariosPorGrupodeEdad($grupo){
        return $this->database->query("SELECT COUNT(*) FROM question q where $grupo=q.grupo");
    }
    */

}