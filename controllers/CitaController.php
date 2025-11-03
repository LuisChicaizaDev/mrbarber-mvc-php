<?php 

namespace Controllers;

use MVC\Router;

class CitaController {
    public static function index (Router $router) {
        // debuguear($_SESSION);

        // Antes de renderizar la vista, verificamos si está autenticado
        isAuth();

        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }
}