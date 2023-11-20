<?php

class SugerirpreguntaController{

    //Joaquin

    private $PreguntaModel;
    private $renderer;

    public function __construct($model, $renderer )
    {
        $this->PreguntaModel = $model;
        $this->renderer = $renderer;
    }


    public function view()
    {
        $data = [];
        $this->renderer->render("sugerirpregunta",$data);
    }

    public function agregarpregunta(){
        $required = ['idcategoria', 'description', 'option_1', 'option_2', 'option_3', 'option_4', 'correct_option'];
        $errorMessage = "Error: Todos los campos son obligatorios";

        foreach ($required as $field) {
            if (!isset($_POST[$field])) {
                echo $errorMessage;
                return;
            }
        }
        $idCategoria = $_POST['idcategoria'];
        $description = $_POST['description'];
        $option_1 = $_POST['option_1'];
        $option_2 = $_POST['option_2'];
        $option_3 = $_POST['option_3'];
        $option_4 = $_POST['option_4'];
        $correct_option = $_POST['correct_option'];

        if (!$this->PreguntaModel->searchQuestionByDescription($description)) {
            $this->PreguntaModel->addQuestion( $idCategoria, $description, $option_1, $option_2, $option_3, $option_4, $correct_option);
        }else{
            $errorMessage = "Error: Esa Pregunta ya existe";
            echo $errorMessage;
            exit();
        }

    }


}