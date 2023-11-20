<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/Logger.php');

include_once('controller/RegisterController.php');
include_once('controller/LoginController.php');
include_once('controller/PartidaController.php');
include_once('controller/RankingController.php');
include_once('controller/PerfilController.php');

include_once('model/RegisterModel.php');
include_once('model/LoginModel.php');
include_once('model/PartidaModel.php');
include_once('model/RankingModel.php');
include_once('model/PerfilModel.php');

include_once('helpers/RegisterService.php');
include_once('helpers/LoginService.php');
include_once('helpers/PartidaService.php');
include_once('helpers/PerfilService.php');

include_once('third-party/mustache/src/Mustache/Autoloader.php');


class Configuration {
    private $configFile = 'config/config.ini';

    public function __construct() {
    }

    public function getRegisterController() {
        return new RegisterController( $this->getRegisterModel(), $this->getRegisterService(),$this->getRenderer());
    }
    public function getLoginController() {
        return new LoginController( $this->getLoginModel(), $this->getLoginService(),$this->getRenderer());
    }

    public function getPartidaController() {
        return new PartidaController($this->getPartidaModel(), $this->getPartidaService(), $this->getRenderer());
    }
    public function getRankingController() {
        return new RankingController( $this->getRankingModel(),$this->getRenderer());
    }
    public function getGraficadorController() {
        return new GraficadorController( $this->getGraficadorModel(),$this->getRenderer());
    }
    private function getArrayConfig() {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer() {
        return new MustacheRender('view/partial');
    }

    public function getDatabase() {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter() {
        return new Router(
            $this,
            "getRegisterController",
            "view");
    }
    public function getRegisterService() {
        return new RegisterService(
            $this->getRegisterModel()
        );
    }
    public function getRegisterModel()
    {
        return new RegisterModel($this->getDatabase());
    }
    public function getLoginService() {
        return new LoginService(
            $this->getLoginModel()
        );
    }
    public function getLoginModel()
    {
        return new LoginModel($this->getDatabase());
    }

    public function getPartidaService() {
        return new PartidaService(
            $this->getPartidaModel()
        );
    }

    public function getPartidaModel() {
        return new PartidaModel($this->getDatabase());
    }

    public function getRankingModel() {
        return new RankingModel($this->getDatabase());
    }
   
    public function getPerfilController() {
        return new PerfilController($this->getPerfilService(), $this->getRenderer());
    }

    public function getPerfilService() {
        return new PerfilService($this->getPerfilModel());
    }

    public function getPerfilModel() {
        return new PerfilModel($this->getDatabase());
    }

    private function getGraficadorModel()
    {
        return new GraficadorModel($this->getDatabase());
    }
}