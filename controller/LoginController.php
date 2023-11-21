<?php

class LoginController{

    private $loginModel;
    private $loginService;
    private $renderer;
    private $sessionControl;

    public function __construct($model, $service, $renderer, $sessionControl) {
        $this->loginModel = $model;
        $this->loginService = $service;
        $this->renderer = $renderer;
        $this->sessionControl = $sessionControl;
    }

    public function view() {
        $data = [];
        $this->renderer->render("login", $data);
    }

    public function loginSession(){
        if ($this->sessionControl->get('idUser') == null) {
            $userNameForm = ucfirst(strtolower($_POST['user']));
            $pass = md5($_POST['pass']);

            $userConnected = $this->loginModel->getUserByNameAndPass($userNameForm, $pass);

            if (sizeof($userConnected) == 1) {
                $this->setUserSession($userConnected);
                $idRol = $this->sessionControl->get("idRol");
                $this->userRolControl($idRol);
            } else {
                $this->redirectHome();
            }
        }
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

    public function validateEmail(){
        $hash = $_GET["hash"];
        $hashBD = $this->loginModel->getUserHash($hash);

        if ($hash == $hashBD) {
            $this->loginModel->setUserRolHash($hashBD);
            $data = [];
            $this->renderer->render("accountOK", $data);
        } else {
            header("Location: /registro");
        }
        exit();
    }

    private function setUserSession($user){
        $this->sessionControl->set("username", $user[0]['username']);
        $this->sessionControl->set("idUser", $user[0]["Id"]);
        $this->sessionControl->set("idRol", $user[0]["Id_rol"]);
    }

    private function userRolControl($idRol): void
    {
        switch ($idRol) {
            case 0:
                $this->redirectIndex();
                break;
            case 1:
                $this->sessionControl->set('admin', true);
                $this->redirectLobby();
                break;
            case 2:
                $this->sessionControl->set('edit', true);
                $this->redirectLobby();
                break;
            case 3:
                $this->sessionControl->set('player', true);
                $this->redirectLobby();
                break;
            default:
                $this->redirectIndex();
                break;
        }
    }

    private function redirectIndex(){
        header("Location: /");
        exit();
    }
    private function redirectLobby(){
        header("Location: /lobby");
        exit();
    }

}

?>