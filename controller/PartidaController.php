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
        $question = $this->partidaService->getRandomQuestion();
        $this->renderNewGame($question);
    }

    private function renderNewGame($question)
    {

        //$data['question'] = $question[0]['description'];
        $data['question'] = $question[0];
        $this->renderer->render("game", $data);
    }
}