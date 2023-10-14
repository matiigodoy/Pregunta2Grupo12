<?php

class RegisterModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveUser($nameComplete, $birth, $gender, $country, $city, $mail, $nameUser, $photo, $pass)
    {
        $ret = false;

        if ($this->validateUser($mail, $nameUser)) {
            $query = "INSERT INTO usuario (Nombre_completo, Fecha_nacimiento, Genero, idPais, idCiudad, Mail, Nombre_usuario, Foto_perfil, Pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->database->prepare($query);
            $stmt->bind_param("sssiissss", $nameComplete, $birth, $gender, $country, $city, $mail, $nameUser, $photo, $pass);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $ret = true;
            }
        }
        return $ret;
    }

    public function validateUser($mail, $nameUser)
    {
        $query = "SELECT COUNT(*) AS count FROM usuario WHERE mail = ? OR nombre_usuario = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $mail, $nameUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return false;
            // El mail o el nombre ya existen en la base de datos
        } else {
            return true;
        }
    }

    public function validatePassword($pass, $passValidate)
    {
        return $pass === $passValidate;
    }

}