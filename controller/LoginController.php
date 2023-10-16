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

    public function verify() {
        if(isset($_POST["nombre_usuario"], $_POST["contrasenia"])) {
            $formData = $_POST;

            $result = $this->loginService->verifyUser($formData);

            if($result === true) {
                //Reemplazar destino
                header("Location: index.php");
                exit();
            } else {
                $data["message"] = "Usuario y/o contraseña inválidos. Vuelva a intentar.";
                $data["showMessage"] = true;
                $this->renderer->render("login", $data);
            }
        } else {
            $data["message"] = "Faltó completar uno o más campos. Por favor, vuelva a intentar.";
            $data["showMessage"] = true;
            $this->renderer->render("login", $data);
        }
    }

}

?>