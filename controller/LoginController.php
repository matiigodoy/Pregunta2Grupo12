<?php

class LoginController{

    private $loginModel;
    private $loginService;
    private $renderer;

    public function __construct($model, $service, $renderer) {
        $this->loginModel = $model;
        $this->loginService = $service;
        $this->renderer = $renderer;
    }

    public function view() {
        $data = [];
        $this->renderer->render("login", $data);
    }

    public function authenticate() {
        if(isset($_POST["nombre_usuario"], $_POST["contrasenia"])) {
            $formData = $_POST;

            $result = $this->loginService->verifyUser($formData);

            if($result === true) {
                //header("Location: index.php");
                $this->renderLoginSuccess();
            } else {
                $this->renderLoginError($result);
            }
        } else {
            $data["message"] = "Faltó completar uno o más campos. Por favor, vuelva a intentar.";
            $data["showMessage"] = true;
            $this->renderer->render("login", $data);
        }
    }

    private function renderLoginSuccess()
    {
        $data = [];
        $this->renderer->render("loginOK", $data);
    }
    private function renderLoginError($message)
    {
        $data["message"] = $message;
        $data['showMessage'] = true;
        $data['mapa'] = true;
        $this->renderer->render("login", $data);
    }

}

?>