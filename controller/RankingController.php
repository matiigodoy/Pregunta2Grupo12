<?php

class RankingController
{
    private $rankingModel;
    private $renderer;

    public function __construct($model, $renderer){
        $this->rankingModel = $model;
        $this->renderer=$renderer;
    }

    public function view(){

        $data['users']=$this->rankingModel->getNameAndScoreByPositionOfUsers();
        $this->renderer->render("ranking",$data);

    }



}