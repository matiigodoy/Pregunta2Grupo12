<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/Logger.php');
include_once('helpers/perfilService.php');

include_once('controller/RegisterController.php');
include_once('controller/LoginController.php');
include_once('controller/perfilController.php');

include_once('model/RegisterModel.php');
include_once('model/LoginModel.php');
include_once('model/perfilModel.php');

include_once('helpers/RegisterService.php');
include_once('helpers/LoginService.php');

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

   
    public function getPerfilController() {
        return new perfilController($this->getPerfilService(), $this->getRenderer());
    }

    public function getPerfilService() {
        return new perfilService($this->getPerfilModel());
    }

    public function getPerfilModel() {
        return new perfilModel($this->getDatabase());
    }


}