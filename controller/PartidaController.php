<?php

class PartidaController {
    private $partidaModel;
    private $partidaService;
    private $renderer;

    public function __construct($model, $service, $renderer)
    {
        $this->partidaModel = $model;
        $this->partidaService = $service;
        $this->renderer = $renderer;
    }

    public function view()
    {
        $data[] = true;
        $this->renderer->render("partida", $data);
    }

    public function newGame()
    {
        $this->renderer->render("game");
    }

    public function getQuestion()
    {
        $question = $this->partidaService->getRandomQuestion();
        echo json_encode($question[0]);
    }

}