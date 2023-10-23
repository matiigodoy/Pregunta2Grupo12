<?php

class PartidaService
{
    private $model;
    public function __construct($model){
        $this->model= $model;
    }

    public function getRandomQuestion()
    {
        return $this->model->getRandomQuestion();
    }

}