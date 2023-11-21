<?php

class LoginModel {
    private $database;
    
    public function __construct($database){
        $this->database = $database;
    }

    public function validateCredentials($username, $password){
        $query = "SELECT id FROM user WHERE username = ? AND password = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows;
        $stmt->close();

        return $count > 0;
    }

    public function getUserHash($hash){
        $result= $this->database->uniqueQuery("SELECT Hash FROM user WHERE Hash = '$hash' ");
        return $result['Hash'];
    }

    public function getUserByNameAndPass($user, $pass){
        return $this->database->query("SELECT * FROM user WHERE username = '$user' and password_hash = '$pass'");
    }

    public function setUserRolHash($hash){
        $this->database->update("UPDATE user SET Id_rol = 3 WHERE Hash = '$hash'");
    }
}

?>