<?php

class RegisterController {
    private $registerModel;
    private $registerService;
    private $renderer;

    public function __construct($model, $service, $renderer)
    {
        $this->registerModel = $model;
        $this->registerService = $service;
        $this->renderer = $renderer;
    }

    public function view()
    {
        $data['mapa'] = true;
        $this->renderer->render("register", $data);
    }

    public function newUser()
    {
        if (isset($_POST["nombre"], $_POST["fecha_nacimiento"], $_POST["genero"], $_POST["pais"], $_POST["ciudad"], $_POST["correo"], $_POST["nombre_usuario"], $_POST["contrasenia"], $_POST["confirmar_contrasenia"])) {
            $formData = $_POST;

            if (isset($_FILES['foto_perfil']) && isset($_FILES['foto_perfil']['name'])) {
                $formData['foto_perfil']['name'] =  $_FILES['foto_perfil']['name'];
            }

            $result = $this->registerService->receiveRegistrationForm($formData);

            if ($result === true) {
                $this->renderRegistrationSuccess();
            } else {
                $this->renderRegistrationError($result);
            }
        } else {
            $data["message"] = "Por favor, completa todos los campos. Solo es opcional la imagen de perfil.";
            $data['showMessage'] = true;
            $this->renderer->render("register", $data);
            Logger::info;
        }
    }

    private function renderRegistrationSuccess()
    {
        $data = [];
        $this->renderer->render("registerOK", $data);
    }

    private function renderRegistrationError($message)
    {
        $data["message"] = $message;
        $data['showMessage'] = true;
        $data['mapa'] = true;
        $this->renderer->render("register", $data);
        Logger::info('Ejecutando query: ' . $message);
    }
}