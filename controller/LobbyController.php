<?php

class LobbyController
{
    private $lobbyModel;
    private $renderer;
    private $sessionControl;

    public function __construct($model, $renderer, $sessionControl){
        $this->lobbyModel = $model;
        $this->renderer = $renderer;
        $this->sessionControl = $sessionControl;
    }

/*     public function view() {
        $data = $this->prepareData();
        $this->renderer->render("lobbyPlayer", $data);
    } */

    public function view(){
        $data = $this->prepareData();

        if ($this->sessionControl->get('edit') !== null){
            $this->renderEditorLobby($data);
        }

        if ($this->sessionControl->get('player') !== null){
            $this->renderPlayerLobby($data);
        }

        if ($this->sessionControl->get('admin') !== null){
            $this->renderAdminLobby($data);
        }
    }

    private function prepareData(){
        $username = $this->sessionControl->get("username");

        $data['welcome'] = $this->getWelcome();
        $data['username'] = $username;

        return $data;
    }

    private function getWelcome(){
        $result = 'Te damos la bienvenida!';
        return $result;
    }

    private function renderEditorLobby($data){
        $this->renderer->render("lobbyEditor", $data);
    }

    private function renderPlayerLobby($data){
        $this->renderer->render("lobbyPlayer", $data);
    }

    private function renderAdminLobby($data){
        $this->renderer->render("lobbyAdmi", $data);
    }

}

?>