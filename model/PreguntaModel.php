<?php

class PreguntaModel
{
    //Joaquin

    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getSuggestedQuestions(){
        return $this->database->query("SELECT * FROM question WHERE id_estado = 1");
    }
    public function getAcceptedQuestions(){
        return $this->database->query("SELECT * FROM question WHERE id_estado = 2");
    }
    public function getRepportQuestions(){
        return $this->database->query("SELECT * FROM question WHERE id_estado = 3");
    }
    public function setAcceptQuestion($id){
        $this->database->update("UPDATE question SET id_estado = 2 WHERE id = '$id'");
    }
    public function declineQuestion($id){
        $this->database->update("DELETE FROM question WHERE id = '$id'");
    }

    public function editQuestion($id, $description, $id_categoria, $option_1, $option_2, $option_3, $option_4, $correct_option){
        $this->database->update("UPDATE question SET description = '$description', id_categoria = '$id_categoria', 
                    option_1 = '$option_1', option_2 = '$option_2', option_3 = '$option_3', option_4 = '$option_4', correct_option='$correct_option' WHERE id = '$id'");
    }


    public function addQuestion($idCategoria, $description, $option_1, $option_2, $option_3, $option_4, $correct_option)
    {
        $idEstado = 0;

        $query = "INSERT INTO question (id_estado, id_categoria, description, option_1, option_2, option_3, option_4, correct_option)
              VALUES ($idEstado, $idCategoria, '$description', '$option_1', '$option_2', '$option_3', '$option_4', '$correct_option')";

        $this->database->update($query);
    }


    public function searchQuestionById($id){
        return $this->database->query("SELECT * FROM question WHERE id = '$id'");
    }


    public function searchQuestionByDescription($description){
        return $this->database->query("SELECT * FROM question WHERE description = '$description'");
    }

}