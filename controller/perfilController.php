<?php
class PerfilController {
    private $perfilService;
    private $renderer;

    public function __construct($perfilService, $renderer) {
        $this->perfilService = $perfilService;
        $this->renderer = $renderer;
    }

    public function view($usuarioID) {
        // aca tomo datos del perfil del usuario desde el servicio
        $perfilData = $this->perfilService->obtenerPerfil($usuarioID);
    
        // renderiza la vista con los datos del perfil.
        $this->renderer->render("verPerfil", $perfilData);
    }
}
?>
