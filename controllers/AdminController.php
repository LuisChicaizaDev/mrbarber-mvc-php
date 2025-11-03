<?php 

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router) {

        // Verficar si el admin está autenticado
        isAdmin();

        //debuguear($_GET);
        // obtenemos la fecha de la url o genera la fecha del servidor del día de hoy
        $fecha = $_GET['fecha'] ?? date('Y-m-d'); 

        $fechas = explode('-', $fecha); // Separamos el string de la fecha por año-mes-dia

        // para validar la fecha de la url con checkdate(), devuelve true o false
        if (!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location: ' . BASE_URL . '/404');
        } 

        // Consultar la bbdd, para extraer los datos de la citas del cliente
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citas_servicios ";
        $consulta .= " ON citas_servicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citas_servicios.servicioId ";
        $consulta .= " WHERE fecha =  '$fecha' ";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION["nombre"],
            'citas' => $citas,
            'fecha' => $fecha,
        ]);
    }
}