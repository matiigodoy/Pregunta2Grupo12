<?php

class RegisterService
{
    private $model;
    public function __construct($model){
        $this->model= $model;
    }
    public function receiveRegistrationForm($formData)
    {
        $data = [];
        $nameComplete = $formData["nombre"];
        $birth = $formData["fecha_nacimiento"];
        $gender = $formData["genero"];
        $country = $formData["pais"];
        $city = $formData["ciudad"];
        $mail = $formData["correo"];
        $nameUser = $formData["nombre_usuario"];
        $pass = $formData["contrasenia"];
        $passValidate = $formData["confirmar_contrasenia"];
        $photo = null;

        if ($formData['foto_perfil']['name']) {
            $photo = basename($formData['foto_perfil']['name']);
            $imagePath = "./public/images/" . $photo;
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $imagePath);
        }
        if (!$this->validatePassword($pass, $passValidate)) {
            return "Las contraseñas no coinciden. Intentá de nuevo.";
        } else {
            if (!$this->createAccount($pass, $nameComplete, $birth, $gender, $country, $city, $mail, $nameUser, $photo)) {
                return "El usuario ya está registrado. Prueba con otro nombre o correo electrónico.";
            } else {
                return true;
            }
        }
    }

    private function createAccount($pass, $nameComplete, $birth, $gender, $country, $city, $mail, $nameUser, $photo)
    {
        {
            if ($this->model->saveUser($nameComplete, $birth, $gender, $country, $city, $mail, $nameUser, $photo, $pass)) {
                return true;
            }
        }
        return false;
    }

    private function validatePassword($pass, $passValidate)
    {
        return $this->model->validatePassword($pass, $passValidate);
    }

}