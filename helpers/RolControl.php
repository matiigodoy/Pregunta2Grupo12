<?php

class RolControl {

    private $rolIni = 'config/user-rol.ini';

    private function getConfig(){
        return parse_ini_file($this->rolIni, true);
    }

    public function getAccessRol($id, $module, $method){
        $arrayRol = $this->getConfig();

        if (array_key_exists($id, $arrayRol)) {
            $validControllers = $arrayRol[$id];
        if (array_key_exists($module, $validControllers)) {
            $validMethods = $validControllers[$module];
        if (in_array($method, $validMethods)) {
                return true;
            }
        }
    }
    return false;
    }

}

?>