<?php

class LoginService {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function verifyUser($formData) {
        $username = $formData["nombre_usuario"];
        $password = $formData["contrasenia"];

        if($this->model->validateCredentials($username, $password)){
            return true;
        } else {
            return "Usuario y/o contraseña inválidos. Intente nuevamente";
        }
    }
}

?>