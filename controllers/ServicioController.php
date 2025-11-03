<?php 

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {

    public static function index (Router $router) {
        // Autenticamos que sea admin
        isAdmin();

        // Extraemos todos los servicios
        $servicios = Servicio::all();

        
        // Leer mensaje de éxito (si existe) y borrarlo
        $mensaje_exito = $_SESSION['mensaje_exito'] ?? null;
        unset($_SESSION['mensaje_exito']);

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios,
            'mensaje_exito' => $mensaje_exito,
        ]);
    }

    // Para crear el servicio
    public static function crear (Router $router) {

        isAdmin();

        // Instanciamos para tener el objeto
        $servicio = new Servicio;
        $alertas = [];
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Con este método el objeto asigna los datos del POST al objeto existente 
            $servicio->sincronizar($_POST);

            // validamos los campos
            $alertas = $servicio->validar();

            // Si no hay errores, creamos el servicio
            if (empty($alertas)) {
                $servicio->guardar(); 

                $_SESSION['mensaje_exito'] = 'Tu servicio se <strong>ha creado</strong> correctamente';

                header('Location: ' . BASE_URL .'/servicios');
            }
        }

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
        ]);
    }

    // Para actualizar el servicio
    public static function actualizar (Router $router) {

        isAdmin();
       
        // validamos que el id sea un numero
        if (!is_numeric($_GET['id'])) return;

        // Instanciamos el servicio para buscar por id
        $servicio = Servicio::find($_GET['id']);

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sincronizamos con los datos de POST
            $servicio->sincronizar($_POST);

            $alertas= $servicio->validar();
            
            if(empty($alertas)) {
                $servicio->guardar();

                $_SESSION['mensaje_exito'] = 'Tu servicio se <strong>ha actualizado</strong> correctamente';

                header('Location: ' . BASE_URL . '/servicios');
            }
        }

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas,
        ]);
    }

    // Para eliminar el servicio
    public static function eliminar () {

        isAdmin();
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            // buscamos el servicio a eliminar
            $servicio = Servicio::find($id);

            // debuguear($servicio);

            $servicio->eliminar();

            $_SESSION['mensaje_exito'] = 'Tu servicio se <strong>ha eliminado</strong> correctamente';
            
            header('Location: ' . BASE_URL . '/servicios');

        }
    }
}