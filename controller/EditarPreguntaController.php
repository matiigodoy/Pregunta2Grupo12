<?php

class EditarPreguntaController
{
    private $PreguntaModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->PreguntaModel = $model;
        $this->renderer = $renderer;
    }

    public function view()
    {
        $idQuestion=$_POST["id"];

        if ($idQuestion !== null){
            $data['pregunta'] =  $this->questionModel->searchQuestionById($idQuestion);
        }
        $this->renderer->render("editarpregunta", $data);
    }

    public function editarpregunta()
    {
        $required = ['id', 'description', 'idcategoria', 'option_1', 'option_2', 'option_3', 'option_4', 'respuestaCorrecta'];
        $errorMessage = "Error: Todos los campos son obligatorios";


        foreach ($required as $field) {
            if (!isset($_POST[$field])) {
                echo $errorMessage;
                return;
            }
        }

        $id = $_POST['id'];
        $description = $_POST['description'];
        $idcategoria = $_POST['idcategoria'];
        $option_1 = $_POST['option_1'];
        $option_2 = $_POST['option_2'];
        $option_3 = $_POST['option_3'];
        $option_4 = $_POST['option_4'];
        $correct_option = $_POST['correct_option'];

        $this->questionModel->editQuestion($id, $description, $idcategoria, $option_1, $option_2, $option_3, $option_4, $correct_option);




}
}