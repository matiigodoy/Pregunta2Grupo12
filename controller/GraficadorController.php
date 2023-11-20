<?php

class GraficadorController
{

    private $graficadorModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->$graficadorModel = $model;
        $this->renderer = $renderer;
    }

    public function view() {

        $dataGenero =   $GraficadorModel->getCantidadUsuariosPorGenero();
        $dataCountry =  $GraficadorModel->getCantidadUsuariosPorPais();

        $data["imagePathGenre"]= $this->graficoUserByGenre($dataGenero);
        $data["imagePathCountry"]=$this->graficoUserByCountry($dataCountry);

        $data = [];
        $this->renderer->render("graficador", $data);
    }


    public function playersGraph()
    {



        $tabla=$this->adminModel->getPrintTotalUsersByGenre();
        $this->renderer->render("graph", $data);
    }


}